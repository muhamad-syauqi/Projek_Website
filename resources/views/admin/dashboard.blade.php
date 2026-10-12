@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <h1 class="h3 mb-4">Dashboard Admin</h1>
    <p class="text-muted">Kelola konten website Fahira Wedding dari sini.</p>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <p class="text-muted mb-1">Total Paket</p>
                <h2>{{ $totalPaket }}</h2>
                <a href="{{ route('admin.packages.index') }}">Kelola paket</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <p class="text-muted mb-1">Total Foto Galeri</p>
                <h2>{{ $totalGaleri }}</h2>
                <a href="{{ route('admin.galleries.index') }}">Kelola galeri</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <p class="text-muted mb-1">Paket Aktif</p>
                <h2>{{ $paketAktif }}</h2>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <p class="text-muted mb-1">Foto Galeri Aktif</p>
                <h2>{{ $galeriAktif }}</h2>
            </div>
        </div>
    </div>
@endsection
