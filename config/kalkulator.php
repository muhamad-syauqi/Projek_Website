<?php

return [

    'whatsapp' => env('KALKULATOR_WHATSAPP', '62895343552652'),

    'min_guests' => 50,
    'max_guests' => 2000,

    'tiers' => [
        'basic' => 'Basic',
        'standar' => 'Standar',
        'premium' => 'Premium',
    ],

    'concepts' => [
        'adat-sunda' => 'Adat Sunda',
        'modern' => 'Modern',
        'rustic' => 'Rustic',
        'islami' => 'Islami',
        'lainnya' => 'Lainnya',
    ],

    'venues' => [
        'rumah' => 'Di rumah',
        'gedung' => 'Di gedung',
    ],

    'durations' => [
        'satu-hari' => '1 hari',
        'dua-hari' => '2 hari',
    ],

    'services' => [
        'dekorasi' => [
            'label' => 'Dekorasi & Tenda',
            'desc' => 'Pelaminan, tenda, photo booth area',
            'icon' => 'fa-solid fa-leaf',
            'default' => 'standar',
            'per_guest' => false,
            'prices' => ['basic' => 8000000, 'standar' => 12000000, 'premium' => 18000000],
        ],
        'rias' => [
            'label' => 'Rias & Busana',
            'desc' => 'Rias pengantin, baju akad, aksesoris',
            'icon' => 'fa-solid fa-crown',
            'default' => 'premium',
            'per_guest' => false,
            'prices' => ['basic' => 6000000, 'standar' => 7500000, 'premium' => 9500000],
        ],
        'catering' => [
            'label' => 'Catering',
            'desc' => 'Menu prasmanan, dihitung per tamu',
            'icon' => 'fa-solid fa-utensils',
            'default' => 'standar',
            'per_guest' => true,
            'prices' => ['basic' => 35000, 'standar' => 45000, 'premium' => 60000],
        ],
        'dokumentasi' => [
            'label' => 'Dokumentasi',
            'desc' => 'Foto, video, album, flashdisk',
            'icon' => 'fa-solid fa-camera',
            'default' => 'standar',
            'per_guest' => false,
            'prices' => ['basic' => 3500000, 'standar' => 6000000, 'premium' => 9000000],
        ],
        'hiburan' => [
            'label' => 'Hiburan',
            'desc' => 'Panggung, sound system, live music',
            'icon' => 'fa-solid fa-music',
            'default' => 'basic',
            'per_guest' => false,
            'prices' => ['basic' => 4000000, 'standar' => 6000000, 'premium' => 9000000],
        ],
        'mc' => [
            'label' => 'MC Wedding',
            'desc' => 'MC formal dan rundown acara',
            'icon' => 'fa-solid fa-microphone',
            'default' => 'basic',
            'per_guest' => false,
            'prices' => ['basic' => 1500000, 'standar' => 2500000, 'premium' => 3500000],
        ],
    ],

    'addons' => [
        'photobooth' => ['label' => 'Galeri photo booth', 'price' => 1500000, 'default' => true],
        'minigarden' => ['label' => 'Mini garden', 'price' => 2000000, 'default' => false],
        'henna' => ['label' => 'Henna & nail art', 'price' => 750000, 'default' => true],
        'cinematic' => ['label' => 'Video cinematic 4-5 menit', 'price' => 3000000, 'default' => false],
        'pager' => ['label' => 'Pager ayu & pager bagus', 'price' => 1200000, 'default' => false],
        'softlens' => ['label' => 'Soft lens', 'price' => 500000, 'default' => false],
    ],

];