<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.sekretaris.profil', compact('user'));
    }
}
