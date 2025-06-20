<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AccountSettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user statistics based on your existing model
        $stats = [
            'total_orders' => 0, // You can implement this based on your order models
            'member_since' => $user->created_at->format('F Y'),
            'email_verified' => $user->hasVerifiedEmail(),
            'last_login' => $user->updated_at->diffForHumans(),
        ];

        return view('settings.index', compact('user', 'stats'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Profile update failed. Please check your inputs.');
        }

        $user->update($request->only(['name', 'email']));

        return redirect()->back()
            ->with('success', 'Profile updated successfully!');
    }

    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid image file. Please upload a valid image (max 2MB).'
            ], 422);
        }

        $user = Auth::user();

        // Delete old photo if exists
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        // Store new photo
        $photoPath = $request->file('photo')->store('photos', 'public');
        
        $user->update(['photo' => $photoPath]);

        return response()->json([
            'success' => true,
            'message' => 'Profile photo updated successfully!',
            'photo_url' => $user->photo_url
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Password update failed. Please check your inputs.');
        }

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()
            ->with('success', 'Password updated successfully!');
    }

    public function updateNotifications(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_notifications' => ['boolean'],
            'sms_notifications' => ['boolean'],
            'marketing_emails' => ['boolean'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Notification settings update failed.');
        }

        // You can add notification preferences to your User model if needed
        // For now, we'll store in session or create a separate preferences table

        session([
            'email_notifications' => $request->boolean('email_notifications'),
            'sms_notifications' => $request->boolean('sms_notifications'),
            'marketing_emails' => $request->boolean('marketing_emails'),
        ]);

        return redirect()->back()
            ->with('success', 'Notification preferences updated successfully!');
    }

    public function deleteAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'current_password'],
            'confirmation' => ['required', 'in:DELETE'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Account deletion failed. Please verify your password and confirmation.');
        }

        $user = Auth::user();
        
        // Delete user photo if exists
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }
        
        // Log out the user
        Auth::logout();
        
        // Soft delete the user account (using your existing SoftDeletes trait)
        $user->delete();

        return redirect()->route('login')
            ->with('success', 'Your account has been successfully deleted.');
    }

    public function resendVerification(Request $request)
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->back()
                ->with('info', 'Your email is already verified.');
        }

        $code = $user->generateVerificationCode();
        
        // Here you would send the verification email
        // Mail::to($user->email)->send(new VerificationCodeMail($code));

        return redirect()->back()
            ->with('success', 'Verification code sent to your email!');
    }

    public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verification_code' => ['required', 'string', 'size:6'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Invalid verification code format.');
        }

        $user = Auth::user();

        if ($user->verification_code !== $request->verification_code) {
            return redirect()->back()
                ->with('error', 'Invalid verification code.');
        }

        if ($user->isVerificationCodeExpired()) {
            return redirect()->back()
                ->with('error', 'Verification code has expired. Please request a new one.');
        }

        $user->markEmailAsVerified();

        return redirect()->back()
            ->with('success', 'Email verified successfully!');
    }
}
