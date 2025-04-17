<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasDesaController;
use App\Http\Controllers\InformasiDesaController;
use App\Http\Controllers\GalleryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//=========================================================
// Route Pengguna
//=========================================================

Route::get('/', function () {
    return view('pengguna/page/home/index_home');
});

Route::get('/about', function () {
    return view('pengguna/page/About/index_about');
});

Route::get('/alat', function () {
    return view('pengguna/page/Alat_Pertanian/index_alat_pertanian');
});

Route::get('/informasi', function () {
    return view('pengguna/page/Informasi/index_informasi');
});

Route::get('/pengurus', function () {
    return view('pengguna/page/Data_Pengurus_Desa/index_data_pengurus_desa');
});

Route::get('/galeri', function () {
    return view('pengguna/page/Galeri/index_galeri');
});

Route::get('/fasilitas', function () {
    return view('pengguna/page/Fasilitas/index_fasilitas');
});

Route::get('/contact', function () {
    return view('pengguna/page/Contact/index_contact');
});

//=========================================================
// Route Auth
//=========================================================

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


//=========================================================
// Route Dashboard (Arah Login)
//=========================================================
//bumdes
Route::middleware(['auth'])->group(function () {
    Route::get('/index_bumdes', function () {
        return view('dashboard.bumdes.page.Home.index_home');
    })->name('dashboard.bumdes');
//sekretaris
    Route::get('/index_sekretaris', function () {//kode didalamnya akan di eksekusi jika route ini di akses
        return view('dashboard.sekretaris.page.Home.index_home');//saya meu membuat route ini untuk mengarahkan ke halaman dashboard sekretaris
    })->name('dashboard.sekretaris');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

//=========================================================
// Route Admin Sekretaris
//=========================================================
Route::get('/about_sekretaris', function () {
    return view('dashboard/sekretaris/page/About/index_about');
});

//==========================================================
// Route Fasilitas Sekretaris
//==========================================================
// Route::get('/fasilitas_sekretaris', function () {
//     return view('dashboard/sekretaris/page/Fasilitas/index_fasilitas');
// });
Route::get('/fasilitas_sekretaris', [FasilitasDesaController::class, 'index'])->name('sekretaris.fasilitas.index');
                                                                                                    // A
// Route::get('/fasilitas_sekretaris/create', [FasilitasDesaController::class, 'create'])->name('sekretaris.fasilitas.create');

Route::post('/fasilitas_sekretaris/store', [FasilitasDesaController::class, 'store'])->name('sekretaris.fasilitas.store');

// Route::get('/fasilitas/{id_fasilitas/edit', [FasilitasDesaController::class, 'edit'])->name('sekretaris.fasilitas.edit');

Route::put('/fasilitas_sekretaris/{id_fasilitas}', [FasilitasDesaController::class, 'update'])->name('sekretaris.fasilitas.update');

Route::delete('/fasilitas_sekretaris/{id_fasilitas}', [FasilitasDesaController::class, 'destroy'])->name('sekretaris.fasilitas.destroy');

//==========================================================

//==========================================================
// Route Informasi Sekretaris
//==========================================================
// Route::get('/informasi_sekretaris', function () {
//     return view('dashboard/sekretaris/page/Informasi/index_informasi');
// });
Route::get('/sekretaris/page/Informasi/informasi_sekretaris', [InformasiDesaController::class, 'index'])->name('sekretaris.informasi.berita'); //untuk menampilkan

Route::get('/informasi_pengumuman', [InformasiDesaController::class, 'index'])->name('sekretaris.informasi.pengumuman'); //untuk menampilkan

Route::post('/informasi_sekretaris/store', [InformasiDesaController::class, 'store'])->name('sekretaris.informasi.store'); //untuk menyimpan data

Route::put('/informasi_sekretaris/{id_fasilitas}', [InformasiDesaController::class, 'update'])->name('sekretaris.informasi.update'); //untuk mengupdate data

Route::delete('/informasi_sekretaris/{id_fasilitas)', [InformasiDesaController::class, 'destroy'])->name('sekretaris.informasi.destroy'); //untuk menghapus data
//==========================================================

// Route::get('/galeri_sekretaris', function () {
//     return view('dashboard/sekretaris/page/Galeri/index_galeri');
// });
// Daftar semua galeri (index)
Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
Route::post('/galleries', [GalleryController::class, 'sto
re'])->name('galleries.store');
Route::get('/galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
Route::put('/galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
Route::patch('/galleries/{gallery}', [GalleryController::class, 'update']); // Biasanya disertakan juga untuk update sebagian
Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

Route::get('/data_pengurus_desa_sekretaris', function () {
    return view('dashboard/sekretaris/page/Data_Pengurus_Desa/index_data_pengurus_desa');
});

Route::get('/alat_pertanian_sekretaris', function () {
    return view('dashboard/sekretaris/page/Alat_Pertanian/index_alat_pertanian');
});

Route::get('/contact_sekretaris', function () {
    return view('dashboard/sekretaris/page/Contact/index_contact');
});

//=========================================================
// Route Admin Bumdes
//=========================================================

Route ::get('/about_bumdes', function () {
    return view('dashboard/bumdes/page/About/index_about');
});

Route::get('/fasilitas_bumdes', function () {
    return view('dashboard/bumdes/page/Fasilitas/index_fasilitas');
});

Route::get('/informasi_bumdes', function () {
    return view('dashboard/bumdes/page/Informasi/index_informasi');
});

Route::get('/galeri_bumdes', function () {
    return view('dashboard/bumdes/page/Galeri/index_galeri');
});

Route::get('/data_pengurus_desa_bumdes', function () {
    return view('dashboard/bumdes/page/Data_Pengurus_Desa/index_data_pengurus_desa');
});

Route::get('/alat_pertanian_bumdes', function () {
    return view('dashboard/bumdes/page/Alat_Pertanian/index_alat_pertanian');
});

Route::get('/contact_bumdes', function () {
    return view('dashboard/bumdes/page/Contact/index_contact');
});

Route::resource('galleries', GalleryController::class);
