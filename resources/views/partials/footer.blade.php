{{-- FOOTER (dipakai di semua halaman publik) --}}
<link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ filemtime(public_path('css/footer.css')) }}">
<footer class="footer">
    <div class="footer-main">
        <div class="footer-brand">
            <img class="footer-logo" src="{{ asset('images/logo-footer.png') }}" alt="Fahira Wedding">
        </div>

        <div class="footer-column">
            <h3>Menu</h3>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('paket') }}">Paket</a>
            <a href="{{ url('/wedding-calculator') }}">Wedding calculator</a>
            <a href="{{ url('/galeri') }}">Galeri</a>
            <a href="{{ route('tentang') }}">Tentang</a>
            <a href="{{ route('home') }}#konsultasi">Konsultasi</a>
        </div>

        <div class="footer-column">
            <h3>Layanan</h3>
            <a href="{{ route('paket') }}">Wedding Organizer</a>
            <a href="{{ route('paket') }}">Dekorasi</a>
            <a href="{{ route('paket') }}">Catering</a>
            <a href="{{ route('paket') }}">Dokumentasi</a>
            <a href="{{ route('paket') }}">Entertainment</a>
            <a href="{{ route('paket') }}">MUA dan Busana</a>
        </div>

        <div class="footer-column social-column">
            <h3>Sosial Media</h3>
            <a href="https://www.facebook.com/share/19wwmKsXe9/" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i><span>Facebook</span></a>
            <a href="https://maps.app.goo.gl/7vWY2TrRpU4AE29V8" target="_blank" rel="noopener noreferrer" aria-label="Maps"><i class="fa-solid fa-location-dot"></i><span>Maps</span></a>
            <a href="https://www.instagram.com/fahiraweddingsalon_?utm_source=ig_web_button_share_sheet&srtk=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i><span>Instagram</span></a>
        </div>
    </div>

    <div class="footer-bottom">
        <small class="copyright">Copyright © {{ date('Y') }} Fahira Wedding</small>
        <div class="footer-legal">
            <a href="#">Terms &amp; Conditions</a>
            <a href="#">Privacy Policy</a>
        </div>
    </div>
</footer>