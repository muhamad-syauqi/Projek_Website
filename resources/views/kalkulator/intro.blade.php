@extends('kalkulator.layout')

@section('title', 'Wedding Calculator')

@use('App\Support\WeddingEstimator', 'Estimator')

@php
    $start = route('kalkulator.langkah', 1);

    $how = [
        ['Data Acara', 'Isi jumlah tamu, konsep, lokasi, dan durasi acara.'],
        ['Pilih Layanan', 'Tentukan tingkat Basic, Standar, atau Premium tiap layanan.'],
        ['Tambahan', 'Pilih layanan pelengkap jika diperlukan. Boleh dilewati.'],
        ['Hasil Estimasi', 'Lihat rincian biaya lalu unduh sebagai PDF.'],
    ];

    $benefits = [
        ['Rincian per layanan', 'Setiap layanan dan tingkatnya tercantum beserta biayanya.'],
        ['Total yang langsung berubah', 'Ubah jumlah tamu atau tingkat layanan, total ikut menyesuaikan.'],
        ['Dokumen PDF', 'Simpan atau bagikan hasil estimasi kepada keluarga dan pasangan.'],
        ['Lanjut konsultasi', 'Kirim hasilnya ke tim kami lewat WhatsApp kapan saja.'],
    ];

    $faqs = [
        ['Apakah angka estimasi ini sudah harga final?', 'Belum. Hasilnya adalah estimasi awal. Harga final dipastikan setelah konsultasi dengan tim Fahira Wedding, menyesuaikan tanggal, lokasi, dan kebutuhan acara.'],
        ['Apakah saya bisa mengubah pilihan?', 'Bisa. Anda dapat kembali ke langkah sebelumnya kapan saja sebelum mengunduh hasil estimasi.'],
        ['Bagaimana jika saya masih bingung memilih?', 'Anda bisa langsung konsultasi lewat WhatsApp, atau lihat paket pernikahan yang sudah tersedia sebagai acuan.'],
    ];
@endphp

@section('content')

    {{-- HERO --}}
    <section class="kw-ihero">
        <div class="kw-ihero-in">
            <div class="kw-ihero-t">
                <div class="kw-eyebrow">Wedding Calculator</div>
                <h1><span class="kw-gold">Rencanakan Anggaran</span><br>Pernikahan Impian Anda</h1>
                <p>Jawab beberapa pertanyaan singkat, pilih layanan yang Anda butuhkan, lalu dapatkan estimasi biaya lengkap yang bisa diunduh sebagai PDF.</p>

                <div class="kw-hb">
                    <a class="kw-bt kw-bt-w" href="{{ $start }}">Mulai Hitung Estimasi →</a>
                    <a class="kw-bt kw-bt-g" href="{{ route('paket') }}">Lihat Paket Pernikahan</a>
                </div>

                <div class="kw-pills">
                    <span><i>✓</i>Hanya 4 langkah</span>
                    <span><i>✓</i>Total berubah langsung</span>
                    <span><i>✓</i>Hasil bisa diunduh PDF</span>
                </div>
            </div>

            <div class="kw-arch">
                <div class="kw-a1">
                    <img src="{{ asset('images/paket-pernikahan.jpg') }}" alt="Pasangan pengantin">
                </div>
                <div class="kw-fl">
                    <small>Contoh total estimasi</small>
                    <b>{{ Estimator::rupiah($sample['total']) }}</b>
                    <div>
                        <span>{{ $sample['guests'] }} tamu</span>
                        <span>{{ $sample['concept'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CARA KERJA --}}
    <section class="kw-how">
        <div class="kw-sec">
            <div class="kw-hd">
                <div class="kw-eyebrow kw-dk">Cara Kerja</div>
                <h2>Empat langkah menuju estimasi Anda</h2>
                <p>Setiap langkah ada di halaman sendiri, jadi mudah diikuti</p>
            </div>

            <div class="kw-hg">
                @foreach ($how as $i => [$title, $text])
                    <div class="kw-hc">
                        <span class="kw-hn">{{ $i + 1 }}</span>
                        <h3>{{ $title }}</h3>
                        <p>{{ $text }}</p>
                        <span class="kw-ht">Langkah {{ $i + 1 }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- YANG ANDA DAPATKAN --}}
    <section class="kw-get">
        <div class="kw-sec kw-gc">
            <div class="kw-pv">
                <div class="kw-pv-h">Rincian Estimasi<small>Contoh tampilan</small></div>

                @foreach (array_slice($sample['lines'], 0, 4) as $line)
                    <div class="kw-pr">
                        <span>{{ $line['label'] }}{{ $line['detail'] ? ' · ' . $sample['guests'] . ' tamu' : '' }}</span>
                        <b>{{ Estimator::rupiah($line['amount']) }}</b>
                    </div>
                @endforeach

                <div class="kw-pt">
                    <small>Total estimasi</small>
                    <b>{{ Estimator::rupiah($sample['total']) }}</b>
                </div>

                <div class="kw-pb"><i class="fa-solid fa-file-arrow-down"></i> Unduh Estimasi (PDF)</div>
            </div>

            <div class="kw-gt">
                <div class="kw-eyebrow kw-dk kw-left">Yang Anda Dapatkan</div>
                <h2>Gambaran biaya yang jelas dan rapi</h2>

                <div class="kw-ck">
                    @foreach ($benefits as [$title, $text])
                        <div>
                            <i>✓</i>
                            <p><b>{{ $title }}</b><span>{{ $text }}</span></p>
                        </div>
                    @endforeach
                </div>

                <a class="kw-bt kw-bt-p" href="{{ $start }}">Mulai Hitung Estimasi →</a>
            </div>
        </div>
    </section>

    {{-- LAYANAN YANG DIHITUNG --}}
    <section class="kw-svs">
        <div class="kw-sec">
            <div class="kw-hd">
                <div class="kw-eyebrow kw-dk">Layanan yang Dihitung</div>
                <h2>Semua kebutuhan hari istimewa</h2>
                <p>Enam layanan utama, ditambah pilihan layanan pelengkap</p>
            </div>

            <div class="kw-sr">
                @foreach ($config['services'] as $service)
                    <div class="kw-sc">
                        <span class="kw-g"><i class="{{ $service['icon'] }}"></i></span>
                        <b>{{ $service['label'] }}</b>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PERTANYAAN UMUM --}}
    <section class="kw-faq">
        <div class="kw-sec">
            <div class="kw-hd">
                <div class="kw-eyebrow kw-dk">Pertanyaan Umum</div>
                <h2>Sebelum Anda mulai</h2>
            </div>

            <div class="kw-fq">
                @foreach ($faqs as $i => [$question, $answer])
                    <details class="kw-q" @if ($i === 0) open @endif>
                        <summary>{{ $question }}</summary>
                        <p>{{ $answer }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- BANNER AJAKAN --}}
    <section class="kw-cta">
        <img src="{{ asset('images/logo-fahira.png') }}" alt="Fahira Wedding">
        <div class="kw-cta-t">
            <h2>Siap menghitung anggaran pernikahan Anda?</h2>
            <p>Mulai sekarang, hasilnya bisa Anda unduh dalam bentuk PDF.</p>
        </div>
        <a href="{{ $start }}">Mulai Hitung →</a>
    </section>

@endsection