<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiDesa; // Mengimpor model InformasiDesa
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; // Mengimpor Storage untuk mengelola file

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

    public function index_pengumuman()
    {
        $pengumuman = InformasiDesa::where('kategori_informasi', 'Pengumuman')->get();
        return view('dashboard.sekretaris.page.Informasi.informasi_pengumuman', compact('pengumuman')); //compact('pengumuman')); // mengarah ke @foreach ($pengumuman as $item)
    }

    public function index_berita()
    {
        $berita = InformasiDesa::where('kategori_informasi', 'Berita')->get();
        return view('dashboard.sekretaris.page.Informasi.index_informasi', compact('berita')); //compact('berita')); mengarah ke  @foreach ($berita as $item)
    }

    public function index_berita_masyarakat()
    {
        $berita_masyarakat = InformasiDesa::where('kategori_informasi', 'berita')->get();
        return view('dashboard.masyarakat.page.Informasi.index_informasi', compact('berita_masyarakat'));
    }

    public function index_pengumuman_masyarakat()
    {
        $pengumuman_masyarakat = InformasiDesa::where('kategori_informasi', 'Pengumuman')->get();
        return view('dashboard.masyarakat.page.Informasi.informasi_pengumuman', compact('pengumuman_masyarakat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_informasi'      => 'required|string|max:255',
            'deskripsi_informasi'  => 'required|string',
            'kategori_informasi'   => 'required|string|max:255',
            'lampiran_informasi'   => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'status_informasi'     => 'required|boolean',
        ]);

        //    Simpan File
        // $file = $request->file('lampiran_informasi');
        // $path = $file->store('informasi', 'public');

        // open simpan file
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

        // Jika Word, konversi ke PDF
        if (in_array($extension, ['doc', 'docx'])) {
            $fullInputPath = storage_path("app/public/" . $filePath);
                // $command = "soffice --headless --convert-to pdf --outdir \"$storagePath\" \"$fullInputPath\"";
                // exec($command);
                //perubahan
                $command = "\"C:\\Program Files\\LibreOffice\\program\\soffice.exe\" --headless --convert-to pdf --outdir \"$storagePath\" \"$fullInputPath\"";
                exec($command, $output, $return_var);
                // dd($command, $output, $return_var);
                //dd('sampai sini');


                // Ubah nama file yang disimpan di database menjadi versi PDF
                $filePath = 'informasi/' . $filename . '.pdf';
        }
        //close simpan file

        // simpan ke database
        InformasiDesa::create([
            'judul_informasi'      => $validated['judul_informasi'],
            'deskripsi_informasi'  => $validated['deskripsi_informasi'],
            'kategori_informasi'   => $validated['kategori_informasi'],
            'lampiran_informasi'   => $filePath,
            'status_informasi'     => $validated['status_informasi']
        ]);

        //berdasarkan kategori
        if($validated['kategori_informasi'] === 'Berita') {
            return Redirect()->route('informasi.berita')->with('success', 'Data informasi berhasil ditambahkan!');
        } elseif($validated['kategori_informasi'] === 'Pengumuman') {
            return Redirect()->route('informasi.pengumuman')->with('success', 'Data informasi berhasil ditambahkan!');
        }

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
            'kategori_informasi'   => 'required|string|max:255',
            'lampiran_informasi'   => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'status_informasi'     => 'required|boolean'
        ]);

        $dataUpdate = [
            'judul_informasi'      => $request->judul_informasi,
            'deskripsi_informasi'  => $request->deskripsi_informasi,
            'kategori_informasi'   => $request->kategori_informasi,
            'status_informasi'     => $request->status_informasi
        ];

        if($request->hasFile('lampiran_informasi')){
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
                //ubah path agar jadi format windows
                $fullInputPath = str_replace( '/', '\\', storage_path("app/public/" . $filePath));
                $storagePath = str_replace( '/', '\\', storage_path("app/public/informasi"));
                // ==$command = "soffice --headless --convert-to pdf --outdir \"$storagePath\" \"$fullInputPath\"";
                // exec($command);
                //perubahan

                //Jeda sejanak untuk memastikan filenya
                sleep(1);

                $command = "\"C:\\Program Files\\LibreOffice\\program\\soffice.exe\" --headless --convert-to pdf --outdir \"$storagePath\" \"$fullInputPath\"";
                exec($command, $output, $return_var);

                $convertedFiles = scandir($storagePath);
                $foundPdf = null;
                foreach($convertedFiles as $f){
                    if(str_contains($f, $filename) && str_ends_with($f, '.pdf')){
                        $foundPdf = $f;
                        break;
                    }
                }

                if(!$foundPdf){
                    dd("PDF tidak ditemukan", $convertedFiles, $command, $output, $return_var);
                }

                //simpan file yan benar
                $filePath = 'informasi/' . $foundPdf;

                // $pdfPath = $storagePath . '\\' . $filename . '.pdf';
                // if (!file_exists($pdfPath)) {
                //     dd("PDF gagal dibuat", $pdfPath, $output, $return_var);
                // }


                //dd($command, $output, $return_var);// karena ini update, maka pakai ini untuk mengatasi bentrok dengan file lama yang ada
                //dd('sampai sini');


                // Ubah nama file yang disimpan di database menjadi versi PDF
                // $filePath = 'informasi/' . $filename . '.pdf';
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
        if ($validated['kategori_informasi'] === 'Berita') {
            return Redirect()->route('informasi.berita')->with('success', 'Data informasi berhasil diubah!');
        } elseif ($validated['kategori_informasi'] === 'Pengumuman') {
            return Redirect()->route('informasi.pengumuman')->with('success', 'Data informasi berhasil diubah!');
        }

        return redirect()->back()->with('success', 'Data informasi berhasil diperbaharui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $informasi = InformasiDesa::findOrFail($id);
        Storage::disk('public')->delete($informasi->lampiran_informasi);

        //simpan jenis kategori sebelum dihapus
        $kategori = $informasi->kategori_informasi;

        // Hapus data dari database
        $informasi->delete();

        // return redirect()->route('informasi.berita')->with('success', 'Data berhasil di hapus');
        if($kategori === 'Berita'){
            return redirect()->route('informasi.berita')->with('success', 'Data berhasil di hapus');
        }elseif($kategori === 'Pengumuman'){
            return redirect()->route('informasi.pengumuman')->with('success', "Data berhasil di hapus");
        }else{//jika kategori tidak di kenali, maka akan dibuat secara default aja
            return redirect()->back()->with('success', 'Data berhasil di hapus');
        }
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
