<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiDesa; // Mengimpor model InformasiDesa
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; // Mengimpor Storage untuk mengelola file
use Illuminate\Support\Facades\Auth;

class InformasiDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $informasi = InformasiDesa::all(); // Mengambil semua data dari model InformasiDesa
    //     return view('dashboard.sekretaris.page.Informasi.index_informasi', compact('informasi')); // Mengirim data ke view
    // }

    // public function index_pengumuman()
    // {
    //     $pengumuman = InformasiDesa::where('kategori_informasi', 'Pengumuman')->get();
    //     return view('dashboard.sekretaris.page.Informasi.informasi_pengumuman', compact('pengumuman')); //compact('pengumuman')); // mengarah ke @foreach ($pengumuman as $item)
    // }

    // public function index_pengumuman_pengguna()
    // {
    //     $pengumuman_pengguna = InformasiDesa::where('kategori_informasi', 'Pengumuman')->get();
    //     return view('pengguna.page.Informasi.informasi_pengumuman', compact('pengumuman_pengguna')); //compact('pengumuman_pengguna')); // mengarah ke @foreach ($pengumuman as $item)
    // }

    public function index_berita()
    {
        // $berita = InformasiDesa::where('kategori_informasi', 'Berita')->get();
        $berita = InformasiDesa::get();
        return view('dashboard.sekretaris.page.Informasi.index_informasi', compact('berita')); //compact('berita')); mengarah ke  @foreach ($berita as $item)
    }

    public function index_berita_masyarakat()
    {
        $berita_masyarakat = InformasiDesa::where('status_informasi', 'publish')
            // ->where('status_informasi', 'publish') // Pastikan hanya yang publish yang tampil
            ->orderBy('created_at', 'desc')       // Urutkan dari yang terbaru
            ->paginate(9); // Ganti get() menjadi paginate(). Angka 9 berarti 9 berita per halaman.

        return view('dashboard.masyarakat.page.Informasi.index_informasi', compact('berita_masyarakat'));
    }

    public function index_berita_pengguna()
    {
        $berita_pengguna = InformasiDesa::where('kategori_informasi', 'berita')
            ->where('status_informasi', 'publish') // Hanya tampilkan berita yang sudah di-publish
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->get();
        return view('pengguna.page.Informasi.index_informasi_berita_pengguna', compact('berita_pengguna')); // <-- PASTIKAN NAMA VIEW INI (akan dibuat di langkah 3)
    }

    public function showBerita(string $id_informasi)
    {
        $berita = InformasiDesa::where('id_informasi', $id_informasi)
            // ->where('kategori_informasi', 'berita')
            ->where('status_informasi', 'publish') // Pastikan hanya berita publish yang bisa dilihat detailnya
            ->firstOrFail(); // Akan otomatis 404 jika tidak ditemukan

        return view('dashboard.masyarakat.page.Informasi.detail_berita', compact('berita'));
    }

    // public function index_pengumuman_masyarakat()
    // {
    //     $pengumuman_masyarakat = InformasiDesa::where('kategori_informasi', 'Pengumuman')->get();
    //     return view('dashboard.masyarakat.page.Informasi.informasi_pengumuman', compact('pengumuman_masyarakat'));
    // }


    public function store(Request $request)
    {
        // Langkah 1: Validasi (Ini sudah benar dari kode Anda)
        $validated = $request->validate([
            'judul_informasi'     => 'required|string|max:255',
            'deskripsi_informasi' => 'required|string',
            // 'kategori_informasi'  => 'required|string|in:Berita,Pengumuman',
            'lampiran_informasi'  => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'status_informasi'    => 'required|string|in:draft,publish',
        ]);

        // Langkah 2 (PENTING): Siapkan data awal dan tambahkan user_id
        $dataToCreate = $validated;
        $dataToCreate['user_id'] = Auth::id(); // <-- INI ADALAH PERBAIKAN UTAMA

        // Langkah 3: Gunakan kembali LOGIKA FILE ANDA untuk memproses lampiran
        $filePath = null; // Nilai default jika tidak ada file
        if ($request->hasFile('lampiran_informasi')) {
            $file = $request->file('lampiran_informasi');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $filename = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME);
            $storagePath = storage_path('app/public/informasi');

            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0777, true);
            }

            // Simpan file asli
            $filePath = $file->storeAs('informasi', $filename . '.' . $extension, 'public');

            // Logika konversi Word ke PDF Anda
            if (in_array($extension, ['doc', 'docx'])) {
                $fullInputPath = storage_path("app/public/" . $filePath);
                $command = "\"C:\\Program Files\\LibreOffice\\program\\soffice.exe\" --headless --convert-to pdf --outdir \"$storagePath\" \"$fullInputPath\"";
                exec($command, $output, $return_var);

                if ($return_var === 0 && file_exists($storagePath . '/' . $filename . '.pdf')) {
                    // Jika konversi berhasil, update path file menjadi path PDF
                    $filePath = 'informasi/' . $filename . '.pdf';
                    // Opsional: Hapus file Word asli
                    // \Illuminate\Support\Facades\Storage::disk('public')->delete('informasi/' . $filename . '.' . $extension);
                }
            }
        }

        // Langkah 4: Masukkan path file final ke dalam data yang akan disimpan
        $dataToCreate['lampiran_informasi'] = $filePath;

        // Langkah 5: Simpan semua data ke database
        InformasiDesa::create($dataToCreate);

        // Langkah 6: Redirect (Ini sudah benar dari kode Anda)
        // if ($validated['kategori_informasi'] === 'Berita') {
        //     return redirect()->route('informasi.berita')->with('success', 'Data berita berhasil ditambahkan!');
        // } elseif ($validated['kategori_informasi'] === 'Pengumuman') {
        //     return redirect()->route('informasi.pengumuman')->with('success', 'Data pengumuman berhasil ditambahkan!');
        // }

        return redirect()->back()->with('success', 'Data informasi berhasil ditambahkan!');
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
            // 'kategori_informasi'   => 'required|string|max:255',
            'lampiran_informasi'   => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'status_informasi'     => 'required|string|in:draft,publish'
        ]);

        $dataUpdate = [
            'judul_informasi'      => $request->judul_informasi,
            'deskripsi_informasi'  => $request->deskripsi_informasi,
            // 'kategori_informasi'   => $request->kategori_informasi,
            'status_informasi'     => $request->status_informasi
        ];

        if ($request->hasFile('lampiran_informasi')) {
            //Upload Gambar Baru
            // $path = $request->file('lampiran_informasi')->store('informasi', 'public');
            // $dataUpdate['lampiran_informasi'] = $path;

            //$informasi->update($dataUpdate);

            // open simpan file
            $file = $request->file('lampiran_informasi');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME);
            $storagePath = storage_path('app/public/informasi');

            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0777, true);
            }

            // Simpan file baru
            $filePath = $file->storeAs('informasi', $filename . '.' . $extension, 'public');

            // Jika Word, konversi ke PDF
            if (in_array($extension, ['doc', 'docx'])) {
                $fullInputPath = storage_path("app/public/" . $filePath);
                $command = "\"C:\\Program Files\\LibreOffice\\program\\soffice.exe\" --headless --convert-to pdf --outdir \"$storagePath\" \"$fullInputPath\"";
                exec($command, $output, $return_var);

                // Cek apakah konversi berhasil dan file PDF benar-benar ada
                // Ini adalah bagian dari logika yang lebih robust yang Anda punya di update(),
                // sebaiknya terapkan juga di store() untuk konsistensi dan keandalan.
                $convertedFiles = scandir($storagePath);
                $foundPdf = null;
                foreach ($convertedFiles as $f) {
                    if (str_contains($f, $filename) && str_ends_with($f, '.pdf')) {
                        $foundPdf = $f;
                        break;
                    }
                }

                if (!$foundPdf) {
                    // Handle jika PDF tidak ditemukan setelah konversi (misal: log error, atau tetap gunakan file asli)
                    // dd("PDF tidak ditemukan setelah konversi di store", $convertedFiles, $command, $output, $return_var);
                    // Untuk saat ini, kita bisa memilih untuk membiarkan $filePath tetap sebagai file aslinya jika konversi gagal.
                } else {
                    // Ubah nama file yang disimpan di database menjadi versi PDF yang ditemukan
                    $filePath = 'informasi/' . $foundPdf;
                }
            }
            //close simpan file

            //Hapus Gambar Lama
            if ($informasi->lampiran_informasi) {
                Storage::disk('public')->delete($informasi->lampiran_informasi);
            }

            $dataUpdate['lampiran_informasi'] = $filePath;
        }

        $informasi->update($dataUpdate);

        // return redirect()->route('sekretaris.informasi.index')->with('success', 'Data informasi berhasil diperbarui!');
        // if ($validated['kategori_informasi'] === 'Berita') {
        //     return Redirect()->route('informasi.berita')->with('success', 'Data informasi berhasil diubah!');
        // } elseif ($validated['kategori_informasi'] === 'Pengumuman') {
        //     return Redirect()->route('informasi.pengumuman')->with('success', 'Data informasi berhasil diubah!');
        // }

        // return redirect()->back()->with('success', 'Data informasi berhasil diperbaharui');
        return Redirect()->route('informasi.berita')->with('success', 'Data informasi berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $informasi = InformasiDesa::findOrFail($id);
        // Storage::disk('public')->delete($informasi->lampiran_informasi);
        if ($informasi->lampiran_informasi) {
            Storage::disk('public')->delete($informasi->lampiran_informasi);
        }

        //simpan jenis kategori sebelum dihapus
        $kategori = $informasi->kategori_informasi;

        // Hapus data dari database
        $informasi->delete();

        // return redirect()->route('informasi.berita')->with('success', 'Data berhasil di hapus');
        // if ($kategori === 'Berita') {
        //     return redirect()->route('informasi.berita')->with('success', 'Data berhasil di hapus');
        // } elseif ($kategori === 'Pengumuman') {
        //     return redirect()->route('informasi.pengumuman')->with('success', "Data berhasil di hapus");
        // } else { //jika kategori tidak di kenali, maka akan dibuat secara default aja
        //     return redirect()->back()->with('success', 'Data berhasil di hapus');
        // }
        return redirect()->route('informasi.berita')->with('success', 'Data berhasil di hapus');
    }

    public function convertToPdf($filename)
    {
        $inputPath = storage_path("app/public/dokumen/{$filename}");
        $outputDir = storage_path("app/public/dokumen");

        $command = "soffice --headless --convert-to pdf \"$inputPath\" --outdir \"$outputDir\"";
        exec($command, $output, $return_var);

        if ($return_var === 0) {
            return response()->json(['message' => 'Berhasil convert ke PDF.']);
        } else {
            return response()->json(['message' => 'Gagal convert.'], 500);
        }
    }
}


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\InformasiDesa;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini untuk menggunakan Auth Facade

