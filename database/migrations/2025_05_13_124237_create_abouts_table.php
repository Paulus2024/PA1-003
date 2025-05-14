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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('gambar1')->nullable(); // Atau tambahkan validasi required() jika diperlukan
            $table->text('sejarah')->nullable();
            $table->string('gambar2')->nullable();
            $table->text('visi_misi')->nullable();
            $table->integer('jumlah_penduduk')->nullable();
            $table->string('luas_wilayah')->nullable();
            $table->integer('jumlah_perangkat_desa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
