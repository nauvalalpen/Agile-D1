<?php

namespace App\Helpers;

class SettingsHelper
{
    /**
     * Get default notification preferences
     */
    public static function getDefaultNotificationPreferences(): array
    {
        return [
            'email_order_updates' => true,
            'email_security_alerts' => true,
            'email_marketing' => false,
            'email_newsletter' => true,
            'push_order_updates' => true,
            'push_security_alerts' => true,
            'push_marketing' => false,
            'sms_security_alerts' => false,
            'sms_order_updates' => false,
        ];
    }

    /**
     * Get default privacy settings
     */
    public static function getDefaultPrivacySettings(): array
    {
        return [
            'profile_public' => false,
            'show_activity' => false,
            'analytics_tracking' => true,
            'personalized_ads' => false,
            'data_sharing' => false,
            'location_tracking' => false,
        ];
    }

    /**
     * Calculate security score based on user settings
     */
    public static function calculateSecurityScore($user): array
    {
        $score = 0;
        $maxScore = 100;
        $recommendations = [];

        // Email verification (20 points)
        if ($user->hasVerifiedEmail()) {
            $score += 20;
        } else {
            $recommendations[] = [
                'type' => 'danger',
                'title' => 'Verify your email address',
                'description' => 'Email verification is required for account security.',
                'action' => 'Verify Email',
                'url' => route('verification.notice')
            ];
        }

        // Strong password (25 points)
        if (self::hasStrongPassword($user)) {
            $score += 25;
        } else {
            $recommendations[] = [
                'type' => 'warning',
                'title' => 'Use a stronger password',
                'description' => 'Your password should be at least 12 characters with mixed case, numbers, and symbols.',
                'action' => 'Update Password',
                'url' => '#security'
            ];
        }

        // Two-factor authentication (30 points)
        if ($user->has2FAEnabled()) {
            $score += 30;
        } else {
            $recommendations[] = [
                'type' => 'warning',
                'title' => 'Enable Two-Factor Authentication',
                'description' => '2FA adds an extra layer of security to your account.',
                'action' => 'Setup 2FA',
                'url' => '#'
            ];
        }

        // Recent login activity (15 points)
        if (self::hasRecentSecureActivity($user)) {
            $score += 15;
        } else {
            $recommendations[] = [
                'type' => 'info',
                'title' => 'Review login activity',
                'description' => 'Regularly check your account for suspicious activity.',
                'action' => 'View Activity',
                'url' => '#security'
            ];
        }

        // Privacy settings configured (10 points)
        if (self::hasConfiguredPrivacy($user)) {
            $score += 10;
        } else {
            $recommendations[] = [
                'type' => 'info',
                'title' => 'Configure privacy settings',
                'description' => 'Review and customize your privacy preferences.',
                'action' => 'Privacy Settings',
                'url' => '#privacy'
            ];
        }

        // Determine score level
        $level = 'poor';
        if ($score >= 80) {
            $level = 'excellent';
        } elseif ($score >= 60) {
            $level = 'good';
        } elseif ($score >= 40) {
            $level = 'fair';
        }

        return [
            'score' => $score,
            'max_score' => $maxScore,
            'percentage' => round(($score / $maxScore) * 100),
            'level' => $level,
            'recommendations' => $recommendations
        ];
    }

    /**
     * Check if user has a strong password
     */
    private static function hasStrongPassword($user): bool
    {
        // This is a simplified check - in reality, you'd want to store
        // password strength metrics when the password is set
        return $user->updated_at->diffInDays(now()) < 90; // Password changed recently
    }

    /**
     * Check if user has recent secure activity
     */
    private static function hasRecentSecureActivity($user): bool
    {
        return $user->last_login_at && $user->last_login_at->diffInDays(now()) < 7;
    }

    /**
     * Check if user has configured privacy settings
     */
    private static function hasConfiguredPrivacy($user): bool
    {
        return !empty($user->privacy_settings);
    }

    /**
     * Get notification preference labels
     */
    public static function getNotificationLabels(): array
    {
        return [
            'email_order_updates' => 'Order status updates via email',
            'email_security_alerts' => 'Security alerts via email',
            'email_marketing' => 'Marketing emails and promotions',
            'email_newsletter' => 'Newsletter and updates',
            'push_order_updates' => 'Order notifications on device',
            'push_security_alerts' => 'Security alerts on device',
            'push_marketing' => 'Marketing notifications on device',
            'sms_security_alerts' => 'Security alerts via SMS',
            'sms_order_updates' => 'Order updates via SMS',
        ];
    }

    /**
     * Get privacy setting labels
     */
    public static function getPrivacyLabels(): array
    {
        return [
            'profile_public' => 'Make my profile visible to other users',
            'show_activity' => 'Show my activity status',
            'analytics_tracking' => 'Allow analytics tracking for site improvement',
            'personalized_ads' => 'Show personalized advertisements',
            'data_sharing' => 'Share anonymized data with partners',
            'location_tracking' => 'Allow location-based features',
        ];
    }

