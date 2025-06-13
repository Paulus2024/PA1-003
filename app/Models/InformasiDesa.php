<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class InformasiDesa extends Model
// {
//     use HasFactory;

//     protected $table = 'informasi'; // Nama Table
//     protected $primaryKey = 'id_informasi'; // Nama Primary Key
//     protected $fillable = [
//         'id_informasi',
//         'user_id',
//         'judul_informasi',
//         'deskripsi_informasi',
//         'kategori_informasi',
//         'lampiran_informasi',
//         'status_informasi'
//     ];

//     public function user()
//     {
//         return $this->belongsTo(User::class, 'user_id', 'id');
//     }

//     protected $nullable = [
//         'create_at',
//         'update_at'
//     ];
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiDesa extends Model
{
    use HasFactory;

    // Nama tabel sudah benar 'informasi', bukan 'informasi_desa' seperti di controller
    // Ini PENTING, pastikan nama di controller dan model konsisten.
    // Jika nama tabel Anda adalah 'informasi_desa', ubah di sini.
    protected $table = 'informasi';

    protected $primaryKey = 'id_informasi';

    /**
     * Atribut yang dapat diisi secara massal.
     * 'id_informasi' DIHAPUS dari sini karena merupakan auto-incrementing primary key.
     */
    protected $fillable = [
        'user_id', // Pastikan kolom ini ada di tabel 'informasi' Anda
        'judul_informasi',
        'deskripsi_informasi',
        // 'kategori_informasi',
        'lampiran_informasi',
        'status_informasi'
    ];

    /**
     * Relasi ke model User. Ini sudah benar.
     */
    public function user()
    {
        // Pastikan nama model User sudah benar (biasanya App\Models\User)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Properti $nullable yang tidak standar sudah dihapus.
    // Laravel akan mengelola created_at dan updated_at secara otomatis.
}
