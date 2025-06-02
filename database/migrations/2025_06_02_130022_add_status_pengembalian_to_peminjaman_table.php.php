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
        Schema::table('peminjaman', function (Blueprint $table) {
            // Tambahkan kolom ini jika belum ada
            $table->string('status_pengembalian')->nullable()->after('status_peminjaman'); // Simpan status seperti 'menunggu_verifikasi', 'disetujui', 'ditolak'
            $table->string('bukti_pengembalian')->nullable()->after('status_pengembalian'); // Untuk menyimpan path/nama file foto bukti
            $table->timestamp('tanggal_kembali_aktual')->nullable()->after('bukti_pengembalian'); // Tanggal alat benar-benar kembali
            $table->text('catatan_admin')->nullable()->after('tanggal_kembali_aktual'); // Catatan dari admin saat verifikasi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn(['status_pengembalian', 'bukti_pengembalian', 'tanggal_kembali_aktual', 'catatan_admin']);
        });
    }
};
