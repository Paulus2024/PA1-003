<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Memastikan hanya user yang login yang bisa mengakses
        // $this->middleware('role:sekretaris'); // Hapus baris ini
    }

    /**
     * Display the About information.  Since we're assuming only one "About" record,
     * this is effectively an "index" method.
     */
    public function index()
    {
        $about = About::first(); // Ambil data About yang pertama (atau null jika tidak ada)
        return view('dashboard.sekretaris.page.about.index_about', compact('about'));
    }

    /**
     * Show the form for creating a new About entry.
     */
    public function create()
    {
        return view('dashboard.sekretaris.page.about.index_about');  // You might not need this if you're using a modal
    }

    /**
     * Store a newly created About entry in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Gambar bisa opsional
            'sejarah' => 'required',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Gambar bisa opsional
            'visi_misi' => 'required',
            'jumlah_penduduk' => 'nullable|integer',
            'luas_wilayah' => 'nullable|string',
            'jumlah_perangkat_desa' => 'nullable|integer',
        ]);

        $data = $request->except(['_token']);

        // Handle gambar1
        if ($request->hasFile('gambar1')) {
            $path = $request->file('gambar1')->store('abouts', 'public');
            $data['gambar1'] = $path;
        }

        // Handle gambar2
        if ($request->hasFile('gambar2')) {
            $path = $request->file('gambar2')->store('abouts', 'public');
            $data['gambar2'] = $path;
        }


        // If an About entry already exists, update it; otherwise, create a new one
        $existingAbout = About::first();
        if ($existingAbout) {
            $existingAbout->update($data);
            $message = 'Data About berhasil diperbarui.';
        } else {
            About::create($data);
            $message = 'Data About berhasil ditambahkan.';
        }

        return redirect()->route('abouts.index')->with('success', $message);
    }

    /**
     * Display the specified About entry.  (Unlikely to be used directly in this single-record scenario)
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
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sejarah' => 'required',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visi_misi' => 'required',
            'jumlah_penduduk' => 'nullable|integer',
            'luas_wilayah' => 'nullable|string',
            'jumlah_perangkat_desa' => 'nullable|integer',
        ]);

        $data = $request->except(['_token', '_method']);

        // Handle gambar1
        if ($request->hasFile('gambar1')) {
            // Delete old image if it exists
            if ($about->gambar1) {
                Storage::disk('public')->delete($about->gambar1);
            }
            $path = $request->file('gambar1')->store('abouts', 'public');
            $data['gambar1'] = $path;
        }

        // Handle gambar2
        if ($request->hasFile('gambar2')) {
            // Delete old image if it exists
            if ($about->gambar2) {
                Storage::disk('public')->delete($about->gambar2);
            }
            $path = $request->file('gambar2')->store('abouts', 'public');
            $data['gambar2'] = $path;
        }

        $about->update($data);

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about = About::findOrFail($id);

        // Delete associated images
        if ($about->gambar1) {
            Storage::disk('public')->delete($about->gambar1);
        }
        if ($about->gambar2) {
            Storage::disk('public')->delete($about->gambar2);
        }

        $about->delete();

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil dihapus!');
    }
}
