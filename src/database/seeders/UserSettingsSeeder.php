<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSettingsSeeder extends Seeder
{
    public function run()
    {
        $defaultNotificationPreferences = [
            'email_order_updates' => true,
            'email_security_alerts' => true,
            'email_marketing' => false,
            'push_order_updates' => true,
            'push_news' => false,
        ];

        $defaultPrivacySettings = [
            'profile_public' => false,
            'show_activity' => false,
            'analytics_tracking' => true,
            'personalized_ads' => false,
        ];

        // Update existing users without preferences
        User::whereNull('notification_preferences')
            ->orWhereNull('privacy_settings')
            ->chunk(100, function ($users) use ($defaultNotificationPreferences, $defaultPrivacySettings) {
                foreach ($users as $user) {
                    $user->update([
                        'notification_preferences' => $user->notification_preferences ?? $defaultNotificationPreferences,
                        'privacy_settings' => $user->privacy_settings ?? $defaultPrivacySettings,
                    ]);
                }
            });
    }
}
