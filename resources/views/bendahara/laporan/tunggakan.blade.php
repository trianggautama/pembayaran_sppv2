@extends('layouts.app')

@section('page-title', 'Laporan Tunggakan')
@section('page-subtitle', 'Cetak laporan tunggakan SPP siswa')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    <form action="{{ route('bendahara.laporan.tunggakan') }}" method="GET" class="space-y-4 max-w-sm">
        <input type="hidden" name="cetak" value="1">
        
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Filter Kelas (Opsional)</label>
            <select name="kelas_id" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800">
                <option value="">Semua Kelas</option>
                @foreach($kelass as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" target="_blank" class="w-full bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">
            Cetak Laporan Tunggakan
        </button>
    </form>
</div>
@endsection
