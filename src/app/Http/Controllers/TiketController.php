<?php

namespace App\Http\Controllers;

use App\Models\TiketMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TiketController extends Controller
{
    /**
     * Display a listing of the tourists.
     */
    public function adminindex()
    {
        $tikets = TiketMasuk::all();
        return view('admin.tiketmasuks.index', compact('tikets'));
    }

    /**
     * Display a listing of all tourists for admin.
     */
    public function index()
    {
        $tikets = TiketMasuk::withTrashed()->get();
        return view('admin.tiketmasuks.index', compact('tikets'));
    }

    /**
     * Show the form for creating a new tourist.
     */
    public function create()
    {
        return view('admin.tiketmasuks.create');
    }

    /**
     * Store a newly created tourist in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ketua' => 'required|string|max:100',
            'jumlah_rombongan' => 'required|integer',
            'nohp' => 'required|string|regex:/^[0-9]+$/|max:13',
            'alamat' => 'required|string|max:100',
        ]);

        TiketMasuk::create($validated);

        return redirect()->route('admin.tiketmasuks.index')
            ->with('success', 'Wisatawan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified tourist.
     */
    public function edit(TiketMasuk $tiket)
    {
        return view('admin.tiketmasuks.edit', compact('tiket'));
    }

    /**
     * Update the specified tourist in storage.
     */
    public function update(Request $request, TiketMasuk $tiket)
    {
        $validated = $request->validate([
            'nama_ketua' => 'nullable|string|max:100',
            'jumlah_rombongan' => 'nullable|integer',
            'nohp' => 'nullable|string|regex:/^[0-9]+$/|max:13',
            'alamat' => 'nullable|string|max:100',
        ]);

        $tiket->update($validated);

        return redirect()->route('admin.tiketmasuks.index')
            ->with('success', 'Wisatawan berhasil diperbarui.');
    }

    public function updateStatus($id)
    {
        $tiket = TiketMasuk::findOrFail($id);

        // Update status dan waktu selesai
        $tiket->status = 'selesai';
        $tiket->waktu_selesai = now();
        $tiket->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

}