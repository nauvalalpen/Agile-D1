<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\Helpers\SettingsHelper;

class SettingsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display settings page
     */
    public function index()
    {
        $user = Auth::user();
        $securityScore = $user->getSecurityScore();
        
        return view('settings.index', compact('user', 'securityScore'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data = $request->only(['name', 'email', 'phone', 'bio']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            
            $data['photo'] = $request->file('photo')->store('profile-photos', 'public');
            $data['avatar'] = null; // Clear Google avatar if user uploads custom photo
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'photo_url' => $user->fresh()->profile_photo
        ]);
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!'
        ]);
    }

    /**
     * Update notification preferences
     */
    public function updateNotifications(Request $request)
    {
        $preferences = $request->all();
        unset($preferences['_token']);

        $user = Auth::user();
        $user->updateNotificationPreferences($preferences);

        return response()->json([
            'success' => true,
            'message' => 'Notification preferences updated successfully!'
        ]);
    }

    /**
     * Update privacy settings
     */
    public function updatePrivacy(Request $request)
    {
        $settings = $request->all();
        unset($settings['_token']);

        $user = Auth::user();
        $user->updatePrivacySettings($settings);

        return response()->json([
            'success' => true,
            'message' => 'Privacy settings updated successfully!'
        ]);
    }

    /**
     * Setup 2FA
     */
    public function setup2FA()
    {
        $user = Auth::user();
        
        // Generate secret key for 2FA
        $google2fa = app('pragmarx.google2fa');
        $secretKey = $google2fa->generateSecretKey();
        
        // Generate QR code
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secretKey
        );

        return response()->json([
            'success' => true,
            'secret_key' => $secretKey,
            'qr_code_url' => $qrCodeUrl
        ]);
    }

    /**
     * Enable 2FA
     */
    public function enable2FA(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'string', 'size:6'],
            'secret_key' => ['required', 'string']
        ]);

        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');

        // Verify the code
        $valid = $google2fa->verifyKey($request->secret_key, $request->verification_code);

        if (!$valid) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification code. Please try again.'
            ], 422);
        }

        // Generate backup codes
        $backupCodes = SettingsHelper::generateBackupCodes();

        // Save 2FA settings
        $user->update([
            'two_factor_secret' => encrypt($request->secret_key),
            'two_factor_recovery_codes' => encrypt($backupCodes)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Two-factor authentication enabled successfully!',
            'backup_codes' => $backupCodes
        ]);
    }

    /**
     * Disable 2FA
     */
    public function disable2FA(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password']
        ]);

        $user = Auth::user();
        $user->update([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Two-factor authentication disabled successfully!'
        ]);
    }

    /**
     * Export user data
     */
    public function exportData()
    {
        $user = Auth::user();
        
        // Gather user data
        $userData = [
            'profile' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'email_verified_at' => $user->email_verified_at,
                'last_login_at' => $user->last_login_at,
            ],
            'preferences' => [
                'notification_preferences' => $user->getNotificationPreferences(),
                'privacy_settings' => $user->getPrivacySettings(),
            ],
            'security' => [
                'two_factor_enabled' => $user->has2FAEnabled(),
                'security_score' => $user->getSecurityScore(),
            ],
            'orders' => [
                'tour_guide_orders' => \DB::table('order_tour_guides')
                    ->where('user_id', $user->id)
                    ->select('id', 'status', 'created_at', 'updated_at')
                    ->get(),
                'honey_orders' => \DB::table('order_madus')
                    ->where('user_id', $user->id)
                    ->select('id', 'status', 'created_at', 'updated_at')
                    ->get(),
            ],
            'exported_at' => now()->toISOString(),
        ];

        $filename = 'onevision-data-export-' . $user->id . '-' . now()->format('Y-m-d-H-i-s') . '.json';

        return response()->json($userData)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Content-Type', 'application/json');
    }

    /**
     * Delete user account
     */
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
            'confirmation' => ['required', 'in:DELETE']
        ]);

        $user = Auth::user();

        // Check if account can be deleted
        if (!$user->canDeleteAccount()) {
            $restrictions = $user->getAccountDeletionRestrictions();
            return response()->json([
                'success' => false,
                'message' => 'Account cannot be deleted due to the following restrictions:',
                'restrictions' => $restrictions
            ], 422);
        }

        // Delete user photo if exists
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        // Anonymize user data instead of hard delete
        $user->update([
            'name' => 'Deleted User',
            'email' => 'deleted-' . $user->id . '@example.com',
            'password' => Hash::make(str()->random(32)),
            'photo' => null,
            'avatar' => null,
            'google_id' => null,
            'verification_code' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'notification_preferences' => null,
            'privacy_settings' => null,
        ]);

        // Soft delete the user
        $user->delete();

        // Logout the user
        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Your account has been successfully deleted.',
            'redirect' => route('login')
        ]);
    }
}
