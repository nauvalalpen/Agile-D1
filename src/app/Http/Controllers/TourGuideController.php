<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\TourGuide;
use Illuminate\Support\Str;

class TourGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = DB::table('tourguides');
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('alamat', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Filter by price range
        if ($request->has('price_filter') && !empty($request->price_filter)) {
            $query->where('price_range', 'like', '%' . $request->price_filter . '%');
        }
        
        // Sorting
        $sortField = $request->sort_by ?? 'id';
        $sortDirection = $request->sort_direction ?? 'asc';
        $query->orderBy($sortField, $sortDirection);
        
        // Get the paginated results
        $tourguides = $query->paginate(3);
        
        // Pass sort parameters to maintain state when paginating
        $tourguides->appends([
            'search' => $request->search,
            'price_filter' => $request->price_filter,
            'sort_by' => $sortField,
            'sort_direction' => $sortDirection
        ]);
        
        return view('tourguides.index', compact('tourguides'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nohp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'pricerange' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoPath = 'tourguides/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/tourguides'), $fotoPath);
        }

        DB::table('tourguides')->insert([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'price_range' => $request->pricerange,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('tourguides.index')->with('success', 'Tour guide added successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nohp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'pricerange' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tourguide = DB::table('tourguides')->where('id', $id)->first();
        $fotoPath = $tourguide->foto;

        if ($request->hasFile('foto')) {
            // Delete old image if exists
            if ($fotoPath && Storage::exists('public/' . $fotoPath)) {
                Storage::delete('public/' . $fotoPath);
            }
            
            $file = $request->file('foto');
            $fotoPath = 'tourguides/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/tourguides'), $fotoPath);
        }

        DB::table('tourguides')->where('id', $id)->update([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'price_range' => $request->pricerange,
            'foto' => $fotoPath,
            'updated_at' => now(),
        ]);
        
        return redirect()->route('tourguides.index')->with('success', 'Tour guide updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tourguide = DB::table('tourguides')->where('id', $id)->first();
        
        // Delete the image file if it exists
        if ($tourguide->foto && Storage::exists('public/' . $tourguide->foto)) {
            Storage::delete('public/' . $tourguide->foto);
        }
        
        DB::table('tourguides')->where('id', $id)->delete();
        
        return redirect()->route('tourguides.index')->with('success', 'Tour guide deleted successfully!');
    }
}
