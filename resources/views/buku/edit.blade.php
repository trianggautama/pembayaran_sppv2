<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Edit Buku</h2>
    {{-- sesuaikan route --}}
    <form action="{{ route('buku.update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- sesuaikan inputan --}}
        <div class="mb-3">
            <label>Kode Buku</label>
            <input type="text" name="kode_buku" class="form-control" value="{{ $buku->kode_buku }}" required>
        </div>
        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" id="kategori" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                <option value="Novel" {{ $buku->kategori == 'Novel' ? 'selected' : '' }}>Novel</option>
                <option value="Komik" {{ $buku->kategori == 'Komik' ? 'selected' : '' }}>Komik</option>
                <option value="Buku Pelajaran" {{ $buku->kategori == 'Buku Pelajaran' ? 'selected' : '' }}>Buku Pelajaran</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Pengarang</label>
            <input type="text" name="pengarang" class="form-control" value="{{ $buku->pengarang }}" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $buku->harga }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        {{-- sesuaikan route --}}
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>