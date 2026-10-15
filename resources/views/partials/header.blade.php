{{-- HEADER (dipakai di semua halaman kecuali home) --}}
@php
    // Ganti dengan nomor WhatsApp bisnis, pakai kode negara tanpa tanda +
    $waNumber = '6281234567890';
    $waText = 'Halo Fahira Wedding, saya ingin konsultasi mengenai paket pernikahan.';
@endphp

<header class="site-header paket-header" id="beranda">
    <a class="brand brand-header" href="{{ route('home') }}" aria-label="Fahira Wedding beranda">
        <img src="{{ asset('images/logo-fahira.png') }}" alt="Fahira Wedding">
    </a>

    <button class="menu-toggle" type="button"
        aria-label="Buka menu" aria-expanded="false">☰</button>

    <nav class="navigation" aria-label="Navigasi utama">
        <a href="{{ route('home') }}">Beranda</a>
        <a class="{{ request()->routeIs('paket', 'paket.detail') ? 'active' : '' }}"
           href="{{ route('paket') }}">Paket</a>
        <a class="{{ request()->is('wedding-calculator*') ? 'active' : '' }}"
           href="{{ url('/wedding-calculator') }}">Wedding Calculator</a>
        <a class="{{ request()->routeIs('tentang') ? 'active' : '' }}"
           href="{{ route('tentang') }}">Tentang</a>
        <a class="{{ request()->is('galeri') ? 'active' : '' }}"
           href="{{ url('/galeri') }}">Galeri</a>
        <a class="nav-cta"
           href="https://wa.me/{{ $waNumber }}?text={{ rawurlencode($waText) }}"
           target="_blank" rel="noopener noreferrer">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            <span>Konsultasi</span>
        </a>
    </nav>
</header>

<style>
    /* =====================================
       HEADER BERSAMA (semua halaman kecuali home)
       Bar tipis, menempel di atas saat scroll
       ===================================== */

    html:has(.paket-header) {
        scroll-padding-top: 84px;
    }

    .site-header.paket-header {
        position: sticky;
        top: 0;
        z-index: 100;
        height: 80px;
        min-height: 0;
        padding: 0 clamp(16px, 5vw, 72px);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: rgba(57, 55, 45, .97);
        border-bottom: 1px solid rgba(178, 155, 69, .5);
        transition: height .25s ease, background .25s ease, box-shadow .25s ease;
    }

    .site-header.paket-header.is-scrolled {
        height: 66px;
        background: rgba(43, 41, 34, .98);
        box-shadow: 0 6px 18px rgba(0, 0, 0, .35);
    }

    /* Logo tetap besar dan jelas, hanya mengecil sedikit saat scroll */
    .paket-header .brand-header {
        width: auto;
        min-height: 0;
    }

    /* File logo berbentuk persegi dengan ruang transparan di sekelilingnya,
       jadi kotaknya dibuat lebih besar dari bar agar gambar logo tampil jelas */
    .paket-header .brand-header img {
        width: auto;
        max-width: none;
        height: 118px;
        margin: -20px 0;
        object-fit: contain;
        filter: drop-shadow(0 1px 4px rgba(0, 0, 0, .6));
        transition: height .25s ease;
    }

    .paket-header.is-scrolled .brand-header img {
        height: 98px;
    }

    .paket-header .navigation {
        gap: 4px;
        font-size: 15px;
        font-weight: 500;
    }

    .paket-header .navigation a {
        padding: 8px 14px;
    }

    /* Tombol Konsultasi (ke WhatsApp), tampil beda dari menu lain */
    .paket-header .navigation a.nav-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-left: 12px;
        padding: 9px 20px;
        border: 1px solid #e9d36f;
        border-radius: 999px;
        background: linear-gradient(100deg, #6e0a1f, #c31538);
        box-shadow: 0 3px 10px rgba(195, 21, 56, .35);
        color: #fff;
        font-weight: 600;
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    }

    .paket-header .navigation a.nav-cta svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    .paket-header .navigation a.nav-cta:hover {
        background: linear-gradient(100deg, #6e0a1f, #c31538);
        color: #fff;
        filter: brightness(1.15);
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(195, 21, 56, .45);
    }

    @media (max-width: 1000px) {
        .paket-header .navigation {
            gap: 0;
            font-size: 14px;
        }

        .paket-header .navigation a {
            padding: 8px 10px;
        }
    }

    @media (max-width: 820px) {
        html:has(.paket-header) {
            scroll-padding-top: 72px;
        }

        .site-header.paket-header {
            height: 66px;
            padding: 0 16px;
        }

        .site-header.paket-header.is-scrolled {
            height: 58px;
        }

        .paket-header .brand-header img {
            height: 92px;
            margin: -14px 0;
        }

        .paket-header.is-scrolled .brand-header img {
            height: 80px;
        }

        .paket-header .navigation {
            top: calc(100% + 8px);
            left: 12px;
            right: 12px;
            gap: 4px;
            font-size: 15px;
        }

        .paket-header .navigation a {
            padding: 10px 12px;
        }

        .paket-header .navigation a.nav-cta {
            justify-content: center;
            margin: 6px 0 0;
            padding: 12px;
        }
    }
</style>

<script>
    (function () {
        var header = document.querySelector('.paket-header');
        if (!header) return;

        var ticking = false;

        function update() {
            header.classList.toggle('is-scrolled', window.scrollY > 24);
            ticking = false;
        }

        window.addEventListener('scroll', function () {
            if (!ticking) {
                window.requestAnimationFrame(update);
                ticking = true;
            }
        }, { passive: true });

        update();
    })();
</script>