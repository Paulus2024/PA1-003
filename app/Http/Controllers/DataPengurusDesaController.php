<?php

namespace App\Http\Controllers;

use App\Models\DataPengurusDesa;
use App\Models\Jabatan; // Import model Jabatan
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataPengurusDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load relasi 'jabatan' untuk menghindari N+1 query problem
        $data_pengurus_desas = DataPengurusDesa::with('jabatan')->get();

        // Ambil semua jabatan yang belum terisi (untuk modal tambah)
        $jabatan_tersedia = Jabatan::whereDoesntHave('pengurus')->get();

        // Ambil semua jabatan (untuk modal edit, agar semua opsi jabatan bisa ditampilkan)
        $semua_jabatan = Jabatan::all();

        return view(
            'dashboard.sekretaris.page.Data_Pengurus_Desa.index_data_pengurus_desa',
            compact('data_pengurus_desas', 'jabatan_tersedia', 'semua_jabatan')
        );
    }

    public function index_Bumdes()
    {
        $data_pengurus_desas = DataPengurusDesa::with('jabatan')->get();
        return view('dashboard.bumdes.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
    }

    // public function index_masyarakat()
    // {
    //     $data_pengurus_desas = DataPengurusDesa::with('jabatan')->get();
    //     return view('dashboard.masyarakat.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
    // }
    public function index_masyarakat()
    {
        // Ambil semua data pengurus dengan relasi jabatannya.
        $all_pengurus = DataPengurusDesa::with('jabatan')->get();

        // Siapkan variabel untuk setiap kelompok jabatan.
        $kepala_desa = null;
        $sekretaris = null;
        $kasi_collection = collect(); // Gunakan koleksi untuk menampung para Kasi
        $kaur_collection = collect(); // Gunakan koleksi untuk menampung para Kaur
        $kadus_collection = collect(); // Gunakan koleksi untuk menampung para Kadus

        // Loop melalui semua pengurus dan kelompokkan berdasarkan nama jabatan.
        // Catatan: Ini mengasumsikan nama jabatan di database Anda mengandung kata kunci
        // seperti 'Kepala Desa', 'Sekretaris', 'Kasi', 'Kaur', 'Kadus'.
        foreach ($all_pengurus as $pengurus) {
            $jabatan = strtolower($pengurus->jabatan->nama_jabatan);

            if (str_contains($jabatan, 'kepala desa')) {
                $kepala_desa = $pengurus;
            } elseif (str_contains($jabatan, 'sekretaris')) {
                $sekretaris = $pengurus;
            } elseif (str_contains($jabatan, 'kasi')) {
                $kasi_collection->push($pengurus);
            } elseif (str_contains($jabatan, 'kaur')) {
                $kaur_collection->push($pengurus);
            } elseif (str_contains($jabatan, 'kadus')) {
                $kadus_collection->push($pengurus);
            }
        }

        // Kirim data yang sudah dikelompokkan ke view.
        return view('dashboard.masyarakat.page.Data_Pengurus_Desa.index_data_pengurus_desa', [
            'kepala_desa' => $kepala_desa,
            'sekretaris' => $sekretaris,
            'kasi_list' => $kasi_collection,
            'kaur_list' => $kaur_collection,
            'kadus_list' => $kadus_collection,
        ]);
    }

    public function index_pengguna()
    {
        $data_pengurus_desas = DataPengurusDesa::with('jabatan')->get();
        return view('pengguna.page.Data_Pengurus_Desa.index_data_pengurus_desa', compact('data_pengurus_desas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Metode ini sekarang tidak perlu, karena form tambah ada di index
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_data_pengurus_desa' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatan,id|unique:data_pengurus_desas,jabatan_id',
            'deskripsi_data_pengurus_desa' => 'required|string',
            'gambar_data_pengurus_desa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar_data_pengurus_desa')) {
            $file = $request->file('gambar_data_pengurus_desa');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $imagePath = $file->storeAs('pengurus_images', $filename, 'public');
        }

        DataPengurusDesa::create([
            'user_id' => Auth::id(),
            'jabatan_id' => $request->jabatan_id,
            'nama_data_pengurus_desa' => $request->nama_data_pengurus_desa,
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
        // ... (tidak ada perubahan signifikan)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data_pengurus_desa = DataPengurusDesa::findOrFail($id);

        $rules = [
            'nama_data_pengurus_desa' => 'required|string|max:255',
            'deskripsi_data_pengurus_desa' => 'required|string',
            'gambar_data_pengurus_desa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        // Validasi jabatan_id: wajib ada, harus ada di tabel jabatan,
        // dan unik kecuali untuk data pengurus yang sedang diupdate ini sendiri.
        if ($request->jabatan_id != $data_pengurus_desa->jabatan_id) {
            $rules['jabatan_id'] = 'required|exists:jabatan,id|unique:data_pengurus_desas,jabatan_id';
        } else {
            $rules['jabatan_id'] = 'required|exists:jabatan,id';
        }

        $request->validate($rules);

        $data = [
            'jabatan_id' => $request->input('jabatan_id'),
            'nama_data_pengurus_desa' => $request->input('nama_data_pengurus_desa'),
            'deskripsi_data_pengurus_desa' => $request->input('deskripsi_data_pengurus_desa'),
        ];

        if ($request->hasFile('gambar_data_pengurus_desa')) {
            if ($data_pengurus_desa->gambar_data_pengurus_desa && Storage::disk('public')->exists($data_pengurus_desa->gambar_data_pengurus_desa)) {
                Storage::disk('public')->delete($data_pengurus_desa->gambar_data_pengurus_desa);
            }
            $file = $request->file('gambar_data_pengurus_desa');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('pengurus_images', $filename, 'public');
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
        $data_pengurus_desa = DataPengurusDesa::findOrFail($id);

        if ($data_pengurus_desa->gambar_data_pengurus_desa && Storage::disk('public')->exists($data_pengurus_desa->gambar_data_pengurus_desa)) {
            Storage::disk('public')->delete($data_pengurus_desa->gambar_data_pengurus_desa);
        }
        $data_pengurus_desa->delete();

        return redirect()->route('data_pengurus_desa.index')->with('success', 'Data Pengurus Desa Berhasil Dihapus!');
    }
}