// class InformasiDesaController extends Controller
// {
//     // ... (index methods dan method lainnya tetap sama) ...

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'judul_informasi'     => 'required|string|max:255',
//             'deskripsi_informasi' => 'required|string',
//             'kategori_informasi'  => 'required|string|in:berita,pengumuman', // Lebih baik gunakan 'in' untuk enum
//             'lampiran_informasi'  => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
//             // 'status_informasi'    => 'required|boolean', // Kolom Anda adalah enum('draft','publish')
//             'status_informasi'    => 'required|string|in:draft,publish', // Validasi untuk enum
//         ]);

//         // Logika penyimpanan file (tetap sama, namun perhatikan perbaikan kecil di bawah)
//         $filePath = null; // Inisialisasi filePath
//         if ($request->hasFile('lampiran_informasi')) {
//             $file = $request->file('lampiran_informasi');
//             $originalName = $file->getClientOriginalName();
//             $extension = $file->getClientOriginalExtension();
//             // Sanitasi nama file untuk keamanan dan menghindari karakter aneh
//             $safeFilename = preg_replace('/[^A-Za-z0-9_.-]+/', '_', pathinfo($originalName, PATHINFO_FILENAME));
//             if(empty($safeFilename)) $safeFilename = 'file'; // fallback jika nama asli tidak aman
//             $filename = time() . '_' . $safeFilename;
//             $storagePath = storage_path('app/public/informasi');

