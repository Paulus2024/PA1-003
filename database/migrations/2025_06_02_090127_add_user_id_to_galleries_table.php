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
        Schema::table('galleries', function (Blueprint $table) {
            // Tambahkan kolom user_id setelah id_galeri (sesuai primaryKey model Anda)
            // Jadikan nullable() jika ada data lama atau jika data ini bisa dibuat tanpa user terkait langsung
            $table->unsignedBigInteger('user_id')->nullable()->after('id_galeri');

            // Tambahkan foreign key constraint
            // 'user_id' mereferensikan kolom 'id' di tabel 'users'
            // onDelete('cascade') berarti jika user dihapus, data galeri terkait juga akan dihapus.
            // Sesuaikan 'users' jika nama tabel pengguna Anda berbeda.
            $table->foreign('user_id')
                ->references('id')
                ->on('users') // Pastikan nama tabel pengguna Anda adalah 'users'
                ->onDelete('cascade'); // Opsi lain: 'set null' (jika user_id nullable), 'restrict'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['user_id']); // Atau $table->dropForeign('galleries_user_id_foreign');

            // Hapus kolom user_id
            $table->dropColumn('user_id');
        });
    }
};
