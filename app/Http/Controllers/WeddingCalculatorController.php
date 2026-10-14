<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Support\WeddingEstimator;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class WeddingCalculatorController extends Controller
{
    public function index(WeddingEstimator $estimator)
    {
        $packages = Package::where('is_active', true)
            ->orderBy('price')
            ->get(['name', 'slug', 'price'])
            ->map(fn (Package $package) => [
                'name' => $package->name,
                'price' => $package->price,
                'url' => route('paket.detail', $package->slug),
            ])
            ->values();

        return view('kalkulator', [
            'config' => config('kalkulator'),
            'calculatorData' => $estimator->catalog() + ['packages' => $packages],
        ]);
    }

    public function pdf(Request $request, WeddingEstimator $estimator)
    {
        $config = config('kalkulator');

        $rules = [
            'guests' => ['required', 'integer', 'min:' . $config['min_guests'], 'max:' . $config['max_guests']],
            'concept' => ['required', Rule::in(array_keys($config['concepts']))],
            'venue' => ['required', Rule::in(array_keys($config['venues']))],
            'duration' => ['required', Rule::in(array_keys($config['durations']))],
            'tier' => ['required', 'array'],
            'addons' => ['nullable', 'array'],
            'addons.*' => ['string', Rule::in(array_keys($config['addons']))],
        ];

        foreach (array_keys($config['services']) as $service) {
            $rules["tier.$service"] = ['required', Rule::in(array_keys($config['tiers']))];
        }

        $estimate = $estimator->calculate($request->validate($rules));

        $logoPath = public_path('images/logo-footer.png');
        $logo = is_file($logoPath)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : null;

        $html = view('kalkulator-pdf', [
            'estimate' => $estimate,
            'logo' => $logo,
            'createdAt' => now()->locale('id')->translatedFormat('d F Y'),
            'whatsapp' => $config['whatsapp'],
        ])->render();

        $tempDir = storage_path('app/dompdf');
        File::ensureDirectoryExists($tempDir);

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Serif');
        $options->set('isRemoteEnabled', false);
        $options->set('tempDir', $tempDir);
        $options->set('fontCache', $tempDir);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $fileName = 'estimasi-pernikahan-fahira-wedding-' . now()->format('Ymd') . '.pdf';

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}