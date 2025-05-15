<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries/*1*/ = Gallery::all();//nama variabel bebas = Nama Model::all();
        return view('dashboard.sekretaris.page.Galeri.index_galeri', compact('galleries')); //mengambil data dari database dan mengirim ke view| fasilitas.index = nama route| compact('fasilitas') = nama variabel yang dikirim ke view /*1*/

    }
    public function index_masyarakat()
    {
        $galleries = Gallery::all(); // Atau sesuai model kamu
        return view('dashboard.masyarakat.page.Galeri.index_galeri', compact('galleries'));
    }



public function index_bumdes()
{
    $galleries = Gallery::all();
    return view('dashboard.bumdes.page.Galeri.index_galeri', compact('galleries'));
}

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
        //
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

        $path = $request->file('gambar_galeri')->store('galeri', 'public');

        Gallery::create([
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $galleries = Gallery::findOrFail($id);
        $request->validate([
            'judul_galeri' => 'required|string|max:255',
            'gambar_galeri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 'nullable'
        ]);

        $data = [
            'judul_galeri' => $request->input('judul_galeri'),
        ];

        if ($request->hasFile('gambar_galeri')) {
            // Hapus gambar lama jika ada
            if ($galleries->gambar_galeri) {
                Storage::disk('public')->delete($galleries->gambar_galeri);
            }
            $path = $request->file('gambar_galeri')->store('galeri', 'public');
            $data['gambar_galeri'] = $path;
        }

        $galleries->update($data);

        return redirect()->route('galleries.index')->with('success', 'Data galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galleries = Gallery::findOrFail($id);
        Storage::disk('public')->delete($galleries->gambar_galeri);
        $galleries->delete();

        return redirect()->route('galleries.index')->with('success', 'Data galeri berhasil dihapus!');
    }
}
