<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiDesa extends Model
{
    use HasFactory;

    protected $table = 'informasi'; // Nama Table
    protected $primarikey = 'id_informasi'; // Nama Primary Key
    protected $fillable = [
        'id_informasi',
        'judul_informasi',
        'deskripsi_informasi',
        'kategori_informasi',
        'lampiran_informasi',
        'status_informasi'
    ];

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}
