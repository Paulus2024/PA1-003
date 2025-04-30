<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\AlatPertanian;
use Illuminate\Http\Request;

class AlatPertanianController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model AlatPertanian
        $alat_pertanian = AlatPertanian::all();
        return view('dashboard.bumdes.page.Alat_Pertanian.index_alat_pertanian', compact('alat_pertanian'));
    }

    public function store(Request $request)
    {
        $test = $request->validate([
            'nama_alat_pertanian'       => 'required|string|max:255',
            'jenis_alat_pertanian'      => 'required|string',
            'harga_sewa'                => 'required|integer|min:0',
            'jumlah_alat'               => 'required|string',
            'gambar_alat'               => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catatan'                   => 'required|string|max:255',
        ]);

        //upload gambar
        $path = $request->file('gambar_alat')->store('alat_pertanian', 'public');

        //perkiraan untuk menentukan status alat tersedia atau tidak
        $tersedia   = $test['jumlah_alat'];
        $status     = $tersedia > 0 ? 'tersedia' : 'tidak tersedia';

        AlatPertanian::create([
            // 'nama_fasilitas'        => $validated['nama_fasilitas'],
            // 'deskripsi_fasilitas'   => $validated['deskripsi_fasilitas'], // Sesuaikan nama field database (misalnya 'deskripsi')
            // 'lokasi_fasilitas'      => $validated['lokasi_fasilitas'],    // Sesuaikan nama field database (misalnya 'lokasi')
            // 'gambar_fasilitas'      => $path

            'nama_alat_pertanian'       => $test['nama_alat_pertanian'],
            'jenis_alat_pertanian'      => $test['jenis_alat_pertanian'],
            'harga_sewa'                => $test['harga_sewa'],
            'jumlah_alat'               => $test['jumlah_alat'],
            'jumlah_tersedia'           => $tersedia,
            'status_alat'               => $status,
            'gambar_alat'               => $path,
            'catatan'                   => $test['catatan']
        ]);
                                    //lihat di Route::get('/alat_pertanian_bumdes', [AlatPertanianController::class, 'index'])->name('alat_pertanian.index'); untuk bagian route nya
        return redirect()->route('alat_pertanian.index')->with('success', 'Data pertanian berhasil ditambahkan!');
    }
}
