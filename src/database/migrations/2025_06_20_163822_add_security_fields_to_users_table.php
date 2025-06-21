<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_login_at')->nullable()->after('updated_at');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
            $table->json('login_history')->nullable()->after('last_login_ip');
            $table->boolean('two_factor_enabled')->default(false)->after('is_verified');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_login_at', 'last_login_ip', 'login_history', 'two_factor_enabled']);
        });
    }
};
