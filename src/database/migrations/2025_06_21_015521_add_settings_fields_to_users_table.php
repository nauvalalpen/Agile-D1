<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('phone')->nullable()->after('email');
            // $table->text('bio')->nullable()->after('phone');
            // $table->json('notification_preferences')->nullable()->after('bio');
            // $table->json('privacy_settings')->nullable()->after('notification_preferences');
            // $table->text('two_factor_secret')->nullable()->after('privacy_settings');
            // $table->text('two_factor_recovery_codes')->nullable()->after('two_factor_secret');
            // $table->timestamp('two_factor_confirmed_at')->nullable()->after('two_factor_recovery_codes');
            // $table->timestamp('last_login_at')->nullable()->after('two_factor_confirmed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'bio',
                'notification_preferences',
                'privacy_settings',
                'two_factor_secret',
                'two_factor_recovery_codes',
                'two_factor_confirmed_at',
                'last_login_at'
            ]);
        });
    }
};
