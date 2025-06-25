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
        Schema::table('facilities', function (Blueprint $table) {
            $table->integer('usage_count')->default(0)->after('deskripsi');
            $table->timestamp('last_used_at')->nullable()->after('usage_count');
        });
    }

    /**
     * Run the migrations.
     */
    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['usage_count', 'last_used_at']);
        });
    }
};
