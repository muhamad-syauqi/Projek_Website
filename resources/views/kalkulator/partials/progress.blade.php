@php
    $steps = [
        1 => ['Data Acara', 'Tamu & konsep'],
        2 => ['Pilih Layanan', 'Tingkat paket'],
        3 => ['Tambahan', 'Opsional'],
        4 => ['Hasil Estimasi', 'Unduh PDF'],
    ];

    // Langkah yang boleh dibuka = langkah yang sudah selesai + 1
    $reachable = min(4, session('kalkulator.progress', 0) + 1);
@endphp

<nav class="kw-prog" aria-label="Langkah calculator">
    @foreach ($steps as $number => [$title, $caption])
        @php
            $class = $number < $current ? 'is-done' : ($number === $current ? 'is-current' : '');
            $url = $number === 4
                ? route('kalkulator.hasil')
                : route('kalkulator.langkah', $number);
            $tag = $number <= $reachable ? 'a' : 'div';
        @endphp

        <{{ $tag }} class="kw-pst {{ $class }}"
            @if ($tag === 'a') href="{{ $url }}" @endif
            @if ($number === $current) aria-current="step" @endif>
            <b>{{ $number < $current ? '✓' : $number }}</b>
            <span>{{ $title }}<small>{{ $caption }}</small></span>
        </{{ $tag }}>
    @endforeach
</nav>