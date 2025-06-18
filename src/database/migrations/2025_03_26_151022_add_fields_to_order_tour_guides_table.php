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
        Schema::table('order_tour_guides', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending')->after('price_range');
            $table->decimal('final_price', 10, 2)->nullable()->after('status');
            $table->text('admin_notes')->nullable()->after('final_price');
            $table->boolean('is_read')->default(false)->after('admin_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_tour_guides', function (Blueprint $table) {
            $table->dropColumn(['status', 'final_price', 'admin_notes', 'is_read']);
        });
    }
};
