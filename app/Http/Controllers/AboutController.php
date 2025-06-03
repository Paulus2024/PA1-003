<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $abouts = About::all();
        return view('dashboard.sekretaris.page.about.index_about', compact('abouts'));
    }

    // Fungsi store yang pertama (yang menyebabkan error sintaks) dihapus.
    // Kita akan menggunakan fungsi store di bawah ini yang lebih lengkap.

    public function ShowPublic()
    {
        $about = About::first(); // Ambil data About yang pertama
        // Pastikan view 'pengguna.page.about.index_about' ada dan mengharapkan variabel 'about' tunggal
        if (!$about) {
            // Handle jika tidak ada data about, mungkin redirect atau tampilkan pesan
            // return redirect()->route('home')->with('error', 'Informasi "About Us" belum tersedia.');
        }
        return view('pengguna.page.about.index_about', compact('about'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gambar_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sejarah' => 'required|string',
            'gambar_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visi_misi' => 'required|string',
            'jumlah_penduduk' => 'required|integer',
            'luas_wilayah' => 'required|string|max:255', // tambahkan max:255 jika kolom db juga varchar(255)
            'jumlah_perangkat_desa' => 'required|integer',
        ], [
            'sejarah.required' => 'Sejarah wajib diisi.',
            'visi_misi.required' => 'Visi & Misi wajib diisi.',
            'gambar_1.required' => 'Gambar 1 wajib diisi.',
            // tambahkan pesan validasi lain jika perlu
        ]);

        $data = $request->except(['_token', 'gambar_1', 'gambar_2']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('gambar_1')) {
            $data['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts');
        }

        if ($request->hasFile('gambar_2')) {
            $data['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts');
        }

        About::create($data);

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $about = About::findOrFail($id);

        // Otorisasi bisa ditambahkan di sini jika perlu
        // if ($about->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
        //     abort(403, 'Unauthorized action.');
        // }

        // Hapus deklarasi $validated yang tidak terpakai
        // $validated = $request->validate([...]); // Tidak terpakai

        $rules = [
            'sejarah' => 'required|string',
            'visi_misi' => 'required|string',
            'jumlah_penduduk' => 'nullable|integer', // Sesuaikan required/nullable sesuai kebutuhan update
            'luas_wilayah' => 'nullable|string|max:255',
            'jumlah_perangkat_desa' => 'nullable|integer',
        ];

        if ($request->hasFile('gambar_1')) {
            $rules['gambar_1'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        if ($request->hasFile('gambar_2')) {
            $rules['gambar_2'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validatedData = $request->validate($rules, [
            'sejarah.required' => 'Sejarah wajib diisi.',
            'visi_misi.required' => 'Visi & Misi wajib diisi.',
            // tambahkan pesan validasi lain
        ]);

        $data = $request->except(['_token', '_method', 'gambar_1', 'gambar_2']);

        if ($request->hasFile('gambar_1')) {
            $data['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts', $about->gambar_1);
        }
        // Jika tidak ada file gambar_1 baru, $data['gambar_1'] tidak akan diset,
        // sehingga gambar lama akan tetap ada (ini perilaku yang umumnya diinginkan).

        if ($request->hasFile('gambar_2')) {
            $data['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts', $about->gambar_2);
        }
        // Hapus blok duplikat untuk gambar_2

        $about->update($data);

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $about = About::findOrFail($id);

        // Otorisasi bisa ditambahkan di sini jika perlu

        $this->deleteImage($about->gambar_1);
        $this->deleteImage($about->gambar_2);

        $about->delete();

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil dihapus!');
    }

    private function uploadImage(Request $request, string $fieldName, string $directory, ?string $existingPath = null): ?string
    {
        if ($request->hasFile($fieldName)) {
            if ($existingPath) {
                $this->deleteImage($existingPath);
            }
            // Pastikan storage link sudah dibuat: php artisan storage:link
            $path = $request->file($fieldName)->store($directory, 'public');
            return $path;
        }
        return $existingPath; // Kembalikan path yang ada jika tidak ada file baru diupload (penting untuk update)
        // atau null jika ini adalah create dan tidak ada file.
        // Untuk store (create) lebih baik null jika tidak ada file.
        // Untuk update, jika fieldName tidak ada di request, kembalikan existingPath agar tidak null.
        // Namun, karena kita hanya memanggil ini jika $request->hasFile(), maka return null jika tidak ada file itu OK.
        // Untuk kasus update, lebih baik panggil fungsi ini HANYA jika ada file,
        // dan jika tidak, jangan masukkan key gambar ke $data agar tidak menimpa.
        // Perubahan di atas (di update method) sudah menghandle ini.
    }

    private function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
