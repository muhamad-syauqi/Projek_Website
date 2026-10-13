
<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\GalleryPageController;
use App\Models\Gallery;
use App\Models\Package;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::view('/', 'home')->name('home');

Route::view('/tentang', 'tentang')->name('tentang');

Route::get('/paket', function () {
    $packages = Package::where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    return view('paket', compact('packages'));
})->name('paket');

Route::get('/paket/{slug}', function (string $slug) {
    $package = Package::where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    $waUrl = 'https://wa.me/6281234567890?text='
        . rawurlencode(
            'Halo Fahira Wedding, saya ingin konsultasi mengenai '
            . $package->name . '.'
        );

    return view('detail-paket', [
        'package' => $package,
        'waUrl' => $waUrl,
    ]);
})->name('paket.detail');

Route::get('/galeri', [GalleryPageController::class, 'index'])->name('galeri');

// Login admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.process');

    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('packages', PackageController::class)
            ->except(['show']);

        Route::resource('galleries', GalleryController::class)
            ->except(['show']);
    });
});
