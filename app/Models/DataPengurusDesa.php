<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengurusDesa extends Model
{
    use HasFactory;

    protected $table = 'data_pengurus_desas';
    protected $primaryKey = 'id_data_pengurus_desa';

    protected $fillable = [
        'user_id',
        'nama_data_pengurus_desa',
        'jabatan_data_pengurus_desa',
        'deskripsi_data_pengurus_desa',
        'gambar_data_pengurus_desa',
    ];

    public function user()
    {
        // 'user_id' adalah foreign key di tabel 'data_pengurus_desas'
        // 'id' adalah primary key di tabel 'users' (sesuaikan jika berbeda)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}


