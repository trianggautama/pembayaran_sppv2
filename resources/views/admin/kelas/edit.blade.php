@extends('layouts.app')

@section('page-title', 'Edit Data Kelas')
@section('page-subtitle', 'Perbarui informasi kelas')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 max-w-4xl">
    <form action="#" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Kelas</label>
                <input type="text" name="nama_kelas" value="{{ $kelas['nama_kelas'] }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Tingkat</label>
                <select name="tingkat" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
                    <option value="">Pilih Tingkat</option>
                    <option value="1" {{ $kelas['tingkat'] == 1 ? 'selected' : '' }}>Tingkat 1</option>
                    <option value="2" {{ $kelas['tingkat'] == 2 ? 'selected' : '' }}>Tingkat 2</option>
                    <option value="3" {{ $kelas['tingkat'] == 3 ? 'selected' : '' }}>Tingkat 3</option>
                    <option value="4" {{ $kelas['tingkat'] == 4 ? 'selected' : '' }}>Tingkat 4</option>
                    <option value="5" {{ $kelas['tingkat'] == 5 ? 'selected' : '' }}>Tingkat 5</option>
                    <option value="6" {{ $kelas['tingkat'] == 6 ? 'selected' : '' }}>Tingkat 6</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Wali Kelas</label>
                <input type="text" name="wali_kelas" value="{{ $kelas['wali_kelas'] }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>
        </div>

        <div class="mt-8 flex items-center gap-3">
            <button type="submit" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">Simpan Perubahan</button>
            <a href="{{ route('admin.kelas.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
