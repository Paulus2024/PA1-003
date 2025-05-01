<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatPertanian;
use App\Models\Peminjaman;


class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with('alat')->get(); // pastikan relasi 'alat' ada di model Peminjaman
        return view('dashboard.bumdes.page.Alat_Pertanian.index_alat_pertanian', compact('data'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'alat_id'         => 'required|exists:alat_pertanian,id_alat_pertanian',
            'peminjam'        => 'required|string',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $alat = AlatPertanian::find($r->alat_id);
        if ($alat->jumlah_tersedia < 1) {
            return back()->withErrors('Maaf, alat tidak tersedia');
        }

        // kurangi tersedia
        $alat->decrement('jumlah_tersedia');
        if ($alat->jumlah_tersedia == 0) {
            $alat->status_alat = 'tidak_tersedia';
        }
        $alat->save();

        // simpan peminjaman
        Peminjaman::create([
            'alat_pertanian_id' => $r->alat_id,
            'peminjam'          => $r->peminjam,
            'tanggal_pinjam'    => $r->tanggal_pinjam,
            'tanggal_kembali'   => $r->tanggal_kembali,
        ]);

        return back()->with('success', 'Peminjaman berhasil dibuat');
    }

    public function kembalikan($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pinjam->status = 'dikembalikan';
        $pinjam->save();

        // tambah kembali tersedia
        $alat = $pinjam->alat;
        $alat->increment('jumlah_tersedia');
        $alat->status_alat = 'tersedia';
        $alat->save();

        return back()->with('success', 'Alat berhasil dikembalikan');
    }
}
