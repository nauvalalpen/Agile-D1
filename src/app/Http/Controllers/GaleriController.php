<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('galeri', compact('galleries'));
    }

    public function adminIndex()
    {
        $galleries = Gallery::withTrashed()->get();
        return view('admin.gallery.index', compact('galleries'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('gallery', 'public');
            $validated['foto'] = $fotoPath;
        }

        $validated['tanggal'] = now();

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil dibuat.');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'nullable|date',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old image if exists
            if ($gallery->foto && Storage::disk('public')->exists($gallery->foto)) {
                Storage::disk('public')->delete($gallery->foto);
            }

            // Store new image
            $fotoPath = $request->file('foto')->store('gallery', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Set tanggal if not provided
        if (!isset($validated['tanggal'])) {
            $validated['tanggal'] = $gallery->tanggal ?? $gallery->created_at;
        }

        // Update the gallery
        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil diperbarui.');
    }

    public function editModal($gallery)
    {
        // Handle both ID and model binding
        if (is_numeric($gallery)) {
            $gallery = Gallery::findOrFail($gallery);
        }
        
        return view('admin.gallery.edit', compact('gallery'));
    }


    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil dihapus.');
    }

    public function restore($id)
    {
        $gallery = Gallery::withTrashed()->findOrFail($id);
        $gallery->restore();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $gallery = Gallery::withTrashed()->findOrFail($id);

        if ($gallery->foto && Storage::disk('public')->exists($gallery->foto)) {
            Storage::disk('public')->delete($gallery->foto);
        }

        $gallery->forceDelete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil dihapus permanen.');
    }

public function showDetails($id)
{
    try {
        $gallery = Gallery::withTrashed()->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $gallery->id,
                'judul' => $gallery->judul,
                'deskripsi' => $gallery->deskripsi,
                'foto' => $gallery->foto ? asset('storage/' . $gallery->foto) : null,
                'created_at' => $gallery->created_at->format('d F Y, H:i'),
                'updated_at' => $gallery->updated_at->format('d F Y, H:i'),
                'status' => $gallery->deleted_at ? 'Deleted' : 'Active',
                'deleted_at' => $gallery->deleted_at ? $gallery->deleted_at->format('d F Y, H:i') : null
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gallery not found'
        ], 404);
    }
}


    
}
