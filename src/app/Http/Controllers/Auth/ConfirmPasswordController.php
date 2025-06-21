<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ConfirmPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the password confirmation form
     */
    public function show()
    {
        return view('auth.passwords.confirm');
    }

    /**
     * Confirm the user's password
     */
    public function confirm(Request $request)
    {
        $user = Auth::user();

        // If user doesn't have a password (Google OAuth only), redirect to settings
        if (!$user->password || Hash::check('', $user->password)) {
            return redirect()->route('settings.index')
                ->with('warning', 'Please set a password for your account first.');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'The provided password is incorrect.'])
                ->withInput();
        }

        // Mark password as confirmed
        session(['auth.password_confirmed_at' => now()]);

        // Redirect to intended URL or settings
        $intended = session('url.intended', route('settings.index'));
        session()->forget('url.intended');

        return redirect($intended)->with('success', 'Password confirmed successfully.');
    }
}