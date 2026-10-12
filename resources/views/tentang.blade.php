<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Fahira Wedding</title>
    <meta name="description" content="Fahira Wedding berkomitmen memberikan pelayanan terbaik dalam membantu mewujudkan momen pernikahan yang berkesan bagi setiap pasangan.">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paket.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="paket-page about-page">

   @include('partials.header')

    {{-- HERO --}}
    <section class="about-hero">
        <div class="about-hero-overlay"></div>
        <div class="about-hero-content">
            <h1>Tentang Fahira Wedding</h1>
            <p>Fahira Wedding berkomitmen untuk memberikan pelayanan terbaik dalam membantu mewujudkan momen pernikahan yang berkesan bagi setiap pasangan.</p>
        </div>
    </section>

    <main class="about-main">
        <div class="about-rule"></div>

        {{-- SIAPA KAMI --}}
        <section class="about-who">
            <div class="about-who-copy">
                <h2>Siapa kami?</h2>
                <p>Fahira Wedding adalah penyedia jasa yang bergerak di bidang pelayanan dan penyelenggaraan acara pernikahan. Kami hadir untuk membantu setiap pasangan mewujudkan acara pernikahan yang indah, berkesan, dan sesuai dengan kebutuhan serta keinginan pelanggan.</p>

                <a class="about-btn" href="{{ route('home') }}#layanan">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                    Lihat layanan kami
                </a>
            </div>

            <div class="about-photo" role="img" aria-label="Pasangan pengantin Fahira Wedding"></div>
        </section>

        <div class="about-rule about-rule-bottom"></div>

        {{-- KEUNGGULAN --}}
        <section class="about-features" aria-label="Keunggulan Fahira Wedding">
            <article class="about-feature">
                <h3>Competitive Price</h3>
                <p>The best offers with guaranteed quality.</p>
            </article>
            <article class="about-feature">
                <h3>Various Packages</h3>
                <p>Many package options from intimate to grand wedding.</p>
            </article>
            <article class="about-feature">
                <h3>Professional Service</h3>
                <p>Creating unforgettable moments for every couple.</p>
            </article>
            <article class="about-feature">
                <h3>Memorable Moment</h3>
                <p>Creating unforgettable moments for every couple.</p>
            </article>
        </section>
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>