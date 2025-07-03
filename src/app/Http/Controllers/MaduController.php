<?php

namespace App\Http\Controllers;

use App\Models\Madu;
use App\Models\OrderMadu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaduController extends Controller
{
    /**
     * Display a listing of the honey products.
     */
    public function index()
    {
        $madus = Madu::where('stock', '>', 0)->get();
        return view('madu.index', compact('madus'));
    }

    /**
     * Display a listing of all honey products for admin.
     */
    public function adminIndex()
    {
        $madus = Madu::withTrashed()->get();
        return view('admin.madu.index', compact('madus'));
    }

    /**
     * Show the form for creating a new honey product.
     */
    public function create()
    {
        return view('admin.madu.create');
    }

    /**
     * Store a newly created honey product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_madu' => 'required|string|max:255',
            'ukuran' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'stock' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('madus', 'public');
            $validated['gambar'] = $gambarPath;
        }

        Madu::create($validated);

        return redirect()->route('admin.madu.index')
            ->with('success', 'Produk Madu berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified honey product.
     */
    public function edit(Madu $madu)
    {
        return view('admin.madu.edit', compact('madu'));
    }

    /**
     * Update the specified honey product in storage.
     */
    public function update(Request $request, Madu $madu)
    {
        $validated = $request->validate([
            'nama_madu' => 'required|string|max:255',
            'ukuran' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'stock' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($madu->gambar && Storage::disk('public')->exists($madu->gambar)) {
                Storage::disk('public')->delete($madu->gambar);
            }
            
            $gambarPath = $request->file('gambar')->store('madus', 'public');
            $validated['gambar'] = $gambarPath;
        }

        $madu->update($validated);

        return redirect()->route('admin.madu.index')
            ->with('success', 'Produk Madu berhasil diperbarui.');
    }

    /**
     * Remove the specified honey product from storage.
     */
    public function destroy(Madu $madu)
    {
        $madu->delete();

        return redirect()->route('admin.madu.index')
            ->with('success', 'Produk Madu berhasil dihapus.');
    }

    /**
     * Restore the specified deleted honey product.
     */
    public function restore($id)
    {
        $madu = Madu::withTrashed()->findOrFail($id);
        $madu->restore();

        return redirect()->route('admin.madu.index')
            ->with('success', 'Produk Madu berhasil dipulihkan.');
    }

    /**
     * Permanently delete the specified honey product from storage.
     */
    public function forceDelete($id)
    {
        $madu = Madu::withTrashed()->findOrFail($id);
        
        // Delete image if exists
        if ($madu->gambar && Storage::disk('public')->exists($madu->gambar)) {
            Storage::disk('public')->delete($madu->gambar);
        }
        
        $madu->forceDelete();

        return redirect()->route('admin.madu.index')
            ->with('success', 'Produk Madu berhasil dihapus secara permanen.');
    }

    /**
     * Show the order form for a specific honey product.
     */
    public function order($id)
    {
        $madu = Madu::findOrFail($id);
        return view('madu.order', compact('madu'));
    }

    /**
     * Process the order for a honey product.
     */
    public function orderSubmit(Request $request, $id)
    {
        $madu = Madu::findOrFail($id);
        
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $madu->stock,
            'tanggal' => 'required|date|after_or_equal:today',
        ]);

        // Calculate total price
        $totalHarga = $madu->harga * $validated['jumlah'];

        // Create order
        OrderMadu::create([
            'user_id' => Auth::id(),
            'madu_id' => $madu->id,
            'nama_madu' => $madu->nama_madu,
            'jumlah' => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
            'total_harga' => $totalHarga,
            'status' => 'pending'
        ]);

        // Update stock
        $madu->update([
            'stock' => $madu->stock - $validated['jumlah']
        ]);

        return redirect()->route('order-madu.index')
            ->with('success', 'Your honey order has been submitted and is pending approval.');
    }
}
