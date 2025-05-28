<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('dashboard.bumdes.page.Alat_Pertanian.detail_peminjaman', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        $notification->read_at = now();
        $notification->save();

        return back(); // Atau redirect ke halaman yang sesuai
    }
}
