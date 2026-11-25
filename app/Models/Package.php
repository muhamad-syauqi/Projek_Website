<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /**
     * Kelompok fasilitas di halaman detail paket.
     * Urutan di sini = urutan tampil. Kunci dipakai di kolom `facilities` (JSON).
     */
    public const FACILITY_GROUPS = [
        'dekorasi' => 'Dekorasi',
        'rias' => 'Rias & Busana',
        'dokumentasi' => 'Dokumentasi',
        'lainnya' => 'Fasilitas Lainnya',
    ];

    protected $fillable = [
        'name',
        'slug',
        'category',
        'price',
        'description',
        'image',
        'facilities',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'facilities' => 'array',
            'is_active' => 'boolean',
            'price' => 'integer',
        ];
    }

    /**
     * Fasilitas per kelompok, hanya yang terisi:
     * ['dekorasi' => [...], 'rias' => [...], 'dokumentasi' => [...], 'lainnya' => [...]]
     *
     * Data lama berupa daftar datar (['A', 'B', ...]) otomatis masuk ke 'lainnya'.
     */
    protected function facilityGroups(): Attribute
    {
        return Attribute::get(function (): array {
            $raw = $this->facilities;

            if (! is_array($raw) || $raw === []) {
                return [];
            }

            if (array_is_list($raw)) {
                $raw = ['lainnya' => $raw];
            }

            $groups = [];

            foreach (array_keys(self::FACILITY_GROUPS) as $key) {
                $items = array_values(array_filter(
                    array_map(fn ($item) => trim((string) $item), (array) ($raw[$key] ?? [])),
                    fn ($item) => $item !== ''
                ));

                if ($items !== []) {
                    $groups[$key] = $items;
                }
            }

            return $groups;
        });
    }

    /** Semua fasilitas dalam satu daftar datar (untuk ringkasan di kartu paket). */
    protected function facilityList(): Attribute
    {
        return Attribute::get(
            fn (): array => collect($this->facility_groups)->flatten()->values()->all()
        );
    }
}