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
        Schema::create('data_pengurus_desas', function (Blueprint $table) {
            $table->id('id_data_pengurus_desa');
            $table->string('nama_data_pengurus_desa');
            $table->string('jabatan_data_pengurus_desa');
            $table->string('deskripsi_data_pengurus_desa');
            $table->string('gambar_data_pengurus_desa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pengurus_desas');
    }
};
