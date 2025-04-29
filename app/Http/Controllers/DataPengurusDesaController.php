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
    $request->validate([
        'nama_data_pengurus_desa' => 'required|string|max:255',
        'jabatan_data_pengurus_desa' => 'required|string|max:255',
        'deskripsi_data_pengurus_desa' => 'required|string',
        'gambar_data_pengurus_desa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('gambar_data_pengurus_desa')) {
        $imagePath = $request->file('gambar_data_pengurus_desa')->store('pengurus_images', 'public');
    }

    DataPengurusDesa::create([
        'nama_data_pengurus_desa' => $request->nama_data_pengurus_desa,
        'jabatan_data_pengurus_desa' => $request->jabatan_data_pengurus_desa,
        'deskripsi_data_pengurus_desa' => $request->deskripsi_data_pengurus_desa,
        'gambar_data_pengurus_desa' => $imagePath,
    ]);

    return redirect()->route('data_pengurus_desa.index')->with('success', 'Data pengurus berhasil ditambahkan.');
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
        $data_pengurus_desas = DataPengurusDesa::findOrFail($id);
        return view('data_pengurus_desa.edit', compact('pengurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data_pengurus_desas = DataPengurusDesa::findOrFail($id);
        $request->validate([
            'nama_data_pengurus_desa' => 'required|string|max:255',
            'jabatan_data_pengurus_desa' => 'required|string|max:255',
            'deskripsi_data_pengurus_desa' => 'required|string|max:255','nullable',
            'gambar_data_pengurus_desa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 'nullable'
        ]);

        $data = [
            'nama_data_pengurus_desa' => $request->input('nama_data_pengurus_desa'),
            'jabatan_data_pengurus_desa' => $request->input('jabatan_data_pengurus_desa'),
            'deskripsi_data_pengurus_desa' => $request->input('deskripsi_data_pengurus_desa'),
            'gambar_data_pengurus_desa' => $path ?? null,
        ];

        if ($request->hasFile('gambar_data_pengurus_desa')) {
            // Hapus gambar lama jika ada
            if ($data_pengurus_desas->gambar_data_pengurus_desa) {
                Storage::disk('public')->delete($data_pengurus_desas->gambar_data_pengurus_desa);
            }
            $path = $request->file('gambar_data_pengurus_desa')->store('pengurus', 'public');
            $data['gambar_data_pengurus_desa'] = $path;
        }

        $data_pengurus_desas->update($data);

        return redirect()->route('data_pengurus_desa.index')->with('success', 'Data Pengurus Desa Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_pengurus_desas = DataPengurusDesa::findOrFail($id);
        Storage::disk('public')->delete($data_pengurus_desas->gambar_data_pengurus_desa);
        $data_pengurus_desas->delete();

        return redirect()->route('data_pengurus_desa.index')->with('success', 'Data Pengurus Desa Berhasil Dihapus!');
    }
}
