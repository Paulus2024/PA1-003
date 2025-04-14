<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasDesa extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';//Nama Table
    protected $primaryKey = 'id_fasilitas';//Nama Primary Key

    protected $fillable = [
        'nama_fasilitas',
        'deskripsi_fasilitas',
        'lokasi_fasilitas',
        'gambar_fasilitas'
    ];

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}
