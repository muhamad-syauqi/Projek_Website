<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - Fahira Wedding</title>
    <meta name="description" content="Kumpulan momen berharga bersama klien Fahira Wedding.">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paket.css') }}">
    <link rel="stylesheet" href="{{ asset('css/galeri.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="paket-page galeri-page">

    @include('partials.header')

    {{-- HERO --}}
    <section class="galeri-hero">
        <div class="galeri-hero-overlay"></div>
        <div class="galeri-hero-content">
            <h1>Album</h1>
            <p>Kumpulan moment berharga dengan client kami</p>
        </div>
    </section>

    <main class="galeri-main">

        {{-- FILTER BULAN --}}
        <nav class="galeri-filter" aria-label="Filter galeri berdasarkan bulan">
            <a href="{{ route('galeri') }}" class="{{ ! $bulan ? 'on' : '' }}">Semua</a>

            @foreach ($months as $month)
                <a href="{{ route('galeri', ['bulan' => $month['value']]) }}"
                   class="{{ $bulan === $month['value'] ? 'on' : '' }}">
                    {{ $month['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- GRID FOTO --}}
        @if ($galleries->isEmpty())
            <div class="galeri-empty">
                @if ($bulan)
                    Belum ada foto pada bulan ini.
                @else
                    Belum ada foto di galeri.
                @endif
            </div>
        @else
            <div class="galeri-grid">
                @foreach ($galleries as $gallery)
                    <figure class="galeri-card">
                        <button type="button" class="galeri-photo"
                                data-full="{{ asset('storage/'.$gallery->image) }}"
                                data-caption="{{ $gallery->title }}{{ $gallery->venue ? ' - '.$gallery->venue : '' }}"
                                aria-label="Perbesar foto {{ $gallery->title }}">
                            <img src="{{ asset('storage/'.$gallery->image) }}"
                                 alt="{{ $gallery->title }}" loading="lazy">
                        </button>

                        <figcaption>
                            <b>{{ $gallery->title }}</b>

                            @if ($gallery->venue)
                                <small class="venue">
                                    <svg class="pin" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12 21s7-6.2 7-11.5A7 7 0 0 0 5 9.5C5 14.8 12 21 12 21z"/>
                                        <circle cx="12" cy="9.5" r="2.5"/>
                                    </svg>
                                    <span>{{ $gallery->venue }}</span>
                                </small>
                            @endif
                        </figcaption>
                    </figure>
                @endforeach
            </div>

            @if ($galleries->hasPages())
                <div class="galeri-pager">
                    {{ $galleries->links('vendor.pagination.admin') }}
                </div>
            @endif
        @endif
    </main>

    {{-- LIGHTBOX --}}
    <div class="lightbox" id="lightbox" hidden>
        <button type="button" class="lightbox-close" id="lightbox-close" aria-label="Tutup">&times;</button>
        <img id="lightbox-img" alt="">
        <p id="lightbox-caption"></p>
    </div>

    @include('partials.footer')

    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/galeri.js') }}"></script>
</body>
</html>