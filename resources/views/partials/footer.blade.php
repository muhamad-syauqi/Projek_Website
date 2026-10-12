{{-- FOOTER (dipakai di home dan paket) --}}
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
            <a href="{{ route('home') }}#tentang">Tentang</a>
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
            <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i><span>Facebook</span></a>
            <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i><span>Twitter</span></a>
            <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i><span>Instagram</span></a>
        </div>
    </div>

    <div class="footer-bottom">
        <small class="copyright">Copyright © {{ date('Y') }}</small>
        <div class="footer-legal">
            <a href="#">Terms &amp; Conditions</a>
            <a href="#">Privacy Policy</a>
        </div>
    </div>
</footer>