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

    public function ShowPublic()
    {
        $about = About::first(); // Ambil data About yang pertama

        return view('pengguna.page.about.index_about', compact('about'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gambar_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sejarah' => 'required',
            'gambar_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visi_misi' => 'required',
            'jumlah_penduduk' => 'required|integer',
            'luas_wilayah' => 'required|string',
            'jumlah_perangkat_desa' => 'required|integer',
        ], [
            'sejarah.required' => 'Sejarah wajib diisi.',
            'visi_misi.required' => 'Visi & Misi wajib diisi.',
            'gambar_1.required' => 'Gambar 1 wajib diisi.',
            'gambar_2.required' => 'Gambar 2 wajib diisi.',
            'jumlah_penduduk.required' => 'Jumlah Penduduk wajib diisi.',
            'luas_wilayah.required' => 'Luas Wilayah wajib diisi.',
            'jumlah_perangkat_desa.required' => 'Jumlah Perangkat Desa wajib diisi.',
        ]);

        $data = $request->except(['_token', 'gambar_1', 'gambar_2']);

        $data['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts');
        $data['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts');

        About::create($data);

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $about = About::findOrFail($id);

        $rules = [
            'sejarah' => 'required',
            'visi_misi' => 'required',
            'jumlah_penduduk' => 'required|integer',
            'luas_wilayah' => 'required|string',
            'jumlah_perangkat_desa' => 'required|integer',
        ];

        // Validasi gambar_1 hanya jika ada file yang diupload
        if ($request->hasFile('gambar_1')) {
            $rules['gambar_1'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        // Validasi gambar_2 hanya jika ada file yang diupload
        if ($request->hasFile('gambar_2')) {
            $rules['gambar_2'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validatedData = $request->validate($rules, [
            'sejarah.required' => 'Sejarah wajib diisi.',
            'visi_misi.required' => 'Visi & Misi wajib diisi.',
            'jumlah_penduduk.required' => 'Jumlah Penduduk wajib diisi.',
            'luas_wilayah.required' => 'Luas Wilayah wajib diisi.',
            'jumlah_perangkat_desa.required' => 'Jumlah Perangkat Desa wajib diisi.',
            'gambar_1.image' => 'Gambar 1 harus berupa file gambar.',
            'gambar_1.mimes' => 'Gambar 1 harus berformat: jpeg, png, jpg, gif, svg.',
            'gambar_1.max' => 'Ukuran Gambar 1 tidak boleh lebih dari 2048 KB.',
            'gambar_2.image' => 'Gambar 2 harus berupa file gambar.',
            'gambar_2.mimes' => 'Gambar 2 harus berformat: jpeg, png, jpg, gif, svg.',
            'gambar_2.max' => 'Ukuran Gambar 2 tidak boleh lebih dari 2048 KB.',
        ]);

        $data = $request->except(['_token', '_method', 'gambar_1', 'gambar_2']);

        // Handle gambar_1
        if ($request->hasFile('gambar_1')) {
            // Upload gambar baru dan hapus yang lama
            $data['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts', $about->gambar_1);
        }

        // Handle gambar_2
        if ($request->hasFile('gambar_2')) {
            $data['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts', $about->gambar_2);
        }

        $about->update($data);

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $about = About::findOrFail($id);

        $this->deleteImage($about->gambar_1);
        $this->deleteImage($about->gambar_2);

        $about->delete();

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil dihapus!');
    }

    private function uploadImage(Request $request, string $fieldName, string $directory, ?string $existingPath = null): ?string
    {
        if ($request->hasFile($fieldName)) {
            // Delete existing image if it exists
            if ($existingPath) {
                $this->deleteImage($existingPath);
            }

            $path = $request->file($fieldName)->store($directory, 'public');
            return $path;
        }

        return null;
    }

    private function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
