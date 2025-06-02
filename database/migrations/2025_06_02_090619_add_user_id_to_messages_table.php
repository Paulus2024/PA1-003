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
        Schema::table('messages', function (Blueprint $table) {
            // Tambahkan kolom user_id setelah kolom id (primary key default)
            // Kolom ini WAJIB nullable karena pesan bisa juga dikirim oleh pengguna yang tidak login (tamu)
            $table->unsignedBigInteger('user_id')->nullable()->after('id');

            // Tambahkan foreign key constraint
            // 'user_id' mereferensikan kolom 'id' di tabel 'users'
            // onDelete('set null'): Jika user dihapus, user_id pada pesan terkait akan menjadi NULL.
            // Ini cocok karena pesan mungkin masih relevan meskipun pengirimnya (jika user) sudah dihapus.
            // Alternatif lain adalah onDelete('cascade') jika Anda ingin pesan juga terhapus.
            $table->foreign('user_id')
                ->references('id')
                ->on('users') // Pastikan nama tabel pengguna Anda adalah 'users'
                ->onDelete('set null'); // Mengatur user_id menjadi NULL jika user dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['user_id']); // Atau $table->dropForeign('messages_user_id_foreign');

            // Hapus kolom user_id
            $table->dropColumn('user_id');
        });
    }
};
