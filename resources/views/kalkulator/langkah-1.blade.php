@extends('kalkulator.layout', [
    'step' => 1,
    'judul' => 'Data Acara',
    'sub' => 'Mulai dari jumlah tamu dan konsep pernikahan Anda',
])

@section('title', 'Data Acara')

@section('content')
    <div class="kw-ttl">
        <h2>Ceritakan tentang acara Anda</h2>
        <p>Data ini menjadi dasar perhitungan biaya</p>
    </div>

    <form id="kw-form" method="POST" action="{{ route('kalkulator.simpan', 1) }}">
        @csrf

        {{-- 1. Jumlah tamu --}}
        <section class="kw-card">
            <label class="kw-lbl" for="guests"><i>1</i>Jumlah tamu undangan</label>

            <div class="kw-guest">
                <div class="kw-stp">
                    <button type="button" data-guest-step="-10" aria-label="Kurangi 10 tamu">−</button>
                    <input type="number" id="guests" name="guests"
                           min="{{ $config['min_guests'] }}"
                           max="{{ $config['max_guests'] }}"
                           step="1"
                           value="{{ old('guests', $state['guests']) }}">
                    <button type="button" data-guest-step="10" aria-label="Tambah 10 tamu">+</button>
                </div>

                <div>
                    <input type="range" id="guests-range" class="kw-range"
                           min="50" max="500" step="10"
                           value="{{ old('guests', $state['guests']) }}"
                           aria-label="Geser jumlah tamu">
                    <div class="kw-tk" aria-hidden="true">
                        <span>50</span><span>200</span><span>350</span><span>500+</span>
                    </div>
                </div>
            </div>

            @error('guests')
                <p class="kw-err">{{ $message }}</p>
            @enderror
        </section>

        {{-- 2. Konsep --}}
        <section class="kw-card">
            <div class="kw-lbl"><i>2</i>Konsep acara</div>

            <div class="kw-ch kw-c5">
                @foreach ($config['concepts'] as $key => $item)
                    <label class="kw-cc">
                        <input type="radio" name="concept" value="{{ $key }}"
                               @checked(old('concept', $state['concept']) === $key)>
                        <span class="kw-cc-in">
                            <span class="kw-g"><i class="{{ $item['icon'] }}"></i></span>
                            <span class="kw-cc-t">
                                <b>{{ $item['label'] }}</b>
                                <small>{{ $item['desc'] }}</small>
                            </span>
                        </span>
                    </label>
                @endforeach
            </div>
        </section>

        {{-- 3 & 4. Lokasi dan durasi --}}
        <section class="kw-card">
            <div class="kw-lbl"><i>3</i>Lokasi acara</div>

            <div class="kw-ch kw-c2">
                @foreach ($config['venues'] as $key => $item)
                    <label class="kw-cc kw-cc-h">
                        <input type="radio" name="venue" value="{{ $key }}"
                               @checked(old('venue', $state['venue']) === $key)>
                        <span class="kw-cc-in">
                            <span class="kw-g"><i class="{{ $item['icon'] }}"></i></span>
                            <span class="kw-cc-t">
                                <b>{{ $item['label'] }}</b>
                                <small>{{ $item['desc'] }}</small>
                            </span>
                        </span>
                    </label>
                @endforeach
            </div>

            <div class="kw-lbl kw-lbl-gap"><i>4</i>Durasi acara</div>

            <div class="kw-ch kw-c2">
                @foreach ($config['durations'] as $key => $item)
                    <label class="kw-cc kw-cc-h">
                        <input type="radio" name="duration" value="{{ $key }}"
                               @checked(old('duration', $state['duration']) === $key)>
                        <span class="kw-cc-in">
                            <span class="kw-g"><i class="{{ $item['icon'] }}"></i></span>
                            <span class="kw-cc-t">
                                <b>{{ $item['label'] }}</b>
                                <small>{{ $item['desc'] }}</small>
                            </span>
                        </span>
                    </label>
                @endforeach
            </div>
        </section>

        <div class="kw-bar">
            <a class="kw-bt kw-bt-o" href="{{ route('kalkulator.intro') }}">← Kembali</a>

            <div class="kw-run">
                <small>Pilihan saat ini</small>
                <b class="kw-sum" id="kw-summary"></b>
            </div>

            <button type="submit" class="kw-bt kw-bt-p">Lanjut: Pilih Layanan →</button>
        </div>
    </form>
@endsection