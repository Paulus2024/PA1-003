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
        Schema::table('informasi', function (Blueprint $table) {
            // Tambahkan kolom user_id setelah kolom id_informasi
            // Pastikan tipe data unsignedBigInteger agar cocok dengan tipe default id di tabel users
            // Jadikan nullable jika ada data lama yang mungkin tidak memiliki user_id,
            // atau jika Anda berencana mengisinya nanti.
            // Jika ini adalah setup baru atau Anda yakin semua informasi akan memiliki user, Anda bisa menghapus nullable().
            $table->unsignedBigInteger('user_id')->nullable()->after('id_informasi');

            // Tambahkan foreign key constraint
            // 'user_id' mereferensikan kolom 'id' di tabel 'users'
            // onDelete('cascade') berarti jika user dihapus, semua informasi terkait user tersebut juga akan dihapus.
            // Anda bisa menggantinya dengan onDelete('set null') jika user_id nullable dan Anda ingin user_id menjadi NULL saat user dihapus.
            // Sesuaikan 'users' jika nama tabel pengguna Anda berbeda.
            $table->foreign('user_id')
                ->references('id')
                ->on('users') // Ganti 'users' jika nama tabel user Anda berbeda
                ->onDelete('cascade'); // Pilihan lain: 'set null', 'restrict'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            // Nama constraint default: nama_tabel_nama_kolom_foreign
            $table->dropForeign(['user_id']); // Atau $table->dropForeign('informasi_user_id_foreign');

            // Hapus kolom user_id
            $table->dropColumn('user_id');
        });
    }
};
