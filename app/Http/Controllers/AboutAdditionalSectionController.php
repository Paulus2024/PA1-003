<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutAdditionalSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini diimpor
use Illuminate\Support\Str; // Pastikan ini diimpor

class AboutAdditionalSectionController extends Controller
{
    // Method untuk menampilkan semua additional sections untuk about tertentu
    // Anda akan memanggil ini dari halaman admin About Anda, misalnya:
    // <a href="{{ route('abouts.additional-sections.index', $about->id) }}">Kelola Bagian Tambahan</a>
    public function index(About $about)
    {
        $additionalSections = $about->additionalSections()->orderBy('created_at', 'asc')->get();
        return view('dashboard.sekretaris.page.about.additional_sections.index', compact('about', 'additionalSections'));
    }

    // Method untuk menampilkan form tambah data tambahan
    public function create(About $about)
    {
        return view('dashboard.sekretaris.page.about.additional_sections.create', compact('about'));
    }

    // Method untuk menyimpan data tambahan baru
    public function store(Request $request, About $about)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string', // Konten dari TinyMCE
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
        ], [
            'title.required' => 'Judul bagian tambahan wajib diisi.',
            'content.required' => 'Konten bagian tambahan wajib diisi.',
            'media_file.mimes' => 'Format file media tidak didukung.',
            'media_file.max' => 'Ukuran file media terlalu besar.',
        ]);

        if ($request->hasFile('media_file')) {
            $validatedData['media_file'] = $this->uploadFile($request, 'media_file', 'abouts/additional_sections');
        }

        $about->additionalSections()->create($validatedData);

        return redirect()->route('abouts.additional-sections.index', $about->id)->with('success', 'Bagian tambahan berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit data tambahan
    public function edit(About $about, AboutAdditionalSection $section)
    {
        return view('dashboard.sekretaris.page.about.additional_sections.edit', compact('about', 'section'));
    }

    // Method untuk memperbarui data tambahan
    public function update(Request $request, About $about, AboutAdditionalSection $section)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
        ], [
            'title.required' => 'Judul bagian tambahan wajib diisi.',
            'content.required' => 'Konten bagian tambahan wajib diisi.',
            'media_file.mimes' => 'Format file media tidak didukung.',
            'media_file.max' => 'Ukuran file media terlalu besar.',
        ]);

        if ($request->hasFile('media_file')) {
            $validatedData['media_file'] = $this->uploadFile($request, 'media_file', 'abouts/additional_sections', $section->media_file);
        } elseif ($request->has('remove_media_file')) { // Checkbox untuk menghapus media
            $this->deleteFile($section->media_file);
            $validatedData['media_file'] = null;
        } else {
            // Jika tidak ada file baru dan tidak ada perintah hapus, pertahankan yang lama
            unset($validatedData['media_file']);
        }

        $section->update($validatedData);

        return redirect()->route('abouts.additional-sections.index', $about->id)->with('success', 'Bagian tambahan berhasil diperbarui.');
    }

    // Method untuk menghapus data tambahan
    public function destroy(About $about, AboutAdditionalSection $section)
    {
        if ($section->media_file) {
            $this->deleteFile($section->media_file);
        }
        $section->delete();
        return redirect()->route('abouts.additional-sections.index', $about->id)->with('success', 'Bagian tambahan berhasil dihapus.');
    }

    /**
     * Helper function untuk mengunggah file (gambar atau video).
     * Disarankan untuk memindahkan ini ke Trait atau Service jika banyak digunakan.
     */
    private function uploadFile(Request $request, string $fieldName, string $directory, ?string $existingPath = null): ?string
    {
        if ($request->hasFile($fieldName)) {
            if ($existingPath && Storage::disk('public')->exists($existingPath)) {
                Storage::disk('public')->delete($existingPath);
            }
            $file = $request->file($fieldName);
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', Str::replace(' ', '_', $file->getClientOriginalName()));
            $path = $file->storeAs($directory, $filename, 'public');
            return $path;
        }
        return null;
    }

    /**
     * Helper function untuk menghapus file.
     * Disarankan untuk memindahkan ini ke Trait atau Service jika banyak digunakan.
     */
    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
