<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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
            Cache::forget('user_' . $this->user_id . '_notifications');
            Cache::forget('user_' . $this->user_id . '_bumdes_notifications');
            Cache::forget('user_' . $this->user_id . '_masyarakat_notifications');
        }
    }

    public static function createNotification($userId, $message, $type, $peminjamanId = null)
    {
        self::create([
            'user_id' => $userId,
            'peminjaman_id' => $peminjamanId,
            'message' => $message,
            'type' => $type,
        ]);
        // Invalidate cache untuk user penerima
        Cache::forget('user_' . $userId . '_notifications');
        Cache::forget('user_' . $userId . '_bumdes_notifications');
        Cache::forget('user_' . $userId . '_masyarakat_notifications');
        Cache::forget('user_' . $userId . '_sekretaris_notifications');
        Cache::forget('user_' . $userId . '_unread_notifications_count');    }
}
