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
        Schema::table('abouts', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada untuk menghindari error jika migrasi dijalankan lebih dari sekali
            if (!Schema::hasColumn('abouts', 'gambar_1')) {
                $table->string('gambar_1')->nullable()->after('jumlah_perangkat_desa'); // Sesuaikan posisi 'after' jika perlu
            }
            if (!Schema::hasColumn('abouts', 'gambar_2')) {
                $table->string('gambar_2')->nullable()->after('gambar_1');
            }
            // Anda bisa juga menambahkan kolom lain di sini jika ternyata ada yang kurang
            // Contoh, jika 'sejarah' atau 'visi_misi' juga tidak ada:
            // if (!Schema::hasColumn('abouts', 'sejarah')) {
            //     $table->text('sejarah')->nullable()->after('id'); // atau posisi lain
            // }
            // if (!Schema::hasColumn('abouts', 'visi_misi')) {
            //     $table->text('visi_misi')->nullable()->after('sejarah');
            // }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            // Jika ingin bisa di-rollback, tambahkan dropColumn
            // $table->dropColumn(['gambar_1', 'gambar_2'/*, 'sejarah', 'visi_misi'*/]);
        });
    }
};
