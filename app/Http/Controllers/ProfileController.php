<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit() {
        return view('profile');
    }

    public function update(Request $request) {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/profile_photos/' . $user->photo);
            }
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/profile_photos', $filename);
            $user->photo = $filename;
        }

        $user->name = $validated['name'];
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function deletePhoto() {
        $user = Auth::user();
        if ($user->photo) {
            Storage::delete('public/profile_photos/' . $user->photo);
            $user->photo = null;
            $user->save();
        }
        return back()->with('success', 'Foto profil dihapus.');
    }

    public function deleteAccount() {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
