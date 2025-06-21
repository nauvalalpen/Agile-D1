<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Str;

class SettingsHelper
{
    /**
     * Get default notification preferences
     */
    public static function getDefaultNotificationPreferences(): array
    {
        return [
            'email_order_updates' => true,
            'email_promotions' => false,
            'email_newsletter' => true,
            'email_security_alerts' => true,
            'push_order_updates' => true,
            'push_promotions' => false,
            'push_reminders' => true,
            'sms_order_updates' => false,
            'sms_security_alerts' => true,
        ];
    }

    /**
     * Get default privacy settings
     */
    public static function getDefaultPrivacySettings(): array
    {
        return [
            'profile_visibility' => true,
            'show_email' => false,
            'show_phone' => false,
            'allow_search' => true,
            'data_analytics' => true,
            'marketing_emails' => false,
            'third_party_sharing' => false,
        ];
    }

    /**
     * Get notification labels
     */
    public static function getNotificationLabels(): array
    {
        return [
            'email_order_updates' => 'Order status updates',
            'email_promotions' => 'Promotional offers',
            'email_newsletter' => 'Newsletter and updates',
            'email_security_alerts' => 'Security alerts',
            'push_order_updates' => 'Order status updates',
            'push_promotions' => 'Promotional offers',
            'push_reminders' => 'Booking reminders',
            'sms_order_updates' => 'Order status updates',
            'sms_security_alerts' => 'Security alerts',
        ];
    }

    /**
     * Get privacy labels
     */
    public static function getPrivacyLabels(): array
    {
        return [
            'profile_visibility' => 'Make my profile visible to other users',
            'show_email' => 'Show my email address on profile',
            'show_phone' => 'Show my phone number on profile',
            'allow_search' => 'Allow others to find me by email',
            'data_analytics' => 'Allow data collection for analytics',
            'marketing_emails' => 'Receive marketing emails from partners',
            'third_party_sharing' => 'Allow sharing data with trusted partners',
        ];
    }

    /**
     * Get privacy impact levels
     */
    public static function getPrivacyImpacts(): array
    {
        return [
            'profile_visibility' => 'medium',
            'show_email' => 'high',
            'show_phone' => 'high',
            'allow_search' => 'medium',
            'data_analytics' => 'low',
            'marketing_emails' => 'low',
            'third_party_sharing' => 'high',
        ];
    }

    /**
     * Validate notification preferences
     */
    public static function validateNotificationPreferences(array $preferences): array
    {
        $defaults = self::getDefaultNotificationPreferences();
        $validated = [];

        foreach ($defaults as $key => $defaultValue) {
            $validated[$key] = isset($preferences[$key]) && $preferences[$key] === 'on';
        }

        return $validated;
    }

    /**
     * Validate privacy settings
     */
    public static function validatePrivacySettings(array $settings): array
    {
        $defaults = self::getDefaultPrivacySettings();
        $validated = [];

        foreach ($defaults as $key => $defaultValue) {
            $validated[$key] = isset($settings[$key]) && $settings[$key] === 'on';
        }

        return $validated;
    }

    /**
     * Calculate security score
     */
    public static function calculateSecurityScore(User $user): array
    {
        $score = 0;
        $maxScore = 100;
        $recommendations = [];

        // Email verification (20 points)
        if ($user->hasVerifiedEmail()) {
            $score += 20;
        } else {
            $recommendations[] = [
                'type' => 'warning',
                'title' => 'Verify your email',
                'description' => 'Email verification helps secure your account and enables important notifications.'
            ];
        }

        // Strong password (25 points)
        if (strlen($user->password) >= 60) { // Hashed password length indicates complexity
            $score += 25;
        } else {
            $recommendations[] = [
                'type' => 'warning',
                'title' => 'Use a strong password',
                'description' => 'Use at least 8 characters with a mix of letters, numbers, and symbols.'
            ];
        }

        // Two-factor authentication (30 points)
        if ($user->has2FAEnabled()) {
            $score += 30;
        } else {
            $recommendations[] = [
                'type' => 'info',
                'title' => 'Enable two-factor authentication',
                'description' => 'Add an extra layer of security with 2FA using an authenticator app.'
            ];
        }

        // Recent login activity (15 points)
        if ($user->last_login_at && $user->last_login_at->diffInDays(now()) <= 30) {
            $score += 15;
        }

        // Profile completeness (10 points)
        if ($user->name && $user->email) {
            $score += 10;
        }

        // Determine security level
        $percentage = min(100, $score);
        if ($percentage >= 80) {
            $level = 'excellent';
        } elseif ($percentage >= 60) {
            $level = 'good';
        } elseif ($percentage >= 40) {
            $level = 'fair';
        } else {
            $level = 'poor';
        }

        return [
            'score' => $score,
            'percentage' => $percentage,
            'level' => $level,
            'recommendations' => $recommendations
        ];
    }

    /**
     * Generate backup codes for 2FA
     */
    public static function generateBackupCodes(): array
    {
        $codes = [];
        for ($i = 0; $i < 8; $i++) {
            $codes[] = strtoupper(Str::random(4) . '-' . Str::random(4));
        }
        return $codes;
    }
}
