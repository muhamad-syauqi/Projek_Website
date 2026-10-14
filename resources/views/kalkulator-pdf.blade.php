<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Estimasi Biaya Pernikahan - Fahira Wedding</title>
    <style>
        @page { margin: 34px 40px 70px; }

        body {
            margin: 0;
            color: #25221e;
            font-family: 'DejaVu Serif', serif;
            font-size: 11px;
            line-height: 1.45;
        }

        table { width: 100%; border-collapse: collapse; }
        td, th { vertical-align: top; }

        .head td { vertical-align: middle; }
        .head .logo { width: 110px; }
        .head .logo img { width: 100px; }
        .head .title { text-align: right; }
        .head h1 {
            margin: 0;
            color: #850d28;
            font-size: 21px;
            font-weight: bold;
        }
        .head p { margin: 3px 0 0; color: #6b655b; font-size: 10px; }

        .line { height: 3px; margin: 10px 0 18px; background: #b29b45; }

        h2 { margin: 0 0 8px; color: #5d0a1c; font-size: 13px; font-weight: bold; }

        .info { margin-bottom: 20px; }
        .info td { padding: 6px 10px; border: 1px solid #d6d0c5; }
        .info td.k { width: 22%; background: #f2f0ec; color: #6b655b; }
        .info td.v { width: 28%; font-weight: bold; }

        .rincian { margin-bottom: 6px; }
        .rincian th {
            padding: 8px 10px;
            background: #850d28;
            color: #ffffff;
            font-size: 10px;
            text-align: left;
        }
        .rincian td { padding: 8px 10px; border-bottom: 1px solid #e0dbcf; }
        .rincian .r { text-align: right; white-space: nowrap; }
        .rincian small { color: #8a8478; font-size: 9px; }
        .rincian tr.sub td { background: #f2f0ec; font-weight: bold; }

        .total { margin-top: 14px; background: #850d28; color: #ffffff; }
        .total td { padding: 12px 14px; vertical-align: middle; }
        .total .lbl { font-size: 11px; letter-spacing: 1px; }
        .total .amt {
            text-align: right;
            color: #f0dc7a;
            font-size: 20px;
            font-weight: bold;
        }

        .note {
            margin-top: 18px;
            padding: 10px 14px;
            border: 1px solid #d6d0c5;
            background: #f2f0ec;
            color: #4a463f;
            font-size: 9.5px;
        }
        .note b { color: #850d28; }

        .footer {
            position: fixed;
            right: 0;
            bottom: -46px;
            left: 0;
            padding-top: 8px;
            border-top: 1px solid #d6d0c5;
            color: #6b655b;
            font-size: 9px;
        }
        .footer .r { text-align: right; }
    </style>
</head>
<body>

    <table class="head">
        <tr>
            <td class="logo">
                @if ($logo)
                    <img src="{{ $logo }}" alt="Fahira Wedding">
                @endif
            </td>
            <td class="title">
                <h1>Estimasi Biaya Pernikahan</h1>
                <p>Dibuat pada {{ $createdAt }} melalui Wedding Calculator</p>
            </td>
        </tr>
    </table>

    <div class="line"></div>

    <h2>Data Acara</h2>
    <table class="info">
        <tr>
            <td class="k">Jumlah tamu</td>
            <td class="v">{{ number_format($estimate['guests'], 0, ',', '.') }} orang</td>
            <td class="k">Konsep acara</td>
            <td class="v">{{ $estimate['concept'] }}</td>
        </tr>
        <tr>
            <td class="k">Lokasi</td>
            <td class="v">{{ $estimate['venue'] }}</td>
            <td class="k">Durasi</td>
            <td class="v">{{ $estimate['duration'] }}</td>
        </tr>
    </table>

    <h2>Rincian Layanan</h2>
    <table class="rincian">
        <thead>
            <tr>
                <th style="width: 40%">Layanan</th>
                <th style="width: 20%">Tingkat</th>
                <th style="width: 40%; text-align: right">Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estimate['lines'] as $line)
                <tr>
                    <td>{{ $line['label'] }}</td>
                    <td>{{ $line['tier'] }}</td>
                    <td class="r">
                        {{ \App\Support\WeddingEstimator::rupiah($line['amount']) }}
                        @if ($line['detail'])
                            <br><small>{{ $line['detail'] }}</small>
                        @endif
                    </td>
                </tr>
            @endforeach

            @foreach ($estimate['addons'] as $addon)
                <tr>
                    <td>{{ $addon['label'] }}</td>
                    <td>Tambahan</td>
                    <td class="r">{{ \App\Support\WeddingEstimator::rupiah($addon['amount']) }}</td>
                </tr>
            @endforeach

            <tr class="sub">
                <td colspan="2">Subtotal layanan</td>
                <td class="r">{{ \App\Support\WeddingEstimator::rupiah($estimate['subtotal']) }}</td>
            </tr>
            @if ($estimate['addons_total'] > 0)
                <tr class="sub">
                    <td colspan="2">Subtotal layanan tambahan</td>
                    <td class="r">{{ \App\Support\WeddingEstimator::rupiah($estimate['addons_total']) }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <table class="total">
        <tr>
            <td class="lbl">TOTAL ESTIMASI</td>
            <td class="amt">{{ \App\Support\WeddingEstimator::rupiah($estimate['total']) }}</td>
        </tr>
    </table>

    <div class="note">
        <b>Catatan:</b> angka di atas adalah estimasi awal dan bukan penawaran
        yang mengikat. Harga final dapat berubah sesuai tanggal, lokasi, dan
        kebutuhan acara, dan akan dipastikan setelah konsultasi dengan tim
        Fahira Wedding.
    </div>

    <div class="footer">
        <table>
            <tr>
                <td>Fahira Wedding · Wedding Organizer</td>
                <td class="r">Konsultasi WhatsApp: +{{ $whatsapp }}</td>
            </tr>
        </table>
    </div>

</body>
</html>