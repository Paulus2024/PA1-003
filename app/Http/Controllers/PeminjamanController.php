<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatPertanian;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Notifications\PeminjamanBaru;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil semua data peminjaman beserta relasinya
        $peminjaman = Peminjaman::with('user', 'alat')->get();

        // Ambil semua data alat pertanian
        $alatList = AlatPertanian::all();

        // Update status alat secara otomatis berdasarkan jumlah
        foreach ($alatList as $item) {
            if ($item->jumlah > 0) {
                $item->status_alat = 'tersedia';
            } else {
                $item->status_alat = 'tidak_tersedia';
            }
            $item->save(); // Simpan perubahan ke database
        }

        // Tampilkan ke view
        return view('dashboard.bumdes.page.Alat_Pertanian.histori_pemesanan', compact('peminjaman'));
    }

    // public function store(Request $request)
    // {
    //     Log::info('Mulai memproses peminjaman');

    //     $validated = $request->validate([
    //         'alat_id' => 'required|exists:alat_pertanian,id_alat_pertanian',
    //         'nama_peminjam' => 'required|string|max:255',
    //         'tanggal_pinjam' => 'required|date|after_or_equal:today',
    //         'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    //         'jumlah_alat_di_sewa' => 'required|integer|min:1',
    //     ]);

    //     Log::info('Validasi berhasil');

    //     if (!Auth::check()) {
    //         return back()->with('error', 'Anda harus login terlebih dahulu untuk meminjam alat.');
    //     }

    //     $alat = AlatPertanian::find($request->alat_id);
    //     if (!$alat) {
    //         Log::error('Alat pertanian tidak ditemukan dengan ID: ' . $validated['alat_id']);
    //         return back()->with('error', 'Alat pertanian tidak ditemukan.');
    //     }

    //     if ($alat->jumlah_tersedia < $validated['jumlah_alat_di_sewa']) {
    //         return back()->withErrors([
    //             'jumlah_alat_di_sewa' => 'Jumlah alat tidak mencukupi. Tersedia: ' . $alat->jumlah_tersedia
    //         ])->withInput();
    //     }

    //     DB::beginTransaction();
    //     try {
    //         Log::info('Mulai transaksi database');
    //         // DB::beginTransaction(); // HAPUS: Transaksi sudah dimulai di luar blok try

    //         // Update stok alat
    //         $alat->jumlah_tersedia -= $validated['jumlah_alat_di_sewa'];
    //         $alat->jumlah_tersedia = max(0, $alat->jumlah_tersedia);

    //         // Penting: pastikan enum cocok dengan isi database
    //         $alat->status_alat = $alat->jumlah_tersedia > 0 ? 'tersedia' : 'tidak_tersedia';

    //         $alat->save();
    //         Log::info('Alat pertanian berhasil diupdate: ' . $alat->toJson());

    //         // Buat peminjaman
    //         $peminjaman = Peminjaman::create([
    //             'alat_pertanian_id' => $validated['alat_id'],
    //             'user_id' => auth()->id(),
    //             'nama_peminjam' => $validated['nama_peminjam'],
    //             'tanggal_pinjam' => $validated['tanggal_pinjam'],
    //             'tanggal_kembali' => $validated['tanggal_kembali'],
    //             'jumlah_alat_di_sewa' => $validated['jumlah_alat_di_sewa'],
    //             'status_peminjaman' => 'menunggu',
    //         ]);
    //         Log::info('Peminjaman berhasil dibuat: ' . $peminjaman->toJson());

    //         // Kirim notifikasi ke admin
    //         try {
    //             Log::info('Mulai mengirim notifikasi ke admin');
    //             $admins = User::where('usertype', 'bumdes')->get();
    //             foreach ($admins as $admin) {
    //                 $admin->notify(new PeminjamanBaru($peminjaman, $alat));
    //                 Log::info('Notifikasi berhasil dikirim ke admin: ' . $admin->name);
    //             }
    //             Log::info('Semua notifikasi berhasil dikirim');
    //         } catch (\Exception $e) {
    //             Log::error('Gagal mengirim notifikasi: ' . $e->getMessage());
    //             // Jangan rollback transaksi jika pengiriman notifikasi gagal
    //         }
    //         // close kirim notifikasi ke admin

    //         Log::info('Commit transaksi database');
    //         DB::commit();

    //         //DETEKSI ROLE USER
    //         $role = auth()->user()->role;

    //         if ($role == 'bumdes') {
    //             return redirect()->route('alat_pertanian.index')
    //                 ->with('success', 'Peminjaman berhasil diajukan. Menunggu persetujuan admin.');
    //         } elseif ($role == 'sekretaris') {
    //             return redirect()->route('alat_pertanian.index_sekretaris')
    //                 ->with('success', 'Peminjaman berhasil diajukan.');
    //         } elseif ($role == 'masyarakat') {
    //             return redirect()->route('alat_pertanian.index_masyarakat')
    //                 ->with('success', 'Peminjaman berhasil diajukan.');
    //         } else {
    //             return redirect()->back()->with('success', 'Peminjaman berhasil diajukan.');
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Error saat memproses peminjaman: ' . $e->getMessage());
    //         return back()->with('error', 'Terjadi kesalahan saat memproses peminjaman.');
    //     }
    // }

    public function store(Request $request)
    {
        Log::info('Mulai memproses peminjaman');

        $validated = $request->validate([
            'alat_id' => 'required|exists:alat_pertanian,id_alat_pertanian',
            'nama_peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jumlah_alat_di_sewa' => 'required|integer|min:1',
        ]);

        Log::info('Validasi berhasil');

        if (!Auth::check()) {
            return back()->with('error', 'Anda harus login terlebih dahulu untuk meminjam alat.');
        }

        $alat = AlatPertanian::find($request->alat_id);
        if (!$alat) {
            Log::error('Alat pertanian tidak ditemukan dengan ID: ' . $validated['alat_id']);
            return back()->with('error', 'Alat pertanian tidak ditemukan.');
        }

        if ($alat->jumlah_tersedia < $validated['jumlah_alat_di_sewa']) {
            return back()->withErrors([
                'jumlah_alat_di_sewa' => 'Jumlah alat tidak mencukupi. Tersedia: ' . $alat->jumlah_tersedia
            ])->withInput();
        }

        DB::beginTransaction();
        try {
            Log::info('Mulai transaksi database');
            // DB::beginTransaction(); // HAPUS: Transaksi sudah dimulai di luar blok try

            // Update stok alat
            $alat->jumlah_tersedia -= $validated['jumlah_alat_di_sewa'];
            $alat->jumlah_tersedia = max(0, $alat->jumlah_tersedia);

            // Penting: pastikan enum cocok dengan isi database
            $alat->status_alat = $alat->jumlah_tersedia > 0 ? 'tersedia' : 'tidak_tersedia';

            $alat->save();
            Log::info('Alat pertanian berhasil diupdate: ' . $alat->toJson());

            // Buat peminjaman
            $peminjaman = Peminjaman::create([
                'alat_pertanian_id' => $validated['alat_id'],
                'user_id' => auth()->id(),
                'nama_peminjam' => $validated['nama_peminjam'],
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'jumlah_alat_di_sewa' => $validated['jumlah_alat_di_sewa'],
                'status_peminjaman' => 'menunggu',
            ]);
            Log::info('Peminjaman berhasil dibuat: ' . $peminjaman->toJson());

            // Kirim notifikasi ke admin
            try {
                Log::info('Mulai mengirim notifikasi ke admin');
                $admins = User::where('usertype', 'bumdes')->get();
                foreach ($admins as $admin) {
                    $admin->notify(new PeminjamanBaru($peminjaman, $alat));
                    Log::info('Notifikasi berhasil dikirim ke admin: ' . $admin->name);
                }
                Log::info('Semua notifikasi berhasil dikirim');
            } catch (\Exception $e) {
                Log::error('Gagal mengirim notifikasi: ' . $e->getMessage());
                // Jangan rollback transaksi jika pengiriman notifikasi gagal
            }
            // close kirim notifikasi ke admin

            Log::info('Commit transaksi database');
            DB::commit();

            //DETEKSI ROLE USER
            $role = auth()->user()->role;

            if ($role == 'bumdes') {
                return redirect()->route('alat_pertanian.index')
                    ->with('success', 'Peminjaman berhasil diajukan. Menunggu persetujuan admin.');
            } elseif ($role == 'sekretaris') {
                return redirect()->route('alat_pertanian.index_sekretaris')
                    ->with('success', 'Peminjaman berhasil diajukan.');
            } elseif ($role == 'masyarakat') {
                return redirect()->route('alat_pertanian.index_masyarakat')
                    ->with('success', 'Peminjaman berhasil diajukan.');
            } else {
                return redirect()->back()->with('success', 'Peminjaman berhasil diajukan.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat memproses peminjaman: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses peminjaman.');
        }
    }

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
    public function history_sekretaris()
    {
        // Ambil semua peminjaman beserta data alat-nya, terbaru paling atas
        $peminjaman = Peminjaman::with('alat')
            ->where('status_peminjaman', 'disetujui')
            ->orderBy('created_at', 'desc')
            ->get();

        // Kembalikan view khusus histori
        return view('dashboard.sekretaris.page.Alat_Pertanian.histori_pemesanan', compact('peminjaman'));
    }

    public function history_masyarakat()
    {
        // Ambil semua peminjaman beserta data alat-nya, terbaru paling atas
        $peminjaman = Peminjaman::with('alat')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Kembalikan view khusus histori
        return view('dashboard.masyarakat.page.Alat_Pertanian.histori_pemesanan', compact('peminjaman'));
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
        $alat = $peminjaman->alat; // relasi dari model Peminjaman ke AlatPertanian

        DB::beginTransaction();
        try {
            // Hitung selisih jumlah alat yang disewa
            $jumlah_lama = $peminjaman->jumlah_alat_di_sewa;
            $jumlah_baru = $request->input('jumlah_alat_di_sewa');
            $selisih = $jumlah_baru - $jumlah_lama;

            // Cek jika alat tersedia cukup saat jumlah disewa bertambah
            if ($selisih > 0 && $alat->jumlah_tersedia < $selisih) {
                return back()->withErrors([
                    'jumlah_alat_di_sewa' => 'Jumlah alat tidak mencukupi. Tersedia: ' . $alat->jumlah_tersedia
                ])->withInput();
            }

            // Update stok alat
            $alat->jumlah_tersedia -= $selisih;
            $alat->jumlah_tersedia = max(0, $alat->jumlah_tersedia);
            $alat->status_alat = $alat->jumlah_tersedia > 0 ? 'tersedia' : 'tidak_tersedia';
            $alat->save();

            // Update data peminjaman
            $peminjaman->update([
                'nama_peminjam' => $request->input('nama_peminjam'),
                'tanggal_pinjam' => $request->input('tanggal_pinjam'),
                'tanggal_kembali' => $request->input('tanggal_kembali'),
                'jumlah_alat_di_sewa' => $jumlah_baru,
            ]);

            DB::commit();
            return back()->with('success', 'Data peminjaman berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal update peminjaman: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

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

    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('dashboard.bumdes.page.Alat_Pertanian.detail_peminjaman', compact('peminjaman')); // Ganti dengan view yang sesuai
    }
}
