<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OAuthController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'google_users' => User::whereNotNull('google_id')->count(),
            'email_users' => User::whereNull('google_id')->count(),
            'verified_users' => User::verified()->count(),
        ];

        $recentGoogleUsers = User::whereNotNull('google_id')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.oauth.index', compact('stats', 'recentGoogleUsers'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filter === 'google') {
            $query->whereNotNull('google_id');
        } elseif ($request->filter === 'email') {
            $query->whereNull('google_id');
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.oauth.users', compact('users'));
    }
}
