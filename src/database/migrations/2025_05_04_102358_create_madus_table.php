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
        Schema::create('madus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_madu');
            $table->string('ukuran');
            $table->decimal('harga', 10, 2);
            $table->text('deskripsi');
            $table->integer('stock');
            $table->string('gambar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('madus');
    }
};
