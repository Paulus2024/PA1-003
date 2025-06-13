<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'id');
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function markNotificationAsRead()
    {
        if (is_null($this->read_at)) {
            $this->update(['read_at' => now()]);
            $this->clearUserNotificationsCache($this->user_id);
        }
    }

    public static function createNotification($userId, $message, $type, $peminjamanId = null)
    {
        if (is_null($message) || trim($message) === '') {
            Log::warning("PESAN NOTIFIKASI KOSONG diterima untuk User ID: {$userId}, Type: {$type}, Peminjaman ID: {$peminjamanId}. Notifikasi mungkin tidak dibuat atau dibuat dengan pesan default.");
        }

        $notification = self::create([
            'user_id'       => $userId,
            'peminjaman_id' => $peminjamanId,
            'message'       => $message,
            'type'          => $type,
        ]);

        self::clearUserNotificationsCache($userId);
        return $notification;
    }

    private static function clearUserNotificationsCache($userId)
    {
        if ($userId) {
            Cache::forget('user_' . $userId . '_notifications_list');
            Cache::forget('user_' . $userId . '_unread_notifications_count');
            Cache::forget('user_' . $userId . '_bumdes_notifications'); 
            Cache::forget('user_' . $userId . '_masyarakat_notifications');
            Cache::forget('user_' . $userId . '_sekretaris_notifications');
        }
    }
}
