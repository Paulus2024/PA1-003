<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FasilitasDesa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class FasilitasDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = FasilitasDesa::all(); //nama variabel bebas = Nama Model::all();
        return view('dashboard.sekretaris.page.Fasilitas.index_fasilitas', compact('fasilitas')); //mengambil data dari database dan mengirim ke view| fasilitas.index = nama route| compact('fasilitas') = nama variabel yang dikirim ke view

    }

    public function index_masyarakat()
    {
        $fasilitas_masyarakat = FasilitasDesa::all();
        return view('dashboard.masyarakat.page.fasilitas.index_fasilitas', compact('fasilitas_masyarakat'));
    }
    /**
     * Show the form for creating a new resource.
     */
    /*public function create()
    {
        return view('dashboard.sekretaris.page.Fasilitas.create_fasilitas');            1. karena modal
    }*/

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas'      => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string',
            'lokasi_fasilitas'    => 'required|string|max:255',
            'gambar_fasilitas'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('gambar_fasilitas')->store('fasilitas', 'public');

        FasilitasDesa::create([
            'nama_fasilitas'        => $validated['nama_fasilitas'],
            'deskripsi_fasilitas'   => $validated['deskripsi_fasilitas'],
            'lokasi_fasilitas'      => $validated['lokasi_fasilitas'],
            'gambar_fasilitas'      => $path,
            'user_id'               => Auth::id(), // Tambahkan user_id saat create
        ]);

        return redirect()->route('sekretaris.fasilitas.index')->with('success', 'Data fasilitas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //cari fasilitas berdasarkan primary key
    //     $item = FasilitasDesa::findOrFail($id);

    //     //tampilkan view detail di folder pengunjung
    //     return view('pengunjung.fasilitas.show', compact('item'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fasilitas = FasilitasDesa::findOrFail($id);
        return view('dashboard.sekretaris.page.Fasilitas.edit_fasilitas', compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fasilitas = FasilitasDesa::findOrFail($id);

        $request->validate([
            'nama_fasilitas'      => 'required|string|max:255',
            'deskripsi_fasilitas' => 'required|string',
            'lokasi_fasilitas'    => 'required|string|max:255',
            'gambar_fasilitas'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar_fasilitas')) {
            // Hapus gambar lama
            Storage::disk('public')->delete($fasilitas->gambar_fasilitas);
            // Upload gambar baru
            $path = $request->file('gambar_fasilitas')->store('fasilitas', 'public');
            $fasilitas->gambar_fasilitas = $path;
        }

        $fasilitas->update([
            'nama_fasilitas'   => $request->nama_fasilitas,
            'deskripsi_fasilitas' => $request->deskripsi_fasilitas,
            'lokasi_fasilitas'   => $request->lokasi_fasilitas,
            'user_id'           => Auth::id(),  // Update user_id saat update (optional, lihat penjelasan di bawah)
        ]);

        return redirect()->route('sekretaris.fasilitas.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fasilitas = FasilitasDesa::findOrFail($id);
        Storage::disk('public')->delete($fasilitas->gambar_fasilitas);
        $fasilitas->delete();

        return redirect()->route('sekretaris.fasilitas.index')->with('success', 'Data berhasil dihapus!');
    }
}
