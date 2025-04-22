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
        'nama_data_pengurus_desa',
        'jabatan_data_pengurus_desa',
        'deskripsi_data_pengurus_desa',
        'gambar_data_pengurus_desa'
    ];

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}
