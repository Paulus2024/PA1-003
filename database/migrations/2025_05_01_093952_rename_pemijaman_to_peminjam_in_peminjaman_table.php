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
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // 1. Tambah kolom baru 'peminjam'
            $table->string('peminjam')->after('alat_pertanian_id');
        });

        // 2. Salin data dari kolom lama
        DB::table('peminjaman')
            ->update(['peminjam' => DB::raw('pemijaman')]);

        Schema::table('peminjaman', function (Blueprint $table) {
            // 3. Drop kolom lama
            $table->dropColumn('pemijaman');
        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Balikkan: tambahkan kembali kolom lama
            $table->string('pemijaman')->after('alat_pertanian_id');
        });

        DB::table('peminjaman')
            ->update(['pemijaman' => DB::raw('peminjam')]);

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('peminjam');
        });
    }
};
