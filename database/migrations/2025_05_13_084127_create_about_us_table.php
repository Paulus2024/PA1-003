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
        Schema::create('about_uses', function (Blueprint $table) {
            $table->id();
            $table->string('gambar1')->nullable(); // Jika gambar boleh kosong
            $table->text('visi_misi')->nullable();
            $table->string('gambar2')->nullable();
            $table->longText('sejarah')->nullable();
            $table->integer('jumlah_penduduk')->nullable();
            $table->string('luas_wilayah')->nullable();
            $table->integer('jumlah_perangkat_desa')->nullable();
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_uses');
    }
};
