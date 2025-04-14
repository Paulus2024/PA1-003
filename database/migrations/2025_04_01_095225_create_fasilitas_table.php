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
        Schema::create('fasilitas', function (Blueprint $table) {//buat table
            $table->id('id_fasilitas');//prymari key, auto increment
            $table->string('nama_fasilitas');
            $table->text('deskripsi_fasilitas');
            $table->string('lokasi_fasilitas');
            $table->string('gambar_fasilitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
