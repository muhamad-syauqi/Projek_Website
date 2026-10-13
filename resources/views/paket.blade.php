<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Wedding Package - Fahira Wedding</title>
    <meta name="description"
          content="Pilih paket pernikahan Fahira Wedding sesuai kebutuhan Anda.">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paket.css') }}">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap"
          rel="stylesheet">
</head>

<body class="paket-page">

    @include('partials.header')

    {{-- HERO --}}
    <section class="paket-hero">
        <div class="paket-hero-overlay"></div>

        <div class="paket-hero-content">
            <h1>Wedding Package</h1>
            <p>Pilih paket yang sesuai dengan kebutuhan Anda</p>
        </div>
    </section>

    {{-- DAFTAR PAKET --}}
    <main class="paket-main" id="paket">

        {{-- FILTER KATEGORI --}}
        <div class="paket-filters" aria-label="Filter kategori paket">

            <button type="button"
                    class="filter-btn active"
                    data-filter="semua">
                Semua
            </button>

            <button type="button"
                    class="filter-btn"
                    data-filter="cinta">
                Paket Cinta
            </button>

            <button type="button"
                    class="filter-btn"
                    data-filter="bahagia">
                Paket Bahagia
            </button>

            <button type="button"
                    class="filter-btn"
                    data-filter="impian">
                Paket Impian
            </button>

            <button type="button"
                    class="filter-btn"
                    data-filter="lainnya">
                Lainnya
            </button>

        </div>

        {{-- KARTU PAKET DINAMIS --}}
        <div class="paket-grid">

            @forelse ($packages as $package)

                <article class="paket-card"
                         data-category="{{ $package->category }}">

                    {{-- FOTO PAKET --}}
                    <div class="paket-image">
                        @if ($package->image)
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($package->image) }}"
                                alt="{{ $package->name }}"
                                loading="lazy">
                        @else
                            <img
                                src="{{ asset('images/paket/hero-paket.jpg') }}"
                                alt="{{ $package->name }}"
                                loading="lazy">
                        @endif
                    </div>

                    <div class="paket-card-content">

                        {{-- FASILITAS --}}
                        <div class="paket-tags">

                            @forelse (($package->facilities ?? []) as $facility)
                                <span>
                                    {{ $facility }}
                                    <b>✓</b>
                                </span>
                            @empty
                                <span>
                                    Informasi fasilitas tersedia saat konsultasi
                                </span>
                            @endforelse

                        </div>

                        {{-- DESKRIPSI --}}
                        <p class="paket-description">
                            {{ $package->description }}
                        </p>

                        {{-- HARGA --}}
                        <p class="paket-price">
                            Rp {{ number_format($package->price, 0, ',', '.') }}
                        </p>

                        {{-- TOMBOL --}}
                        <div class="paket-actions">

                            <a class="paket-btn paket-btn-primary"
                               href="https://wa.me/6281234567890?text={{ rawurlencode('Halo Fahira Wedding, saya ingin konsultasi mengenai ' . $package->name . '.') }}"
                               target="_blank"
                               rel="noopener noreferrer">
                                Pilih Paket
                            </a>

                            <a class="paket-btn paket-btn-outline"
                               href="{{ route('paket.detail', ['slug' => $package->slug]) }}">
                                Detail
                            </a>

                            <a class="paket-arrow"
                               href="{{ route('paket.detail', ['slug' => $package->slug]) }}"
                               aria-label="Lihat detail {{ $package->name }}">
                                ↳
                            </a>

                        </div>

                    </div>
                </article>

            @empty

                <div class="paket-empty">
                    <h2>Belum Ada Paket</h2>
                    <p>
                        Paket pernikahan belum tersedia.
                        Silakan kunjungi kembali nanti.
                    </p>
                </div>

            @endforelse

        </div>
    </main>

    {{-- BANNER KONSULTASI --}}
    <section class="paket-cta">
        <div class="paket-cta-inner">

            <div>
                <h2>Masih Bingung Memilih Paket?</h2>
                <p>Konsultasikan kebutuhan pernikahan Anda bersama kami.</p>
            </div>

            <a class="paket-whatsapp"
               href="https://wa.me/62895343552652?text={{ rawurlencode('Halo Fahira Wedding, saya ingin konsultasi paket pernikahan.') }}"
               target="_blank"
               rel="noopener noreferrer">

                <i class="fa-brands fa-whatsapp"></i>
                Konsultasi

            </a>

        </div>
    </section>

    @include('partials.footer')

    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/paket.js') }}"></script>

</body>
</html>
