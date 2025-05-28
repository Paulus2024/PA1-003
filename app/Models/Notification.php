<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Notification extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'user_id',
//         'peminjaman_id', // Optional, bisa null jika notifikasi tidak terkait peminjaman
//         'message',
//         'read_at',
//         'type'//membedakan field type untuk notifikasi
//     ];

//     protected $casts = [
//         'read_at' => 'datetime',
//     ];

//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     public function peminjaman()
//     {
//         return $this->belongsTo(Peminjaman::class);
//     }

//     public function scopeUnread($query)
//     {
//         return $query->whereNull('read_at');
//     }

//     public function markAsRead()
//     {
//         if (is_null($this->read_at)) {
//             $this->update(['read_at' => now()]);
//         }
//     }
// }


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'peminjaman_id',
        'message',
        'read_at',
        'type'
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->update(['read_at' => now()]);
        }
    }
}
