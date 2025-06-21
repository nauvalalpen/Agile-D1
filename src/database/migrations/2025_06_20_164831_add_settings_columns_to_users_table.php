<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Google OAuth fields
            // $table->string('google_id')->nullable()->after('password');
            // $table->string('avatar')->nullable()->after('google_id');
            
            // Two-Factor Authentication
            // $table->boolean('two_factor_enabled')->default(false)->after('avatar');
            // $table->text('two_factor_secret')->nullable()->after('two_factor_enabled');
            
            // User preferences
            // $table->json('notification_preferences')->nullable()->after('two_factor_secret');
            // $table->json('privacy_settings')->nullable()->after('notification_preferences');
            
            // Activity tracking
            // $table->timestamp('last_login_at')->nullable()->after('privacy_settings');
            
            // Add indexes for performance
            $table->index('google_id');
            $table->index('two_factor_enabled');
            $table->index('last_login_at');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['google_id']);
            $table->dropIndex(['two_factor_enabled']);
            $table->dropIndex(['last_login_at']);
            
            $table->dropColumn([
                'google_id',
                'avatar',
                'two_factor_enabled',
                'two_factor_secret',
                'notification_preferences',
                'privacy_settings',
                'last_login_at',
            ]);
        });
    }
};
