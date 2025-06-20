<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\GoogleLoginNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists with this Google ID
            $existingUser = User::where('google_id', $googleUser->id)->first();
            
            if ($existingUser) {
                // Update user info from Google
                $existingUser->update([
                    'name' => $googleUser->name,
                    'avatar_url' => $googleUser->avatar,
                    'email_verified_at' => now(),
                    'is_verified' => true,
                ]);
                
                Auth::login($existingUser);
                
                // Send login notification
                try {
                    Mail::to($existingUser->email)->send(new GoogleLoginNotification($existingUser, false));
                } catch (Exception $e) {
                    \Log::warning('Failed to send Google login notification: ' . $e->getMessage());
                }
                
                return redirect()->intended('/')->with('success', 'Welcome back, ' . $existingUser->name . '!');
            }
            
            // Check if user exists with same email but no Google ID
            $existingEmailUser = User::where('email', $googleUser->email)->first();
            
            if ($existingEmailUser) {
                // Link Google account to existing user
                $existingEmailUser->update([
                    'google_id' => $googleUser->id,
                    'avatar_url' => $googleUser->avatar,
                    'email_verified_at' => now(),
                    'is_verified' => true,
                ]);
                
                Auth::login($existingEmailUser);
                
                // Send account linking notification
                try {
                    Mail::to($existingEmailUser->email)->send(new GoogleLoginNotification($existingEmailUser, false));
                } catch (Exception $e) {
                    \Log::warning('Failed to send Google linking notification: ' . $e->getMessage());
                }
                
                return redirect()->intended('/')->with('success', 'Google account linked successfully! You can now login with either method.');
            }
            
            // Create new user
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar_url' => $googleUser->avatar,
                'password' => Hash::make(Str::random(24)), // Random password for Google users
                'role' => 'user',
                'email_verified_at' => now(),
                'is_verified' => true,
            ]);
            
            Auth::login($newUser);
            
            // Send welcome email
            try {
                Mail::to($newUser->email)->send(new GoogleLoginNotification($newUser, true));
            } catch (Exception $e) {
                \Log::warning('Failed to send welcome email: ' . $e->getMessage());
            }
            
            return redirect()->intended('/')->with('success', 'Account created successfully! Welcome to oneVision!');
            
        } catch (Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            
            return redirect()->route('login')->with('error', 'Something went wrong with Google authentication. Please try again.');
        }
    }

    /**
     * Unlink Google account
     */
    public function unlinkGoogle()
    {
        $user = Auth::user();
        
        if (!$user->google_id) {
            return redirect()->back()->with('error', 'No Google account linked.');
        }
        
        // Check if user has a password set (can login without Google)
        if (!$user->password || Hash::check('', $user->password)) {
            return redirect()->back()->with('error', 'Please set a password before unlinking your Google account. Go to Security settings to set a password.');
        }
        
        $user->update([
            'google_id' => null,
            'avatar_url' => null,
        ]);
        
        return redirect()->back()->with('success', 'Google account unlinked successfully. You can now only login with your email and password.');
    }
}
