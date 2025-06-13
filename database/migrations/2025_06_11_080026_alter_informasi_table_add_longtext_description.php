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
        Schema::table('informasi', function (Blueprint $table) {
            // Ubah tipe kolom deskripsi_informasi menjadi longText
            $table->longText('deskripsi_informasi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi', function (Blueprint $table) {
            // Kembalikan ke tipe text jika diperlukan saat rollback
            $table->text('deskripsi_informasi')->nullable()->change();
        });
    }
};
