<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/paket', 'paket')->name('paket');

Route::get('/paket/{slug}', function (string $slug) {
    $paket = config("paket.$slug");

    abort_if(! $paket, 404);

    $waUrl = 'https://wa.me/6281234567890?text='
        . rawurlencode("Halo Fahira Wedding, saya ingin konsultasi mengenai {$paket['nama']}.");

    return view('detail-paket', compact('paket', 'waUrl'));
})->name('paket.detail');