<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatPertanian;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('alat')->paginate(10);
        return view('dashboard.bumdes.page.Alat_Pertanian.histori_pemesanan', compact('peminjaman'));
    }

    public function store(Request $r)
    {
        try {
            //   $r->validate([
            //     'alat_id'               => 'required|exists:alat_pertanian,id_alat_pertanian',
            //     'nama_peminjam'         => 'required|string',
            //     'tanggal_pinjam'        => 'required|date', // Hapus date_format
            //     'tanggal_kembali'       => 'required|date|after_or_equal:tanggal_pinjam', // Hapus date_format
            //     'jumlah_alat_di_sewa'   => 'required|integer|min:1|max:2',
            // ]);

            $alat = AlatPertanian::findOrFail($r->alat_id);

            if ($alat->jumlah_tersedia < $r->jumlah_alat_di_sewa) {
                return back()->withErrors(['jumlah_alat_di_sewa' => 'Stok alat tidak mencukupi. Hanya tersedia ' . $alat->jumlah_tersedia . 'unit']);
            }

            $alat->jumlah_tersedia -= $r->jumlah_alat_di_sewa;
            $alat->status_alat = $alat->jumlah_tersedia > 0 ? 'tersedia' : 'tidak_tersedia';

            if ($alat->jumlah_tersedia < 0) {
                $alat->jumlah_tersedia = 0;
                $alat->status_alat = 'tidak_tersedia';
            }

            $alat->save();
            $dataPeminjaman = [
                'alat_pertanian_id'     => $r->alat_id,
                'nama_peminjam'         => $r->nama_peminjam,
                'jumlah_alat_di_sewa'   => $r->jumlah_alat_di_sewa,
                'tanggal_pinjam'        => $r->tanggal_pinjam,
                'tanggal_kembali'       => $r->tanggal_kembali,
                'status_peminjaman'     => 'menunggu',
            ];

            try {

                $peminjaman = Peminjaman::create([
                    'alat_pertanian_id'     => $r->alat_id,
                    'nama_peminjam'         => $r->nama_peminjam,
                    'jumlah_alat_di_sewa'   => $r->jumlah_alat_di_sewa,
                    'tanggal_pinjam'        => $r->tanggal_pinjam,
                    'tanggal_kembali'       => $r->tanggal_kembali,
                    'status_peminjaman'     => 'menunggu',
                ]);
                dd($dataPeminjaman);


                return back()->with([
                    'success' => 'Peminjaman Alat Berhasil Diajukan',
                    'info'    => 'Silahkan Tunggu Konfirmasi Dari Admin',
                    'alat'    => $alat,
                ]);
            } catch (\Exception $createError) {

                Log::error($createError); // Log error

                return back()->with('error', 'Terjadi kesalahan saat memproses peminjaman.');
            }
            dd($dataPeminjaman);
        } catch (\Exception $e) {
            Log::error($e);
            return back()->with('error', 'Terjadi kesalahan saat memproses peminjaman.');
        }
    }
    // public function approve($id)
    // {
    //     $pinjam = Peminjaman::findOrFail($id);
    //     $pinjam->status_peminjaman = 'disetujui';
    //     $pinjam->save();

    //     return back()->with('success', 'peminjaman disetujui');
    // }
    public function approve($id)
    {
        // Otorisasi: Pastikan hanya admin yang bisa menyetujui
        if (Gate::allows('approve-peminjaman')) { // Ganti 'approve-peminjaman' dengan ability yang sesuai
            $pinjam = Peminjaman::findOrFail($id);
            $pinjam->status_peminjaman = 'disetujui';
            $pinjam->save();

            return back()->with('success', 'Peminjaman disetujui');
        } else {
            abort(403, 'Anda tidak memiliki izin untuk menyetujui peminjaman.');
        }
    }

    public function kembalikan($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pinjam->status_peminjaman = 'dikembalikan';
        $pinjam->save();

        // tambah kembali tersedia (saat alat di kembalikan, maka jumlah alat yang tersedia akan bertambah)
        $alat = $pinjam->alat;
        $alat->jumlah_tersedia += $pinjam->jumlah_alat_di_sewa;

        if ($alat->jumlah_tersedia > $alat->jumlah_alat) {
            $alat->jumlah_tersedia = $alat->jumlah_alat;
        }

        $alat->status_alat = 'tersedia';
        $alat->save();

        return back()->with('success', 'Alat berhasil dikembalikan');
    }

    public function history()
    {
        // Ambil semua peminjaman beserta data alat-nya, terbaru paling atas
        $peminjaman = Peminjaman::with('alat')
            ->orderBy('created_at', 'desc')
            ->get();

        // Kembalikan view khusus histori
        return view('dashboard.bumdes.page.Alat_Pertanian.histori_pemesanan', compact('peminjaman'));
    }

    public function historyMasyarakat()
    {
        $peminjamanMasyarakat = Peminjaman::with('alat')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.masyarakat.page.Alat_Pertanian.histori_pemesanan', compact('peminjamanMasyarakat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_peminjam' => 'required|string',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jumlah_alat_di_sewa' => 'required|integer|min:1|max:2',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->jumlah_alat_di_sewa = $request->jumlah_alat_di_sewa;
        $peminjaman->save();

        return back()->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    // public function destroy($id)
    // {
    //     $peminjaman = Peminjaman::findOrFail($id);
    //     $peminjaman->delete();

    //     return back()->with('success', 'Data peminjaman berhasil dihapus.');
    // }
    public function cancel($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        //hanya bisa membatalkan jika status masih menunggu
        if ($pinjam->status_peminjaman === 'menunggu') {
            $pinjam->status_peminjaman = 'dibatalkan';
            $pinjam->save();

            //kembalikan jumlah ketersediaan alat
            $alat = $pinjam->alat;
            $alat->jumlah_tersedia += $pinjam->jumlah_alat_di_sewa;

            if ($alat->jumlah_tersedia > $alat->jumlah_alat) {
                $alat->jumlah_tersedia = $alat->jumlah_alat;
            }

            $alat->status_alat = $alat->jumlah_tersedia > 0 ? 'tersedia' : 'tidak_tersedia';
            $alat->save();

            return back()->with('success', 'Peminjaman dibatalkan.');
        }
        return back()->with('error', 'Peminjaman tidak dapat dibatalkan karena statusnya bukan menunggu.');
    }
}
