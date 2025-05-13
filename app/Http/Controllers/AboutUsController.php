<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('dashboard.sekretaris.page.About.index_about', compact('aboutUs')); // Sesuaikan nama view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('about_us.create'); // Sesuaikan nama view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'visi_misi' => 'required|string',
            'sejarah' => 'required|string',
            'jumlah_penduduk' => 'nullable|integer',
            'luas_wilayah' => 'nullable|string',
            'jumlah_perangkat_desa' => 'nullable|integer',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambar1Path = null;
        if ($request->hasFile('gambar1')) {
            $gambar1Path = $request->file('gambar1')->store('about_us', 'public');
        }

        $gambar2Path = null;
        if ($request->hasFile('gambar2')) {
            $gambar2Path = $request->file('gambar2')->store('about_us', 'public');
        }

        AboutUs::create([
            'visi_misi' => $validated['visi_misi'],
            'sejarah' => $validated['sejarah'],
            'jumlah_penduduk' => $validated['jumlah_penduduk'],
            'luas_wilayah' => $validated['luas_wilayah'],
            'jumlah_perangkat_desa' => $validated['jumlah_perangkat_desa'],
            'gambar1' => $gambar1Path,
            'gambar2' => $gambar2Path,
        ]);

        return redirect()->route('sekretaris.about_us.index')->with('success', 'Data About Us berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used in this example, you can remove this if you don't need it
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('about_us.edit', compact('aboutUs')); // Sesuaikan nama view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);

        $validated = $request->validate([
            'visi_misi' => 'required|string',
            'sejarah' => 'required|string',
            'jumlah_penduduk' => 'nullable|integer',
            'luas_wilayah' => 'nullable|string',
            'jumlah_perangkat_desa' => 'nullable|integer',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'visi_misi' => $validated['visi_misi'],
            'sejarah' => $validated['sejarah'],
            'jumlah_penduduk' => $validated['jumlah_penduduk'],
            'luas_wilayah' => $validated['luas_wilayah'],
            'jumlah_perangkat_desa' => $validated['jumlah_perangkat_desa'],
        ];

        if ($request->hasFile('gambar1')) {
            // Hapus gambar lama jika ada
            if ($aboutUs->gambar1) {
                Storage::disk('public')->delete($aboutUs->gambar1);
            }
            $path = $request->file('gambar1')->store('about_us', 'public');
            $data['gambar1'] = $path;
        }

        if ($request->hasFile('gambar2')) {
            // Hapus gambar lama jika ada
            if ($aboutUs->gambar2) {
                Storage::disk('public')->delete($aboutUs->gambar2);
            }
            $path = $request->file('gambar2')->store('about_us', 'public');
            $data['gambar2'] = $path;
        }

        $aboutUs->update($data);

        return redirect()->route('sekretaris.about_us.index')->with('success', 'Data About Us berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);

        if ($aboutUs->gambar1) {
            Storage::disk('public')->delete($aboutUs->gambar1);
        }
        if ($aboutUs->gambar2) {
            Storage::disk('public')->delete($aboutUs->gambar2);
        }

        $aboutUs->delete();

        return redirect()->route('sekretaris.about_us.index')->with('success', 'Data About Us berhasil dihapus!');
    }
}
