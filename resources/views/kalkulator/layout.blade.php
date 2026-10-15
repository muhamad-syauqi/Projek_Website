<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Wedding Calculator') - Fahira Wedding</title>
    <meta name="description"
          content="Hitung estimasi biaya pernikahan Anda bersama Fahira Wedding.">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paket.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kalkulator.css') }}">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap"
          rel="stylesheet">
</head>

<body class="paket-page kalkulator-page">

    @include('partials.header')

    @if (($step ?? 0) > 0)
        {{-- HERO langkah --}}
        <section class="kw-hero">
            <div class="kw-hero-in">
                <div>
                    <div class="kw-kic">Wedding Calculator</div>
                    <h1>{{ $judul }}</h1>
                    <p>{{ $sub }}</p>
                </div>
                <div class="kw-pill">Langkah {{ $step }} dari 4</div>
            </div>
        </section>

        <div class="kw-wrap">
            @include('kalkulator.partials.progress', ['current' => $step])

            @if ($errors->any())
                <div class="kw-alert" role="alert">
                    Data belum valid, silakan periksa kembali pilihan Anda.
                </div>
            @endif

            @yield('content')
        </div>
    @else
        @yield('content')
    @endif

    @include('partials.footer')

    @isset($calculatorData)
        <script>
            window.KALKULATOR = @json($calculatorData);
        </script>
    @endisset

    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/kalkulator.js') }}"></script>

</body>
</html>