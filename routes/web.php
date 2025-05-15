
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FasilitasDesaController;
use App\Http\Controllers\InformasiDesaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DataPengurusDesaController;
use App\Http\Controllers\AlatPertanianController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AboutController; // Corrected class name


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

//=========================================================
// Route Pengguna (Public Routes - No Authentication Required)
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

Route::get('/pengurus', [DataPengurusDesaController::class, 'index_pengguna'])->name('pengurus.index');

Route::get('/galeri', [GalleryController::class, 'index_pengguna'])->name('galeri');

Route::get('/fasilitas', function () {
    return view('pengguna/page/Fasilitas/index_fasilitas');
});

Route::get('/contact', [MessageController::class, 'index'])->name('contact');
Route::post('/contact', [MessageController::class, 'store']);

//=========================================================
// Route Auth (Authentication Routes)
//=========================================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//=========================================================
// Route Dashboard & Profile (Protected Routes - Authentication Required)
//=========================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/index_bumdes', function () {
        return view('dashboard.bumdes.page.Home.index_home');
    })->name('dashboard.bumdes');

    Route::get('/index_sekretaris', function () {
        return view('dashboard.sekretaris.page.Home.index_home');
    })->name('dashboard.sekretaris');

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware('auth');
    Route::get('/index_masyarakat', function () {
        return view('dashboard/masyarakat/page/Home/index_home');
    })->middleware('auth');

    Route::get('/dashboard', function () {
        return view('dashboard/masyarakat/page/Home/index_home');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    Route::post('/profile/delete-account', [ProfileController::class, 'deleteAccount'])->name('profile.account.delete');
});

//=========================================================
// Route Admin Sekretaris (Protected Routes - Authentication Required)
//=========================================================
Route::middleware(['auth'])->group(function () {

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
    //About us
    Route::get('about_us', [AboutController::class, 'index'])->name('sekretaris.about_us.index');
    Route::get('about_us/create', [AboutController::class, 'create'])->name('sekretaris.about_us.create');
    Route::post('about_us', [AboutController::class, 'store'])->name('sekretaris.about_us.store');
    Route::get('about_us/edit/{id}', [AboutController::class, 'edit'])->name('sekretaris.about_us.edit');
    Route::put('about_us/update/{id}', [AboutController::class, 'update'])->name('sekretaris.about_us.update');
    Route::delete('about_us/delete/{id}', [AboutController::class, 'destroy'])->name('sekretaris.about_us.destroy');

    Route::get('/fasilitas_sekretaris', [FasilitasDesaController::class, 'index'])->name('sekretaris.fasilitas.index');
    Route::get('/fasilitas_sekretaris/create', [FasilitasDesaController::class, 'create'])->name('sekretaris.fasilitas.create');
    Route::post('/fasilitas_sekretaris/store', [FasilitasDesaController::class, 'store'])->name('sekretaris.fasilitas.store');
    Route::get('/fasilitas/{id_fasilitas}/edit', [FasilitasDesaController::class, 'edit'])->name('sekretaris.fasilitas.edit');
    Route::put('/fasilitas_sekretaris/{id_fasilitas}', [FasilitasDesaController::class, 'update'])->name('sekretaris.fasilitas.update');
    Route::delete('/fasilitas_sekretaris/{id_fasilitas}', [FasilitasDesaController::class, 'destroy'])->name('sekretaris.fasilitas.destroy');

    Route::get('/informasi_sekretaris', [InformasiDesaController::class, 'index_berita'])->name('informasi.berita');
    Route::get('/informasi_pengumuman', [InformasiDesaController::class, 'index_pengumuman'])->name('informasi.pengumuman');
    Route::post('/informasi_sekretaris/store', [InformasiDesaController::class, 'store'])->name('sekretaris.informasi.store');
    Route::put('/informasi_sekretaris/{id_informasi}', [InformasiDesaController::class, 'update'])->name('sekretaris.informasi.update');
    Route::delete('/informasi_sekretaris/{id_informasi}', [InformasiDesaController::class, 'destroy'])->name('sekretaris.informasi.destroy');

    Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('/galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
    Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('/galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::patch('/galleries/{gallery}', [GalleryController::class, 'update']);
    Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    //Route::get('/galeri', [GalleryController::class, 'index_pengguna'])->name('/galeri');

    Route::get('/data_pengurus_desa_sekretaris', [DataPengurusDesaController::class, 'index'])->name('data_pengurus_desa.index');
    Route::get('/data_pengurus_desa_sekretaris/create', [DataPengurusDesaController::class, 'create'])->name('data_pengurus_desa.create');
    Route::post('/data_pengurus_desa_sekretaris', [DataPengurusDesaController::class, 'store'])->name('data_pengurus_desa.store');
    Route::get('/data_pengurus_desa_sekretaris/{pengurus}', [DataPengurusDesaController::class, 'show'])->name('data_pengurus_desa.show');
    Route::get('/data_pengurus_desa_sekretaris/{pengurus}/edit', [DataPengurusDesaController::class, 'edit'])->name('data_pengurus_desa.edit');
    Route::put('/data_pengurus_desa_sekretaris/{pengurus}', [DataPengurusDesaController::class, 'update'])->name('data_pengurus_desa.update');
    Route::patch('/data_pengurus_desa_sekretaris/{pengurus}', [DataPengurusDesaController::class, 'update']);
    Route::delete('/data_pengurus_desa_sekretaris/{pengurus}', [DataPengurusDesaController::class, 'destroy'])->name('data_pengurus_desa.destroy');
    Route::get('/data-pengurus-desa-bumdes', [DataPengurusDesaController::class, 'indexBumdes'])->name('data_pengurus_desa.bumdes');


    Route::get('/alat_pertanian_sekretaris', [AlatPertanianController::class, 'index_sekretaris'])->name('alat_pertanian_sekretaris');

    Route::get('/contact_sekretaris', function () {
        return view('dashboard/sekretaris/page/Contact/index_contact');
    });

    // About Routes (Sekretaris) - ADD THESE LINES
    Route::resource('/about_sekretaris', AboutController::class)->names([
        'index' => 'abouts.index',
        'create' => 'abouts.create',
        'store' => 'abouts.store',
        'show' => 'abouts.show',
        'edit' => 'abouts.edit',
        'update' => 'abouts.update',
        'destroy' => 'abouts.destroy',
    ]);
});

//=========================================================
// Route Admin Bumdes (Protected Routes - Authentication Required)
//=========================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/about_bumdes', function () {
        return view('dashboard/bumdes/page/About/index_about');
    });

    Route::get('/fasilitas_bumdes', function () {
        return view('dashboard/bumdes/page/Fasilitas/index_fasilitas');
    });

    Route::get('/informasi_bumdes', function () {
        return view('dashboard/bumdes/page/Informasi/index_informasi');
    });

    Route::get('/galeri_bumdes', [GalleryController::class, 'index_bumdes'])->name('galleries.index_bumdes');

    Route::get('/data_pengurus_desa_bumdes', [DataPengurusDesaController::class, 'index_bumdes'])->name('data_pengurus_desa.bumdes');

    Route::get('/alat_pertanian_bumdes', [AlatPertanianController::class, 'index'])->name('alat_pertanian.index');
    Route::get('/alat_pertanian_sekretaris', [AlatPertanianController::class, 'index_sekretaris'])->name('alat_pertanian.index_sekretaris');
    Route::get('/alat_pertanian_masyarakat', [AlatPertanianController::class, 'index_masyarakat'])->name('alat_pertanian.index_masyarakat');

    Route::post('/alat_pertanian_bumdes/store', [AlatPertanianController::class, 'store'])->name('bumdes.alat_pertanian.store');

    Route::delete('alat_pertanian_bumdes/{alat}', [AlatPertanianController::class, 'destroy'])->name('bumdes.alat_pertanian.destroy');

    Route::put('alat_pertanian/{id}', [AlatPertanianController::class, 'update'])->name('alat_pertanian.update');

    Route::get('/alat-pertanian/histori', [PeminjamanController::class, 'history'])->name('pemesanan.history');

    Route::get('/alat-pertanian/histori/sekretaris', [PeminjamanController::class, 'history_sekretaris'])->name('pemesanan.history.sekretaris');

    // Route::post('alat_pertanian/pinjam', [PeminjamanController::class, 'store'])->name('alat_pertanian.pinjam');
    Route::middleware(['auth'])->group(function () {
        Route::post('alat_pertanian/pinjam', [PeminjamanController::class, 'store'])->name('alat_pertanian.pinjam');
    });


    Route::patch('alat_pertanian/kembali/{id}', [PeminjamanController::class, 'kembalikan'])->name('alat_pertanian.kembali');

    Route::patch('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');

    Route::patch('/peminjaman/{id}/cancel', [PeminjamanController::class, 'cancel'])->name('peminjaman.cancel');

    Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');

    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

    Route::get('/contact_bumdes', function () {
        return view('dashboard/bumdes/page/Contact/index_contact');
    });
});

