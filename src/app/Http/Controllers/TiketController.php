<?php

namespace App\Http\Controllers;

use App\Models\tiketMasuk;
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
        $tikets = tiketMasuk::all();
        return view('admin.tiketmasuks.index', compact('tikets'));
    }

    /**
     * Display a listing of all tourists for admin.
     */
    public function index()
    {
        $tikets = tiketMasuk::withTrashed()->get();
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

        tiketMasuk::create($validated);

        return redirect()->route('admin.tiketmasuks.index')
            ->with('success', 'Tourists add successfully.');
    }

    /**
     * Show the form for editing the specified tourist.
     */
    public function edit(tiketMasuk $tiket)
    {
        return view('admin.tiketmasuks.edit', compact('tiket'));
    }

    /**
     * Update the specified tourist in storage.
     */
    public function update(Request $request, tiketMasuk $tiket)
    {
        $validated = $request->validate([
            'nama_ketua' => 'nullable|string|max:100',
            'jumlah_rombongan' => 'nullable|integer',
            'nohp' => 'nullable|string|regex:/^[0-9]+$/|max:13',
            'alamat' => 'nullable|string|max:100',
        ]);

        $tiket->update($validated);

        return redirect()->route('admin.tiketmasuks.index')
            ->with('success', 'Tourists updated successfully.');
    }

    public function updateStatus($id)
    {
        $tiket = tiketMasuk::findOrFail($id);

        // Update status dan waktu selesai
        $tiket->status = 'selesai';
        $tiket->waktu_selesai = now();
        $tiket->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

}