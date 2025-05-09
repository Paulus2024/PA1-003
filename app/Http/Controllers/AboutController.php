<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::all(); //nama variabel bebas = Nama Model::all();
        return view('dashboard.sekretaris.page.about.index_about', compact('abouts')); //mengambil data dari database dan mengirim ke view| fasilitas.index = nama route| compact('fasilitas') = nama variabel yang dikirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.sekretaris.page.about.index_about'); // Return the create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'visi_misi' => 'required|string',
            'sejarah' => 'required|string',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'visi_misi' => $validated['visi_misi'],
            'sejarah' => $validated['sejarah'],
        ];

        if ($request->hasFile('gambar1')) {
            $path1 = $request->file('gambar1')->store('abouts', 'public');
            $data['gambar1'] = $path1;
        }

        if ($request->hasFile('gambar2')) {
            $path2 = $request->file('gambar2')->store('abouts', 'public');
            $data['gambar2'] = $path2;
        }

        About::create($data);

        return redirect()->route('abouts.index')->with('success', 'Data about berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $about = About::findOrFail($id);
        return view('dashboard.sekretaris.page.about.index_about', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $about = About::findOrFail($id);
        return view('dashboard.sekretaris.page.about.index_about', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about = About::findOrFail($id);

        $validated = $request->validate([
            'visi_misi' => 'required|string',
            'sejarah' => 'required|string',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'visi_misi' => $validated['visi_misi'],
            'sejarah' => $validated['sejarah'],
        ];

        // Handle gambar1
        if ($request->hasFile('gambar1')) {
            // Delete old image if exists
            if ($about->gambar1) {
                Storage::disk('public')->delete($about->gambar1);
            }
            $path1 = $request->file('gambar1')->store('abouts', 'public');
            $data['gambar1'] = $path1;
        }

        // Handle gambar2
        if ($request->hasFile('gambar2')) {
            // Delete old image if exists
            if ($about->gambar2) {
                Storage::disk('public')->delete($about->gambar2);
            }
            $path2 = $request->file('gambar2')->store('abouts', 'public');
            $data['gambar2'] = $path2;
        }

        $about->update($data);

        return redirect()->route('abouts.index')->with('success', 'Data about berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about = About::findOrFail($id);

        // Delete gambar1 if exists
        if ($about->gambar1) {
            Storage::disk('public')->delete($about->gambar1);
        }

        // Delete gambar2 if exists
        if ($about->gambar2) {
            Storage::disk('public')->delete($about->gambar2);
        }

        $about->delete();

        return redirect()->route('abouts.index')->with('success', 'Data about berhasil dihapus!');
    }
}
