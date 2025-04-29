<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AlatPertanian extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug', 'deskripsi', 'kategori', 'gambar'];

    protected static function booted()
    {
        static::creating(function ($alat) {
            $alat->slug = Str::slug($alat->nama);
        });

        static::updating(function ($alat) {
            $alat->slug = Str::slug($alat->nama);
        });
    }
}
