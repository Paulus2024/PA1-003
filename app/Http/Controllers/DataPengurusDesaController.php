<?php

// namespace App\Http\Controllers;

// use App\Models\DataPengurusDesa;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Http\Request;

// class DataPengurusDesaController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $data_pengurus_desas/*1*/ = DataPengurusDesa::all();//nama variabel bebas = Nama Model::all();
//         return view('dashboard.sekretaris.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
//     }

//     public function index_Bumdes()
//     {
//         $data_pengurus_desas = DataPengurusDesa::all(); // Ambil semua
//         return view('dashboard.bumdes.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
//     }

//         public function index_masyarakat()
//     {
//         $data_pengurus_desas = DataPengurusDesa::all(); // Ambil semua
//         return view('dashboard.masyarakat.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
//     }

//         public function index_pengguna()
//     {
//         $data_pengurus_desas = DataPengurusDesa::all(); // Ambil semua
//         return view('pengguna.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
//     }





//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
// {
//     $request->validate([
//         'nama_data_pengurus_desa' => 'required|string|max:255',
//         'jabatan_data_pengurus_desa' => 'required|string|max:255',
//         'deskripsi_data_pengurus_desa' => 'required|string',
//         'gambar_data_pengurus_desa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//     ]);

//     $imagePath = null;
//     if ($request->hasFile('gambar_data_pengurus_desa')) {
//         $imagePath = $request->file('gambar_data_pengurus_desa')->store('pengurus_images', 'public');
//     }

//     DataPengurusDesa::create([
//         'nama_data_pengurus_desa' => $request->nama_data_pengurus_desa,
//         'jabatan_data_pengurus_desa' => $request->jabatan_data_pengurus_desa,
//         'deskripsi_data_pengurus_desa' => $request->deskripsi_data_pengurus_desa,
//         'gambar_data_pengurus_desa' => $imagePath,
//     ]);

//     return redirect()->route('data_pengurus_desa.index')->with('success', 'Data pengurus berhasil ditambahkan.');
// }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         $data_pengurus_desas = DataPengurusDesa::findOrFail($id);
//         return view('data_pengurus_desa.edit', compact('data_pengurus_desas'));
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         $data_pengurus_desas = DataPengurusDesa::findOrFail($id);
//             $request->validate([
//                 'nama_data_pengurus_desa' => 'required|string|max:255',
//                 'jabatan_data_pengurus_desa' => 'required|string|max:255',
//                 'deskripsi_data_pengurus_desa' => 'required|string|max:255',
//                 'gambar_data_pengurus_desa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//             ]);




//             $data = [
//                 'nama_data_pengurus_desa' => $request->input('nama_data_pengurus_desa'),
//                 'jabatan_data_pengurus_desa' => $request->input('jabatan_data_pengurus_desa'),
//                 'deskripsi_data_pengurus_desa' => $request->input('deskripsi_data_pengurus_desa'),
//             ];

//             // Update gambar hanya jika ada file baru
//             if ($request->hasFile('gambar_data_pengurus_desa')) {
//                 if ($data_pengurus_desas->gambar_data_pengurus_desa) {
//                     Storage::disk('public')->delete($data_pengurus_desas->gambar_data_pengurus_desa);
//                 }

//                 $path = $request->file('gambar_data_pengurus_desa')->store('pengurus', 'public');
//                 $data['gambar_data_pengurus_desa'] = $path;
//             }

//         $data_pengurus_desas->update($data);

//         return redirect()->route('data_pengurus_desa.index')->with('success', 'Data Pengurus Desa Berhasil Diperbarui!');
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         $data_pengurus_desas = DataPengurusDesa::findOrFail($id);
//         Storage::disk('public')->delete($data_pengurus_desas->gambar_data_pengurus_desa);
//         $data_pengurus_desas->delete();

//         return redirect()->route('data_pengurus_desa.index')->with('success', 'Data Pengurus Desa Berhasil Dihapus!');
//     }
// }

namespace App\Http\Controllers;

use App\Models\DataPengurusDesa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan impor Auth facade

class DataPengurusDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pertimbangkan untuk hanya menampilkan data yang dibuat oleh user tertentu jika perlu,
        // atau filter berdasarkan role. Untuk saat ini, mengambil semua.
        $data_pengurus_desas = DataPengurusDesa::all();
        return view('dashboard.sekretaris.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
    }

    public function index_Bumdes()
    {
        $data_pengurus_desas = DataPengurusDesa::all();
        return view('dashboard.bumdes.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
    }

    public function index_masyarakat()
    {
        $data_pengurus_desas = DataPengurusDesa::all();
        return view('dashboard.masyarakat.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
    }

    public function index_pengguna()
    {
        $data_pengurus_desas = DataPengurusDesa::all();
        return view('pengguna.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Biasanya di sini Anda akan menampilkan view untuk form create
        // return view('dashboard.sekretaris.page.Data_Pengurus_Desa.create_data_pengurus_desa');
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
            $file = $request->file('gambar_data_pengurus_desa');
            // Buat nama file unik untuk menghindari konflik dan sanitasi nama
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $imagePath = $file->storeAs('pengurus_images', $filename, 'public');
        }

        DataPengurusDesa::create([
            'user_id' => Auth::id(), // <-- Tambahkan ID pengguna yang sedang login
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
        // $data_pengurus_desa = DataPengurusDesa::findOrFail($id);
        // return view('path.to.show.view', compact('data_pengurus_desa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data_pengurus_desa = DataPengurusDesa::findOrFail($id); // Ubah variabel agar konsisten
        // Sebaiknya ada pemeriksaan apakah pengguna yang login berhak mengedit data ini
        // if ($data_pengurus_desa->user_id !== Auth::id() && !Auth::user()->isAdminRole()) { // Contoh otorisasi
        //     abort(403, 'Akses ditolak.');
        // }
        // Pastikan path view 'data_pengurus_desa.edit' benar
        return view('dashboard.sekretaris.page.Data_Pengurus_Desa.edit_data_pengurus_desa', compact('data_pengurus_desa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data_pengurus_desa = DataPengurusDesa::findOrFail($id); // Ubah nama variabel
        // Sebaiknya ada pemeriksaan otorisasi di sini juga

        $request->validate([
            'nama_data_pengurus_desa' => 'required|string|max:255',
            'jabatan_data_pengurus_desa' => 'required|string|max:255',
            'deskripsi_data_pengurus_desa' => 'required|string', // Max 255 dihilangkan karena deskripsi bisa panjang
            'gambar_data_pengurus_desa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // SVG ditambahkan
        ]);

        $data = [
            // user_id biasanya tidak diubah saat update, kecuali oleh admin dengan logika khusus
            'nama_data_pengurus_desa' => $request->input('nama_data_pengurus_desa'),
            'jabatan_data_pengurus_desa' => $request->input('jabatan_data_pengurus_desa'),
            'deskripsi_data_pengurus_desa' => $request->input('deskripsi_data_pengurus_desa'),
        ];

        if ($request->hasFile('gambar_data_pengurus_desa')) {
            // Hapus gambar lama jika ada
            if ($data_pengurus_desa->gambar_data_pengurus_desa && Storage::disk('public')->exists($data_pengurus_desa->gambar_data_pengurus_desa)) {
                Storage::disk('public')->delete($data_pengurus_desa->gambar_data_pengurus_desa);
            }
            // Simpan gambar baru
            $file = $request->file('gambar_data_pengurus_desa');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('pengurus_images', $filename, 'public'); // Konsistenkan direktori ke 'pengurus_images'
            $data['gambar_data_pengurus_desa'] = $path;
        }

        $data_pengurus_desa->update($data);

        return redirect()->route('data_pengurus_desa.index')->with('success', 'Data Pengurus Desa Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_pengurus_desa = DataPengurusDesa::findOrFail($id); // Ubah nama variabel
        // Sebaiknya ada pemeriksaan otorisasi di sini juga

        // Hapus gambar dari storage jika ada
        if ($data_pengurus_desa->gambar_data_pengurus_desa && Storage::disk('public')->exists($data_pengurus_desa->gambar_data_pengurus_desa)) {
            Storage::disk('public')->delete($data_pengurus_desa->gambar_data_pengurus_desa);
        }
        $data_pengurus_desa->delete();

        return redirect()->route('data_pengurus_desa.index')->with('success', 'Data Pengurus Desa Berhasil Dihapus!');
    }
}
