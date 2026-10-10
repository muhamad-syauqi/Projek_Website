<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fahira Wedding</title>
    <meta name="description" content="Fahira Wedding - Sempurnakan hari bahagia Anda dengan sentuhan elegan.">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    {{-- Font elegan; hapus jika ingin memakai font lokal/offline --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        {{-- HERO --}}
        <section class="hero" id="beranda">
            <header class="site-header">
                <a class="brand brand-header" href="{{ route('home') }}"
                        aria-label="Fahira Wedding beranda">
                        <img src="{{ asset('images/logo-fahira.png') }}"
                        alt="Fahira Wedding">
                </a>

                <button class="menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false">☰</button>
                <nav class="navigation" aria-label="Navigasi utama">
                    <a class="active" href="#beranda">Beranda</a>
                    <a href="paket">Paket</a>
                    <a href="#calculator">Wedding Calculator</a>
                    <a href="#tentang">Tentang</a>
                    <a href="#galeri">Galeri</a>
                    <a href="#konsultasi">Konsultasi</a>
                    <a class="phone-link" href="#konsultasi" aria-label="Telepon">♧</a>
                </nav>
            </header>

            <div class="hero-copy">
                <h1>FAHIRA WEDDING</h1>
                <p>Sempurnakan Hari Bahagia Anda dengan Sentuhan Elegan<br class="desktop-only"> yang Mengubah Setiap Momen Menjadi Kenangan.</p>
            </div>
        </section>

        {{-- KEUNGGULAN --}}
        <section class="features" aria-label="Keunggulan Fahira Wedding">
            <article class="feature">
                <span class="feature-icon">♙</span>
                <p>Tim Profesional<br>Berpengalaman</p>
            </article>
            <article class="feature">
                <span class="feature-icon">▤</span>
                <p>Paket Lengkap<br>dan Fleksibel</p>
            </article>
            <article class="feature">
                <span class="feature-icon">▧</span>
                <p>Desain Custom<br>dan Sesuai Impian</p>
            </article>
            <article class="feature">
                <span class="feature-icon">♧</span>
                <p>Harga Transparan<br>Tanpa Biaya Tersembunyi</p>
            </article>
        </section>

        {{-- CERITA / GALERI --}}
        <section class="commitment" id="tentang">
            <div class="commitment-inner">
                <div class="photo-collage">
                    <img class="photo-back" src="{{ asset('images/foto-pengantin-2.jpg') }}" alt="Momen pernikahan">
                    <img class="photo-front" src="{{ asset('images/foto-pengantin-1.jpg') }}" alt="Pasangan pengantin">
                    <div class="photo-count"><strong>100<sup>+</sup></strong><small>Happy Moments</small></div>
                </div>
                <div class="commitment-copy">
                    <h2>Kami berkomitmen untuk menjadikan<br class="desktop-only"> pernikahan Anda tak terlupakan.</h2>
                    <p>Kami hadir untuk membantu Anda menciptakan momen pernikahan yang indah, berkesan, dan penuh makna. Dengan perencanaan yang matang, perhatian terhadap setiap detail, serta pelayanan yang sepenuh hati, kami berkomitmen untuk mewujudkan pernikahan impian Anda.</p>
                    <a class="button button-light" href="#galeri">Kunjungi Galeri</a>
                </div>
            </div>
        </section>

        {{-- PILIH LAYANAN --}}
        <section class="services" id="layanan">
            <div class="section-heading">
                <h2>Pilih layanan kami</h2>
                <p>Temukan layanan terbaik untuk hari istimewamu</p>
            </div>
            <div class="service-grid">
                <a class="service-card" id="paket" href="{{ url('/paket') }}">
                    <div class="service-image"><img src="{{ asset('images/paket-pernikahan.jpg') }}" alt="Paket pernikahan"></div>
                    <span class="service-icon">♙</span>
                    <h3>Paket pernikahan</h3>
                    <p>Pilih paket untuk hari istimewa mu</p>
                </a>
                <a class="service-card" id="calculator" href="{{ url('/wedding-calculator') }}">
                    <div class="service-image"><img src="{{ asset('images/wedding-calculator.jpg') }}" alt="Wedding calculator"></div>
                    <span class="service-icon">▦</span>
                    <h3>Wedding calculator</h3>
                    <p>Hitung estimasi biaya pernikahan anda</p>
                </a>
                <a class="service-card" href="#tentang">
                    <div class="service-image"><img src="{{ asset('images/tentang-kami.jpg') }}" alt="Tentang kami"></div>
                    <span class="service-icon">ⓘ</span>
                    <h3>Tentang kami</h3>
                    <p>Kenali kami lebih dekat</p>
                </a>
                <a class="service-card" id="galeri" href="{{ url('/galeri') }}">
                    <div class="service-image"><img src="{{ asset('images/galeri.jpg') }}" alt="Galeri pernikahan"></div>
                    <span class="service-icon">▧</span>
                    <h3>Galeri</h3>
                    <p>Lihat momen penuh makna</p>
                </a>
            </div>

            {{-- CTA WHATSAPP --}}
            <div class="whatsapp-cta" id="konsultasi">
                <a class="brand cta-brand" href="#beranda"
                    aria-label="Kembali ke beranda">
                    <img src="{{ asset('images/logo-fahira.png') }}"
                        alt="Fahira Wedding">
                </a>
                <div class="cta-copy">
                    <h2>Masih bingung memilih paket yang cocok</h2>
                    <p>Konsultasi dengan tim kami melalui whatsapp</p>
                </div>
                {{-- Ganti nomor di bawah dengan nomor WhatsApp bisnis, gunakan kode negara tanpa + --}}
                <a class="button whatsapp-button" href="https://wa.me/6281234567890?text={{ rawurlencode('Halo Fahira Wedding, saya ingin konsultasi mengenai paket pernikahan.') }}" target="_blank" rel="noopener">
                    <span class="whatsapp-symbol">◉</span> Chat Sekarang
                </a>
            </div>
            <div class="section-rule"></div>
        </section>

        {{-- FOOTER --}}
        <footer class="footer">
            
            <div class="footer-brand">
                <img
                    src="{{ asset('images/logo-footer.png') }}"
                    alt="Fahira Wedding"
                    class="footer-logo"
                >

                <small>Copyright © {{ date('Y') }}</small>
            </div>
            <div class="footer-column">
                <h3>Menu</h3>
                <a href="#beranda">Beranda</a>
                <a href="#paket">Paket</a>
                <a href="#calculator">Wedding calculator</a>
                <a href="#galeri">Galeri</a>
                <a href="#tentang">Tentang</a>
                <a href="#konsultasi">Konsultasi</a>
            </div>
            <div class="footer-column">
                <h3>Layanan</h3>
                <a href="#layanan">Wedding Organizer</a>
                <a href="#layanan">Dekorasi</a>
                <a href="#layanan">Catering</a>
                <a href="#layanan">Dokumentasi</a>
                <a href="#layanan">Entertainment</a>
                <a href="#layanan">MUA dan Busana</a>
            </div>
            <div class="footer-column social-column">
                <h3>Sosial Media</h3>
                <a href="#" aria-label="Facebook">f&nbsp; Facebook</a>
                <a href="#" aria-label="Twitter">♥&nbsp; Twitter</a>
                <a href="#" aria-label="Instagram">◎&nbsp; Instagram</a>
            </div>
        </footer>
    </main>
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>
