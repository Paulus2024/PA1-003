<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PeminjamanBaru extends Notification
{
    use Queueable;

    protected $peminjaman;
    protected $alat;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($peminjaman, $alat)
    {
        $this->peminjaman = $peminjaman;
        $this->alat = $alat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // Hanya simpan di database
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'peminjaman_id' => $this->peminjaman->id,
            'nama_peminjam' => $this->peminjaman->nama_peminjam,
            'alat_pertanian' => $this->alat->nama_alat_pertanian,
        ];
    }
}
