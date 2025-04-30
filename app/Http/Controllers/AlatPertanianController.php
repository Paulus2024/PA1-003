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
        $validated = $request->validate([
            'nama_alat_pertanian'       => 'required|string|max:255',
            'jenis_alat_pertanian'      => 'required|string',
            'harga_sewa'                => 'required|integer|min:0',
            'status_alat'               => 'required|string|max:255',
            'jumlah_alat'               => 'required|string',
            'gambar_alat'               => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catatan'                   => 'required|string|max:255',
        ]);

        $path = $request->file('gambar_alat')->store('alat_pertanian', 'public');

        AlatPertanian::create([
            // 'nama_fasilitas'        => $validated['nama_fasilitas'],
            // 'deskripsi_fasilitas'   => $validated['deskripsi_fasilitas'], // Sesuaikan nama field database (misalnya 'deskripsi')
            // 'lokasi_fasilitas'      => $validated['lokasi_fasilitas'],    // Sesuaikan nama field database (misalnya 'lokasi')
            // 'gambar_fasilitas'      => $path

            'nama_alat_pertanian'       => $validated['nama_alat_pertanian'],
            'jenis_alat_pertanian'      => $validated['jenis_alat_pertanian'],
            'harga_sewa'                => $validated['harga_sewa'],
            'status_alat'               => $status,
            'jumlah_alat'               => $jumlah,
            'gambar_alat'               => $path,
            'catatan'                   => $validated['catatan']
        ]);

        return redirect()->route('sekretaris.alat_pertanian.index')->with('success', 'Data pertanian berhasil ditambahkan!');
    }
}
