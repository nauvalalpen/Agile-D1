<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TourGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // dd(Auth::user());
        $tourguides = DB::table('tourguides')->get();
        
        
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
        //
        return view('tourguides/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required|string|max:255',
            'nohp' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'foto' => 'required|string|max:255',
        ]);

        DB::table('tourguides')->insert([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'foto' => $request->foto,
        ]);

        return redirect()->route('tourguides.index')->with('success', 'Tour guide created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $tourguides = DB::table('tourguides')->where('id', $id)->first();
        return view('tourguides.edit', compact('tourguides'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nama' => 'required|string|max:255',
            'nohp' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'foto' => 'required|string|max:255',
        ]);

        DB::table('tourguides')->where('id', $id)->update([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'foto' => $request->foto,
            'updated_at' => now(),
        ]);
        
        return redirect()->route('tourguides.index')->with('Success', 'Data Tour Guide berhasil diupdate');
    }

    public function order(Request $request, $id){
        $tourguide = DB::table('tourguides')->where('id', $id)->first();
    
        if (!$tourguide) {
            return redirect()->route('tourguides.index')->with('error', 'Tour guide not found.');
        }
        
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
        'price_range' => 'required|string|max:255',
        'notes' => 'nullable|string|max:500',
    ]);
    
    $tourguide = DB::table('tourguides')->where('id', $id)->first();
    
    if (!$tourguide) {
        return redirect()->route('tourguides.index')->with('error', 'Tour guide not found.');
    }
    
    // Insert the order into the database
    DB::table('order_tour_guides')->insert([
        'user_id' => Auth::id(),
        'tourguide_id' => $id,
        'tanggal_order' => $request->tanggal_order,
        'jumlah_orang' => $request->jumlah_orang,
        'price_range' => $request->price_range,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    return redirect()->route('tourguides.index')->with('success', 'Tour guide ordered successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('tourguides')->where('id', $id)->delete();
        return redirect()->route('tourguides.index')->with('Success', 'Data Tour Guide berhasil dihapus');
    }
}
