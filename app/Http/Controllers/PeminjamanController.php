<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatPertanian;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('alat')->paginate(10);
        return view('dashboard.bumdes.page.Alat_Pertanian.histori_pemesanan', compact('peminjaman'));

        foreach ($alat as $item) {
            $totalDipinjam = $item->peminjaman()->where('status_peminjaman', 'disetujui')->sum('jumlah_alat_di_sewa');
            $item->jumlah_tersedia -= $totalDipinjam;

            if ($item->jumlah_tersedia <= 0) {
                $item->status_alat = 'tidak tersedia';
            } else {
                $item->status_alat = 'tersedia';
            }
            $item->save();
        }

        return view('dashboard.bumdes.page.Alat_Pertanian.histori_pemesanan', compact('peminjaman', 'alat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alat_id' => 'required|exists:alat_pertanian,id_alat_pertanian',
            'nama_peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jumlah_alat_di_sewa' => 'required|integer|min:1',
        ]);

        $alat = AlatPertanian::findOrFail($validated['alat_id']);

        if ($alat->jumlah_tersedia < $validated['jumlah_alat_di_sewa']) {
            return back()->withErrors([
                'jumlah_alat_di_sewa' => 'Jumlah alat tidak mencukupi. Tersedia: ' . $alat->jumlah_tersedia
            ])->withInput();
        }

        DB::beginTransaction();
        try {
            // Update stok alat
            // $alat->jumlah_tersedia -= $validated['jumlah_alat_di_sewa'];
            // $alat->jumlah_tersedia = max(0, $alat->jumlah_tersedia); // hindari negatif
            // $alat->status_alat = $alat->jumlah_tersedia > 0 ? 'tersedia' : 'tidak_tersedia';
            // $alat->save();
            $alat = AlatPertanian::find($request->alat_id); // pastikan ambil data dari DB

            $alat->jumlah_tersedia -= $validated['jumlah_alat_di_sewa'];
            $alat->jumlah_tersedia = max(0, $alat->jumlah_tersedia); // hindari negatif

            // Penting: pastikan enum cocok dengan isi database
            $alat->status_alat = $alat->jumlah_tersedia > 0 ? 'tersedia' : 'tidak_tersedia';

            $alat->save();

            // Buat peminjaman
            $peminjaman = Peminjaman::create([
                'alat_pertanian_id' => $validated['alat_id'],
                'nama_peminjam' => $validated['nama_peminjam'],
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'jumlah_alat_di_sewa' => $validated['jumlah_alat_di_sewa'],
                'status_peminjaman' => 'menunggu',
            ]);

            DB::commit();

            return redirect()->route('alat_pertanian.index')
                ->with('success', 'Peminjaman berhasil diajukan. Menunggu persetujuan admin.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat memproses peminjaman: ' . $e->getMessage());
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
