@extends('kalkulator.layout', [
    'step' => 4,
    'judul' => 'Hasil Estimasi',
    'sub' => 'Ringkasan biaya pernikahan sesuai pilihan Anda',
])

@section('title', 'Hasil Estimasi')

@use('App\Support\WeddingEstimator', 'Estimator')

@section('content')
    <div class="kw-ok">
        <span class="kw-ok-ico"><i class="fa-solid fa-check"></i></span>
        <div>
            <h2>Estimasi Anda sudah siap</h2>
            <p>Simpan sebagai PDF atau lanjutkan konsultasi dengan tim kami</p>
        </div>
    </div>

    <div class="kw-rs">

        {{-- RINCIAN --}}
        <section class="kw-card kw-rc">
            <div class="kw-rs-h">
                Rincian Estimasi
                <small>Dibuat {{ $createdAt }}</small>
            </div>

            <div class="kw-mt">
                <div><small>Jumlah tamu</small><b>{{ number_format($estimate['guests'], 0, ',', '.') }} orang</b></div>
                <div><small>Konsep</small><b>{{ $estimate['concept'] }}</b></div>
                <div><small>Lokasi</small><b>{{ $estimate['venue'] }}</b></div>
                <div><small>Durasi</small><b>{{ $estimate['duration'] }}</b></div>
            </div>

            <div class="kw-scroll">
                <table class="kw-table">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Tingkat</th>
                            <th class="r">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimate['lines'] as $line)
                            <tr>
                                <td>
                                    {{ $line['label'] }}
                                    @if ($line['detail'])
                                        <small>{{ $line['detail'] }}</small>
                                    @endif
                                </td>
                                <td><span class="kw-tag">{{ $line['tier'] }}</span></td>
                                <td class="r">{{ Estimator::rupiah($line['amount']) }}</td>
                            </tr>
                        @endforeach

                        <tr class="sub">
                            <td colspan="2">Subtotal layanan</td>
                            <td class="r">{{ Estimator::rupiah($estimate['subtotal']) }}</td>
                        </tr>

                        @foreach ($estimate['addons'] as $addon)
                            <tr>
                                <td>{{ $addon['label'] }}</td>
                                <td><span class="kw-tag">Tambahan</span></td>
                                <td class="r">{{ Estimator::rupiah($addon['amount']) }}</td>
                            </tr>
                        @endforeach

                        @if ($estimate['addons_total'] > 0)
                            <tr class="sub">
                                <td colspan="2">Subtotal layanan tambahan</td>
                                <td class="r">{{ Estimator::rupiah($estimate['addons_total']) }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>

        {{-- TOTAL & AKSI --}}
        <aside>
            <div class="kw-tot">
                <small>Total estimasi</small>
                <b>{{ Estimator::rupiah($estimate['total']) }}</b>
                <em>Estimasi awal, harga final setelah konsultasi</em>
            </div>

            <div class="kw-rb">
                <a class="kw-bt kw-bt-p" href="{{ route('kalkulator.pdf') }}">
                    <i class="fa-solid fa-file-arrow-down"></i> Unduh Estimasi (PDF)
                </a>
                <p class="kw-pdfn">Format A4 · berisi seluruh rincian di samping</p>

                <a class="kw-bt kw-bt-o" href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-whatsapp"></i> Konsultasi via WhatsApp
                </a>

                <a class="kw-bt kw-bt-o" href="{{ route('kalkulator.langkah', 1) }}">
                    ← Ubah Pilihan
                </a>
            </div>

            @if ($package)
                <a class="kw-reco" href="{{ route('paket.detail', $package->slug) }}">
                    <img src="{{ $package->image
                        ? \Illuminate\Support\Facades\Storage::url($package->image)
                        : asset('images/paket/hero-paket.jpg') }}"
                         alt="{{ $package->name }}">
                    <span>
                        <small>Paket terdekat</small>
                        <b>{{ $package->name }}</b>
                        <em>{{ Estimator::rupiah($package->price) }}</em>
                    </span>
                </a>
            @endif

            <p class="kw-nt">
                Harga adalah perkiraan dan dapat berubah sesuai tanggal, lokasi,
                dan kebutuhan acara Anda.
            </p>
        </aside>
    </div>
@endsection