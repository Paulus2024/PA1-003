<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries'; // Nama Table
    protected $primaryKey = 'id_galeri'; // Nama Primary Key


    protected $fillable = [
        'judul_galeri',
        'gambar_galeri'
    ];

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}
