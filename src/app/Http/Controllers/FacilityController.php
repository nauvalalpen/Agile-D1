<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the facilities for public view.
     */
    public function index()
    {
        $facilities = Facility::all();
        return view('facility', compact('facilities'));
    }

    /**
     * Display a listing of the facilities for admin view.
     */
    public function adminIndex()
    {
        $facilities = Facility::withTrashed()->get();
        return view('admin.facility.index', compact('facilities'));
    }

    /**
     * Return the edit form content for a modal.
     */
    public function editModal($id)
    {
        $facility = Facility::findOrFail($id);
        return view('admin.facility.edit', compact('facility'));
    }

    /**
     * Store a newly created facility in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('facilities', 'public');
            $validated['foto'] = $fotoPath;
        }

        Facility::create($validated);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    /**
     * Update the specified facility in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old image if exists
            if ($facility->foto && Storage::disk('public')->exists($facility->foto)) {
                Storage::disk('public')->delete($facility->foto);
            }
            
            $fotoPath = $request->file('foto')->store('facilities', 'public');
            $validated['foto'] = $fotoPath;
        }

        $facility->update($validated);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified facility from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }

    /**
     * Restore the specified deleted facility.
     */
    public function restore($id)
    {
        $facility = Facility::withTrashed()->findOrFail($id);
        $facility->restore();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil ditambahkan');
    }

    /**
     * Permanently delete the specified facility from storage.
     */
    public function forceDelete($id)
    {
        $facility = Facility::withTrashed()->findOrFail($id);
        
        // Delete image if exists
        if ($facility->foto && Storage::disk('public')->exists($facility->foto)) {
            Storage::disk('public')->delete($facility->foto);
        }
        
        $facility->forceDelete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil dihapus secara permanen.');
    }
}
