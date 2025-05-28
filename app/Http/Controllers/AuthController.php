<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Log; // Tambahkan ini

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password berhasil direset, silakan login.')
            : back()->withErrors(['email' => __($status)]);
    }

    public function register(Request $request)
{
    Log::info('Pendaftaran dimulai untuk email: ' . $request->email);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);

    Log::info('Validasi berhasil untuk email: ' . $request->email);

    $response = Http::get('https://apilayer.net/api/check', [
        'access_key' => 'ff73f78f10fd2c0bc68d3752ce98f6c7',
        'email' => $request->email,
    ]);

    Log::info('Respons API untuk email: ' . $request->email . ', Respons: ' . json_encode($response->json()));

    if (!$response['format_valid'] || !$response['smtp_check']) {
        Log::error('Email tidak valid atau tidak aktif: ' . $request->email);
        return redirect()->back()->with('error', 'Email tidak valid atau tidak aktif.');
    }

    $user = User::create([  // Simpan instance User
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Log::info('Pengguna berhasil dibuat: ' . $request->email);

    Auth::login($user); // Login pengguna setelah pendaftaran!

    Log::info('Pengguna berhasil login: ' . $request->email);

    try {
        return redirect()->route('index.masyarakat')->with('success', 'Registrasi berhasil! Silakan login.');
    } catch (\Exception $e) {
        Log::error('Gagal melakukan redirect ke index.masyarakat: ' . $e->getMessage());
        throw $e;
    }
}
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found!');
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Incorrect password!');
        }

        if ($user->usertype === 'bumdes') {
            return redirect()->route('dashboard.bumdes');
        } elseif ($user->usertype === 'sekretaris') {
            return redirect()->route('dashboard.sekretaris');
        } else {
            return redirect('/index_masyarakat');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
