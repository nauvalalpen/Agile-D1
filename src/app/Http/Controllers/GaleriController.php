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

    public function editModal($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
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
            'tanggal' => 'required|date',
        ]);

        if ($request->hasFile('foto')) {
            if ($gallery->foto && Storage::disk('public')->exists($gallery->foto)) {
                Storage::disk('public')->delete($gallery->foto);
            }

            $fotoPath = $request->file('foto')->store('gallery', 'public');
            $validated['foto'] = $fotoPath;
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil diperbarui.');
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
}
