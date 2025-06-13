<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('dashboard.bumdes.page.Alat_Pertanian.detail_peminjaman', compact('notifications'));
    }

    /**
     * Tandai notifikasi individual sebagai sudah dibaca TANPA redirect otomatis.
     * Hanya akan kembali ke halaman sebelumnya.
     *
     * @param  \Illuminate\Notifications\DatabaseNotification  $notification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead(DatabaseNotification $notification)
    {
        if (auth()->id() !== $notification->notifiable_id) {
            abort(403, 'Unauthorized action.');
        }

        $notification->markAsRead();

        return back()->with('info', 'Notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * Tandai notifikasi individual sebagai sudah dibaca dan arahkan ke tautan terkait.
     *
     * @param  \Illuminate\Notifications\DatabaseNotification  $notification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsReadAndRedirect(DatabaseNotification $notification)
    {
        if (auth()->id() !== $notification->notifiable_id) {
            abort(403, 'Unauthorized action.');
        }

        $notification->markAsRead();

        $link = $notification->data['link'] ?? route('index.masyarakat');

        return redirect($link)->with('success', 'Notifikasi telah dibaca.');
    }

    /**
     * Tandai semua notifikasi belum dibaca milik pengguna sebagai sudah dibaca.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}
