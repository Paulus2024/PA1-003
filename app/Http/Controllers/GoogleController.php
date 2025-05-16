<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            \Log::info('Google user data:', (array) $googleUser);

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                \Log::info('User not found, creating new user.');

                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt('google_password_default'),
                    'usertype' => 'user',
                ]);

                \Log::info('User created:', $user->toArray());
            }

            Auth::login($user);
            return redirect()->intended('/');
        } catch (\Exception $e) {
            \Log::error('Google login failed: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Login dengan Google gagal: ' . $e->getMessage());
        }
    }

}
