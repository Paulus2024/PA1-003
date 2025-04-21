<?php

namespace App\Http\Controllers;

use App\Models\DataPengurusDesa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DataPengurusDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_pengurus_desas/*1*/ = DataPengurusDesa::all();//nama variabel bebas = Nama Model::all();
        return view('dashboard.sekretaris.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas')); //mengambil data dari database dan mengirim ke view| fasilitas.index = nama route| compact('fasilitas') = nama variabel yang dikirim ke view /*1*/
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
            'nama_data_pengurus_desa' => 'required|string|max:255',
            'jabatan_data_pengurus_desa' => 'required|string|max:255',
            'deskripsi_data_pengurus_desa' => 'required|string|max:255',
            'gambar_data_pengurus_desa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 'nullable'
        ]);

        $path = $request->file('gambar_data_pengurus_desa')->store('data_pengurus_desa', 'public');

        DataPengurusDesa::create([
            'nama_data_pengurus_desa' => $validated['nama_data_pengurus_desa'],
            'jabatan_data_pengurus_desa' => $validated['jabatan_data_pengurus_desa'],
            'deskripsi_data_pengurus_desa' => $validated['deskripsi_data_pengurus_desa'],
            'gambar_data_pengurus_desa' => $path
        ]);

        return redirect()->route('data_pengurus_desa_sekretaris')->with('success', 'Data baru berhasil ditambahkan!');
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
        $galleries = DataPengurusDesa::findOrFail($id);
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $galleries = DataPengurusDesa::findOrFail($id);
        $request->validate([
            'nama_data_pengurus_desa' => 'required|string|max:255',
            'jabatan_data_pengurus_desa' => 'required|string|max:255',
            'deskripsi_data_pengurus_desa' => 'required|string|max:255',
            'gambar_data_pengurus_desa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 'nullable'
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
        $galleries = DataPengurusDesa::findOrFail($id);
        Storage::disk('public')->delete($galleries->gambar_galeri);
        $galleries->delete();

        return redirect()->route('galleries.index')->with('success', 'Data galeri berhasil dihapus!');
    }
}
