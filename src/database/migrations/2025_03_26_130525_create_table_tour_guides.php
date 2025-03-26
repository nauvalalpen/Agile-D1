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
        Schema::create('tourGuides', function (Blueprint $table) {
            //
            $table->id();
            $table->string('nama');
            $table->string('nohp');
            $table->string('deskripsi');
            $table->string('alamat');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tourGuides', function (Blueprint $table) {
            //
        });
    }
};
