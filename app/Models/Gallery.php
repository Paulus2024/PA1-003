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
        'user_id',
        'judul_galeri',
        'gambar_galeri'
    ];

    public function user()
    {
        // 'user_id' adalah foreign key di tabel 'galleries'
        // 'id' adalah primary key di tabel 'users' (sesuaikan jika berbeda)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}