//             if (!file_exists($storagePath)) {
//                 mkdir($storagePath, 0777, true);
//             }

//             $filePath = $file->storeAs('informasi', $filename . '.' . $extension, 'public');

//             // Konversi ke PDF jika file Word
//             if (in_array(strtolower($extension), ['doc', 'docx'])) {
//                 $fullInputPath = storage_path("app/public/" . $filePath);
//                 // Gunakan DIRECTORY_SEPARATOR untuk path yang lebih portabel
//                 $escapedStoragePath = escapeshellarg(str_replace('/', DIRECTORY_SEPARATOR, $storagePath));
//                 $escapedFullInputPath = escapeshellarg(str_replace('/', DIRECTORY_SEPARATOR, $fullInputPath));

//                 // Pastikan path ke soffice benar dan dapat dieksekusi
//                 $libreOfficePath = "C:\\Program Files\\LibreOffice\\program\\soffice.exe"; // Sesuaikan jika perlu

//                 $command = "\"{$libreOfficePath}\" --headless --convert-to pdf --outdir {$escapedStoragePath} {$escapedFullInputPath}";
//                 exec($command, $output, $return_var);

//                 if ($return_var === 0) {
//                     $expectedPdfPath = $storagePath . DIRECTORY_SEPARATOR . $filename . '.pdf';
//                     if (file_exists($expectedPdfPath)) {
//                         // Hapus file .doc/.docx asli jika konversi berhasil (opsional)
//                         // Storage::disk('public')->delete($filePath);
//                         $filePath = 'informasi/' . $filename . '.pdf';
//                     } else {
//                         // Log atau tangani kasus PDF tidak ditemukan meskipun return_var 0
//                         // Mungkin biarkan $filePath sebagai file asli jika konversi gagal
//                     }
//                 } else {
//                     // Log atau tangani kegagalan konversi
//                     // dd('Konversi Gagal:', $command, $output, $return_var); // Untuk debug
//                     // Biarkan $filePath sebagai file asli jika konversi gagal
//                 }
//             }
//         }
//         // close simpan file

