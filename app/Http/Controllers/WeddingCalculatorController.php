<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Support\WeddingEstimator;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class WeddingCalculatorController extends Controller
{
    private const SESSION_KEY = 'kalkulator';
    private const LAST_STEP = 3;

    public function __construct(private WeddingEstimator $estimator)
    {
    }

    /** Halaman awal (penjelasan) sebelum calculator dimulai. */
    public function intro()
    {
        $sample = $this->estimator->calculate($this->estimator->defaults());

        return view('kalkulator.intro', [
            'config' => config('kalkulator'),
            'sample' => $sample,
        ]);
    }

    /** Langkah 1 sampai 3. */
    public function step(int $step)
    {
        if ($redirect = $this->guardStep($step)) {
            return $redirect;
        }

        $state = $this->state();

        return view("kalkulator.langkah-{$step}", [
            'step' => $step,
            'config' => config('kalkulator'),
            'state' => $state,
            'total' => $this->estimator->calculate($state)['total'],
            'calculatorData' => $this->estimator->catalog() + [
                'state' => $state,
                'step' => $step,
            ],
        ]);
    }

    /** Simpan pilihan satu langkah lalu lanjut ke langkah berikutnya. */
    public function save(Request $request, int $step): RedirectResponse
    {
        if ($redirect = $this->guardStep($step)) {
            return $redirect;
        }

        $data = $request->validate($this->rules($step));
        $state = $this->state();

        match ($step) {
            1 => $state = array_replace($state, $data, ['guests' => (int) $data['guests']]),
            2 => $state['tier'] = $data['tier'],
            3 => $state['addons'] = array_values($data['addons'] ?? []),
        };

        session([
            self::SESSION_KEY => [
                'state' => $state,
                'progress' => max($this->progress(), $step),
            ],
        ]);

        return $step < self::LAST_STEP
            ? redirect()->route('kalkulator.langkah', $step + 1)
            : redirect()->route('kalkulator.hasil');
    }

    /** Langkah 4: hasil estimasi. */
    public function result()
    {
        if ($this->progress() < self::LAST_STEP) {
            return redirect()->route('kalkulator.langkah', $this->progress() + 1);
        }

        $config = config('kalkulator');
        $estimate = $this->estimator->calculate($this->state());

        $packages = Package::where('is_active', true)->orderBy('price')->get();
        $nearest = $packages->filter(fn ($p) => $p->price <= $estimate['total'])->last()
            ?? $packages->first();

        $waText = "Halo Fahira Wedding, saya sudah mencoba Wedding Calculator.\n"
            . "Jumlah tamu: {$estimate['guests']}\n"
            . "Konsep: {$estimate['concept']}\n"
            . 'Total estimasi: ' . WeddingEstimator::rupiah($estimate['total']) . "\n"
            . 'Mohon info lebih lanjut.';

        return view('kalkulator.hasil', [
            'step' => 4,
            'config' => $config,
            'estimate' => $estimate,
            'package' => $nearest,
            'waUrl' => 'https://wa.me/' . $config['whatsapp'] . '?text=' . rawurlencode($waText),
            'createdAt' => now()->locale('id')->translatedFormat('d F Y'),
        ]);
    }

    /** Unduh hasil estimasi sebagai PDF (dihitung ulang dari data sesi). */
    public function pdf()
    {
        if ($this->progress() < self::LAST_STEP) {
            return redirect()->route('kalkulator.langkah', $this->progress() + 1);
        }

        $config = config('kalkulator');
        $logoPath = public_path('images/logo-footer.png');

        $html = view('kalkulator-pdf', [
            'estimate' => $this->estimator->calculate($this->state()),
            'logo' => is_file($logoPath)
                ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
                : null,
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

    /** Pilihan tersimpan di sesi, dilengkapi nilai awal untuk yang belum diisi. */
    private function state(): array
    {
        return array_replace(
            $this->estimator->defaults(),
            session(self::SESSION_KEY . '.state', [])
        );
    }

    /** Langkah tertinggi yang sudah selesai (0 = belum mulai). */
    private function progress(): int
    {
        return (int) session(self::SESSION_KEY . '.progress', 0);
    }

    /** Pengguna tidak boleh melompati langkah yang belum diisi. */
    private function guardStep(int $step): ?RedirectResponse
    {
        if ($step > $this->progress() + 1) {
            return redirect()->route('kalkulator.langkah', $this->progress() + 1);
        }

        return null;
    }

    private function rules(int $step): array
    {
        $config = config('kalkulator');

        if ($step === 1) {
            return [
                'guests' => ['required', 'integer', 'min:' . $config['min_guests'], 'max:' . $config['max_guests']],
                'concept' => ['required', Rule::in(array_keys($config['concepts']))],
                'venue' => ['required', Rule::in(array_keys($config['venues']))],
                'duration' => ['required', Rule::in(array_keys($config['durations']))],
            ];
        }

        if ($step === 2) {
            $rules = ['tier' => ['required', 'array']];

            foreach (array_keys($config['services']) as $service) {
                $rules["tier.$service"] = ['required', Rule::in(array_keys($config['tiers']))];
            }

            return $rules;
        }

        return [
            'addons' => ['nullable', 'array'],
            'addons.*' => ['string', Rule::in(array_keys($config['addons']))],
        ];
    }
}