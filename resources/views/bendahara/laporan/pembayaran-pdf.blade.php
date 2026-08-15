<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran SPP</title>
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
    <h2 class="text-center">Laporan Pembayaran SPP</h2>
    <p class="text-center">
        @if($request->bulan || $request->tahun)
            Periode: {{ $request->bulan ? date('F', mktime(0,0,0,$request->bulan,1)) : 'Semua Bulan' }} {{ $request->tahun ?? 'Semua Tahun' }}
        @else
            Semua Periode
        @endif
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Bayar</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Nominal</th>
                <th>Metode</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($pembayarans as $i => $bayar)
                @php $total += $bayar->total_bayar; @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $bayar->created_at->format('d/m/Y') }}</td>
                    <td>{{ $bayar->siswa->nama ?? '-' }}</td>
                    <td>{{ $bayar->siswa->kelas->nama ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($bayar->total_bayar, 0, ',', '.') }}</td>
                    <td>{{ $bayar->metode_pembayaran === 'transfer' ? 'Transfer' : 'Tunai' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pembayaran.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total</th>
                <th class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>