@extends('layouts.app')

@section('page-title', 'Edit Data Siswa')
@section('page-subtitle', 'Perbarui informasi siswa')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 max-w-4xl">
    <form action="#" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">NIS</label>
                <input type="text" name="nis" value="{{ $siswa['nis'] }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $siswa['nama'] }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Kelas</label>
                <select name="kelas" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
                    <option value="">Pilih Kelas</option>
                    <option value="1A" {{ $siswa['kelas'] == '1A' ? 'selected' : '' }}>1A</option>
                    <option value="2A" {{ $siswa['kelas'] == '2A' ? 'selected' : '' }}>2A</option>
                    <option value="2B" {{ $siswa['kelas'] == '2B' ? 'selected' : '' }}>2B</option>
                    <option value="3A" {{ $siswa['kelas'] == '3A' ? 'selected' : '' }}>3A</option>
                    <option value="3C" {{ $siswa['kelas'] == '3C' ? 'selected' : '' }}>3C</option>
                    <option value="4A" {{ $siswa['kelas'] == '4A' ? 'selected' : '' }}>4A</option>
                    <option value="5A" {{ $siswa['kelas'] == '5A' ? 'selected' : '' }}>5A</option>
                    <option value="6A" {{ $siswa['kelas'] == '6A' ? 'selected' : '' }}>6A</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Jenis Kelamin</label>
                <div class="flex items-center gap-4 py-2.5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="L" {{ $siswa['jenis_kelamin'] == 'L' ? 'checked' : '' }} class="text-primary focus:ring-primary h-4 w-4" required>
                        <span class="text-sm text-slate-700">Laki-laki</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="P" {{ $siswa['jenis_kelamin'] == 'P' ? 'checked' : '' }} class="text-primary focus:ring-primary h-4 w-4" required>
                        <span class="text-sm text-slate-700">Perempuan</span>
                    </label>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>{{ $siswa['alamat'] }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Wali Murid</label>
                <input type="text" name="nama_wali" value="{{ $siswa['nama_wali'] }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">No. Telepon Wali</label>
                <input type="text" name="telepon_wali" value="{{ $siswa['telepon_wali'] }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>
        </div>

        <div class="mt-8 flex items-center gap-3">
            <button type="submit" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">Simpan Perubahan</button>
            <a href="{{ route('admin.siswa.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
