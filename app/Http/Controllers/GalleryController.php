<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pertimbangkan untuk memfilter galeri berdasarkan user jika perlu
        $galleries = Gallery::all();
        return view('dashboard.sekretaris.page.Galeri.index_galeri', compact('galleries'));
    }

    public function index_masyarakat()
    {
        $galleries = Gallery::all();
        return view('dashboard.masyarakat.page.Galeri.index_galeri', compact('galleries'));
    }

    public function index_bumdes()
    {
        $galleries = Gallery::all();
        return view('dashboard.bumdes.page.Galeri.index_galeri', compact('galleries'));
    }

    // Menggunakan salah satu definisi index_pengguna yang benar
    // dan menghilangkan definisi index_bumdes yang bersarang.
    public function index_pengguna()
    {
        $galleries = Gallery::all(); // ambil semua galeri
        return view('pengguna.page.Galeri.index_galeri', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashboard.sekretaris.page.Galeri.create_galeri'); // Jika ada halaman create terpisah
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_galeri' => 'required|string|max:255',
            'gambar_galeri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar_galeri')) {
            $file = $request->file('gambar_galeri');
            // Buat nama file unik dan sanitasi
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('galeri', $filename, 'public');
        }

        Gallery::create([
            'user_id' => Auth::id(), // <-- Tambahkan ID pengguna yang sedang login
            'judul_galeri' => $validated['judul_galeri'],
            'gambar_galeri' => $path
        ]);

        return redirect()->route('galleries.index')->with('success', 'Data galeri berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $gallery = Gallery::findOrFail($id);
        // return view('path.to.your.show.view', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Method ini biasanya digunakan untuk mengambil data dan menampilkannya di form edit terpisah.
        // Jika Anda menggunakan modal di halaman index, data mungkin sudah ada atau di-fetch via AJAX.
        $gallery = Gallery::findOrFail($id);
        // return view('dashboard.sekretaris.page.Galeri.edit_galeri', compact('gallery')); // Jika ada view edit terpisah
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id); // Gunakan nama variabel tunggal: $gallery

        // Pertimbangkan otorisasi: apakah pengguna yang login berhak mengupdate galeri ini?
        // if ($gallery->user_id !== Auth::id() && !Auth::user()->isAdminRole()) { // Contoh
        //     abort(403, 'Akses ditolak.');
        // }

        $request->validate([
            'judul_galeri' => 'required|string|max:255',
            'gambar_galeri' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'judul_galeri' => $request->input('judul_galeri'),
            // user_id biasanya tidak diubah saat update
        ];

        if ($request->hasFile('gambar_galeri')) {
            // Hapus gambar lama jika ada dan path-nya valid
            if ($gallery->gambar_galeri && Storage::disk('public')->exists($gallery->gambar_galeri)) {
                Storage::disk('public')->delete($gallery->gambar_galeri);
            }
            // Simpan gambar baru
            $file = $request->file('gambar_galeri');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('galeri', $filename, 'public');
            $data['gambar_galeri'] = $path;
        }

        $gallery->update($data);

        return redirect()->route('galleries.index')->with('success', 'Data galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id); // Gunakan nama variabel tunggal: $gallery

        // Pertimbangkan otorisasi: apakah pengguna yang login berhak menghapus galeri ini?
        // if ($gallery->user_id !== Auth::id() && !Auth::user()->isAdminRole()) { // Contoh
        //     abort(403, 'Akses ditolak.');
        // }

        // Hapus gambar dari storage jika ada dan path-nya valid
        if ($gallery->gambar_galeri && Storage::disk('public')->exists($gallery->gambar_galeri)) {
            Storage::disk('public')->delete($gallery->gambar_galeri);
        }
        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Data galeri berhasil dihapus!');
    }
}
