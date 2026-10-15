@use('App\Support\WeddingEstimator', 'Estimator')

@php
    $waLink = 'https://wa.me/' . $whatsapp . '?text='
        . rawurlencode('Halo Fahira Wedding, saya ingin konsultasi mengenai paket pernikahan.');

    $categoryLabels = [
        'cinta' => 'Cinta',
        'bahagia' => 'Bahagia',
        'impian' => 'Impian',
        'lainnya' => 'Lainnya',
    ];

    $features = [
        ['fa-solid fa-user-tie', 'Tim Profesional', 'Berpengalaman di setiap acara'],
        ['fa-solid fa-box-open', 'Paket Lengkap', 'Fleksibel sesuai kebutuhan'],
        ['fa-solid fa-pen-ruler', 'Desain Custom', 'Sesuai impian Anda'],
        ['fa-solid fa-hand-holding-dollar', 'Harga Transparan', 'Tanpa biaya tersembunyi'],
    ];

    $sampleLines = array_slice($sample['lines'], 0, 2);
    $sampleRest = $sample['total'] - array_sum(array_column($sampleLines, 'amount'));
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fahira Wedding</title>
    <meta name="description"
          content="Fahira Wedding - Sempurnakan hari bahagia Anda dengan sentuhan elegan.">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}?v={{ filemtime(public_path('css/beranda.css')) }}">

    {{-- Font elegan; hapus jika ingin memakai font lokal/offline --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap"
          rel="stylesheet">
</head>


    <body class="hm-page">
    @include('partials.header')

    <main>

        {{-- HERO --}}
        <section class="hm-hero">
           
            <div class="hm-hero-c">
                <div class="hm-hero-t">
                    <div class="hm-eyebrow">Wedding Organizer · Fahira Wedding</div>

                    <h1>
                        <span class="hm-gold">Wujudkan Hari Bahagia</span><br>
                        dengan Sentuhan Elegan
                    </h1>

                    <p>
                        Dari dekorasi, rias pengantin, catering hingga dokumentasi,
                        kami rancang pernikahan Anda sampai ke detail terkecil agar
                        setiap momen menjadi kenangan.
                    </p>

                    <div class="hm-hb">
                        <a class="hm-btn hm-btn-w" href="{{ route('paket') }}">Lihat Paket Pernikahan</a>
                        <a class="hm-btn hm-btn-g" href="{{ route('kalkulator.intro') }}">
                            <i class="fa-solid fa-calculator"></i> Hitung Estimasi Biaya
                        </a>
                    </div>

                    <div class="hm-stats">
                        @if ($packageCount > 0)
                            <div><b>{{ $packageCount }}</b><span>Pilihan Paket</span></div>
                        @endif
                        <div><b>{{ count($services) }}</b><span>Layanan Lengkap</span></div>
                    </div>
                </div>

                <div class="hm-arch">
                    <div class="hm-a1">
                        <img src="{{ asset('images/foto-pengantin-1.jpg') }}" alt="Pasangan pengantin">
                    </div>
                    <div class="hm-a2">
                        <img src="{{ asset('images/foto-pengantin-2.jpg') }}" alt="Momen pernikahan">
                    </div>
                    <div class="hm-badge"><b>100<sup>+</sup></b><small>Event Successful</small></div>
                </div>
            </div>
        </section>

        {{-- KEUNGGULAN --}}
        <section class="hm-feat" aria-label="Keunggulan Fahira Wedding">
            @foreach ($features as [$icon, $title, $text])
                <div class="hm-f">
                    <span class="hm-ico"><i class="{{ $icon }}"></i></span>
                    <p>{{ $title }}<small>{{ $text }}</small></p>
                </div>
            @endforeach
        </section>

        {{-- TENTANG --}}
        <section class="hm-about" id="tentang">
            <div class="hm-col">
                <span class="hm-ring"></span>
                <img class="hm-b" src="{{ asset('images/tentang-kami.jpg') }}" alt="Momen pernikahan">
                <img class="hm-f1" src="{{ asset('images/foto-pengantin-2.jpg') }}" alt="Pasangan pengantin">
            </div>

            <div>
                <div class="hm-eyebrow hm-dk hm-left">Tentang Kami</div>
                <h2>Kami berkomitmen menjadikan pernikahan Anda tak terlupakan.</h2>
                <p>
                    Kami hadir untuk membantu Anda menciptakan momen pernikahan yang
                    indah, berkesan, dan penuh makna. Dengan perencanaan matang,
                    perhatian pada detail, dan pelayanan sepenuh hati.
                </p>

                <div class="hm-ck">
                    <div><i>✓</i>Perencanaan matang dan terjadwal</div>
                    <div><i>✓</i>Koordinasi seluruh vendor oleh satu tim</div>
                    <div><i>✓</i>Konsultasi dengan tim sebelum memilih paket</div>
                </div>

                <a class="hm-btn hm-btn-p" href="{{ route('tentang') }}">Kenali Kami Lebih Dekat</a>
            </div>
        </section>

        {{-- LAYANAN --}}
        <section class="hm-svc" id="layanan">
            <div class="hm-hd">
                <div class="hm-eyebrow hm-dk">Layanan</div>
                <h2>Semua untuk hari istimewamu</h2>
                <p>Satu tim, {{ count($services) }} layanan pernikahan yang saling melengkapi</p>
            </div>

            <div class="hm-sg">
                @foreach ($services as $service)
                    <div class="hm-sc">
                        <span class="hm-ico"><i class="{{ $service['icon'] }}"></i></span>
                        <h3>{{ $service['label'] }}</h3>
                        <p>{{ $service['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- PAKET TERBARU --}}
        @if ($latestPackages->isNotEmpty())
            <section class="hm-pk" id="paket">
                <div class="hm-hd">
                    <div class="hm-eyebrow hm-dk">Paket Pernikahan</div>
                    <h2>Paket terbaru kami</h2>
                    <p>Pilihan paket yang baru ditambahkan, semua bisa disesuaikan</p>
                </div>

                <div class="hm-pg">
                    @foreach ($latestPackages as $package)
                        <article class="hm-pc">
                            <span class="hm-tag">{{ $categoryLabels[$package->category] ?? ucfirst($package->category) }}</span>

                            <a class="hm-pim" href="{{ route('paket.detail', $package->slug) }}">
                                <img src="{{ $package->image
                                        ? \Illuminate\Support\Facades\Storage::url($package->image)
                                        : asset('images/paket/hero-paket.jpg') }}"
                                     alt="{{ $package->name }}" loading="lazy">
                            </a>

                            <div class="hm-pbd">
                                <h3>{{ $package->name }}</h3>
                                <div class="hm-pr">{{ Estimator::rupiah($package->price) }}</div>

                                <div class="hm-chips">
                                    @foreach (array_slice($package->facilities ?? [], 0, 4) as $facility)
                                        <span>{{ $facility }} <b>✓</b></span>
                                    @endforeach
                                </div>

                                <div class="hm-row">
                                    <a class="hm-btn hm-btn-p"
                                       href="https://wa.me/{{ $whatsapp }}?text={{ rawurlencode('Halo Fahira Wedding, saya ingin konsultasi mengenai ' . $package->name . '.') }}"
                                       target="_blank" rel="noopener noreferrer">Pilih Paket</a>
                                    <a class="hm-btn hm-btn-o"
                                       href="{{ route('paket.detail', $package->slug) }}">Detail</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="hm-more">
                    <a class="hm-btn hm-btn-o" href="{{ route('paket') }}">Lihat Semua Paket →</a>
                </div>
            </section>
        @endif

        {{-- WEDDING CALCULATOR --}}
        <section class="hm-calc" id="calculator">
            <div class="hm-calc-ph">
                <img src="{{ asset('images/wedding-calculator.jpg') }}" alt="Wedding calculator">
            </div>

            <div class="hm-calc-tx">
                <div class="hm-eyebrow">Wedding Calculator</div>
                <h2>Hitung estimasi biaya pernikahan Anda</h2>
                <p>
                    Atur jumlah tamu, pilih layanan, dan lihat perkiraan total biaya
                    secara langsung, lengkap dengan hasil yang bisa diunduh sebagai PDF.
                </p>

                <div class="hm-mini">
                    @foreach ($sampleLines as $line)
                        <div class="hm-mr">
                            <span>{{ $line['label'] }} · {{ $line['tier'] }}</span>
                            <b>{{ Estimator::rupiah($line['amount']) }}</b>
                        </div>
                    @endforeach

                    <div class="hm-mr">
                        <span>+ layanan lainnya</span>
                        <b>{{ Estimator::rupiah($sampleRest) }}</b>
                    </div>

                    <div class="hm-mt">
                        <span>Total estimasi</span>
                        <b>{{ Estimator::rupiah($sample['total']) }}</b>
                    </div>
                </div>

                <a class="hm-btn hm-btn-w" href="{{ route('kalkulator.intro') }}">Coba Calculator Sekarang →</a>
            </div>
        </section>

        {{-- GALERI TERBARU --}}
        @if ($latestGalleries->isNotEmpty())
            <section class="hm-gal" id="galeri">
                <div class="hm-hd">
                    <div class="hm-eyebrow hm-dk">Galeri</div>
                    <h2>Momen penuh makna</h2>
                    <p>Foto terbaru dari pasangan yang telah mempercayakan harinya kepada kami</p>
                </div>

                <div class="hm-gg {{ $latestGalleries->count() === 5 ? 'hm-mosaic' : 'hm-line' }}"
                     style="--n: {{ $latestGalleries->count() }}">
                    @foreach ($latestGalleries as $gallery)
                        <a class="hm-gi" href="{{ url('/galeri') }}"
                           aria-label="Lihat galeri: {{ $gallery->title }}">
                            <img src="{{ asset('storage/' . $gallery->image) }}"
                                 alt="{{ $gallery->title }}" loading="lazy">
                            <span class="hm-cap">
                                <b>{{ $gallery->title }}</b>
                                @if ($gallery->venue)
                                    <small>{{ $gallery->venue }}</small>
                                @endif
                            </span>
                        </a>
                    @endforeach
                </div>

                <div class="hm-more">
                    <a class="hm-btn hm-btn-p" href="{{ url('/galeri') }}">Kunjungi Galeri →</a>
                </div>
            </section>
        @endif

        {{-- CTA WHATSAPP --}}
        <section class="hm-cta" id="konsultasi">
            <a class="brand cta-brand" href="#beranda" aria-label="Kembali ke atas">
                <img src="{{ asset('images/logo-fahira.png') }}" alt="Fahira Wedding">
            </a>

            <div class="hm-cta-t">
                <h2>Masih bingung memilih paket yang cocok</h2>
                <p>Konsultasi dengan tim kami melalui whatsapp</p>
            </div>

            <a class="hm-cta-btn" href="{{ $waLink }}" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-whatsapp"></i> Chat Sekarang
            </a>
        </section>

        @include('partials.footer')
    </main>

    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>