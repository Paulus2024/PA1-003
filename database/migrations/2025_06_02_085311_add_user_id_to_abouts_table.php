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
            // Tambahkan kolom user_id
            // Sebaiknya letakkan setelah primary key atau di awal kolom data
            // Jadikan nullable jika ada data 'abouts' lama yang tidak memiliki user_id,
            // atau jika entri 'about' bisa dibuat tanpa user (jarang terjadi untuk data yang diautentikasi).
            // Jika tabel 'abouts' diharapkan selalu memiliki satu user_id, Anda bisa menghapus nullable()
            // setelah memastikan semua data lama (jika ada) sudah diupdate atau jika ini setup baru.
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Asumsi primary key adalah 'id'

            // Tambahkan foreign key constraint
            // 'user_id' mereferensikan kolom 'id' di tabel 'users'
            // onDelete('cascade') berarti jika user dihapus, data about terkait user tersebut juga akan dihapus.
            // Sesuaikan 'users' jika nama tabel pengguna Anda berbeda.
            $table->foreign('user_id')
                ->references('id')
                ->on('users') // Ganti 'users' jika nama tabel user Anda berbeda
                ->onDelete('cascade'); // Pilihan lain: 'set null' (jika user_id nullable), 'restrict'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['user_id']); // Atau $table->dropForeign('abouts_user_id_foreign');

            // Hapus kolom user_id
            $table->dropColumn('user_id');
        });
    }
};
