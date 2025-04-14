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
        Schema::create('informasi', function (Blueprint $table) {
            $table->id('id_informasi');
            $table->string('judul_informasi');
            $table->text('deskripsi_informasi')->nullable();
            $table->enum('kategori_informasi', ['berita', 'pengumuman']);
            $table->string('gambar_informasi')->nullable();
            $table->enum('status_informasi', ['draft','publish'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi');
    }
};
