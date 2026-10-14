<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Wedding Calculator - Fahira Wedding</title>
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

    @php
        $defaultAddons = collect($config['addons'])
            ->filter(fn ($addon) => $addon['default'])
            ->keys()
            ->all();

        $selectedAddons = old('addons', $errors->any() ? [] : $defaultAddons);
    @endphp

    @include('partials.header')

    {{-- HERO (memakai gaya hero halaman paket) --}}
    <section class="paket-hero">
        <div class="paket-hero-overlay"></div>

        <div class="paket-hero-content">
            <h1>Wedding Calculator</h1>
            <p>Hitung estimasi biaya pernikahan impian Anda dalam hitungan menit</p>
        </div>
    </section>

    <main class="kalk-main">

        {{-- INDIKATOR LANGKAH --}}
        <nav class="kalk-steps" aria-label="Langkah calculator">
            <a class="kalk-step is-current" href="#kalk-data"><b>1</b>Data Acara</a>
            <span class="kalk-step-line"></span>
            <a class="kalk-step" href="#kalk-layanan"><b>2</b>Pilih Layanan</a>
            <span class="kalk-step-line"></span>
            <a class="kalk-step" href="#kalk-ringkasan"><b>3</b>Estimasi Biaya</a>
        </nav>

        @if ($errors->any())
            <div class="kalk-alert" role="alert">
                Data belum valid, silakan periksa kembali pilihan Anda.
            </div>
        @endif

        <form id="kalk-form" class="kalk-layout" method="POST"
              action="{{ route('kalkulator.pdf') }}">
            @csrf

            {{-- KOLOM KIRI --}}
            <div>

                {{-- 1. DATA ACARA --}}
                <section class="kalk-card" id="kalk-data">
                    <div class="kalk-card-h">
                        <span class="kalk-n">1</span>
                        <h2>Data Acara</h2>
                        <small>Dasar perhitungan biaya</small>
                    </div>

                    <div class="kalk-card-b">
                        <div class="kalk-field">
                            <label class="kalk-lbl" for="guests">Jumlah tamu undangan</label>

                            <div class="kalk-guest">
                                <div class="kalk-stepper">
                                    <button type="button" data-guest-step="-10"
                                            aria-label="Kurangi 10 tamu">−</button>
                                    <input type="number" id="guests" name="guests"
                                           min="{{ $config['min_guests'] }}"
                                           max="{{ $config['max_guests'] }}"
                                           step="1"
                                           value="{{ old('guests', 300) }}">
                                    <button type="button" data-guest-step="10"
                                            aria-label="Tambah 10 tamu">+</button>
                                </div>
                                <em>orang · geser untuk mengubah jumlah</em>
                            </div>

                            <input type="range" id="guests-range" class="kalk-range"
                                   min="50" max="500" step="10"
                                   value="{{ old('guests', 300) }}"
                                   aria-label="Geser jumlah tamu">

                            <div class="kalk-ticks" aria-hidden="true">
                                <span>50</span><span>200</span><span>350</span><span>500+</span>
                            </div>
                        </div>

                        <div class="kalk-field">
                            <div class="kalk-lbl">Konsep acara</div>
                            <div class="kalk-chips">
                                @foreach ($config['concepts'] as $key => $label)
                                    <label class="kalk-chip">
                                        <input type="radio" name="concept" value="{{ $key }}"
                                               @checked(old('concept', 'adat-sunda') === $key)>
                                        <span>{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="kalk-field kalk-two">
                            <div>
                                <div class="kalk-lbl">Lokasi acara</div>
                                <div class="kalk-chips">
                                    @foreach ($config['venues'] as $key => $label)
                                        <label class="kalk-chip">
                                            <input type="radio" name="venue" value="{{ $key }}"
                                                   @checked(old('venue', 'rumah') === $key)>
                                            <span>{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <div class="kalk-lbl">Durasi acara</div>
                                <div class="kalk-chips">
                                    @foreach ($config['durations'] as $key => $label)
                                        <label class="kalk-chip">
                                            <input type="radio" name="duration" value="{{ $key }}"
                                                   @checked(old('duration', 'satu-hari') === $key)>
                                            <span>{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 2. PILIH LAYANAN --}}
                <section class="kalk-card" id="kalk-layanan">
                    <div class="kalk-card-h">
                        <span class="kalk-n">2</span>
                        <h2>Pilih Layanan</h2>
                        <small>Pilih tingkat paket tiap layanan</small>
                    </div>

                    <div class="kalk-card-b">
                        @foreach ($config['services'] as $key => $service)
                            <div class="kalk-svc">
                                <div class="kalk-ico" aria-hidden="true">
                                    <i class="{{ $service['icon'] }}"></i>
                                </div>

                                <div>
                                    <h3>{{ $service['label'] }}</h3>
                                    <p>{{ $service['desc'] }}</p>
                                </div>

                                <div class="kalk-seg" role="radiogroup"
                                     aria-label="Tingkat {{ $service['label'] }}">
                                    @foreach ($config['tiers'] as $tierKey => $tierLabel)
                                        <label>
                                            <input type="radio" name="tier[{{ $key }}]"
                                                   value="{{ $tierKey }}"
                                                   @checked(old("tier.$key", $service['default']) === $tierKey)>
                                            <span>{{ $tierLabel }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                <div class="kalk-price" data-price-for="{{ $key }}"></div>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- 3. LAYANAN TAMBAHAN --}}
                <section class="kalk-card">
                    <div class="kalk-card-h">
                        <span class="kalk-n">3</span>
                        <h2>Layanan Tambahan</h2>
                        <small>Opsional</small>
                    </div>

                    <div class="kalk-card-b">
                        <div class="kalk-addons">
                            @foreach ($config['addons'] as $key => $addon)
                                <label class="kalk-add">
                                    <input type="checkbox" name="addons[]" value="{{ $key }}"
                                           @checked(in_array($key, $selectedAddons, true))>
                                    <span class="kalk-add-box"><i class="fa-solid fa-check"></i></span>
                                    <span>
                                        <b>{{ $addon['label'] }}</b>
                                        <small>+ Rp {{ number_format($addon['price'], 0, ',', '.') }}</small>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>

            {{-- KOLOM KANAN: RINGKASAN --}}
            <aside class="kalk-sum" id="kalk-ringkasan" aria-live="polite">
                <div class="kalk-card">
                    <div class="kalk-sum-h">
                        <h2>Estimasi Biaya</h2>
                        <p>Diperbarui otomatis saat Anda memilih</p>
                    </div>

                    <div class="kalk-meta" id="kalk-meta"></div>
                    <div class="kalk-rows" id="kalk-rows"></div>

                    <div class="kalk-total">
                        <small>Total estimasi</small>
                        <strong id="kalk-total">Rp 0</strong>
                        <em>Estimasi awal, harga final setelah konsultasi</em>
                    </div>

                    <div class="kalk-reco" id="kalk-reco" hidden></div>

                    <div class="kalk-btns">
                        <button type="submit" class="kalk-btn kalk-btn-p">
                            <i class="fa-solid fa-file-pdf"></i> Unduh Estimasi (PDF)
                        </button>

                        <a id="kalk-wa" class="kalk-btn kalk-btn-o" href="#"
                           target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-whatsapp"></i> Konsultasi via WhatsApp
                        </a>

                        <a class="kalk-btn kalk-btn-o" href="{{ route('paket') }}">
                            Lihat Paket Pernikahan
                        </a>
                    </div>
                </div>

                <p class="kalk-note">
                    Harga di atas adalah perkiraan dan dapat berubah sesuai tanggal,
                    lokasi, dan kebutuhan acara Anda.
                </p>
            </aside>
        </form>
    </main>

    {{-- BANNER KONSULTASI --}}
    <section class="paket-cta">
        <div class="paket-cta-inner">
            <div>
                <h2>Masih Bingung Memilih Paket?</h2>
                <p>Konsultasikan kebutuhan pernikahan Anda bersama kami.</p>
            </div>

            <a class="paket-whatsapp"
               href="https://wa.me/{{ $config['whatsapp'] }}?text={{ rawurlencode('Halo Fahira Wedding, saya ingin konsultasi paket pernikahan.') }}"
               target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-whatsapp"></i>
                Konsultasi
            </a>
        </div>
    </section>

    @include('partials.footer')

    <script>
        window.KALKULATOR = @json($calculatorData);
    </script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/kalkulator.js') }}"></script>

</body>
</html>