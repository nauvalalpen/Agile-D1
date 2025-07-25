<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the facilities.
     */

     public function adminIndex()
    {
        $facilities = Facility::withTrashed()->get();
        return view('admin.facility.index', compact('facilities'));
    }

    public function index()
    {
        $facilities = Facility::withTrashed()->get();
        return view('admin.facility.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new facility.
     */
    public function create()
    {
        return view('admin.facility.create');
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
            ->with('success', 'Facility created successfully.');
    }

    /**
     * Show the form for editing the specified facility.
     */
    public function edit(Facility $facility)
    {
        return view('admin.facility.edit', compact('facility'));
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
            ->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified facility from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility deleted successfully.');
    }

    /**
     * Restore the specified deleted facility.
     */
    public function restore($id)
    {
        $facility = Facility::withTrashed()->findOrFail($id);
        $facility->restore();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility restored successfully.');
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
            ->with('success', 'Facility permanently deleted.');
    }
}
