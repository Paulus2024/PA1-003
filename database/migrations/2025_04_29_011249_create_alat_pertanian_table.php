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
        Schema::create('alat_pertanian', function (Blueprint $table) {
            $table->id('id_alat_pertanian');
            $table->string('nama_alat_pertanian');
            $table->enum('jenis_alat', ['AlatBerat', 'AlatRingan']);
            $table->integer('harga_sewa');
            $table->enum('status_alat', ['tersedia', 'tidak_tersedia']);
            $table->string('kumlah_alat');
            $table->string('gambar_alat');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_pertanian');
    }
};
