<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $allMessages = Message::latest()->get();
        return view('pengguna.page.Contact.index_contact', compact('allMessages'));
    }

    public function index_masyarakat()
    {
        $allMessages = Message::latest()->get();
        return view('dashboard.masyarakat.page.Contact.index_contact', compact('allMessages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Message::create($request->only('name', 'email', 'message'));

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}
