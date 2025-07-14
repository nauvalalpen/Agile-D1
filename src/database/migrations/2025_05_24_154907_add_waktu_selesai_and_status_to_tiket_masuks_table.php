<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tiket_masuks', function (Blueprint $table) {
            $table->timestamp('waktu_selesai')->nullable()->after('alamat'); 
            $table->string('status')->default('active')->after('waktu_selesai'); // default
        });
    }

    public function down()
    {
        Schema::table('tiket_masuks', function (Blueprint $table) {
            $table->dropColumn(['waktu_selesai', 'status']);
        });
    }
};
