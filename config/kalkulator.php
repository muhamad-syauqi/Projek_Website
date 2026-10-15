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
        'adat-sunda' => ['label' => 'Adat Sunda', 'desc' => 'Tradisi & sakral', 'icon' => 'fa-solid fa-gem'],
        'modern' => ['label' => 'Modern', 'desc' => 'Minimalis elegan', 'icon' => 'fa-solid fa-cube'],
        'rustic' => ['label' => 'Rustic', 'desc' => 'Hangat & natural', 'icon' => 'fa-solid fa-tree'],
        'islami' => ['label' => 'Islami', 'desc' => "Khidmat & syar'i", 'icon' => 'fa-solid fa-moon'],
        'lainnya' => ['label' => 'Lainnya', 'desc' => 'Konsep sendiri', 'icon' => 'fa-solid fa-plus'],
    ],

    'venues' => [
        'rumah' => ['label' => 'Di rumah', 'desc' => 'Tenda dan dekorasi di kediaman', 'icon' => 'fa-solid fa-house'],
        'gedung' => ['label' => 'Di gedung', 'desc' => 'Aula atau ballroom', 'icon' => 'fa-solid fa-building'],
    ],

    'durations' => [
        'satu-hari' => ['label' => '1 hari', 'desc' => 'Akad dan resepsi di hari yang sama', 'icon' => 'fa-solid fa-sun'],
        'dua-hari' => ['label' => '2 hari', 'desc' => 'Akad dan resepsi di hari terpisah', 'icon' => 'fa-solid fa-calendar-days'],
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
            'desc' => 'Prasmanan, dihitung per tamu',
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
        'photobooth' => ['label' => 'Galeri photo booth', 'icon' => 'fa-solid fa-camera-retro', 'price' => 1500000, 'default' => true],
        'minigarden' => ['label' => 'Mini garden', 'icon' => 'fa-solid fa-seedling', 'price' => 2000000, 'default' => false],
        'henna' => ['label' => 'Henna & nail art', 'icon' => 'fa-solid fa-hand-sparkles', 'price' => 750000, 'default' => true],
        'cinematic' => ['label' => 'Video cinematic 4-5 menit', 'icon' => 'fa-solid fa-film', 'price' => 3000000, 'default' => false],
        'pager' => ['label' => 'Pager ayu & pager bagus', 'icon' => 'fa-solid fa-user-group', 'price' => 1200000, 'default' => false],
        'softlens' => ['label' => 'Soft lens', 'icon' => 'fa-solid fa-eye', 'price' => 500000, 'default' => false],
    ],

];