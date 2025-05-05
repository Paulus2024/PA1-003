<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Sekretaris\ProfilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasDesaController;
use App\Http\Controllers\InformasiDesaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DataPengurusDesaController;
use App\Http\Controllers\AlatPertanianController;
use App\Models\AlatPertanian;
use App\Http\Controllers\PeminjamanController;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
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
Route::get('/contact_masyarakat', function () {
    return view('dashboard.masyarakat.page.Contact.index_contact');
});

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

//===========================================================
//Rooute Fasilitas Pengunjung
//===========================================================
Route::get('/fasilitas', function () {
    return view('pengguna/page/Fasilitas/index_fasilitas');
});
//===========================================================

// Route::get('/fasilitas', [FasilitasDesaController::class, 'index'])->name('pengguna.fasilitas.index');

//===========================================================

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

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


//=========================================================
// Route Dashboard (Arah Login)
//=========================================================
//bumdes
Route::middleware(['auth'])->group(function () {
    Route::get('/index_bumdes', function () {
        return view('dashboard.bumdes.page.Home.index_home');
    })->name('dashboard.bumdes');
    //sekretaris
    Route::get('/index_sekretaris', function () { //kode didalamnya akan di eksekusi jika route ini di akses
        return view('dashboard.sekretaris.page.Home.index_home'); //saya meu membuat route ini untuk mengarahkan ke halaman dashboard sekretaris
    })->name('dashboard.sekretaris');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard/masyarakat/page/Home/index_home');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    Route::post('/profile/delete-account', [ProfileController::class, 'deleteAccount'])->name('profile.account.delete');
});

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
                                                                                                    // A
Route::get('/fasilitas_sekretaris/create', [FasilitasDesaController::class, 'create'])->name('sekretaris.fasilitas.create');

Route::post('/fasilitas_sekretaris/store', [FasilitasDesaController::class, 'store'])->name('sekretaris.fasilitas.store');

Route::get('/fasilitas/{id_fasilitas}/edit', [FasilitasDesaController::class, 'edit'])->name('sekretaris.fasilitas.edit');

Route::put('/fasilitas_sekretaris/{id_fasilitas}', [FasilitasDesaController::class, 'update'])->name('sekretaris.fasilitas.update');

Route::delete('/fasilitas_sekretaris/{id_fasilitas}', [FasilitasDesaController::class, 'destroy'])->name('sekretaris.fasilitas.destroy');

//==========================================================

//==========================================================
// Route Informasi Sekretaris
//==========================================================
// Route::get('/informasi_sekretaris', function () {
//     return view('dashboard/sekretaris/page/Informasi/index_informasi');
// });
// Route::get('/informasi/pengumuman', [InformasiDesaController::class, 'index_pengumuman']) -> name('informasi.pengumuman'); //error atau penyelesaian

// Route::get('/informasi/berita', [InformasiDesaController::class, 'index_berita']) -> name('informasi.berita');

Route::get('/informasi_sekretaris', [InformasiDesaController::class, 'index_berita'])->name('informasi.berita'); //untuk menampilkan

Route::get('/informasi_pengumuman', [InformasiDesaController::class, 'index_pengumuman'])->name('informasi.pengumuman'); //untuk menampilkan

Route::post('/informasi_sekretaris/store', [InformasiDesaController::class, 'store'])->name('sekretaris.informasi.store'); //untuk menyimpan data
//{id_informasi} berhubungan dengan <form action="{{ route('sekretaris.informasi.update', $item->id_informasi) }}" method="POST">, ini ada di xxx.blade.php
Route::put('/informasi_sekretaris/{id_informasi}', [InformasiDesaController::class, 'update'])->name('sekretaris.informasi.update'); //untuk mengupdate data

Route::delete('/informasi_sekretaris/{id_informasi}', [InformasiDesaController::class, 'destroy'])->name('sekretaris.informasi.destroy'); //untuk menghapus data

//==========================================================

