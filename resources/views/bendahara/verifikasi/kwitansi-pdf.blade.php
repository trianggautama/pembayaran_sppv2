<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kwitansi Pembayaran</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #1e293b;
            line-height: 1.5;
            padding: 20px;
        }

        .kwitansi {
            border: 2px solid #0f172a;
            padding: 24px;
            position: relative;
        }
        .kwitansi::before {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            right: 3px;
            bottom: 3px;
            border: 1px solid #cbd5e1;
        }

        /* Header */
        .header {
            text-align: center;
            border-bottom: 3px double #334155;
            padding-bottom: 14px;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }
        .header h1 {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #0f172a;
        }
        .header h2 {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-top: 2px;
        }
        .nomor {
            font-size: 10px;
            color: #64748b;
            margin-top: 6px;
        }

        /* Info grid */
        .info-grid {
            width: 100%;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }
        .info-grid td {
            padding: 3px 0;
            vertical-align: top;
        }
        .info-grid .label {
            width: 130px;
            font-weight: 600;
            color: #475569;
        }
        .info-grid .sep {
            width: 15px;
            text-align: center;
            color: #94a3b8;
        }
        .info-grid .value {
            color: #0f172a;
            font-weight: 500;
        }

        /* Tagihan table */
        .tagihan-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }
        .tagihan-table thead th {
            background: #0f172a;
            color: #ffffff;
            font-weight: 600;
            padding: 7px 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .tagihan-table tbody td {
            padding: 6px 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }
        .tagihan-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }
        .tagihan-table tfoot td {
            padding: 8px 10px;
            font-weight: 700;
            font-size: 12px;
            border-top: 2px solid #334155;
            color: #0f172a;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }

        /* Terbilang */
        .terbilang {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 10px;
            font-style: italic;
            color: #334155;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }
        .terbilang strong {
            font-style: normal;
        }

        /* Status */
        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-diterima {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .status-ditolak {
            background: #ffe4e6;
            color: #9f1239;
            border: 1px solid #fecdd3;
        }

        /* Footer / TTD */
        .footer-ttd {
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }
        .footer-ttd table {
            width: 100%;
        }
        .footer-ttd td {
            vertical-align: top;
            padding: 0;
        }
        .ttd-box {
            text-align: center;
            width: 180px;
        }
        .ttd-box .line {
            border-bottom: 1px solid #334155;
            margin-top: 50px;
            margin-bottom: 4px;
        }
        .ttd-box .name {
            font-weight: 700;
            color: #0f172a;
            font-size: 11px;
        }
        .ttd-box .role {
            font-size: 9px;
            color: #64748b;
        }
        .print-date {
            font-size: 9px;
            color: #94a3b8;
            position: relative;
            z-index: 1;
        }

        /* Watermark for ditolak */
        .watermark {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 60px;
            font-weight: 900;
            color: rgba(239, 68, 68, 0.08);
            text-transform: uppercase;
            letter-spacing: 10px;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="kwitansi">
        @if($pembayaran->status === 'ditolak')
            <div class="watermark">DITOLAK</div>
        @endif

        <div class="header">
            <h1>Kwitansi Pembayaran</h1>
            <h2>Pembayaran SPP</h2>
            <div class="nomor">No: KW-{{ str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>

        <table class="info-grid">
            <tr>
                <td class="label">Tanggal Bayar</td>
                <td class="sep">:</td>
                <td class="value">{{ $pembayaran->created_at->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Nama Siswa</td>
                <td class="sep">:</td>
                <td class="value">{{ $pembayaran->siswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">NIS</td>
                <td class="sep">:</td>
                <td class="value">{{ $pembayaran->siswa->nis ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td class="sep">:</td>
                <td class="value">{{ $pembayaran->siswa->kelas->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Metode Pembayaran</td>
                <td class="sep">:</td>
                <td class="value">{{ $pembayaran->labelMetode() }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="sep">:</td>
                <td class="value">
                    @if($pembayaran->status === 'diverifikasi')
                        <span class="status-badge status-diterima">Diterima</span>
                    @elseif($pembayaran->status === 'ditolak')
                        <span class="status-badge status-ditolak">Ditolak</span>
                    @endif
                </td>
            </tr>
        </table>

        <table class="tagihan-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 30px;">No</th>
                    <th>Bulan</th>
                    <th>Tahun Ajaran</th>
                    <th class="text-right">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayaran->tagihan as $i => $tagihan)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $tagihan->namaBulan() }}</td>
                        <td>{{ $tagihan->tahunAjaran->nama ?? '-' }} - Sem {{ $tagihan->tahunAjaran->semester ?? '-' }}</td>
                        <td class="text-right">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right">Total Bayar</td>
                    <td class="text-right">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        @php
            // Terbilang helper
            function terbilang($angka) {
                $angka = abs($angka);
                $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
                $temp = '';

                if ($angka < 12) {
                    $temp = ' ' . $huruf[$angka];
                } elseif ($angka < 20) {
                    $temp = terbilang($angka - 10) . ' Belas';
                } elseif ($angka < 100) {
                    $temp = terbilang(intdiv($angka, 10)) . ' Puluh' . terbilang($angka % 10);
                } elseif ($angka < 200) {
                    $temp = ' Seratus' . terbilang($angka - 100);
                } elseif ($angka < 1000) {
                    $temp = terbilang(intdiv($angka, 100)) . ' Ratus' . terbilang($angka % 100);
                } elseif ($angka < 2000) {
                    $temp = ' Seribu' . terbilang($angka - 1000);
                } elseif ($angka < 1000000) {
                    $temp = terbilang(intdiv($angka, 1000)) . ' Ribu' . terbilang($angka % 1000);
                } elseif ($angka < 1000000000) {
                    $temp = terbilang(intdiv($angka, 1000000)) . ' Juta' . terbilang($angka % 1000000);
                } elseif ($angka < 1000000000000) {
                    $temp = terbilang(intdiv($angka, 1000000000)) . ' Miliar' . terbilang($angka % 1000000000);
                }

                return $temp;
            }
        @endphp

        <div class="terbilang">
            <strong>Terbilang:</strong> {{ trim(terbilang($pembayaran->total_bayar)) }} Rupiah
        </div>

        <div class="footer-ttd">
            <table>
                <tr>
                    <td style="width: 50%;">
                        <div class="print-date">
                            Dicetak: {{ now()->translatedFormat('d F Y, H:i') }} WIB
                        </div>
                    </td>
                    <td style="width: 50%;" class="text-right">
                        <div class="ttd-box" style="display: inline-block;">
                            <div style="font-size: 10px; color: #475569;">
                                {{ $pembayaran->verified_at ? $pembayaran->verified_at->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}
                            </div>
                            <div style="font-size: 10px; color: #475569; margin-bottom: 2px;">Bendahara</div>
                            <div class="line"></div>
                            <div class="name">{{ $pembayaran->verifiedBy->name ?? '........................' }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
