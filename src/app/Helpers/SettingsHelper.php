<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Str;

class SettingsHelper
{
    /**
     * Calculate security score for user
     */
    public static function calculateSecurityScore(User $user)
    {
        $score = 0;
        $recommendations = [];

        // Check password strength (basic check)
        if ($user->password) {
            $score += 30;
        }

        // Check email verification
        if ($user->hasVerifiedEmail()) {
            $score += 20;
        } else {
            $recommendations[] = [
                'type' => 'warning',
                'title' => 'Verify your email',
                'description' => 'Please verify your email address to improve security.'
            ];
        }

        // Check 2FA
        if ($user->has2FAEnabled()) {
            $score += 30;
        } else {
            $recommendations[] = [
                'type' => 'info',
                'title' => 'Enable Two-Factor Authentication',
                'description' => 'Add an extra layer of security to your account.'
            ];
        }

        // Check profile completeness
        if ($user->phone && $user->bio) {
            $score += 20;
        } else {
            $recommendations[] = [
                'type' => 'info',
                'title' => 'Complete your profile',
                'description' => 'Add phone number and bio for better security.'
            ];
        }

        // Determine level
        if ($score >= 80) {
            $level = 'excellent';
        } elseif ($score >= 60) {
            $level = 'good';
        } elseif ($score >= 40) {
            $level = 'fair';
        } else {
            $level = 'poor';
        }

        return [
            'percentage' => $score,
            'level' => $level,
            'recommendations' => $recommendations
        ];
    }

    /**
     * Get default notification preferences
     */
    public static function getDefaultNotificationPreferences()
    {
        return [
            'email_orders' => true,
            'email_promotions' => false,
            'email_updates' => true,
            'push_orders' => true,
            'push_promotions' => false,
            'push_updates' => true,
            'sms_orders' => false,
            'sms_promotions' => false,
        ];
    }

    /**
     * Get notification labels
     */
    public static function getNotificationLabels()
    {
        return [
            'email_orders' => 'Order confirmations and updates',
            'email_promotions' => 'Promotional offers and deals',
            'email_updates' => 'Account and security updates',
            'push_orders' => 'Order notifications',
            'push_promotions' => 'Promotional notifications',
            'push_updates' => 'Important updates',
            'sms_orders' => 'Order confirmations',
            'sms_promotions' => 'Promotional messages',
        ];
    }

    /**
     * Validate notification preferences
     */
    public static function validateNotificationPreferences(array $preferences)
    {
        $defaults = self::getDefaultNotificationPreferences();
        $validated = [];

        foreach ($defaults as $key => $defaultValue) {
            $validated[$key] = isset($preferences[$key]) ? (bool) $preferences[$key] : false;
        }

        return $validated;
    }

    /**
     * Get default privacy settings
     */
    public static function getDefaultPrivacySettings()
    {
        return [
            'profile_visibility' => true,
            'show_email' => false,
            'show_phone' => false,
            'allow_messages' => true,
            'data_collection' => true,
            'marketing_emails' => false,
        ];
    }

    /**
     * Get privacy labels
     */
    public static function getPrivacyLabels()
    {
        return [
            'profile_visibility' => 'Make my profile visible to other users',
            'show_email' => 'Show my email address on profile',
            'show_phone' => 'Show my phone number on profile',
            'allow_messages' => 'Allow other users to message me',
            'data_collection' => 'Allow data collection for service improvement',
            'marketing_emails' => 'Receive marketing emails',
        ];
    }

    /**
     * Get privacy impacts
     */
    public static function getPrivacyImpacts()
    {
        return [
            'profile_visibility' => 'medium',
            'show_email' => 'high',
            'show_phone' => 'high',
            'allow_messages' => 'low',
            'data_collection' => 'medium',
            'marketing_emails' => 'low',
        ];
    }

    /**
     * Validate privacy settings
     */
    public static function validatePrivacySettings(array $settings)
    {
        $defaults = self::getDefaultPrivacySettings();
        $validated = [];

        foreach ($defaults as $key => $defaultValue) {
            $validated[$key] = isset($settings[$key]) ? (bool) $settings[$key] : false;
        }

        return $validated;
    }

    /**
     * Generate backup codes for 2FA
     */
    public static function generateBackupCodes($count = 8)
    {
        $codes = [];
        for ($i = 0; $i < $count; $i++) {
            $codes[] = Str::upper(Str::random(4) . '-' . Str::random(4));
        }
        return $codes;
    }
}
