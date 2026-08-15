<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Pembayaran Kelas {{ $kelas->nama_kelas }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h2 class="text-center">Rekap Pembayaran Kelas {{ $kelas->nama_kelas }}</h2>
    <p class="text-center">Tanggal Cetak: {{ now()->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Total Pembayaran Berhasil</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @forelse($kelas->siswas as $i => $siswa)
                @php 
                    $totalSiswa = $siswa->pembayaran->sum('total_bayar'); 
                    $grandTotal += $totalSiswa;
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td class="text-right">Rp {{ number_format($totalSiswa, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data siswa.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Grand Total Kelas</th>
                <th class="text-right">Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>