{{-- HEADER (dipakai di semua halaman kecuali home) --}}
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
        <a class="{{ request()->is('wedding-calculator') ? 'active' : '' }}"
           href="{{ url('/wedding-calculator') }}">Wedding Calculator</a>
        <a class="{{ request()->routeIs('tentang') ? 'active' : '' }}"
           href="{{ route('tentang') }}">Tentang</a>
        <a class="{{ request()->is('galeri') ? 'active' : '' }}"
           href="{{ url('/galeri') }}">Galeri</a>
        <a href="{{ route('home') }}#konsultasi">Konsultasi</a>
    </nav>
</header>