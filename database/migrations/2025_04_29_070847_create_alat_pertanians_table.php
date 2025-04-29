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
        Schema::create('alat_pertanians', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('slug')->unique(); // untuk URL SEO-friendly
            $table->text('deskripsi')->nullable();
            $table->string('kategori', 20); // 'ringan', 'berat', dll
            $table->string('gambar')->nullable(); // path/lokasi file gambar di storage
            $table->timestamps();

            // Tambahkan index untuk kolom yang sering di-query
            $table->index('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_pertanians');
    }
};