//=========================================================
// Route Masyarakat (Protected Routes - Authentication Required)
//=========================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/index_masyarakat', [FasilitasDesaController::class, 'index_masyarakat'])->name('index.masyarakat');
    Route::get('/about_masyarakat', function () {
        return view('dashboard.masyarakat.page.About.index_about');
    })->name('about.masyarakat');
    Route::get('/fasilitas_masyarakat', [FasilitasDesaController::class, 'index_masyarakat'])->name('fasilitas.masyarakat');
    Route::get('/informasi_masyarakat', [InformasiDesaController::class, 'index_berita_masyarakat'])->name('informasi.masyarakat');
    Route::get('/informasi_pengumuman_masyarakat', [InformasiDesaController::class, 'index_pengumuman_masyarakat'])->name('pengumuman.masyarakat');
    // Route::get('/alat_pertanian_masyarakat', [AlatPertanianController::class, 'index_masyarakat'])->name('alat_pertanian.masyarakat');
    Route::get('/alat-pertanian/histori-masyarakat', [PeminjamanController::class, 'history_masyarakat'])->name('pemesanan.history.masyarakat');
    Route::get('/galeri_masyarakat', [GalleryController::class, 'index_masyarakat'])->name('galeri.masyarakat');
    Route::get('/data_pengurus_desa_masyarakat', [DataPengurusDesaController::class, 'index_masyarakat'])->name('data_pengurus_desa.masyarakat');

    Route::get('/contact_masyarakat', [MessageController::class, 'index_masyarakat']);
});

//=========================================================
// Route Convert PDF (No Authentication Required)
//=========================================================
Route::get('/convert-pdf/{filename}', [InformasiDesaController::class, 'convertToPdf']);

Route::get('/about_masyarakat', [AboutController::class, 'indexMasyarakat'])->name('about.masyarakat');