// Route::get('/galeri_sekretaris', function () {
//     return view('dashboard/sekretaris/page/Galeri/index_galeri');
// });
// Daftar semua galeri (index)
Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
Route::get('/galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
Route::put('/galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
Route::patch('/galleries/{gallery}', [GalleryController::class, 'update']); // Biasanya disertakan juga untuk update sebagian
Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
Route::get('/masyarakat/galeri', [GalleryController::class, 'index_masyarakat']);

Route::get('/data_pengurus_desa_sekretaris', [DataPengurusDesaController::class, 'index'])->name('data_pengurus_desa.index');
Route::get('/data_pengurus_desa_sekretaris/create', [DataPengurusDesaController::class, 'create'])->name('data_pengurus_desa.create');
Route::post('/data_pengurus_desa_sekretaris', [DataPengurusDesaController::class, 'store'])->name('data_pengurus_desa.store');
Route::get('/data_pengurus_desa_sekretaris/{pengurus}', [DataPengurusDesaController::class, 'show'])->name('data_pengurus_desa.show');
Route::get('/data_pengurus_desa_sekretaris/{pengurus}/edit', [DataPengurusDesaController::class, 'edit'])->name('data_pengurus_desa.edit');
Route::put('/data_pengurus_desa_sekretaris/{pengurus}', [DataPengurusDesaController::class, 'update'])->name('data_pengurus_desa.update');
Route::patch('/data_pengurus_desa_sekretaris/{pengurus}', [DataPengurusDesaController::class, 'update']);
Route::delete('/data_pengurus_desa_sekretaris/{pengurus}', [DataPengurusDesaController::class, 'destroy'])->name('data_pengurus_desa.destroy');
Route::get('/masyarakat/data_pengurus_desa', [GalleryController::class, 'index_masyarakat']);
// Route::get('/alat_pertanian_sekretaris', function () {
//     return view('dashboard/sekretaris/page/Alat_Pertanian/index_alat_pertanian');
// });
Route::get('/alat_pertanian_sekretaris', [AlatPertanianController::class, 'index_sekretaris'])->name('alat_pertanian_sekretaris');

Route::get('/contact_sekretaris', function () {
    return view('dashboard/sekretaris/page/Contact/index_contact');
});

//=========================================================
// Route Admin Bumdes
//=========================================================

Route::get('/about_bumdes', function () {
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


//============================================================
// CRUD PEMINJAMAN ALAT PERTANIAN
//============================================================
// Route::get('/alat_pertanian_bumdes', function () {
//    return view('dashboard/bumdes/page/Alat_Pertanian/index_alat_pertanian');
// });
//=============================================================
Route::get('/alat_pertanian_bumdes', [AlatPertanianController::class, 'index'])->name('alat_pertanian.index'); //untuk menampilkan data alat pertanian

Route::post('/alat_pertanian_bumdes/store', [AlatPertanianController::class, 'store'])->name('bumdes.alat_pertanian.store');

Route::delete('alat_pertanian_bumdes/{alat}', [AlatPertanianController::class, 'destroy'])->name('bumdes.alat_pertanian.destroy');

Route::put('alat_pertanian/{id}', [AlatPertanianController::class, 'update'])->name('alat_pertanian.update');

// Menampilkan halaman histori pemesanan (untuk Bumdes)
Route::get('/alat-pertanian/histori', [PeminjamanController::class, 'history'])->name('pemesanan.history');

//peminjaman
Route::post('alat_pertanian/pinjam', [PeminjamanController::class, 'store'])->name('alat_pertanian.pinjam');

Route::patch('alat_pertanian/kembali/{id}', [PeminjamanController::class, 'kembalikan'])->name('alat_pertanian.kembali');

// Menampilkan daftar peminjaman untuk admin/bumdes
Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

//============================================================





//============================================================
//CRUD DATA PENGURUS DESA
//============================================================
//Route::get('/alat_pertanian_bumdes', [AlatPertanianController::class, 'index'])->name('alat_pertanian.index');
//============================================================

Route::get('/contact_bumdes', function () {
    return view('dashboard/bumdes/page/Contact/index_contact');
});

Route::resource('galleries', GalleryController::class);

//=========================================================
//convert pdf
//==========================================================
Route::get('/convert-pdf/{filename}', [InformasiDesaController::class, 'convertToPdf']);

//==========================================================
// Route Masyarakat
//==========================================================
Route::get('/index_masyarakat', [FasilitasDesaController::class, 'index_masyarakat'])->name('index.masyarakat');

Route::get('/about_masyarakat', function () {
    return view('dashboard.masyarakat.page.About.index_about');
})->name('dashboard.masyarakat');

Route::get('/fasilitas_masyarakat', [FasilitasDesaController::class, 'index_masyarakat'])->name('fasilitas.masyarakat');

//informasi=================================================
Route::get('/informasi_masyarakat', [InformasiDesaController::class, 'index_berita_masyarakat'])->name('informasi.masyarakat');

Route::get('/informasi_pengumuman_masyarakat', [InformasiDesaController::class, 'index_pengumuman_masyarakat'])->name('pengumuman.masyarakat');
//==========================================================

//alat pertanian============================================
Route::get('/alat_pertanian_masyarakat', [AlatPertanianController::class, 'index_masyarakat'])->name('alat_pertanian.masyarakat');
// Menampilkan halaman histori pemesanan (untuk Masyarakat)
Route::get('/alat-pertanian/histori-masyarakat', [PeminjamanController::class, 'historyMasyarakat'])->name('pemesanan.history.masyarakat');
//==========================================================

Route::get('/galeri_masyarakat', [GalleryController::class, 'index_masyarakat'])->name('galeri.masyarakat');

Route::get('/data_pengurus_desa_masyarakat', [DataPengurusDesaController::class, 'index_masyarakat'])->name('data_pengurus_desa.masyarakat');

Route::get('/contact', [MessageController::class, 'index'])->name('contact');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

