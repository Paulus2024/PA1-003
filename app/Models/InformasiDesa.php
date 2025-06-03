<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiDesa extends Model
{
    use HasFactory;

    protected $table = 'informasi'; // Nama Table
    protected $primaryKey = 'id_informasi'; // Nama Primary Key
    protected $fillable = [
        'id_informasi',
        'user_id',
        'judul_informasi',
        'deskripsi_informasi',
        'kategori_informasi',
        'lampiran_informasi',
        'status_informasi'
    ];

    public function user()
    {
        // 'user_id' adalah foreign key di tabel 'informasi'
        // 'id' adalah primary key di tabel 'users' (sesuaikan jika berbeda)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}
