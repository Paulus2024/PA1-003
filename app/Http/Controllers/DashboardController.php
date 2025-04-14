<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function userDashboard()
    {
        return view('dashboard.user');
    }

    public function bumdesDashboard()
    {
        return view('dashboard.bumdes');
    }

    public function sekretarisDashboard()
    {
        return view('dashboard.sekretaris');
    }
}
