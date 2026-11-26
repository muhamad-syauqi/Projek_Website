@php
    $groups = $package->facility_groups;
    $labels = \App\Models\Package::FACILITY_GROUPS;

    $halfKeys = array_values(array_filter(
        array_keys($groups),
        fn ($k) => in_array($k, ['dekorasi', 'rias', 'hiburan', 'upacara', 'siraman'], true)
    ));
    $loneHalf = count($halfKeys) % 2 === 1 ? end($halfKeys) : null;
    $priceText = 'Rp. ' . number_format($package->price, 0, ',', '.');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail {{ $package->name }} - Fahira Wedding</title>
    @include('partials.favicon')

    <meta name="description"
          content="Detail fasilitas dan harga {{ $package->name }} dari Fahira Wedding.">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paket.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-paket.css') }}?v={{ filemtime(public_path('css/detail-paket.css')) }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Montserrat:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap"
          rel="stylesheet">
</head>

<body class="paket-page detail-page">

    @include('partials.header')

    <main class="detail-wrap">

        {{-- FOTO + INFORMASI PAKET --}}
        <section class="detail-top">

            <div class="detail-photo">
                @if ($package->image)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($package->image) }}"
                         alt="{{ $package->name }}">
                @else
                    <img src="{{ asset('images/paket/hero-paket.jpg') }}"
                         alt="{{ $package->name }}">
                @endif
            </div>

            <div class="detail-info">
                <h1>Detail {{ $package->name }}</h1>
                <p class="detail-price">{{ $priceText }}</p>
                <p class="detail-desc">{{ $package->description }}</p>
            </div>

        </section>

        <hr class="detail-rule">

        {{-- FASILITAS PAKET --}}
        <section class="facility-section">
            <h2 class="facility-heading">Fasilitas Paket</h2>

            @if (count($groups) > 0)
                <div class="facility-grid">
                    @foreach ($groups as $key => $items)
                        <article class="facility-card facility-{{ $key }}{{ $key === $loneHalf ? ' is-wide' : '' }}">
                            <h3>{{ $labels[$key] }}</h3>

                            <ul>
                                @foreach ($items as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="facility-empty">
                    Fasilitas dapat dikonsultasikan langsung bersama tim kami.
                </p>
            @endif
        </section>

        <hr class="detail-rule detail-rule-bottom">

        {{-- ESTIMASI HARGA + KONSULTASI --}}
        <section class="detail-estimate">
            <div>
                <h2>Estimasi Harga</h2>
                <p class="detail-price">{{ $priceText }}</p>
            </div>

            <a class="detail-wa"
               href="{{ $waUrl }}"
               target="_blank"
               rel="noopener noreferrer">
                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                <span>Konsultasi</span>
            </a>
        </section>

    </main>

    <script src="{{ asset('js/home.js') }}"></script>

</body>
</html>