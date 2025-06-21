<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Helpers\SettingsHelper;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

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
        $securityScore = SettingsHelper::calculateSecurityScore($user);

        return view('settings.index', compact('user', 'securityScore'));
    }

    /**
     * Update profile information
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['name', 'email', 'phone', 'bio']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $photoPath = $request->file('photo')->store('profile-photos', 'public');
            $data['photo'] = $photoPath;
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'profile_photo' => $user->profile_photo
        ]);
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully'
        ]);
    }

    /**
     * Update notification preferences
     */
    public function updateNotifications(Request $request)
    {
        $user = Auth::user();
        $preferences = $request->except(['_token']);

        $user->updateNotificationPreferences($preferences);

        return response()->json([
            'success' => true,
            'message' => 'Notification preferences updated successfully'
        ]);
    }

    /**
     * Update privacy settings
     */
    public function updatePrivacy(Request $request)
    {
        $user = Auth::user();
        $settings = $request->except(['_token']);

        $user->updatePrivacySettings($settings);

        return response()->json([
            'success' => true,
            'message' => 'Privacy settings updated successfully'
        ]);
    }

    /**
     * Generate 2FA QR Code
     */
    public function generate2FA()
    {
        $user = Auth::user();
        $google2fa = new Google2FA();

        $secretKey = $google2fa->generateSecretKey();
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secretKey
        );

        // Generate QR Code
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCode = base64_encode($writer->writeString($qrCodeUrl));

        // Store secret key temporarily in session
        session(['2fa_temp_secret' => $secretKey]);

        return response()->json([
            'success' => true,
            'qr_code' => '<img src="data:image/png;base64,' . $qrCode . '" alt="QR Code">',
            'secret_key' => $secretKey
        ]);
    }

    /**
     * Enable 2FA
     */
    public function enable2FA(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verification_code' => ['required', 'string', 'size:6'],
            'secret_key' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $google2fa = new Google2FA();
        $secretKey = $request->secret_key;

        // Verify the code
        $valid = $google2fa->verifyKey($secretKey, $request->verification_code);

        if (!$valid) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification code'
            ], 422);
        }

        // Generate backup codes
        $backupCodes = SettingsHelper::generateBackupCodes();

        // Enable 2FA
        $user->enable2FA($secretKey, $backupCodes);

        // Clear temporary session data
        session()->forget('2fa_temp_secret');

        return response()->json([
            'success' => true,
            'message' => 'Two-factor authentication enabled successfully',
            'backup_codes' => $backupCodes
        ]);
    }

    /**
     * Disable 2FA
     */
    public function disable2FA(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'current_password']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $user->disable2FA();

        return response()->json([
            'success' => true,
            'message' => 'Two-factor authentication disabled successfully'
        ]);
    }

    /**
     * Export user data
     */
    public function exportData()
    {
        $user = Auth::user();

        $data = [
            'profile' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'bio' => $user->bio,
                'created_at' => $user->created_at,
                'email_verified_at' => $user->email_verified_at,
            ],
            'preferences' => [
                'notifications' => $user->getNotificationPreferences(),
                'privacy' => $user->getPrivacySettings(),
            ],
            'security' => [
                'two_factor_enabled' => $user->has2FAEnabled(),
                'last_login_at' => $user->last_login_at,
            ],
            'exported_at' => now(),
        ];

        $filename = 'user-data-' . $user->id . '-' . now()->format('Y-m-d-H-i-s') . '.json';

        return response()->json($data)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Content-Type', 'application/json');
    }

    /**
     * Delete user account
     */
    public function deleteAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'current_password'],
            'confirmation' => ['required', 'in:DELETE']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();

        // Delete profile photo if exists
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        // Anonymize orders instead of deleting them
        \DB::table('order_tour_guides')->where('user_id', $user->id)->update([
            'user_id' => null,
            'updated_at' => now()
        ]);

        \DB::table('order_madus')->where('user_id', $user->id)->update([
            'user_id' => null,
            'updated_at' => now()
        ]);

        // Log out the user
        Auth::logout();

        // Delete the user account
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Your account has been deleted successfully',
            'redirect' => route('login')
        ]);
    }
}
