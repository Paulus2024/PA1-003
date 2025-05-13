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
            DB::statement("ALTER TABLE peminjaman CHANGE COLUMN peminjaman nama_peminjam VARCHAR(255) NOT NULL");
            //pada table lakukan perubahan kolom peminjaman menjadi nama peminjaman
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            DB::statement("ALTER TABLE peminjaman CHANGE COLUMN nama_peminjam peminjaman VARCHAR(255) NOT NULL");
    }
};
