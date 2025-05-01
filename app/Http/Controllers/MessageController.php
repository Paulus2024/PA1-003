<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $allMessages = \App\Models\Message::latest()->get();
        return view('pengguna.page.Contact.index_contact', compact('allMessages'));
    }


    public function store(Request $request)
    {
        Message::create($request->all());
        return redirect()->route('contact');
    }
}
