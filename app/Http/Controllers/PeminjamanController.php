<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatPertanian;
use App\Models\Peminjaman;


class PeminjamanController extends Controller
{
    public function index()
    {
        // Ambil semua data peminjaman beserta relasi alat-nya
        $peminjaman = Peminjaman::with('alat')->get();

        // Tampilkan view peminjaman.index dan lempar data
        return view('dashboard.bumdes.page.Alat_pertanian.index_peminjaman', compact('peminjaman'));    }


    public function store (Request $r)
    {
        $r->validate ([
            'alat_id'       => 'required|exists:alat_pertanian,id_alat_pertanian',
            'peminjam'      => 'required|string',
            'tanggal_pinjam'=> 'required|date',
            'tanggal_kembali'=> 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $alat = AlatPertanian::find($r->alat_id);
        if($alat->jumlah_tersedia < 1){
            return back()->withErrors('Maaf, alat tidak tersedia');
        }

        //kurangi tersedia jika di pinjam
        $alat->decrement('jumlah_tersedia');
        if($alat->jumlah_tersedia == 0){
            $alat->status_alat = 'tidak_tersedia';
        }
        $alat->save();

        //simpan pinjaman
        Peminjaman::create ([
            'alat_pertanian_id' => $r->alat_id,
            'peminjam'          => $r->peminjam,
            'tanggal_pinjam'    => $r->tanggal_pinjam,
            'tanggal_kembali'   => $r->tanggal_kembali,
        ]);
        return back ()->with('success', 'Peminjaman berhasi dilakukan');
    }

    public function kembalikan($id)
    {
        $pinjam = Peminjaman::finOrFail($id);
        $pinjam-> status = 'dikembalikan';
        $pinjam-> save();

        //tambah kembali jumlah tersedia
        $alat = $pinjam->alat;
        $alat->increment('jumlah_tersedia');
        $alat->status_alat = 'tersedia';
        $alat->save();

        return back()->with('success', 'Alat berhasil dikembalikan');
    }
}
