<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('informasi', function (Blueprint $table) {
            // Perintah untuk MENGHAPUS kolom dari tabel
            $table->dropColumn('kategori_informasi');
        });
    }

    /**
     * Membatalkan migrasi.
     */
    public function down(): void
    {
        Schema::table('informasi', function (Blueprint $table) {
            // Perintah untuk MENGEMBALIKAN kolom jika migrasi dibatalkan
            // Ini adalah praktik yang baik untuk membuat migrasi bisa di-rollback
            $table->string('kategori_informasi')->after('deskripsi_informasi');
        });
    }
};
