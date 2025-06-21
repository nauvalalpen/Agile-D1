<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            Log::error('Google OAuth Redirect Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Unable to connect to Google. Please try again.');
        }
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists
            $existingUser = User::where('email', $googleUser->getEmail())->first();
            
            if ($existingUser) {
                // Update user info if needed
                $existingUser->update([
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => $existingUser->email_verified_at ?? now(),
                    'is_verified' => true,
                    'last_login_at' => now(),
                ]);
                
                Auth::login($existingUser);
                
                return redirect()->intended('/')->with('success', 'Welcome back, ' . $existingUser->name . '!');
            } else {
                // Create new user
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(24)), // Random password
                    'email_verified_at' => now(),
                    'is_verified' => true,
                    'role' => 'user',
                    'last_login_at' => now(),
                ]);
                
                Auth::login($newUser);
                
                return redirect('/')->with('success', 'Welcome to OneVision, ' . $newUser->name . '! Your account has been created successfully.');
            }
            
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            Log::error('Google OAuth Invalid State: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Authentication session expired. Please try again.');
        } catch (\Exception $e) {
            Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Unable to login with Google. Please try again or use email/password.');
        }
    }
}
