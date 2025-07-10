<?php

namespace App\Http\Controllers;

use App\Models\Tourguide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TourGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function homepage()
     {
         // Fetch tour guides ordered by ID ascending using Eloquent
         $tourGuides = Tourguide::orderBy('id', 'asc')
                              ->limit(3)
                              ->get();
         
         // Pass the data to the view
         return view('index', compact('tourGuides'));
     }

    public function index()
    {
        // Using Eloquent model instead of Query Builder
        $tourguides = Tourguide::all();
        
        if (!Auth::user() || Auth::user()->role === 'user' || Auth::user()->role === null) {
            return view('tourguides/indexUser', compact('tourguides'));
        } else if (Auth::user()->role === 'admin') {
            return view('tourguides/index', compact('tourguides'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tourguides/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nohp' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'pricerange' => 'required|string|max:255',
            'foto' => 'required|image|max:2048',
        ]);
    
        // Handle file upload
        $fotoPath = '';
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoPath = 'tourguides/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/tourguides'), $fotoPath);
        }
    
        // Create using Eloquent model
        Tourguide::create([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'price_range' => $request->pricerange,
            'foto' => $fotoPath,
        ]);
    
        return redirect()->route('tourguides.index')->with('success', 'Tour Guide berhasil ditambahkan.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tourguide = Tourguide::findOrFail($id);
        return view('tourguides.show', compact('tourguide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tourguides = Tourguide::findOrFail($id);
        return view('tourguides.edit', compact('tourguides'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nohp' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'pricerange' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tourguide = Tourguide::findOrFail($id);
        $fotoPath = $tourguide->foto;

        // Handle file upload if a new photo is provided
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($tourguide->foto && Storage::disk('public')->exists($tourguide->foto)) {
                Storage::disk('public')->delete($tourguide->foto);
            }
            
            $file = $request->file('foto');
            $fotoPath = 'tourguides/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/tourguides'), $fotoPath);
        }

        $tourguide->update([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'price_range' => $request->pricerange,
            'foto' => $fotoPath,
        ]);
        
        return redirect()->route('tourguides.index')->with('success', 'Tour Guide berhasil diperbarui');
    }

    public function order(Request $request, $id)
    {
        $tourguide = Tourguide::findOrFail($id);
        return view('tourguides.order', compact('tourguide'));
    }

    /**
     * Store a new order for a tour guide.
     */
    public function orderSubmit(Request $request, string $id)
    {
        $request->validate([
            'tanggal_order' => 'required|date|after_or_equal:today',
            'jumlah_orang' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);
        
        $tourguide = Tourguide::findOrFail($id);
        
        // Insert the order into the database
        DB::table('order_tour_guides')->insert([
            'user_id' => Auth::id(),
            'tourguide_id' => $id,
            'tanggal_order' => $request->tanggal_order,
            'jumlah_orang' => $request->jumlah_orang,
            'price_range' => $tourguide->price_range,
            'notes' => $request->notes,
            'status' => 'pending',
            'is_read' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('order-history.index')->with('success', 'Pemandu Wisata berhasil dipesan. Tunggu konfirmasi selanjutnya.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tourguide = Tourguide::findOrFail($id);
        
        // Delete associated photo if exists
        if ($tourguide->foto && Storage::disk('public')->exists($tourguide->foto)) {
            Storage::disk('public')->delete($tourguide->foto);
        }
        
        $tourguide->delete();
        
        return redirect()->route('tourguides.index')->with('success', 'Tour Guide berhasil dihapus');
    }
}
