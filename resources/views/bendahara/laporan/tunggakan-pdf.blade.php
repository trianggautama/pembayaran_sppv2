<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Tunggakan SPP</title>
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
    <h2 class="text-center">Laporan Tunggakan SPP</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Bulan/Tahun Ajaran</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $total = 0; 
                $no = 1;
            @endphp
            @forelse($kelassData as $kelas)
                @foreach($kelas->siswas as $siswa)
                    @foreach($siswa->tagihans as $tunggakan)
                        @php $total += $tunggakan->nominal; @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $siswa->nis ?? '-' }}</td>
                            <td>{{ $siswa->nama ?? '-' }}</td>
                            <td>{{ $kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $tunggakan->namaBulan() }} ({{ $tunggakan->tahunAjaran->nama ?? '-' }})</td>
                            <td class="text-right">Rp {{ number_format($tunggakan->nominal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data tunggakan.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total Tunggakan</th>
                <th class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>