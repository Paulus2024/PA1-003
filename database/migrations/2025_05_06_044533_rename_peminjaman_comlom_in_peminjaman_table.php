<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //sebelum mengubah, pastikan semuanya sudah benar
        DB::statement("UPDATE `peminjaman` SET `status` = `menunggu` WHERE status_peminjaman = ('menunggu', 'disetujui', 'ditolak') ");
        //ganti nama kolom yang mengalami typo
        DB::statement("ALTER TABLE `peminjaman` CHANGE `status_peminjaman` `status_peminjaman` ENUM('menunggu', 'disetujui', 'ditolak') NOT NULL DEFAULT 'menunggu'");
        //         lakukan perubahan pada table peminjaman, ubah bagian status_peminjaman, pada status peminjaman ubah menjadi enum dengan pilihan menunggu, disetujui, ditolak dan harus diisi setidaknya dengan default menunggu

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //melakukan perubahan kembali jika di roollback suatu saat
        DB::statement("ALTER TABLE `peminjaman` CHANGE `status` `status_peminjaman` ENUM('menunggu', 'disetujui', 'ditolak') NOT NULL DEFAULT 'mmenunggu' ");
    }
};
