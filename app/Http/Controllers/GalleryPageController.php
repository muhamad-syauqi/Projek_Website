<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GalleryPageController extends Controller
{
    public function index(Request $request)
    {
        // Filter bulan, formatnya YYYY-MM (contoh: 2026-10)
        $bulan = $request->query('bulan');

        if (! is_string($bulan) || ! preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $bulan)) {
            $bulan = null;
        }

        // Daftar bulan yang punya foto aktif, terbaru di depan
        $months = Gallery::where('is_active', true)
            ->whereNotNull('taken_at')
            ->orderByDesc('taken_at')
            ->pluck('taken_at')
            ->map(fn ($date) => $date->format('Y-m'))
            ->unique()
            ->values()
            ->map(fn ($ym) => [
                'value' => $ym,
                'label' => Carbon::createFromFormat('Y-m-d', $ym . '-01')
                    ->locale('id')
                    ->translatedFormat('F Y'),
            ]);

        $galleries = Gallery::where('is_active', true)
            ->when($bulan, function ($query) use ($bulan) {
                [$year, $month] = explode('-', $bulan);

                $query->whereYear('taken_at', (int) $year)
                    ->whereMonth('taken_at', (int) $month);
            })
            ->orderBy('sort_order')
            ->orderByDesc('taken_at')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('galeri', compact('galleries', 'months', 'bulan'));
    }
}