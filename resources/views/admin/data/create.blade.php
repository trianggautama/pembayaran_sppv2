@extends('layouts.app')

@section('page-title', 'Tambah Data ')
@section('page-subtitle', 'Masukkan Data  baru')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 max-w-4xl">
    <form action="{{ route('admin.data.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama </label>
                <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Contoh: 1A" required>
                @error('nama_kelas')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Tingkat</label>
                <select name="tingkat" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
                    <option value="">Pilih Tingkat</option>
                    <option value="1" {{ old('tingkat') == '1' ? 'selected' : '' }}>Tingkat 1</option>
                    <option value="2" {{ old('tingkat') == '2' ? 'selected' : '' }}>Tingkat 2</option>
                    <option value="3" {{ old('tingkat') == '3' ? 'selected' : '' }}>Tingkat 3</option>
                    <option value="4" {{ old('tingkat') == '4' ? 'selected' : '' }}>Tingkat 4</option>
                    <option value="5" {{ old('tingkat') == '5' ? 'selected' : '' }}>Tingkat 5</option>
                    <option value="6" {{ old('tingkat') == '6' ? 'selected' : '' }}>Tingkat 6</option>
                </select>
                @error('tingkat')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Wali Kelas</label>
                <input type="text" name="wali_kelas" value="{{ old('wali_kelas') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Nama lengkap wali kelas" required>
                @error('wali_kelas')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div> --}}
        </div>

        <div class="mt-8 flex items-center gap-3">
            <button type="submit" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">Simpan Data</button>
            <a href="{{ route('admin.data.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
