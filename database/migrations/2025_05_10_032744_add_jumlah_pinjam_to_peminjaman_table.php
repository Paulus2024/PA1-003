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
        Schema::table('peminjaman', function (Blueprint $pada_table) {
            $pada_table->integer('jumlah_alat_di_sewa')->after('tanggal_pinjam')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $pada_table) {
            $pada_table->dropColumn('jumlah_alat_di_sewa');
        });
    }
};
