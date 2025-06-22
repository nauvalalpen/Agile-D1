<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('google_id')->nullable()->after('email');
            // $table->string('avatar')->nullable()->after('photo');
            // $table->json('notification_preferences')->nullable()->after('is_verified');
            // $table->json('privacy_settings')->nullable()->after('notification_preferences');
            $table->text('two_factor_secret')->nullable()->after('privacy_settings');
            $table->json('two_factor_recovery_codes')->nullable()->after('two_factor_secret');
            // $table->timestamp('last_login_at')->nullable()->after('two_factor_recovery_codes');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'google_id',
                'avatar',
                'notification_preferences',
                'privacy_settings',
                'two_factor_secret',
                'two_factor_recovery_codes',
                'last_login_at'
            ]);
        });
    }
};
