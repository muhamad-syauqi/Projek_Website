<?php

/*
 * Data detail paket. Kunci array (cinta, bahagia, dst.) dipakai di URL: /paket/cinta
 * Isi bagian 'kiri', 'kanan', dan 'tambahan' dengan fasilitas asli tiap paket.
 */

$galeri = [
    'images/paket-pernikahan.jpg',
    'images/foto-pengantin-2.jpg',
    'images/foto-pengantin-1.jpg',
    'images/galeri.jpg',
    'images/tentang-kami.jpg',
];

$deskripsi = 'Wujudkan momen pernikahan impian Anda bersama paket wedding yang dirancang untuk memberikan pengalaman istimewa, praktis, dan berkesan.';

return [

    'cinta' => [
        'nama'      => 'Paket Cinta',
        'harga'     => 'Rp 19.000.000',
        'deskripsi' => $deskripsi,
        'foto'      => 'images/paket-pernikahan.jpg',
        'kiri'      => [
            'dekorasi 6x3 meter',
            'panggung pelaminan 6x3 meter',
            'mini garden',
            'galeri photo booth',
            'bokor jalan',
            'lengkungan masuk',
            'red carpet/sintetis',
            'tenda full dekor 100meter',
            'cover tenda',
            'pergola masuk',
            'panggung hiburan 4x3',
            'meja pemanas 1 set',
            'meja stand 1 set',
            'meja dan kursi akad',
            'meja pemanas besar 1 set',
            'piring sendok garpu 100 (hoe)',
            'kursi tamu 100 (plastik + cover) free',
            'background rumah',
        ],
        'kanan'     => [
            'rias pengantin CPW',
            'baju akad CPW dan CPP',
            'sendal CPW dan CPP',
            'aksesoris CPW dan CPP + retouch',
            '2 jas / beskap CPP',
            'melati full ronce CPW',
            'kalung melati CPP',
            'baju bapa dan ibu hajat (makeup)',
            'baju bapa dan ibu besan',
            'baju pager ayu 4 (makeup)',
            'baju pager bagus 2 free',
            'hena dan nail art',
            'soft lens',
            'MC wedding formal (pengatur acara)',
        ],
        'tambahan'  => [
            [
                'judul' => 'Dokumentasi',
                'items' => [
                    '1 Orang fotograper 1 hari kerja',
                    '1 Orang vidiograper 1 hari kerja',
                    'Album foto magazine  12 sheet',
                    'Vidio lipatan 45 menit',
                    'Vidio cinematic 4-5 menit',
                    'Flashdisk all foto dan vidio',
                ],
            ],
        ],
        'galeri'    => $galeri,
    ],

    // Paket di bawah ini masih contoh isian. Ganti dengan fasilitas aslinya.
    'bahagia' => [
        'nama'      => 'Paket Bahagia',
        'harga'     => 'Rp 27.000.000',
        'deskripsi' => $deskripsi,
        'foto'      => 'images/paket-pernikahan.jpg',
        'kiri'      => ['dekorasi pelaminan', 'hiburan', 'upacara adat'],
        'kanan'     => ['rias pengantin', 'makeup keluarga'],
        'tambahan'  => [
            ['judul' => 'Dokumentasi', 'items' => ['fotografer 1 hari kerja', 'videografer 1 hari kerja']],
        ],
        'galeri'    => $galeri,
    ],

    'impian' => [
        'nama'      => 'Paket Impian',
        'harga'     => 'Rp 31.000.000',
        'deskripsi' => $deskripsi,
        'foto'      => 'images/paket-pernikahan.jpg',
        'kiri'      => ['tenda dekorasi', 'hiburan', 'lensa lampu', 'siraman'],
        'kanan'     => ['makeup dan attire', 'susunan acara'],
        'tambahan'  => [],
        'galeri'    => $galeri,
    ],

    'resepsi' => [
        'nama'      => 'Paket Resepsi',
        'harga'     => 'Rp 22.500.000',
        'deskripsi' => $deskripsi,
        'foto'      => 'images/paket-pernikahan.jpg',
        'kiri'      => ['dekorasi resepsi', 'hiburan'],
        'kanan'     => ['rias pengantin'],
        'tambahan'  => [
            ['judul' => 'Dokumentasi', 'items' => ['fotografer 1 hari kerja']],
        ],
        'galeri'    => $galeri,
    ],

    'makeup' => [
        'nama'      => 'Paket Makeup & Attire',
        'harga'     => 'Rp 9.000.000',
        'deskripsi' => $deskripsi,
        'foto'      => 'images/paket-pernikahan.jpg',
        'kiri'      => ['rias pengantin', 'pager ayu 4'],
        'kanan'     => [],
        'tambahan'  => [],
        'galeri'    => $galeri,
    ],

];