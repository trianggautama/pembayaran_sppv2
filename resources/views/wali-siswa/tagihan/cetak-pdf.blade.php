<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
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
        .info-siswa {
            margin-bottom: 16px;
            padding: 10px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
        }
        .info-siswa table {
            border-collapse: collapse;
        }
        .info-siswa td {
            padding: 2px 0;
            font-size: 11px;
            border: none;
        }
        .info-siswa .label {
            font-weight: 600;
            color: #475569;
            width: 120px;
        }
        .info-siswa .value {
            color: #0f172a;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        table.data thead th {
            background: #0f172a;
            color: #ffffff;
            font-weight: 600;
            padding: 8px 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table.data thead th:first-child {
            border-radius: 4px 0 0 0;
        }
        table.data thead th:last-child {
            border-radius: 0 4px 0 0;
        }
        table.data tbody td {
            padding: 7px 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }
        table.data tbody tr:nth-child(even) {
            background: #f8fafc;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $judul }}</h1>
        <h2>Sistem Pembayaran SPP</h2>
        <p>Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>

    <div class="info-siswa">
        <table>
            <tr>
                <td class="label">Nama Siswa</td>
                <td class="value">: {{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td class="label">NIS</td>
                <td class="value">: {{ $siswa->nis }}</td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td class="value">: {{ $siswa->kelas->nama_kelas }}</td>
            </tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th class="text-center" style="width: 35px;">No</th>
                <th>Bulan</th>
                <th>Tahun Ajaran</th>
                <th class="text-right">Nominal</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $tagihan)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $tagihan->namaBulan() }}</td>
                    <td>{{ $tagihan->tahunAjaran->nama ?? '-' }} - Sem {{ $tagihan->tahunAjaran->semester ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if($tagihan->status === 'sudah_bayar')
                            <span class="badge badge-success">Lunas</span>
                        @else
                            <span class="badge badge-danger">Belum Bayar</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px; color: #94a3b8;">
                        Tidak ada data tagihan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($data->count() > 0)
        <div class="summary">
            <table>
                <tr>
                    <td class="label">Jumlah Tagihan:</td>
                    <td class="value">{{ $data->count() }} bulan</td>
                </tr>
                <tr>
                    <td class="label">Total Nominal:</td>
                    <td class="value">Rp {{ number_format($data->sum('nominal'), 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    @endif

    <div class="footer">
        Dokumen ini digenerate secara otomatis oleh sistem.
    </div>
</body>
</html>
