<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Pastikan pengguna sudah login (meskipun route group sudah ada 'auth',
        //    double check di sini tidak masalah, atau bisa diabaikan jika yakin sudah ter-cover)
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Periksa apakah pengguna yang login adalah admin
        //    Sesuaikan 'role' dan 'admin' dengan implementasi Anda
        if (Auth::user()->usertype === 'bumdes') { // GANTI 'role' dan 'admin' jika perlu
            return $next($request); // Lanjutkan ke request berikutnya jika admin
        }

        // Jika bukan admin, kembalikan response error atau redirect
        // abort(403, 'ANDA TIDAK MEMILIKI AKSES SEBAGAI ADMIN.');
        // Atau redirect ke halaman lain dengan pesan error
        return redirect('/')->with('error', 'Anda tidak memiliki hak akses admin.');    }
}
