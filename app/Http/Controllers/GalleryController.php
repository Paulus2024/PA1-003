<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Storage;
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
            'title' => 'required|string|max:255',
            'gambar_galeri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('gambar_galeri')->store('galeri', 'public');

        Gallery::create([
            'nama_galeri' => $validated['nama_galeri'],
            'gambar_galeri' => $path
        ]);

        return redirect()->route('sekretaris.galeri.index')->with('success', 'Data galeri berhasil ditambahkan!');
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
        $galleries = Gallery::findOrFail($id);
        return view('dashboard.sekretaris.page.Galeri.edit_galeri', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $galleries = Gallery::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'gambar_galeri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar_galeri')) {
            // Hapus gambar lama jika ada
            Storage::disk('public')->delete($galleries->gambar_galeri);
            $path = $request->file('gambar_galeri')->store('galeri', 'public');

            $path = $galleries->gambar_galeri;
        }

        $galleries->update([
            'title' => $request->input('title'),
            'gambar_galeri' => $path
        ]);
        return redirect()->route('sekretaris.galeri.index')->with('success', 'Data galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galleries = Gallery::findOrFail($id);
        Storage::disk('public')->delete($galleries->gambar_galeri);
        $galleries->delete();

        return redirect()->route('sekretaris.galeri.index')->with('success', 'Data galeri berhasil dihapus!');
    }
}
