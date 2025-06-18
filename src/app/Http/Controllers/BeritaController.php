<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BeritaController extends Controller
{
    /**
     * Tampilkan daftar berita untuk tampilan publik
     */
    public function index()
    {
        $hotTopic = Berita::orderBy('tanggal', 'desc')->first();
        $beritas = Berita::orderBy('tanggal', 'desc')->skip(1)->take(8)->get();

        return view('berita', compact('hotTopic', 'beritas'));
    }


    /**
     * Tampilkan detail berita untuk tampilan publik
     */
    public function detail($id)
    {
        $berita = Berita::findOrFail($id); // cari berita berdasarkan id, kalau tidak ada langsung 404
        return view('detailberita', compact('berita'));
    }

    /**
     * Tampilkan daftar berita untuk admin (termasuk yang dihapus soft delete)
     */

    public function adminIndex()
    {
        $berita = Berita::withTrashed()->get();
        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Tampilkan form edit berita dalam modal
     */
    public function editModal($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Simpan berita baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'nullable|date',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('berita', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Jika tanggal tidak diisi, otomatis isi dengan sekarang
        $validated['tanggal'] = $validated['tanggal'] ?? Carbon::now();

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dibuat.');
    }

    /***
     * Update berita yang sudah ada
     */
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'nullable|date',
        ]);

        if ($request->hasFile('foto')) {
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }

            $fotoPath = $request->file('foto')->store('berita', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Jika tanggal tidak diisi, biarkan tanggal lama tetap
        if (empty($validated['tanggal'])) {
            unset($validated['tanggal']);
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita (soft delete)
     */
    public function destroy(Berita $berita)
    {
        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Restore berita yang sudah dihapus (soft delete)
     */
    public function restore($id)
    {
        $berita = Berita::withTrashed()->findOrFail($id);
        $berita->restore();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dikembalikan.');
    }

    /**
     * Hapus berita secara permanen (force delete)
     */
    public function forceDelete($id)
    {
        $berita = Berita::withTrashed()->findOrFail($id);

        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->forceDelete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus permanen.');
    }
}