    /**
     * Get privacy impact levels
     */
    public static function getPrivacyImpacts(): array
    {
        return [
            'profile_public' => 'high',
            'show_activity' => 'medium',
            'analytics_tracking' => 'low',
            'personalized_ads' => 'medium',
            'data_sharing' => 'high',
            'location_tracking' => 'high',
        ];
    }

    /**
     * Validate notification preferences
     */
    public static function validateNotificationPreferences(array $preferences): array
    {
        $valid = [];
        $defaults = self::getDefaultNotificationPreferences();

        foreach ($defaults as $key => $defaultValue) {
            $valid[$key] = isset($preferences[$key]) ? (bool) $preferences[$key] : $defaultValue;
        }

        return $valid;
    }

    /**
     * Validate privacy settings
     */
    public static function validatePrivacySettings(array $settings): array
    {
        $valid = [];
        $defaults = self::getDefaultPrivacySettings();

        foreach ($defaults as $key => $defaultValue) {
            $valid[$key] = isset($settings[$key]) ? (bool) $settings[$key] : $defaultValue;
        }

        return $valid;
    }

    /**
     * Generate backup codes for 2FA
     */
    public static function generateBackupCodes(int $count = 8): array
    {
        $codes = [];
        
        for ($i = 0; $i < $count; $i++) {
            $codes[] = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8));
        }

        return $codes;
    }

    /**
     * Format file size
     */
    public static function formatFileSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get user data export structure
     */
    public static function getExportDataStructure(): array
    {
        return [
            'profile' => [
                'name' => 'Personal Information',
                'description' => 'Your basic profile information',
                'fields' => ['name', 'email', 'created_at', 'email_verified_at']
            ],
            'preferences' => [
                'name' => 'Account Preferences',
                'description' => 'Your notification and privacy settings',
                'fields' => ['notification_preferences', 'privacy_settings']
            ],
            'activity' => [
                'name' => 'Account Activity',
                'description' => 'Your login history and account usage',
                'fields' => ['last_login_at', 'login_count', 'orders_count']
            ],
            'orders' => [
                'name' => 'Order History',
                'description' => 'Your complete order history and transactions',
                'fields' => ['order_id', 'type', 'status', 'created_at']
            ]
        ];
    }

    /**
     * Get data retention policies
     */
    public static function getDataRetentionPolicies(): array
    {
        return [
            'profile_data' => [
                'name' => 'Profile Information',
                'retention' => 'Kept until account deletion',
                'description' => 'Basic profile information is retained as long as your account is active.'
            ],
            'order_history' => [
                'name' => 'Order History',
                'retention' => '7 years',
                'description' => 'Order records are kept for 7 years for legal and tax purposes.'
            ],
            'login_logs' => [
                'name' => 'Login Activity',
                'retention' => '2 years',
                'description' => 'Login history is kept for 2 years for security purposes.'
            ],
            'analytics_data' => [
                'name' => 'Usage Analytics',
                'retention' => '26 months',
                'description' => 'Anonymized usage data is kept for up to 26 months.'
            ],
            'support_tickets' => [
                'name' => 'Support Communications',
                'retention' => '3 years',
                'description' => 'Support conversations are kept for 3 years for quality assurance.'
            ]
        ];
    }

    /**
     * Get account deletion consequences
     */
    public static function getAccountDeletionConsequences(): array
    {
        return [
            'immediate' => [
                'Account access will be permanently disabled',
                'Profile information will be anonymized',
                'Active orders will be cancelled where possible',
                'Stored payment methods will be removed'
            ],
            'within_30_days' => [
                'Personal data will be permanently deleted',
                'Order history will be anonymized',
                'Support ticket history will be anonymized',
                'Account recovery will no longer be possible'
            ],
            'retained' => [
                'Anonymized analytics data (for legal compliance)',
                'Financial records (for tax and legal requirements)',
                'Fraud prevention data (for security purposes)'
            ]
        ];
    }

    /**
     * Sanitize user input for settings
     */
    public static function sanitizeInput(array $input): array
    {
        $sanitized = [];

        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $sanitized[$key] = trim(strip_tags($value));
            } elseif (is_bool($value) || is_numeric($value)) {
                $sanitized[$key] = $value;
            } elseif (is_array($value)) {
                $sanitized[$key] = self::sanitizeInput($value);
            }
        }

        return $sanitized;
    }

    /**
     * Check if feature is enabled
     */
    public static function isFeatureEnabled(string $feature): bool
    {
        $features = [
            '2fa' => config('app.features.two_factor_auth', true),
            'data_export' => config('app.features.data_export', true),
            'account_deletion' => config('app.features.account_deletion', true),
            'sms_notifications' => config('app.features.sms_notifications', false),
            'push_notifications' => config('app.features.push_notifications', false),
        ];

        return $features[$feature] ?? false;
    }
}
