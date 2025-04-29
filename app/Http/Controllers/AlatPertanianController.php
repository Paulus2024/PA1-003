<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\AlatPertanian;
use Illuminate\Http\Request;

class AlatPertanianController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model AlatPertanian
        $alat_pertanian = AlatPertanian::all();
        return view('dashboard.bumdes.page.Alat_Pertanian.index_alat_pertanian', compact('alat_pertanian'));
    }
}
