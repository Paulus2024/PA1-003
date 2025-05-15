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

    public function index_sekretaris()
    {
        //mengambil semua data dari model AlatPertanian
        $alat_pertanian = AlatPertanian::all();
        return view('dashboard.sekretaris.page.Alat_Pertanian.index_alat_pertanian', compact('alat_pertanian'));
    }

    public function index_masyarakat()
    {
        // Mengambil semua data dari model AlatPertanian
        $alat_pertanian = AlatPertanian::all();
        return view('dashboard.masyarakat.page.Alat_Pertanian.index_alat_pertanian', compact('alat_pertanian'));
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

    public function update(Request $minta, $id)
    {
        $alat = AlatPertanian::findOrFail($id);

        $validated = $minta->validate([
            'nama_alat_pertanian'       => 'required|string|max:255',
            'jenis_alat_pertanian'      => 'required|string',
            'harga_sewa'                => 'required|integer|min:0',
            'jumlah_alat'               => 'required|string',
            'catatan'                   => 'nullable|string|max:255',
            'gambar_alat'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tersedia = $validated['jumlah_alat'];
        $status = $tersedia > 0 ? 'tersedia' : 'tidak tersedia';

        //chek jika user mengupload gambar baru
        if ($minta->hasFile('gambar_alat')) {
            //hapus gambar lama
            if ($alat->gambar_alat && Storage::disk('public')->exists($alat->gambar_alat)) {
                Storage::disk('public')->delete($alat->gambar_alat);
            }

            //simpan gambar baru
            $gambar = $minta->file('gambar_alat');
            // $path = $gambar->storage('alat_pertanian', 'public');
            $path = $minta->file('gambar_alat')->store('alat_pertanian', 'public');
            $alat->gambar_alat = $path;
        }

        //update dala lainnya
        $alat->update([
            'nama_alat_pertanian' => $validated['nama_alat_pertanian'],
            'jenis_alat_pertanian' => $validated['jenis_alat_pertanian'],
            'harga_sewa' => $validated['harga_sewa'],
            'jumlah_alat' => $validated['jumlah_alat'],
            'jumlah_tersedia' => $tersedia,
            'status_alat' => $status,
            'catatan' => $validated['catatan'],
            'gambar_alat' => $path ?? $alat->gambar_alat, // Tetap gunakan gambar lama jika tidak ada gambar baru
            // 'gambar_alat' sudah di-update di atas jika ada file baru
        ]);

        return redirect()
            ->route('alat_pertanian.index')
            ->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $alat_pertanian = AlatPertanian::findOrFail($id);
        Storage::disk('public')->delete($alat_pertanian->gambar_alat);
        $alat_pertanian->delete();

        return redirect()->route('alat_pertanian.index')->with('success', 'Data berhasil dihapus!');
    }
}
