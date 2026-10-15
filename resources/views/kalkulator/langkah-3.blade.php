@extends('kalkulator.layout', [
    'step' => 3,
    'judul' => 'Layanan Tambahan',
    'sub' => 'Lengkapi acara Anda dengan layanan pelengkap',
])

@section('title', 'Layanan Tambahan')

@section('content')
    <div class="kw-ttl">
        <h2>Mau tambah layanan lain?</h2>
        <p>Bagian ini opsional, Anda boleh melewatinya</p>
    </div>

    @php
        $selected = old('addons', $state['addons']);
    @endphp

    <form id="kw-form" method="POST" action="{{ route('kalkulator.simpan', 3) }}">
        @csrf

        <div class="kw-skip">
            <span class="kw-cnt" id="kw-addon-count">0 dipilih</span>
            Tambahan terpilih: <b id="kw-addon-total">Rp 0</b>
        </div>

        <div class="kw-ag">
            @foreach ($config['addons'] as $key => $addon)
                <label class="kw-ad">
                    <input type="checkbox" name="addons[]" value="{{ $key }}"
                           @checked(in_array($key, $selected, true))>
                    <span class="kw-ad-in">
                        <span class="kw-bx"><i class="fa-solid fa-check"></i></span>
                        <span class="kw-g"><i class="{{ $addon['icon'] }}"></i></span>
                        <b>{{ $addon['label'] }}</b>
                        <span class="kw-ap">+ Rp {{ number_format($addon['price'], 0, ',', '.') }}</span>
                    </span>
                </label>
            @endforeach
        </div>

        <div class="kw-bar">
            <a class="kw-bt kw-bt-o" href="{{ route('kalkulator.langkah', 2) }}">← Pilih Layanan</a>

            <div class="kw-run">
                <small>Estimasi sementara</small>
                <b id="kw-total">Rp {{ number_format($total, 0, ',', '.') }}</b>
            </div>

            <button type="submit" class="kw-bt kw-bt-p">Lihat Hasil Estimasi →</button>
        </div>
    </form>
@endsection