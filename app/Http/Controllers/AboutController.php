<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\AboutAdditionalSection;
use App\Models\FasilitasDesa;
use App\Models\Gallery; // ! 1. import model

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return view('dashboard.sekretaris.page.about.index_about', compact('abouts'));
    }

    // public function index_masyarakat()
    // {
    //     $abouts = About::all();
    //     return view('dashboard.masyarakat.page.About.index_about', compact('abouts'));
    // }
    public function index_masyarakat()
    {
        // Ambil record About pertama atau terbaru, dan eager load additionalSections
        $about = About::with('additionalSections')->latest()->first();
        // Anda bisa memilih 'first()' jika Anda hanya ingin record paling awal,
        // atau 'latest()->first()' jika ingin yang terakhir dibuat/diupdate.
        $fasilitas_terbaru = FasilitasDesa::latest()->limit(3)->get();

        $gallery_terbaru = Gallery::latest()->limit(6)->get(); // ! 2. Ambil 6 gallery terbaru

        if (!$about) {
            // Jika tidak ada data About, kirim $about null ke view
            return view('dashboard.masyarakat.page.About.index_about', [
                'about' => null,
                'fasilitas_terbaru' => $fasilitas_terbaru,
                'gallery_terbaru' => $gallery_terbaru // ! 3. Kirim gallery terbaru ke view
            ]);
        }

        return view('dashboard.masyarakat.page.About.index_about', compact('about', 'fasilitas_terbaru', 'gallery_terbaru'));// ! 4. Kirim fasilitas terbaru dan gallery terbaru ke view
    }

    public function index_bumdes()
    {
        $abouts = About::all();
        return view('dashboard.bumdes.page.About.index_about', compact('abouts'));
    }

    public function index_pengguna()
    {
        $abouts = About::all();
        return view('pengguna.page.About.index_about', compact('abouts'));
    }

    // public function store(Request $request)
    // {
    //     $validatedAboutData = $request->validate([
    //         'kata_sambutan_kepala_desa' => 'required|string',
    //         'media_file' =>  'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
    //         'gambar_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'sejarah' => 'required|string',
    //         'gambar_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'visi' => 'required|string',
    //         'misi' => 'required|string',
    //         'jumlah_penduduk' => 'required|integer',
    //         'luas_wilayah' => 'required|string|max:255',
    //         'jumlah_perangkat_desa' => 'required|integer',
    //     ], [
    //         'kata_sambutan_kepala_desa' => 'required|string',
    //         'media_file' =>  'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
    //         'sejarah.required' => 'Sejarah wajib diisi.',
    //         'visi.required' => 'Visi wajib diisi.',
    //         'misi.required' => 'Misi wajib diisi.',
    //         'gambar_1.required' => 'Gambar 1 wajib diunggah.',
    //         'gambar_2.required' => 'Gambar 2 wajib diunggah.',
    //         'jumlah_penduduk.required' => 'Jumlah penduduk wajib diisi.',
    //         'luas_wilayah.required' => 'Luas wilayah wajib diisi.',
    //         'jumlah_perangkat_desa.required' => 'Jumlah perangkat desa wajib diisi.',
    //     ]);

    //     // Validasi untuk bagian tambahan yang baru (jika ada)
    //     $validatedAdditionalSections = $request->validate([
    //         'new_sections' => 'nullable|array', // Nama array untuk bagian tambahan yang baru
    //         'new_sections.*.title' => 'required|string|max:255',
    //         'new_sections.*.content' => 'required|string',
    //         'new_sections.*.media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
    //     ], [
    //         'new_sections.*.title.required' => 'Judul bagian tambahan wajib diisi.',
    //         'new_sections.*.content.required' => 'Konten bagian tambahan wajib diisi.',
    //         'new_sections.*.media_file.mimes' => 'Format file media bagian tambahan tidak didukung.',
    //         'new_sections.*.media_file.max' => 'Ukuran file media bagian tambahan terlalu besar.',
    //     ]);

    //     // $data = $request->except(['_token', 'gambar_1', 'gambar_2']);
    //     $dataAbout = $validatedAboutData;
    //     // $data = $validatedData;
    //     $dataAbout['user_id'] = Auth::id();

    //     if ($request->hasFile('media_file')){
    //         $dataAbout['media_file'] = $this->uploadFile($request, 'media_file', 'abouts/media');
    //     } else {
    //         $dataAbout['media_file'] = null;
    //     }

    //     if ($request->hasFile('gambar_1')) {
    //         $dataAbout['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts');
    //     }

    //     if ($request->hasFile('gambar_2')) {
    //         $dataAbout['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts');
    //     }

    //     $about = About::create($dataAbout);

    //     // ?--- Handle Bagian Tambahan yang Baru ---
    //     if (isset($validatedAdditionalSections['new_sections'])) {
    //         foreach ($validatedAdditionalSections['new_sections'] as $index => $sectionData) {
    //             $sectionMediaFile = null;
    //             $fileInputName = 'new_sections.' . $index . '.media_file'; // Nama input file di form

    //             if ($request->hasFile($fileInputName)) {
    //                 $sectionMediaFile = $this->uploadFileFromRequest($request, $fileInputName, 'abouts/additional_sections');
    //             }

    //             $about->additionalSections()->create([
    //                 'title' => $sectionData['title'],
    //                 'content' => $sectionData['content'],
    //                 'media_file' => $sectionMediaFile,
    //             ]);
    //         }
    //     }

    //     return redirect()->route('abouts.index')->with('success', 'Data About berhasil ditambahkan.');
    // }
    public function store(Request $request)
    {
        // Validasi untuk data About utama
        $validatedAboutData = $request->validate([
            'gambar_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sejarah' => 'required|string',
            'gambar_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'jumlah_penduduk' => 'required|integer',
            'luas_wilayah' => 'required|string|max:255',
            'jumlah_perangkat_desa' => 'required|integer',
            'kata_sambutan_kepala_desa' => 'required|string',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
        ], [
            'gambar_1.required' => 'Gambar 1 wajib diunggah.',
            'sejarah.required' => 'Sejarah wajib diisi.',
            'gambar_2.required' => 'Gambar 2 wajib diunggah.',
            'visi.required' => 'Visi wajib diisi.',
            'misi.required' => 'Misi wajib diisi.',
            'jumlah_penduduk.required' => 'Jumlah penduduk wajib diisi.',
            'luas_wilayah.required' => 'Luas wilayah wajib diisi.',
            'jumlah_perangkat_desa.required' => 'Jumlah perangkat desa wajib diisi.',
            'kata_sambutan_kepala_desa.required' => 'Kata Sambutan Kepala Desa wajib diisi.',
            'media_file.mimes' => 'Format file media utama tidak didukung. Gunakan gambar (jpeg, png, jpg, gif, svg) atau video (mp4, avi, mov, wmv).',
            'media_file.max' => 'Ukuran file media utama terlalu besar (maksimal 50MB).',
        ]);

        // Validasi untuk bagian tambahan yang baru (jika ada)
        $validatedAdditionalSections = $request->validate([
            'new_sections' => 'nullable|array', // Nama array untuk bagian tambahan yang baru
            'new_sections.*.title' => 'required|string|max:255',
            'new_sections.*.content' => 'required|string',
            'new_sections.*.media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
        ], [
            'new_sections.*.title.required' => 'Judul bagian tambahan wajib diisi.',
            'new_sections.*.content.required' => 'Konten bagian tambahan wajib diisi.',
            'new_sections.*.media_file.mimes' => 'Format file media bagian tambahan tidak didukung.',
            'new_sections.*.media_file.max' => 'Ukuran file media bagian tambahan terlalu besar.',
        ]);


        $dataAbout = $validatedAboutData;
        $dataAbout['user_id'] = Auth::id();

        // Handle file uploads untuk About utama
        if ($request->hasFile('gambar_1')) {
            $dataAbout['gambar_1'] = $this->uploadFile($request, 'gambar_1', 'abouts/images');
        }
        if ($request->hasFile('gambar_2')) {
            $dataAbout['gambar_2'] = $this->uploadFile($request, 'gambar_2', 'abouts/images');
        }
        if ($request->hasFile('media_file')) {
            $dataAbout['media_file'] = $this->uploadFile($request, 'media_file', 'abouts/media');
        } else {
            $dataAbout['media_file'] = null; // Pastikan null jika tidak ada file
        }

        // Buat About utama
        $about = About::create($dataAbout);

        // --- Handle Bagian Tambahan yang Baru ---
        if (isset($validatedAdditionalSections['new_sections'])) {
            foreach ($validatedAdditionalSections['new_sections'] as $index => $sectionData) {
                $sectionMediaFile = null;
                $fileInputName = 'new_sections.' . $index . '.media_file'; // Nama input file di form

                if ($request->hasFile($fileInputName)) {
                    $sectionMediaFile = $this->uploadFileFromRequest($request, $fileInputName, 'abouts/additional_sections');
                }

                $about->additionalSections()->create([
                    'title' => $sectionData['title'],
                    'content' => $sectionData['content'],
                    'media_file' => $sectionMediaFile,
                ]);
            }
        }

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil ditambahkan.');
    }

    // public function update(Request $request, string $id)
    // {
    //     $about = About::findOrFail($id);

    //     $rules = [
    //         'kata_sambutan_kepala_desa' => 'required|string',
    //         'media_file' =>  'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
    //         'sejarah' => 'required|string',
    //         'visi' => 'required|string',
    //         'misi' => 'required|string',
    //         'jumlah_penduduk' => 'nullable|integer',
    //         'luas_wilayah' => 'nullable|string|max:255',
    //         'jumlah_perangkat_desa' => 'nullable|integer',
    //     ];

    //     if ($request->hasFile('gambar_1')) {
    //         $rules['gambar_1'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
    //     }
    //     if ($request->hasFile('gambar_2')) {
    //         $rules['gambar_2'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
    //     }

    //     $validateData = $request->validate($rules, [
    //         'kata_sambutan_kepala_desa.required' => 'Kata sambutan kepada desa wajib diisi.',
    //         'media_file.mimes' => 'Format file media tidak didukung. Gunakan gambar (jpeg, png, jpg, gif, svg) atau video (mp4, avi, mov, wmv).',
    //         'media_file.max' =>  'Ukuran file media terlalu besar (Maksimal 50 MB).',
    //         'sejarah.required' => 'Sejarah wajib diisi.',
    //         'visi.required' => 'Visi wajib diisi.',
    //         'misi.required' => 'Misi wajib diisi.',
    //     ]);

    //     // $data = $request->except(['_token', '_method', 'gambar_1', 'gambar_2']);
    //     $data = $validateData;

    //     if($request->hasFile('media_file')){
    //         if($about->media_file) {
    //             $this->deleteFile($about->media_file);
    //         }
    //         $data['media_file'] = $this->uploadFile($request, 'media_file', 'abouts/media');
    //     } elseif ($request->has('remove_media_file')){//* Hapus media utama tanpa mengunggah yang baru
    //         if($about->media_file){
    //             $this->deleteFile($about->media_file);
    //         }
    //         $data['media_file'] = null;
    //     } else {
    //         unset($data['media_file']); //* Jika tidak ada file baru, jangan ubah field ini
    //     }

    //     if ($request->hasFile('gambar_1')) {
    //         $data['gambar_1'] = $this->uploadImage($request, 'gambar_1', 'abouts', $about->gambar_1);
    //     }

    //     if ($request->hasFile('gambar_2')) {
    //         $data['gambar_2'] = $this->uploadImage($request, 'gambar_2', 'abouts', $about->gambar_2);
    //     }

    //     $about->update($data);

    //     return redirect()->route('abouts.index')->with('success', 'Data About berhasil diperbarui!');
    // }
    public function update(Request $request, string $id)
    {
        $about = About::findOrFail($id);

        // Validasi untuk data About utama
        $rulesAbout = [
            'sejarah' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'jumlah_penduduk' => 'nullable|integer',
            'luas_wilayah' => 'nullable|string|max:255',
            'jumlah_perangkat_desa' => 'nullable|integer',
            'kata_sambutan_kepala_desa' => 'required|string',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
        ];

        if ($request->hasFile('gambar_1')) {
            $rulesAbout['gambar_1'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        if ($request->hasFile('gambar_2')) {
            $rulesAbout['gambar_2'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validatedAboutData = $request->validate($rulesAbout, [
            'sejarah.required' => 'Sejarah wajib diisi.',
            'visi.required' => 'Visi wajib diisi.',
            'misi.required' => 'Misi wajib diisi.',
            'kata_sambutan_kepala_desa.required' => 'Kata Sambutan Kepala Desa wajib diisi.',
            'media_file.mimes' => 'Format file media utama tidak didukung. Gunakan gambar (jpeg, png, jpg, gif, svg) atau video (mp4, avi, mov, wmv).',
            'media_file.max' => 'Ukuran file media utama terlalu besar (maksimal 50MB).',
        ]);

        // Validasi untuk bagian tambahan yang sudah ada (existing) dan yang baru (new)
        $rulesAdditionalSections = [
            'existing_sections' => 'nullable|array',
            'existing_sections.*.id' => 'required|integer|exists:about_additional_sections,id', // ID wajib ada dan valid
            'existing_sections.*.title' => 'required|string|max:255',
            'existing_sections.*.content' => 'required|string',
            'existing_sections.*.media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
            'existing_sections.*.remove_media_file' => 'nullable|boolean', // Checkbox untuk menghapus media
            'existing_sections.*._destroy' => 'nullable|boolean', // Untuk menandai section yang dihapus

            'new_sections' => 'nullable|array',
            'new_sections.*.title' => 'required|string|max:255',
            'new_sections.*.content' => 'required|string',
            'new_sections.*.media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:50000',
        ];

        $messagesAdditionalSections = [
            'existing_sections.*.id.required' => 'ID bagian tambahan tidak valid.',
            'existing_sections.*.id.exists' => 'Bagian tambahan tidak ditemukan.',
            'existing_sections.*.title.required' => 'Judul bagian tambahan wajib diisi.',
            'existing_sections.*.content.required' => 'Konten bagian tambahan wajib diisi.',
            'existing_sections.*.media_file.mimes' => 'Format file media bagian tambahan tidak didukung.',
            'existing_sections.*.media_file.max' => 'Ukuran file media bagian tambahan terlalu besar.',

            'new_sections.*.title.required' => 'Judul bagian tambahan baru wajib diisi.',
            'new_sections.*.content.required' => 'Konten bagian tambahan baru wajib diisi.',
            'new_sections.*.media_file.mimes' => 'Format file media bagian tambahan baru tidak didukung.',
            'new_sections.*.media_file.max' => 'Ukuran file media bagian tambahan baru terlalu besar.',
        ];

        // Gabungkan validasi untuk About utama dan sections
        $validatedData = array_merge($validatedAboutData, $request->validate($rulesAdditionalSections, $messagesAdditionalSections));

        // --- Update Data About Utama ---
        $dataToUpdateAbout = $validatedAboutData;

        if ($request->hasFile('gambar_1')) {
            $dataToUpdateAbout['gambar_1'] = $this->uploadFile($request, 'gambar_1', 'abouts/images', $about->gambar_1);
        }
        if ($request->hasFile('gambar_2')) {
            $dataToUpdateAbout['gambar_2'] = $this->uploadFile($request, 'gambar_2', 'abouts/images', $about->gambar_2);
        }
        if ($request->hasFile('media_file')) {
            $dataToUpdateAbout['media_file'] = $this->uploadFile($request, 'media_file', 'abouts/media', $about->media_file);
        } elseif ($request->has('remove_media_file')) {
            $this->deleteFile($about->media_file);
            $dataToUpdateAbout['media_file'] = null;
        } else {
            unset($dataToUpdateAbout['media_file']); // Pertahankan yang lama jika tidak ada perubahan
        }

        $about->update($dataToUpdateAbout);

        // --- Handle Existing Additional Sections ---
        $existingSectionIds = [];
        if (isset($validatedData['existing_sections'])) {
            foreach ($validatedData['existing_sections'] as $index => $sectionData) {
                // Cari section berdasarkan ID
                $section = AboutAdditionalSection::find($sectionData['id']);

                if (!$section) { // Jika section tidak ditemukan (misal: sudah dihapus di tab lain)
                    continue;
                }

                $existingSectionIds[] = $section->id; // Kumpulkan ID yang masih ada

                // Cek apakah section ditandai untuk dihapus
                if (isset($sectionData['_destroy']) && $sectionData['_destroy'] == '1') {
                    if ($section->media_file) {
                        $this->deleteFile($section->media_file);
                    }
                    $section->delete();
                    continue; // Lanjutkan ke section berikutnya
                }

                // Siapkan data untuk update
                $dataToUpdateSection = [
                    'title' => $sectionData['title'],
                    'content' => $sectionData['content'],
                ];

                // Handle media file untuk existing section
                $fileInputName = 'existing_sections.' . $index . '.media_file';
                if ($request->hasFile($fileInputName)) {
                    $dataToUpdateSection['media_file'] = $this->uploadFileFromRequest($request, $fileInputName, 'abouts/additional_sections', $section->media_file);
                } elseif (isset($sectionData['remove_media_file']) && $sectionData['remove_media_file'] == '1') {
                    if ($section->media_file) {
                        $this->deleteFile($section->media_file);
                    }
                    $dataToUpdateSection['media_file'] = null;
                } else {
                    // Jika tidak ada file baru dan tidak ada perintah hapus, pertahankan yang lama
                    // Jika field tidak dikirim, artinya tidak ada perubahan pada file, jadi tidak perlu diupdate
                    // atau bisa juga ambil dari current $section->media_file
                    // $dataToUpdateSection['media_file'] = $section->media_file; // Opsional: jika ingin eksplisit
                }

                $section->update($dataToUpdateSection);
            }
        }

        // --- Handle New Additional Sections ---
        if (isset($validatedData['new_sections'])) {
            foreach ($validatedData['new_sections'] as $index => $sectionData) {
                $sectionMediaFile = null;
                $fileInputName = 'new_sections.' . $index . '.media_file'; // Nama input file di form

                if ($request->hasFile($fileInputName)) {
                    $sectionMediaFile = $this->uploadFileFromRequest($request, $fileInputName, 'abouts/additional_sections');
                }

                $about->additionalSections()->create([
                    'title' => $sectionData['title'],
                    'content' => $sectionData['content'],
                    'media_file' => $sectionMediaFile,
                ]);
            }
        }

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $about = About::findOrFail($id);

        $this->deleteImage($about->gambar_1);
        $this->deleteImage($about->gambar_2);
        $this->deleteFile($about->media_file);

        $about->delete();

        return redirect()->route('abouts.index')->with('success', 'Data About berhasil dihapus!');
    }

    /**
     * Helper function untuk mengunggah gambar.
     *
     * @param Request $request Instance Request
     * @param string $fieldName Nama field input file
     * @param string $directory Direktori penyimpanan di 'public' disk
     * @param string|null $existingPath Path gambar yang sudah ada (untuk kasus update, guna dihapus)
     * @return string|null Path gambar yang diunggah atau null jika gagal/tidak ada file
     */
    private function uploadImage(Request $request, string $fieldName, string $directory, ?string $existingPath = null): ?string
    {
        if ($request->hasFile($fieldName)) {
            if ($existingPath) {
                $this->deleteImage($existingPath);
            }

            $file = $request->file($fieldName);
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', str_replace(' ', '_', $file->getClientOriginalName()));
            $path = $file->storeAs($directory, $filename, 'public');
            return $path;
        }
        return null;
    }

    private function uploadFileFromRequest(Request $request, string $inputName, string $directory, ?string $existingPath = null): ?string
    {
        if ($request->file($inputName)) { // Menggunakan file($inputName) daripada hasFile() untuk input array
            if ($existingPath && Storage::disk('public')->exists($existingPath)) {
                Storage::disk('public')->delete($existingPath);
            }

            $file = $request->file($inputName);
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', Str::replace(' ', '_', $file->getClientOriginalName()));
            $path = $file->storeAs($directory, $filename, 'public');
            return $path;
        }
        return null;
    }

    // private function uploadFile(Request $request, string $fieldName, string $directory, ?string $existingPath = null): ?string
    // {
    //     if ($request->hasFile($fieldName)) {
    //         if ($existingPath) {
    //             $this->deleteFile($existingPath);
    //         }

    //         $file = $request->file($fieldName);
    //         $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '', Str::replace(' ', '_', $file->getClientOriginalName()));
    //         $path = $file->storeAs($directory, $filename, 'public');
    //         return $path;
    //     }
    //     return null;
    // }

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
     * Helper function untuk menghapus gambar.
     *
     * @param string|null $path Path gambar yang akan dihapus dari 'public' disk
     */
    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
