<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Package;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPaket' => Package::count(),
            'totalGaleri' => Gallery::count(),
            'paketAktif' => Package::where('is_active', true)->count(),
            'galeriAktif' => Gallery::where('is_active', true)->count(),
        ]);
    }
}
