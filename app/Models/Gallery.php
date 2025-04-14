<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galeri'; // Nama Table
    protected $primaryKey = 'id_galeri'; // Nama Primary Key


    protected $fillable = [
        'title',
        'gambar_galeri'
    ];

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}
