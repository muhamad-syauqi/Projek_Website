<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail {{ $package->name }} - Fahira Wedding</title>

    <meta name="description"
          content="Detail fasilitas dan harga {{ $package->name }} dari Fahira Wedding.">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paket.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-paket.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap"
          rel="stylesheet">
</head>

<body class="paket-page detail-page">

    @include('partials.header')

    <main class="detail-wrap">
        <article class="detail-card">

            {{-- FOTO UTAMA --}}
            <div class="detail-photo">

                @if ($package->image)
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url($package->image) }}"
                        alt="{{ $package->name }}">
                @else
                    <img
                        src="{{ asset('images/paket/hero-paket.jpg') }}"
                        alt="{{ $package->name }}">
                @endif

                <a class="detail-close"
                   href="{{ route('paket') }}"
                   aria-label="Kembali ke daftar paket">

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 5l14 14M19 5L5 19"/>
                    </svg>

                </a>
            </div>

            {{-- INFORMASI PAKET --}}
            <div class="detail-body">

                <h1>{{ $package->name }}</h1>

                <p class="detail-price">
                    Rp {{ number_format($package->price, 0, ',', '.') }}
                </p>

                <p class="detail-desc">
                    {{ $package->description }}
                </p>

                <hr class="detail-rule">

                {{-- FASILITAS --}}
                <h2>Fasilitas Paket</h2>

                <div class="detail-facilities">
                    <div class="detail-col">

                        <span class="detail-bookmark"
                              aria-hidden="true"></span>

                        <ul>
                            @forelse (($package->facilities ?? []) as $facility)
                                <li>{{ $facility }}</li>
                            @empty
                                <li>
                                    Fasilitas dapat dikonsultasikan
                                    langsung bersama tim kami.
                                </li>
                            @endforelse
                        </ul>

                    </div>
                </div>

                <hr class="detail-rule detail-rule-bottom">

                {{-- HARGA DAN KONSULTASI --}}
                <div class="detail-estimate">

                    <h2>Estimasi Harga</h2>

                    <p class="detail-price">
                        Rp {{ number_format($package->price, 0, ',', '.') }}
                    </p>

                    <a class="detail-wa"
                       href="{{ $waUrl }}"
                       target="_blank"
                       rel="noopener noreferrer">

                        <i class="fa-brands fa-whatsapp"
                           aria-hidden="true"></i>

                        Konsultasi

                    </a>

                    <p class="detail-note">
                        *Harga dapat berubah sesuai kebutuhan dan lokasi.
                    </p>

                </div>

            </div>

        </article>
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/detail-paket.js') }}"></script>

</body>
</html>
