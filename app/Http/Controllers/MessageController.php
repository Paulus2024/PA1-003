<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Message;

// class MessageController extends Controller
// {
//     public function index()
//     {
//         $allMessages = Message::latest()->get();
//         return view('pengguna.page.Contact.index_contact', compact('allMessages'));
//     }

//     public function index_masyarakat()
//     {
//         $allMessages = Message::latest()->get();
//         return view('dashboard.masyarakat.page.Contact.index_contact', compact('allMessages'));
//     }

//     public function index_sekretaris()
//     {
//         $allMessages = Message::latest()->get();
//         return view('dashboard.sekretaris.page.Contact.index_contact', compact('allMessages'));
//     }
// public function destroy($id)
// {
//     $message = Message::findOrFail($id);
//     $message->delete();

//     return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
// }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email',
//             'message' => 'required|string',
//         ]);

//         Message::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'message' => $request->message,
//         ]);

//         return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
//     }

// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan impor Auth facade

class MessageController extends Controller
{
    public function index()
    {
        // Untuk menampilkan pesan, Anda mungkin ingin juga mengambil data user terkait jika ada
        // $allMessages = Message::with('user')->latest()->get();
        $allMessages = Message::latest()->get();
        return view('pengguna.page.Contact.index_contact', compact('allMessages'));
    }

    public function index_masyarakat()
    {
        // $allMessages = Message::with('user')->latest()->get();
        $allMessages = Message::latest()->get();
        return view('dashboard.masyarakat.page.Contact.index_contact', compact('allMessages'));
    }

    public function index_sekretaris()
    {
        // $allMessages = Message::with('user')->latest()->get();
        $allMessages = Message::latest()->get();
        return view('dashboard.sekretaris.page.Contact.index_contact', compact('allMessages'));
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        // Pertimbangkan otorisasi di sini jika diperlukan (misalnya, hanya admin yang bisa menghapus)
        $message->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255', // Tambahkan max:255 untuk email
            'message' => 'required|string',
        ]);

        $dataToCreate = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            // 'is_approved' akan menggunakan nilai default dari database (false)
        ];

        // Periksa apakah pengguna sedang login
        if (Auth::check()) {
            // Jika login, tambahkan user_id
            $dataToCreate['user_id'] = Auth::id();
            // Anda mungkin juga ingin mengisi nama dan email dari data pengguna yang login
            // jika field form kosong atau Anda ingin meng-override-nya.
            // Contoh:
            // $dataToCreate['name'] = $dataToCreate['name'] ?? Auth::user()->name;
            // $dataToCreate['email'] = $dataToCreate['email'] ?? Auth::user()->email;
        }
        // Jika tidak login, user_id akan otomatis NULL karena tidak ada di $dataToCreate
        // dan kolom di database bersifat nullable.

        Message::create($dataToCreate);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }
}
