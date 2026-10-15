<?php

namespace App\Support;

class WeddingEstimator
{
    /** Pilihan awal saat pengguna pertama kali membuka calculator. */
    public function defaults(): array
    {
        $config = config('kalkulator');

        return [
            'guests' => 300,
            'concept' => array_key_first($config['concepts']),
            'venue' => array_key_first($config['venues']),
            'duration' => array_key_first($config['durations']),
            'tier' => collect($config['services'])
                ->map(fn ($service) => $service['default'])
                ->all(),
            'addons' => collect($config['addons'])
                ->filter(fn ($addon) => $addon['default'])
                ->keys()
                ->all(),
        ];
    }

    /**
     * Hitung estimasi dari pilihan pengguna. Harga SELALU diambil dari
     * config, bukan dari nilai yang dikirim browser.
     */
    public function calculate(array $input): array
    {
        $config = config('kalkulator');
        $guests = (int) $input['guests'];

        $lines = [];
        $subtotal = 0;

        foreach ($config['services'] as $key => $service) {
            $tier = $input['tier'][$key] ?? $service['default'];
            $unit = $service['prices'][$tier];
            $amount = $service['per_guest'] ? $unit * $guests : $unit;

            $lines[] = [
                'label' => $service['label'],
                'tier' => $config['tiers'][$tier],
                'detail' => $service['per_guest']
                    ? $guests . ' tamu × ' . self::rupiah($unit)
                    : null,
                'amount' => $amount,
            ];

            $subtotal += $amount;
        }

        $addons = [];
        $addonsTotal = 0;

        foreach (array_unique((array) ($input['addons'] ?? [])) as $key) {
            if (! isset($config['addons'][$key])) {
                continue;
            }

            $addons[] = [
                'label' => $config['addons'][$key]['label'],
                'amount' => $config['addons'][$key]['price'],
            ];

            $addonsTotal += $config['addons'][$key]['price'];
        }

        return [
            'guests' => $guests,
            'concept' => $config['concepts'][$input['concept']]['label'] ?? '-',
            'venue' => $config['venues'][$input['venue']]['label'] ?? '-',
            'duration' => $config['durations'][$input['duration']]['label'] ?? '-',
            'lines' => $lines,
            'subtotal' => $subtotal,
            'addons' => $addons,
            'addons_total' => $addonsTotal,
            'total' => $subtotal + $addonsTotal,
        ];
    }

    /** Data minimal untuk JavaScript di halaman calculator. */
    public function catalog(): array
    {
        $config = config('kalkulator');
        $labels = fn (array $items) => collect($items)
            ->map(fn ($item) => $item['label'])
            ->all();

        return [
            'min_guests' => $config['min_guests'],
            'max_guests' => $config['max_guests'],
            'tiers' => $config['tiers'],
            'concepts' => $labels($config['concepts']),
            'venues' => $labels($config['venues']),
            'durations' => $labels($config['durations']),
            'services' => collect($config['services'])->map(fn ($service) => [
                'default' => $service['default'],
                'per_guest' => $service['per_guest'],
                'prices' => $service['prices'],
            ])->all(),
            'addons' => collect($config['addons'])->map(fn ($addon) => [
                'price' => $addon['price'],
            ])->all(),
        ];
    }

    public static function rupiah(int $value): string
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}