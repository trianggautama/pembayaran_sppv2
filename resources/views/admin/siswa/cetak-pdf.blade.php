<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
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
        .text-center {
            text-align: center;
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
        <h1>Data Siswa</h1>
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
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nama Wali</th>
                <th>Telepon Wali</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswaList as $i => $siswa)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas->nama_kelas }}</td>
                    <td>{{ $siswa->nama_wali }}</td>
                    <td>{{ $siswa->telepon_wali }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px; color: #94a3b8;">
                        Tidak ada data siswa.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($siswaList->count() > 0)
        <div class="summary">
            <table>
                <tr>
                    <td class="label">Total Siswa:</td>
                    <td class="value">{{ $siswaList->count() }} siswa</td>
                </tr>
            </table>
        </div>
    @endif

    <div class="footer">
        Dokumen ini digenerate secara otomatis oleh sistem.
    </div>
</body>
</html>
