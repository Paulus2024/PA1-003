<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SekretarisController extends Controller
{
    public function index()
    {
        return view('dashboard.sekretaris');
    }

    public function edit()
    {
        return view('sekretaris.profile', [
            'user' => Auth::user()
        ]);
    }

    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Storage;

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // ✅ Hash password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // ✅ Simpan foto profil jika diupload
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && Storage::exists('public/profile_photos/' . $user->profile_photo)) {
                Storage::delete('public/profile_photos/' . $user->profile_photo);
            }

            $filename = time() . '.' . $request->file('profile_photo')->getClientOriginalExtension();
            $request->file('profile_photo')->storeAs('public/profile_photos', $filename);
            $user->profile_photo = $filename;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }


    public function deletePhoto(Request $request)
    {
        $user = auth()->user();

        // Hapus foto dari storage
        if ($user->profile_photo) {
            Storage::delete('public/profile_photos/' . $user->profile_photo);
        }

        // Update kolom profile_photo di database menjadi null
        $user->update(['profile_photo' => null]);

        return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
    }
}
