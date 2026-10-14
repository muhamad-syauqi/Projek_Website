@extends('admin.layout')

@section('title', 'Dashboard')
@section('crumb', 'Admin / Dashboard')

@section('content')
    {{-- Banner sambutan --}}
    <div class="hero">
        <div>
            <h2 class="serif">Selamat datang, {{ auth()->user()->name }}</h2>
            <p>Kelola konten website Fahira Wedding dari sini.</p>
        </div>

        <div class="acts">
            <a class="btn btn-white" href="{{ route('admin.packages.create') }}">
                <x-admin.icon name="plus" />Tambah Paket
            </a>
            <a class="btn btn-ghost" href="{{ route('admin.galleries.create') }}">
                <x-admin.icon name="plus" />Tambah Foto
            </a>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="stats">
        <div class="card stat">
            <div class="ico w"><x-admin.icon name="pkg" /></div>
            <div>
                <p>Total Paket</p>
                <h3>{{ $totalPaket }}</h3>
                <small>Semua paket tersimpan</small>
            </div>
        </div>

        <div class="card stat">
            <div class="ico g"><x-admin.icon name="check" /></div>
            <div>
                <p>Paket Aktif</p>
                <h3>{{ $paketAktif }}</h3>
                <small>Tampil di website</small>
            </div>
        </div>

        <div class="card stat">
            <div class="ico o"><x-admin.icon name="img" /></div>
            <div>
                <p>Total Foto Galeri</p>
                <h3>{{ $totalGaleri }}</h3>
                <small>Semua foto tersimpan</small>
            </div>
        </div>

        <div class="card stat">
            <div class="ico b"><x-admin.icon name="eye" /></div>
            <div>
                <p>Foto Galeri Aktif</p>
                <h3>{{ $galeriAktif }}</h3>
                <small>Tampil di website</small>
            </div>
        </div>
    </div>

    <div class="two">
        {{-- Paket terbaru --}}
        <div class="card">
            <div class="hd">
                <h3 class="serif">Paket terbaru</h3>
                <a href="{{ route('admin.packages.index') }}">Kelola paket <x-admin.icon name="arrow" /></a>
            </div>

            <div class="tbl">
                <table>
                    <tbody>
                        @forelse ($latestPackages as $package)
                            <tr>
                                <td style="width:100px">
                                    @if ($package->image)
                                        <img class="thumb" src="{{ asset('storage/'.$package->image) }}" alt="{{ $package->name }}">
                                    @else
                                        <div class="nophoto">Belum ada foto</div>
                                    @endif
                                </td>
                                <td class="name">
                                    <b>{{ $package->name }}</b>
                                    <small>{{ ucfirst($package->category) }}</small>
                                </td>
                                <td class="price">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="pill {{ $package->is_active ? 'on' : 'off' }}">
                                        {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="empty">Belum ada paket.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Galeri terbaru --}}
        <div class="card">
            <div class="hd">
                <h3 class="serif">Galeri terbaru</h3>
                <a href="{{ route('admin.galleries.index') }}">Kelola galeri <x-admin.icon name="arrow" /></a>
            </div>

            @if ($latestGalleries->isNotEmpty())
                <div class="gal">
                    @foreach ($latestGalleries as $gallery)
                        <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}">
                    @endforeach
                </div>
            @else
                <div class="empty">Belum ada foto galeri.</div>
            @endif

            <div class="tip">
                Foto dan paket yang <b>nonaktif</b> tidak akan tampil di website publik.
            </div>
        </div>
    </div>
@endsection