<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BumdesController extends Controller
{
    public function index()
    {
        return view('dashboard.bumdes');
    }
}

