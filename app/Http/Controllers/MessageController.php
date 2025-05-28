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

    public function index_sekretaris()
    {
        $allMessages = Message::latest()->get();
        return view('dashboard.sekretaris.page.Contact.index_contact', compact('allMessages'));
    }
public function destroy($id)
{
    $message = Message::findOrFail($id);
    $message->delete();

    return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }

}
