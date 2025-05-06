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
        DB::statement(
            <<<SQL
                ALTER TABLE `peminjaman`
                CHANGE `status_peminjaman` `status_peminjaman` ENUM('menunggu', 'disetujui', 'ditolak') NOT NULL DEFAULT 'menunggu'
            SQL
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement(
            <<<SQL
                ALTER TABLE `peminjaman`
                CHANGE `status_peminjaman` `status_peminjaman` ENUM('menunggu', 'disetujui', 'ditolak') NOT NULL DEFAULT 'mmenunggu'
            SQL
        );
    }
};
