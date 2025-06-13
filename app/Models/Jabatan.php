<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan'; // Sesuaikan dengan nama tabel yang dibuat di migration
    protected $fillable = [
        'nama_jabatan',
        'deskripsi_jabatan',
    ];

    /**
     * Get the DataPengurusDesa that holds this Jabatan.
     */
    public function pengurus()
    {
        return $this->hasOne(DataPengurusDesa::class, 'jabatan_id', 'id');
    }
}
