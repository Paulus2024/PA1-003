<?php

namespace App\Http\Controllers;
use App\Models\AlatPertanian;
use Illuminate\Http\Request;

class AlatPertanianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $alat_pertanians = AlatPertanian::all(); // Ambil semua data
        return view('dashboard.sekretaris.page.Alat_Pertanian.index_alat_pertanian', compact('alat_pertanians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alat-pertanian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:ringan,berat',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $filename = null;
        if ($request->hasFile('gambar')) {
            $filename = $request->file('gambar')->store('alat', 'public');
        }

        AlatPertanian::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'gambar' => $filename,
        ]);

        return redirect()->route('alat-pertanian.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(AlatPertanian $alat_pertanians)
    {
        return view('alat-pertanian.show', compact('alatPertanian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlatPertanian $alat_pertanians)
    {
        return view('alat-pertanian.edit', compact('alatPertanian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlatPertanian $alat_pertanians)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:ringan,berat',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($alat_pertanians->gambar) {
                \Storage::disk('public')->delete($alat_pertanians->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat_pertanians->update($data);

        return redirect()->route('alat-pertanian.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlatPertanian $alat_pertanians)
    {
        // Delete associated image if exists
        if ($alat_pertanians->gambar) {
            \Storage::disk('public')->delete($alat_pertanians->gambar);
        }

        $alat_pertanians>delete();

        return redirect()->route('alat-pertanian.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