//         // simpan ke database
//         InformasiDesa::create([
//             'user_id'             => Auth::id(), // <-- Ambil ID pengguna yang sedang login
//             'judul_informasi'     => $validated['judul_informasi'],
//             'deskripsi_informasi' => $validated['deskripsi_informasi'],
//             'kategori_informasi'  => $validated['kategori_informasi'],
//             'lampiran_informasi'  => $filePath,
//             // 'status_informasi'    => $validated['status_informasi'] // Jika boolean dari form
//             'status_informasi'    => $request->input('status_informasi') // Ambil nilai string 'draft' atau 'publish'
//         ]);

//         //berdasarkan kategori
//         if($validated['kategori_informasi'] === 'Berita') {
//             return Redirect::route('informasi.berita')->with('success', 'Data informasi berhasil ditambahkan!');
//         } elseif($validated['kategori_informasi'] === 'Pengumuman') {
//             return Redirect::route('informasi.pengumuman')->with('success', 'Data informasi berhasil ditambahkan!');
//         }

//         return redirect()->back()->with('success', 'Data informasi berhasil ditambahkan!');
//     }

//     // ... (show, edit methods) ...

//     public function update(Request $request, string $id)
//     {
//         $informasi = InformasiDesa::findOrFail($id);

//         $validated = $request->validate([
//             'judul_informasi'     => 'required|string|max:255',
//             'deskripsi_informasi' => 'required|string',
//             'kategori_informasi'  => 'required|string|in:berita,pengumuman',
//             'lampiran_informasi'  => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
//             // 'status_informasi'    => 'required|boolean',
//             'status_informasi'    => 'required|string|in:draft,publish',
//         ]);

//         $dataUpdate = [
//             'judul_informasi'     => $request->judul_informasi,
//             'deskripsi_informasi' => $request->deskripsi_informasi,
//             'kategori_informasi'  => $request->kategori_informasi,
//             // 'status_informasi'    => $request->status_informasi, // Jika boolean
//             'status_informasi'    => $request->input('status_informasi'), // Jika string 'draft' atau 'publish'
//             // user_id biasanya tidak diubah saat update, kecuali ada kebutuhan khusus.
//             // Jika user yang membuat informasi bisa diubah, Anda bisa menambahkan:
//             // 'user_id' => Auth::id(), // atau ID user lain jika ada logika pemilihan
//         ];

