<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $paket['nama'] }} - Fahira Wedding</title>
    <meta name="description" content="Detail fasilitas dan estimasi harga {{ $paket['nama'] }} dari Fahira Wedding.">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paket.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-paket.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="paket-page detail-page">

    {{-- HEADER (sama dengan halaman paket) --}}
    <header class="site-header paket-header" id="beranda">
        <a class="brand brand-header" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-fahira.png') }}" alt="Fahira Wedding">
        </a>

        <button class="menu-toggle" type="button"
            aria-label="Buka menu" aria-expanded="false">☰</button>

        <nav class="navigation" aria-label="Navigasi utama">
            <a href="{{ route('home') }}">Beranda</a>
            <a class="active" href="{{ route('paket') }}">Paket</a>
            <a href="{{ url('/wedding-calculator') }}">Wedding Calculator</a>
            <a href="{{ route('home') }}#tentang">Tentang</a>
            <a href="{{ url('/galeri') }}">Galeri</a>
            <a href="{{ route('home') }}#konsultasi">Konsultasi</a>
        </nav>
    </header>

    <main class="detail-wrap">
        <article class="detail-card">

            {{-- FOTO UTAMA + TOMBOL TUTUP --}}
            <div class="detail-photo">
                <img src="{{ asset($paket['foto']) }}" alt="{{ $paket['nama'] }}">
                <a class="detail-close" href="{{ route('paket') }}" aria-label="Tutup detail paket">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 5l14 14M19 5L5 19"/></svg>
                </a>
            </div>

            <div class="detail-body">
                <h1>Detail {{ $paket['nama'] }}</h1>
                <p class="detail-price">{{ $paket['harga'] }}</p>
                <p class="detail-desc">{{ $paket['deskripsi'] }}</p>

                <hr class="detail-rule">

                {{-- FASILITAS --}}
                <h2>Fasilitas paket</h2>

                <div class="detail-facilities">
                    <div class="detail-col">
                        <span class="detail-bookmark" aria-hidden="true"></span>
                        <ul>
                            @foreach ($paket['kiri'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                    @if (!empty($paket['kanan']))
                        <div class="detail-col">
                            <span class="detail-bookmark" aria-hidden="true"></span>
                            <ul>
                                @foreach ($paket['kanan'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- FASILITAS TAMBAHAN (mis. Dokumentasi) --}}
                @foreach ($paket['tambahan'] as $blok)
                    <div class="detail-extra">
                        <div class="detail-extra-box">
                            <h3><span class="detail-bookmark" aria-hidden="true"></span>{{ $blok['judul'] }}</h3>
                            <ul>
                                @foreach ($blok['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

                <hr class="detail-rule detail-rule-bottom">

                {{-- ESTIMASI HARGA --}}
                <div class="detail-estimate">
                    <h2>Estimasi harga</h2>
                    <p class="detail-price">{{ $paket['harga'] }}</p>
                    <a class="detail-wa" href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Konsultasi
                    </a>
                    <p class="detail-note">*Harga dapat berubah sesuai kebutuhan dan lokasi</p>
                </div>
            </div>

            {{-- GALERI GESER --}}
            <div class="detail-gallery-wrap">
                <div class="detail-gallery" id="detail-gallery">
                    @foreach ($paket['galeri'] as $gambar)
                        <img src="{{ asset($gambar) }}" alt="Dokumentasi {{ $paket['nama'] }}" loading="lazy">
                    @endforeach
                </div>
                <button class="detail-next" id="detail-next" type="button" aria-label="Geser galeri">&#8250;</button>
            </div>
        </article>
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/detail-paket.js') }}"></script>
</body>
</html>