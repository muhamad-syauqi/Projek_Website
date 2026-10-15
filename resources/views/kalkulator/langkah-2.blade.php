@extends('kalkulator.layout', [
    'step' => 2,
    'judul' => 'Pilih Layanan',
    'sub' => 'Tentukan tingkat Basic, Standar, atau Premium untuk tiap layanan',
])

@section('title', 'Pilih Layanan')

@section('content')
    <div class="kw-ttl">
        <h2>Pilih tingkat layanan</h2>
        <p>Atur sesuai kebutuhan, total biaya ikut berubah secara langsung</p>
    </div>

    <form id="kw-form" method="POST" action="{{ route('kalkulator.simpan', 2) }}">
        @csrf

        <div class="kw-sg">
            @foreach ($config['services'] as $key => $service)
                <section class="kw-sv">
                    <div class="kw-sv-h">
                        <span class="kw-sg-ico"><i class="{{ $service['icon'] }}"></i></span>
                        <div>
                            <b>{{ $service['label'] }}</b>
                            <small>{{ $service['desc'] }}</small>
                        </div>
                    </div>

                    <div class="kw-tr" role="radiogroup" aria-label="Tingkat {{ $service['label'] }}">
                        @foreach ($config['tiers'] as $tierKey => $tierLabel)
                            @php
                                $unit = $service['prices'][$tierKey];
                                $amount = $service['per_guest'] ? $unit * $state['guests'] : $unit;
                            @endphp

                            <label class="kw-t">
                                <input type="radio" name="tier[{{ $key }}]" value="{{ $tierKey }}"
                                       @checked(old("tier.$key", $state['tier'][$key]) === $tierKey)>
                                <span class="kw-t-in">
                                    <span class="kw-rd"></span>
                                    <b>{{ $tierLabel }}</b>
                                    <span class="kw-tp">
                                        Rp {{ number_format($amount, 0, ',', '.') }}
                                        @if ($service['per_guest'])
                                            <small>{{ number_format($unit, 0, ',', '.') }} / tamu</small>
                                        @endif
                                    </span>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <div class="kw-bar">
            <a class="kw-bt kw-bt-o" href="{{ route('kalkulator.langkah', 1) }}">← Data Acara</a>

            <div class="kw-run">
                <small>Estimasi sementara</small>
                <b id="kw-total">Rp {{ number_format($total, 0, ',', '.') }}</b>
            </div>

            <button type="submit" class="kw-bt kw-bt-p">Lanjut: Tambahan →</button>
        </div>
    </form>
@endsection