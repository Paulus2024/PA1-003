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
        Schema::table('data_pengurus_desas', function (Blueprint $table) {
            // Tambahkan kolom user_id setelah id_data_pengurus_desa
            // Jadikan nullable() jika ada data lama atau jika data ini bisa dibuat tanpa user terkait langsung
            // Untuk konsistensi, sebaiknya setiap data yang dibuat oleh user memiliki user_id
            $table->unsignedBigInteger('user_id')->nullable()->after('id_data_pengurus_desa');

            // Tambahkan foreign key constraint
            // 'user_id' mereferensikan kolom 'id' di tabel 'users'
            // onDelete('cascade') berarti jika user dihapus, data pengurus terkait juga akan dihapus.
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
        Schema::table('data_pengurus_desas', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            // Nama constraint default: nama_tabel_nama_kolom_foreign
            $table->dropForeign(['user_id']); // Atau $table->dropForeign('data_pengurus_desas_user_id_foreign');

            // Hapus kolom user_id
            $table->dropColumn('user_id');
        });
    }
};
