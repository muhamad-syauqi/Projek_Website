
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Package - Fahira Wedding</title>
    <meta name="description" content="Pilih paket pernikahan Fahira Wedding sesuai kebutuhan Anda.">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paket.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="paket-page">

    {{-- HEADER --}}
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
            <a href="#konsultasi">Konsultasi</a>
        </nav>
    </header>

    {{-- HERO --}}
    <section class="paket-hero">
        <div class="paket-hero-overlay"></div>

        <div class="paket-hero-content">
            <h1>Wedding Package</h1>
            <p>Pilih paket yang sesuai dan cocok dengan kriteria anda</p>
        </div>
    </section>

    {{-- DAFTAR PAKET --}}
    <main class="paket-main" id="paket">

        {{-- FILTER --}}
        <div class="paket-filters" aria-label="Filter kategori paket">
            <button type="button" class="filter-btn active" data-filter="semua">
                Semua
            </button>
            <button type="button" class="filter-btn" data-filter="cinta">
                Paket cinta
            </button>
            <button type="button" class="filter-btn" data-filter="bahagia">
                Paket bahagia
            </button>
            <button type="button" class="filter-btn" data-filter="impian">
                Paket impian
            </button>
            <button type="button" class="filter-btn" data-filter="lainnya">
                Lainnya
            </button>
        </div>

        {{-- KARTU PAKET --}}
        <div class="paket-grid">

            {{-- PAKET 1 --}}
            <article class="paket-card" data-category="cinta">
                <div class="paket-image">
                    <img src="{{ asset('images/paket/paket-pertama.jpg') }}"
                         alt="Paket Wedding Cinta">
                </div>

                <div class="paket-card-content">
                    <div class="paket-tags">
                        <span>Rias Pengantin <b>✓</b></span>
                        <span>Dokumentasi <b>✓</b></span>
                    </div>

                    <p class="paket-description">
                        Popular package with complete benefits for modern events
                    </p>

                    <p class="paket-price">Rp 19.000.000</p>

                    <div class="paket-actions">
                        <a class="paket-btn paket-btn-primary"
                           href="#konsultasi"
                           data-package="Paket Cinta">
                            Pilih Paket
                        </a>
                        <a class="paket-btn paket-btn-outline"
                           href="#konsultasi"
                           data-package="Paket Cinta">
                            Detail
                        </a>
                        <a class="paket-arrow" href="#konsultasi"
                           data-package="Paket Cinta" aria-label="Detail Paket Cinta">↳</a>
                    </div>
                </div>
            </article>

            {{-- PAKET 2 --}}
            <article class="paket-card" data-category="bahagia">
                <div class="paket-image">
                    <img src="{{ asset('images/paket/paket-kedua.jpg') }}"
                         alt="Paket Wedding Bahagia">
                </div>

                <div class="paket-card-content">
                    <div class="paket-tags">
                        <span>Rias Pengantin <b>✓</b></span>
                        <span>Dokumentasi <b>✓</b></span>
                        <span>Hiburan <b>✓</b></span>
                        <span>Upacara Adat <b>✓</b></span>
                        <span>Makeup <b>✓</b></span>
                    </div>

                    <p class="paket-description">
                        Popular package with complete benefits for modern events
                    </p>

                    <p class="paket-price">Rp 27.000.000</p>

                    <div class="paket-actions">
                        <a class="paket-btn paket-btn-primary"
                           href="#konsultasi" data-package="Paket Bahagia">
                            Pilih Paket
                        </a>
                        <a class="paket-btn paket-btn-outline"
                           href="#konsultasi" data-package="Paket Bahagia">
                            Detail
                        </a>
                        <a class="paket-arrow" href="#konsultasi"
                           data-package="Paket Bahagia" aria-label="Detail Paket Bahagia">↳</a>
                    </div>
                </div>
            </article>

            {{-- PAKET 3 --}}
            <article class="paket-card" data-category="impian">
                <div class="paket-image">
                    <img src="{{ asset('images/paket-impian.jpg') }}"
                         alt="Paket Wedding Impian">
                </div>

                <div class="paket-card-content">
                    <div class="paket-tags">
                        <span>Tenda Dekorasi <b>✓</b></span>
                        <span>Hiburan <b>✓</b></span>
                        <span>Makeup & Attire <b>✓</b></span>
                        <span>Lenser Lampe <b>✓</b></span>
                        <span>Acara <b>✓</b></span>
                        <span>Siraman <b>✓</b></span>
                    </div>

                    <p class="paket-description">
                        Popular package with complete benefits for modern events
                    </p>

                    <p class="paket-price">Rp 31.000.000</p>

                    <div class="paket-actions">
                        <a class="paket-btn paket-btn-primary"
                           href="#konsultasi" data-package="Paket Impian">
                            Pilih Paket
                        </a>
                        <a class="paket-btn paket-btn-outline"
                           href="#konsultasi" data-package="Paket Impian">
                            Detail
                        </a>
                        <a class="paket-arrow" href="#konsultasi"
                           data-package="Paket Impian" aria-label="Detail Paket Impian">↳</a>
                    </div>
                </div>
            </article>

            {{-- PAKET 4 --}}
            <article class="paket-card" data-category="bahagia">
                <div class="paket-image">
                    <img src="{{ asset('images/paket-lainnya.jpg') }}"
                         alt="Paket Wedding Resepsi">
                </div>

                <div class="paket-card-content">
                    <div class="paket-tags">
                        <span>Rias Pengantin <b>✓</b></span>
                        <span>Dokumentasi <b>✓</b></span>
                        <span>Hiburan <b>✓</b></span>
                    </div>

                    <p class="paket-description">
                        Popular package with complete benefits for modern events
                    </p>

                    <p class="paket-price">Rp 22.500.000</p>

                    <div class="paket-actions">
                        <a class="paket-btn paket-btn-primary"
                           href="#konsultasi" data-package="Paket Resepsi">
                            Pilih Paket
                        </a>
                        <a class="paket-btn paket-btn-outline"
                           href="#konsultasi" data-package="Paket Resepsi">
                            Detail
                        </a>
                        <a class="paket-arrow" href="#konsultasi"
                           data-package="Paket Resepsi" aria-label="Detail Paket Resepsi">↳</a>
                    </div>
                </div>
            </article>

            {{-- PAKET 5 --}}
            <article class="paket-card paket-card-last" data-category="lainnya">
                <div class="paket-image">
                    <img src="{{ asset('images/paket-makeup-attire.jpg') }}"
                         alt="Paket Makeup dan Attire">
                </div>

                <div class="paket-card-content">
                    <div class="paket-tags">
                        <span>Rias Pengantin <b>✓</b></span>
                        <span>Pager Ayu 4 <b>✓</b></span>
                    </div>

                    <p class="paket-description">
                        Popular package with complete benefits for modern events
                    </p>

                    <p class="paket-price">Rp 9.000.000</p>

                    <div class="paket-actions">
                        <a class="paket-btn paket-btn-primary"
                           href="#konsultasi" data-package="Paket Makeup & Attire">
                            Pilih Paket
                        </a>
                        <a class="paket-btn paket-btn-outline"
                           href="#konsultasi" data-package="Paket Makeup & Attire">
                            Detail
                        </a>
                        <a class="paket-arrow" href="#konsultasi"
                           data-package="Paket Makeup & Attire" aria-label="Detail Paket Makeup dan Attire">↳</a>
                    </div>
                </div>
            </article>

        </div>
    </main>

    {{-- KONSULTASI --}}
    <section class="paket-cta" id="konsultasi">
        <div class="paket-cta-inner">
            <div>
                <h2>Mau tanya tentang paket wedding dari kami?</h2>
                <p>Langsung konsultasi dengan tim kami melalui whatsapp</p>
            </div>

            <a class="paket-whatsapp"
               href="https://wa.me/6281234567890"
               target="_blank" rel="noopener noreferrer">
                <span>◉</span> Chat Sekarang
            </a>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="paket-footer">
        <div class="paket-footer-brand">
            <img src="{{ asset('images/logo-footer.png') }}"
                 alt="Fahira Wedding">
            <small>Copyright © {{ date('Y') }}</small>
        </div>

        <div class="paket-footer-column">
            <h3>Menu</h3>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('paket') }}">Paket</a>
            <a href="{{ url('/wedding-calculator') }}">Wedding calculator</a>
            <a href="{{ url('/galeri') }}">Galeri</a>
            <a href="{{ route('home') }}#tentang">Tentang</a>
            <a href="#konsultasi">Konsultasi</a>
        </div>

        <div class="paket-footer-column">
            <h3>Layanan</h3>
            <a href="#paket">Wedding Organizer</a>
            <a href="#paket">Dekorasi</a>
            <a href="#paket">Catering</a>
            <a href="#paket">Dokumentasi</a>
            <a href="#paket">Entertainment</a>
            <a href="#paket">MUA dan Busana</a>
        </div>

        <div class="paket-footer-column">
            <h3>Sosial Media</h3>
            <a href="#" aria-label="Facebook">f &nbsp; Facebook</a>
            <a href="#" aria-label="Twitter">♥ &nbsp; Twitter</a>
            <a href="#" aria-label="Instagram">◎ &nbsp; Instagram</a>
        </div>
    </footer>

    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/paket.js') }}"></script>
</body>
</html>