//         if($request->hasFile('lampiran_informasi')){
//             // Logika upload dan konversi file (serupa dengan method store)
//             $file = $request->file('lampiran_informasi');
//             $originalName = $file->getClientOriginalName();
//             $extension = $file->getClientOriginalExtension();
//             $safeFilename = preg_replace('/[^A-Za-z0-9_.-]+/', '_', pathinfo($originalName, PATHINFO_FILENAME));
//             if(empty($safeFilename)) $safeFilename = 'file';
//             $filename = time() . '_' . $safeFilename;
//             // $storagePath = storage_path('app/public/informasi'); // Sudah dideklarasikan di atas, pastikan scope-nya benar jika dipindah
//             $storagePath = storage_path('app/public/informasi'); // Deklarasi ulang untuk kejelasan dalam blok ini

//             if (!file_exists($storagePath)) {
//                 mkdir($storagePath, 0777, true);
//             }

//             $newFilePath = $file->storeAs('informasi', $filename . '.' . $extension, 'public');

//             if (in_array(strtolower($extension), ['doc', 'docx'])) {
//                 $fullInputPath = storage_path("app/public/" . $newFilePath);
//                 // Path untuk LibreOffice dan direktori output
//                 $escapedStoragePath = escapeshellarg(str_replace('/', DIRECTORY_SEPARATOR, $storagePath));
//                 $escapedFullInputPath = escapeshellarg(str_replace('/', DIRECTORY_SEPARATOR, $fullInputPath));
//                 $libreOfficePath = "C:\\Program Files\\LibreOffice\\program\\soffice.exe";

//                 // Jeda sebelum konversi (Anda punya ini sebelumnya, pertimbangkan apakah masih perlu)
//                 sleep(1);

//                 $command = "\"{$libreOfficePath}\" --headless --convert-to pdf --outdir {$escapedStoragePath} {$escapedFullInputPath}";
//                 exec($command, $output, $return_var);

//                 // Anda memiliki logika pencarian file PDF yang lebih kompleks sebelumnya,
//                 // yang mungkin diperlukan jika nama file output dari LibreOffice tidak selalu sama persis dengan $filename . '.pdf'
//                 // Untuk penyederhanaan, saya akan asumsikan nama outputnya konsisten.
//                 if ($return_var === 0) {
//                     $expectedPdfPath = $storagePath . DIRECTORY_SEPARATOR . $filename . '.pdf';
//                     if(file_exists($expectedPdfPath)) {
//                          // Hapus file .doc/.docx asli jika konversi berhasil (opsional)
//                         // Storage::disk('public')->delete($newFilePath); // Hapus file .doc/.docx yang baru diupload
//                         $newFilePath = 'informasi/' . $filename . '.pdf';
//                     } else {
//                         // Log: PDF tidak ditemukan setelah konversi sukses
//                         // dd("PDF tidak ditemukan setelah konversi", $expectedPdfPath, $command, $output, $return_var);
//                     }
//                 } else {
//                     // Log: Konversi PDF gagal
//                     // dd("Konversi PDF gagal", $command, $output, $return_var);
//                 }
//             }

//             // Hapus lampiran lama jika ada dan file baru berhasil diunggah/dikonversi
//             if ($informasi->lampiran_informasi) {
//                 Storage::disk('public')->delete($informasi->lampiran_informasi);
//             }
//             $dataUpdate['lampiran_informasi'] = $newFilePath;
//         }

//         $informasi->update($dataUpdate);

//         if ($validated['kategori_informasi'] === 'Berita') {
//             return Redirect::route('informasi.berita')->with('success', 'Data informasi berhasil diubah!');
//         } elseif ($validated['kategori_informasi'] === 'Pengumuman') {
//             return Redirect::route('informasi.pengumuman')->with('success', 'Data informasi berhasil diubah!');
//         }

//         return redirect()->back()->with('success', 'Data informasi berhasil diperbaharui');
//     }

//     // ... (destroy dan convertToPdf methods) ...
// }
