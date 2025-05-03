<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Rename kolom salah ketik ke 'peminjam'
        Schema::table('peminjaman', function (Blueprint $table) {
            if (Schema::hasColumn('peminjaman', 'pemijaman')) {
                DB::statement('ALTER TABLE peminjaman RENAME COLUMN pemijaman TO peminjam');
            }
            if (Schema::hasColumn('peminjaman', 'peminjama')) {
                DB::statement('ALTER TABLE peminjaman RENAME COLUMN peminjama TO peminjam');
            }
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            if (Schema::hasColumn('peminjaman', 'peminjam')) {
                DB::statement('ALTER TABLE peminjaman RENAME COLUMN peminjam TO pemijaman');
            }
        });
    }
};
