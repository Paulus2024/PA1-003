<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Storage;
use Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $registerUser = User::where("google_id", $googleUser->id)->first();

            if (!$registerUser) {
                $user = User::updateOrCreate([
                    'google_id' => $googleUser->id,
                ], [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt('user123'),
                    'usertype' => 'user',
                    'photo' => $googleUser->avatar,
                ]);

                \Log::info('User created:', $user->toArray());
                $imageContents = file_get_contents($googleUser->avatar);
                $imageName = time() . '.jpg';
                $path = 'profile_photos/' . $imageName;
                Storage::disk('public')->put($path, $imageContents);

                $user->photo = $imageName; // simpan path lengkap
                $user->save();
                Auth::login($user);
                return redirect('/index_masyarakat');
            }

            Auth::login($registerUser);
            return redirect('/');
        } catch (\Exception $e) {
            \Log::error('Google login failed: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Login dengan Google gagal: ' . $e->getMessage());
        }
    }

}
