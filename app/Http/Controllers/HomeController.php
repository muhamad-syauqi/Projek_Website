<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Package;
use App\Support\WeddingEstimator;

class HomeController extends Controller
{
    public function index(WeddingEstimator $estimator)
    {
        // 3 paket aktif yang paling baru ditambahkan
        $latestPackages = Package::where('is_active', true)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        // 5 foto galeri aktif yang paling baru diunggah
        $latestGalleries = Gallery::where('is_active', true)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('home', [
            'latestPackages' => $latestPackages,
            'latestGalleries' => $latestGalleries,
            'packageCount' => Package::where('is_active', true)->count(),
            'services' => config('kalkulator.services'),
            'sample' => $estimator->calculate($estimator->defaults()),
            'whatsapp' => config('kalkulator.whatsapp'),
        ]);
    }
}