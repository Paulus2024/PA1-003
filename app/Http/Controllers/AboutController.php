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


    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'gambar_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'sejarah' => 'required',
    //         'gambar_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'visi_misi' => 'required',
    //         'jumlah_penduduk' => 'nullable|integer',
    //         'luas_wilayah' => 'nullable|string',
    //         'jumlah_perangkat_desa' => 'nullable|integer',
    //     ]);

    //     $data = $request->except(['_token', 'gambar_1', 'gambar_2']);

    //     $data['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts');
    //     $data['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts');

    //     About::create($data);

    //     return redirect()->route('abouts.index')->with('success', 'Data About berhasil ditambahkan.');
    // }

    // public function update(Request $request, string $id)
    // {
    //     $about = About::findOrFail($id);

    //     $validated = $request->validate([
    //         'gambar_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'sejarah' => 'required',
    //         'gambar_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'visi_misi' => 'required',
    //         'jumlah_penduduk' => 'nullable|integer',
    //         'luas_wilayah' => 'nullable|string',
    //         'jumlah_perangkat_desa' => 'nullable|integer',
    //     ]);

    //     $data = $request->except(['_token', '_method', 'gambar_1', 'gambar_2']);

    //     // Handle gambar_1
    //     if ($request->hasFile('gambar_1')) {
    //         // Upload gambar baru dan hapus yang lama
    //         $data['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts', $about->gambar_1);
    //     } else {
    //         // Jika tidak ada gambar baru, gunakan gambar yang sudah ada
    //         $data['gambar_1'] = $about->gambar_1;
    //     }

    //     // Handle gambar_2 (mirip dengan gambar_1)
    //     if ($request->hasFile('gambar_2')) {
    //         $data['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts', $about->gambar_2);
    //     } else {
    //         $data['gambar_2'] = $about->gambar_2;
    //     }

    //     $about->update($data);

    //     return redirect()->route('abouts.index')->with('success', 'Data About berhasil diperbarui!');
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sejarah' => 'required|string',
            'gambar_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visi_misi' => 'required|string',
            'jumlah_penduduk' => 'nullable|integer',
            'luas_wilayah' => 'nullable|string|max:255',
            'jumlah_perangkat_desa' => 'nullable|integer',

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

        // Ambil semua data dari request kecuali token dan file gambar
        $data = $request->except(['_token', 'gambar_1', 'gambar_2']);

        // Tambahkan user_id dari pengguna yang terautentikasi
        $data['user_id'] = Auth::id();

        // Proses upload gambar_1 jika ada
        if ($request->hasFile('gambar_1')) {
            $data['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts');
        }

        // Proses upload gambar_2 jika ada
        if ($request->hasFile('gambar_2')) {
            $data['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts');
        }

        About::create($data);

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $about = About::findOrFail($id);


        // Otorisasi: Pastikan user yang mengupdate adalah user yang membuat, atau admin
        // if ($about->user_id !== Auth::id() && !Auth::user()->isAdmin()) { // Asumsi ada method isAdmin() di model User
        //     abort(403, 'Unauthorized action.');
        // }

        $validated = $request->validate([
            'gambar_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sejarah' => 'required|string',
            'gambar_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visi_misi' => 'required|string',
            'jumlah_penduduk' => 'nullable|integer',
            'luas_wilayah' => 'nullable|string|max:255',
            'jumlah_perangkat_desa' => 'nullable|integer',

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

        // User ID biasanya tidak diubah saat update, jadi kita tidak perlu menyertakannya di sini
        // kecuali ada kasus khusus. Jika user_id bisa diubah (misal oleh admin):
        // $data['user_id'] = $request->input('user_id_baru', $about->user_id);

        // Handle gambar_1
        if ($request->hasFile('gambar_1')) {
            $data['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts', $about->gambar_1);

        } else {
            // Jika tidak ada gambar baru dan Anda ingin menghapus gambar_1 yang ada jika checkbox diklik (misal)
            // if ($request->boolean('remove_gambar_1')) {
            //     $this->deleteImage($about->gambar_1);
            //     $data['gambar_1'] = null;
            // } else {
            //     $data['gambar_1'] = $about->gambar_1; // Pertahankan gambar lama jika tidak ada yang baru dan tidak dihapus
            // }
            // Untuk kasus sederhana, jika tidak ada file baru, jangan ubah field gambar di database
            // Biarkan $data tidak memiliki key 'gambar_1' jika tidak ada file baru,
            // maka nilai $about->gambar_1 yang lama tidak akan tertimpa saat update.
            // Namun, jika $fillable Anda mengharuskan semua field ada, maka:
            // $data['gambar_1'] = $about->gambar_1; (jika tidak ada file baru)
        }


        // Handle gambar_2
        if ($request->hasFile('gambar_2')) {
            $data['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts', $about->gambar_2);
        } else {
            // $data['gambar_2'] = $about->gambar_2; // Sama seperti gambar_1

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
