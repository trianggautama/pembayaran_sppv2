<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Tagihan SPP</title>
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
            line-height: 1.4;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #334155;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }
        .header h1 {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #0f172a;
        }
        .header h2 {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-top: 4px;
        }
        .header p {
            font-size: 10px;
            color: #64748b;
            margin-top: 2px;
        }
        .meta {
            margin-bottom: 14px;
            font-size: 10px;
            color: #475569;
        }
        .meta span {
            display: inline-block;
            background: #f1f5f9;
            padding: 3px 10px;
            border-radius: 4px;
            margin-right: 6px;
            margin-bottom: 4px;
            border: 1px solid #e2e8f0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        thead th {
            background: #0f172a;
            color: #ffffff;
            font-weight: 600;
            padding: 8px 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        thead th:first-child {
            border-radius: 4px 0 0 0;
        }
        thead th:last-child {
            border-radius: 0 4px 0 0;
        }
        tbody td {
            padding: 7px 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }
        tbody tr:nth-child(even) {
            background: #f8fafc;
        }
        tbody tr:hover {
            background: #f1f5f9;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .badge-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .badge-danger {
            background: #ffe4e6;
            color: #9f1239;
            border: 1px solid #fecdd3;
        }
        .summary {
            margin-top: 10px;
            border-top: 2px solid #e2e8f0;
            padding-top: 10px;
        }
        .summary table {
            width: auto;
            margin-left: auto;
        }
        .summary td {
            padding: 4px 12px;
            font-size: 11px;
            border: none;
        }
        .summary .label {
            font-weight: 600;
            color: #475569;
        }
        .summary .value {
            text-align: right;
            font-weight: 700;
            color: #0f172a;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #94a3b8;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Tagihan SPP</h1>
        <h2>Sistem Pembayaran SPP</h2>
        <p>Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>

    @if(count($filterInfo) > 0)
        <div class="meta">
            <strong>Filter:</strong>
            @foreach($filterInfo as $info)
                <span>{{ $info }}</span>
            @endforeach
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 35px;">No</th>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Bulan</th>
                <th>Tahun Ajaran</th>
                <th class="text-right">Nominal</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tagihans as $i => $tagihan)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $tagihan->siswa->nama ?? '-' }}</td>
                    <td>{{ $tagihan->siswa->nis ?? '-' }}</td>
                    <td>{{ $tagihan->siswa->kelas->nama ?? '-' }}</td>
                    <td>{{ $tagihan->namaBulan() }}</td>
                    <td>{{ $tagihan->tahunAjaran->nama ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if($tagihan->status === 'sudah_bayar')
                            <span class="badge badge-success">Lunas</span>
                        @else
                            <span class="badge badge-danger">Belum</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 20px; color: #94a3b8;">
                        Tidak ada data tagihan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($tagihans->count() > 0)
        <div class="summary">
            <table>
                <tr>
                    <td class="label">Total Tagihan:</td>
                    <td class="value">{{ $tagihans->count() }} data</td>
                </tr>
                <tr>
                    <td class="label">Total Nominal:</td>
                    <td class="value">Rp {{ number_format($tagihans->sum('nominal'), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Sudah Bayar:</td>
                    <td class="value">{{ $tagihans->where('status', 'sudah_bayar')->count() }} data — Rp {{ number_format($tagihans->where('status', 'sudah_bayar')->sum('nominal'), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Belum Bayar:</td>
                    <td class="value">{{ $tagihans->where('status', 'belum_bayar')->count() }} data — Rp {{ number_format($tagihans->where('status', 'belum_bayar')->sum('nominal'), 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    @endif

    <div class="footer">
        Dokumen ini digenerate secara otomatis oleh sistem.
    </div>
</body>
</html>
