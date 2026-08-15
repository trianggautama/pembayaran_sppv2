@extends('layouts.app')

@section('page-title', 'Laporan Pembayaran')
@section('page-subtitle', 'Cetak laporan pembayaran SPP')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    <form action="{{ route('bendahara.laporan.pembayaran') }}" method="GET" class="space-y-4 max-w-sm">
        <input type="hidden" name="cetak" value="1">
        
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Bulan (Opsional)</label>
            <select name="bulan" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm">
                <option value="">Semua Bulan</option>
                @foreach(range(1, 12) as $m)
                    <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Tahun (Opsional)</label>
            <select name="tahun" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm">
                <option value="">Semua Tahun</option>
                @foreach(range(date('Y')-2, date('Y')+1) as $y)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" target="_blank" class="w-full bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">
            Cetak Laporan Pembayaran
        </button>
    </form>
</div>
@endsection
