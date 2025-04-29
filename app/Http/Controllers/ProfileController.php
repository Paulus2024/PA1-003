<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::user();
        if ($user->profile_photo) {
            Storage::delete('public/profile_photos/' . $user->profile_photo);
        }

        $filename = time() . '.' . $request->file('profile_photo')->extension();
        $request->file('profile_photo')->storeAs('public/profile_photos', $filename);

        $user->profile_photo = $filename;
        $user->save();

        return back()->with('success', 'Foto profil diperbarui.');
    }

    public function deletePhoto()
    {
        $user = Auth::user();
        if ($user->profile_photo) {
            Storage::delete('public/profile_photos/' . $user->profile_photo);
            $user->profile_photo = null;
            $user->save();
        }
        return back()->with('success', 'Foto profil dihapus.');
    }

    public function deleteAccount()
    {
        $user = Auth::user();
        Auth::logout();
        if ($user->profile_photo) {
            Storage::delete('public/profile_photos/' . $user->profile_photo);
        }
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}

