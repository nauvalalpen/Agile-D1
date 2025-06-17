<?php

namespace App\Http\Controllers;

use App\Models\ProdukUMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukUMKMController extends Controller
{
    /**
     * Display a listing of the resource for public users.
     */
    public function index()
    {
        $produkUMKM = ProdukUMKM::latest()->paginate(12);
        return view('produkUMKM', compact('produkUMKM'));
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $produkUMKM = ProdukUMKM::withTrashed()->latest()->get();
        return view('admin.produkUMKM.index', compact('produkUMKM'));
    }

    /**
     * Get edit modal content.
     */
    public function editModal($id)
    {
        $produkUMKM = ProdukUMKM::findOrFail($id);
        return response()->json([
            'id' => $produkUMKM->id,
            'nama' => $produkUMKM->nama,
            'harga' => $produkUMKM->harga,
            'deskripsi' => $produkUMKM->deskripsi,
            'foto' => $produkUMKM->foto,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $data['foto'] = $file->storeAs('produk-umkm', $filename, 'public');
        }

        ProdukUMKM::create($data);

        return redirect()->route('admin.produkUMKM.index')
            ->with('success', 'Produk UMKM berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProdukUMKM $produkUMKM)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($produkUMKM->foto && Storage::disk('public')->exists($produkUMKM->foto)) {
                Storage::disk('public')->delete($produkUMKM->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $data['foto'] = $file->storeAs('produk-umkm', $filename, 'public');
        }

        $produkUMKM->update($data);

        return redirect()->route('admin.produkUMKM.index')
            ->with('success', 'Produk UMKM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdukUMKM $produkUMKM)
    {
        $produkUMKM->delete();

        return redirect()->route('admin.produkUMKM.index')
            ->with('success', 'Produk UMKM berhasil dihapus.');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $produkUMKM = ProdukUMKM::withTrashed()->findOrFail($id);
        $produkUMKM->restore();

        return redirect()->route('admin.produkUMKM.index')
            ->with('success', 'Produk UMKM berhasil dipulihkan.');
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $produkUMKM = ProdukUMKM::withTrashed()->findOrFail($id);
        
        // Delete photo if exists
        if ($produkUMKM->foto && Storage::disk('public')->exists($produkUMKM->foto)) {
            Storage::disk('public')->delete($produkUMKM->foto);
        }

        $produkUMKM->forceDelete();

        return redirect()->route('admin.produkUMKM.index')
            ->with('success', 'Produk UMKM berhasil dihapus permanen.');
    }
}
