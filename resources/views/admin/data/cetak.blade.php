<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Buku</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body onload="window.print()">

    <h2>Laporan Data Buku</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Pengarang</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buku as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_buku }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->pengarang }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>