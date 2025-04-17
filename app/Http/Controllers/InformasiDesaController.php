<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiDesa; // Mengimpor model InformasiDesa
use Illuminate\Support\Facades\Storage; // Mengimpor Storage untuk mengelola file

class InformasiDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = InformasiDesa::all(); // Mengambil semua data dari model InformasiDesa
        return view('dashboard.sekretaris.page.Informasi.index_informasi', compact('informasi')); // Mengirim data ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_informasi'      => 'required|string|max:255',
            'deskripsi_informasi'  => 'required|string',
            'kategori_informasi'   => 'required|string|max:255',
            'lampiran_informasi'   => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc, docx|max:2048',
            'status_informasi'     => 'required|boolean',
        ]);

        $path = $request->file('lampiran_informasi')->store('informasi', 'public');

        InformasiDesa::create([
            'judul_informasi'      => $validated['judul_informasi'],
            'deskripsi_informasi'  => $validated['deskripsi_informasi'],
            'kategori_informasi'   => $validated['kategori_informasi'],
            'lampiran_informasi'   => $path,
            'status_informasi'     => $validated['status_informasi']
        ]);

        return redirect()->route('sekretaris.informasi_sekretaris.index')->with('success', 'Data informasi berhasil ditambahkan!');
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
        $informasi = InformasiDesa::findOrFail($id);
        return view('dashboard.sekretaris.page.Informasi.edit_informasi', compact('informasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $informasi = InformasiDesa::findOrFail($id);

        // $request->validate([
        //     'judul_informasi'      => 'required|string|max:255',
        //     'deskripsi_informasi'  => 'required|string',
        //     'kategori_informasi'   => 'required|string|in:berita,pengumuman',
        //     'lampiran_informasi'   => 'required|string|max:255',
        //     'status_informasi'     => 'required|string|in:draft,publish'
        // ]);
        $validated = $request->validate([
            'judul_informasi'      => 'required|string|max:255',
            'deskripsi_informasi'  => 'required|string',
            'kategori_informasi'   => 'required|string|max:255',
            'lampiran_informasi'   => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc, docx|max:2048',
            'status_informasi'     => 'required|boolean'
        ]);

        $dataUpdate = [
            'judul_informasi'      => $request->judul_informasi,
            'deskripsi_informasi'  => $request->deskripsi_informasi,
            'kategori_informasi'   => $request->kategori_informasi,
            'status_informasi'     => $request->status_informasi
        ];

        if($request->hasFile('lampiran_informasi')){
            //Hapus Gambar Lama
            Storage::disk('public')->delete($informasi->lampiran_informasi);
            //Upload Gambar Baru
            $path = $request->file('lampiran_informasi')->store('informasi', 'public');
            $dataUpdate['lampiran_informasi'] = $path;
        }

        $informasi->update($dataUpdate);
        return redirect()->route('sekretaris.informasi.index')->with('success', 'Data informasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $informasi = InformasiDesa::findOrFail($id);
        Storage::disk('public')->delete($informasi->lampiran_informasi);
        $informasi->delete();

        return redirect()->route('sekretaris.informasi.index')->with('success', 'Data berhasil di hapus');
    }
}
