<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\VerificationMail;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Generate 6-digit verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'verification_code' => $verificationCode,
            'is_verified' => false
        ]);

        // dd($verificationCode);
        // Send verification email
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();
        try {
            Mail::to($user->email)->send(new VerificationMail($user, $verificationCode));
            
            return redirect()->route('verification.notice')
                ->with('success', 'Registration successful! Please check your email for verification code.')
                ->with('email', $user->email);
        } catch (\Exception $e) {
            // If email fails, delete the user and show error
            $user->delete();
            return back()->withErrors(['email' => 'Failed to send verification email. Please try again.']);
        }
    }

    public function showVerificationForm()
    {
        return view('auth.verify-email', [
            'title' => 'Email Verification'
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            // Auth::user()->email,
            // 'email' => ['required', 'email'],
            'verification_code' => ['required', 'string', 'size:6']
        ]);

        $user = User::where('email', Auth::user()->email)
                   ->where('verification_code', $request->verification_code)
                   ->where('is_verified', false)
                   ->first();

        if (!$user) {
            return back()->withErrors(['verification_code' => 'Invalid verification code or email.']);
        }

        // Check if verification code is not older than 24 hours
        if ($user->created_at->diffInHours(now()) > 24) {
            return back()->withErrors(['verification_code' => 'Verification code has expired. Please register again.']);
        }

        $user->markEmailAsVerified();

        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } else {
            return redirect()->intended('/');
        }
    }

    public function resendVerification(Request $request)
    {
        // dd("test");
        
        $user = Auth::user();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found or already verified.']);
        }

        $user = User::where('email', $user->email)->first();
        // Generate new verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->update(['verification_code' => $verificationCode]);

        try {
            // composer require psy/psysh --dev
            Mail::to($user->email)->send(new VerificationMail($user, $verificationCode));
            return back()->with('success', 'Verification code resent successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to resend verification email.']);
        }
    }
}
