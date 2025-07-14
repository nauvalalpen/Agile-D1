<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Tampilkan semua user aktif
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Tampilkan user yang sudah dihapus (riwayat)
     */
    public function trash()
    {
        $users = User::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('admin.users.trash', compact('users'));
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role'     => 'required|in:admin,user',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('users', 'public');
            $validated['photo'] = $photoPath;
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role'     => 'nullable|in:admin,user',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $validated['photo'] = $request->file('photo')->store('users', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if (empty($validated['role'])) {
            unset($validated['role']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Soft delete (masukkan ke riwayat sampah)
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dipindahkan ke riwayat sampah.');
    }

    /**
     * Restore user dari trash
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.trash')
            ->with('success', 'User berhasil dikembalikan.');
    }

    /**
     * Hapus user secara permanen
     */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->forceDelete();

        return redirect()->route('admin.users.trash')
            ->with('success', 'User berhasil dihapus permanen.');
    }
}