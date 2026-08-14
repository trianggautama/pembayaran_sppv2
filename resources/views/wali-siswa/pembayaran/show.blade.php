@extends('layouts.app')

@section('page-title', 'Detail Pembayaran')
@section('page-subtitle', 'Informasi pembayaran yang telah dikirim')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-lg font-display font-semibold text-slate-800">Informasi Pembayaran</h3>
                <p class="text-sm text-slate-500 mt-1">ID Pembayaran: #{{ $pembayaran->id }}</p>
            </div>
            
            @if($pembayaran->status == 'pending')
                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-sm font-medium rounded-full">Pending</span>
            @elseif($pembayaran->status == 'diverifikasi')
                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-sm font-medium rounded-full">Pembayaran Diterima</span>
            @else
                <span class="px-3 py-1 bg-rose-100 text-rose-700 text-sm font-medium rounded-full">Pembayaran Ditolak</span>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <div class="text-sm text-slate-500 mb-1">Tanggal</div>
                <div class="font-medium text-slate-800">{{ $pembayaran->created_at->format('d M Y H:i') }}</div>
            </div>
            <div>
                <div class="text-sm text-slate-500 mb-1">Metode Pembayaran</div>
                <div class="font-medium text-slate-800">{{ $pembayaran->labelMetode() }}</div>
            </div>
            <div>
                <div class="text-sm text-slate-500 mb-1">Total Bayar</div>
                <div class="font-medium text-slate-800 text-lg">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</div>
            </div>
            @if($pembayaran->catatan)
            <div class="md:col-span-2">
                <div class="text-sm text-slate-500 mb-1">Catatan</div>
                <div class="font-medium text-slate-800 bg-slate-50 p-3 rounded-xl">{{ $pembayaran->catatan }}</div>
            </div>
            @endif
        </div>

        <h4 class="font-medium text-slate-800 mb-3 border-t border-slate-100 pt-4">Rincian Tagihan</h4>
        <div class="border border-slate-100 rounded-xl overflow-hidden mb-6">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-sm font-medium border-b border-slate-100">
                    <tr>
                        <th class="py-2 px-4">Bulan</th>
                        <th class="py-2 px-4">Tahun Ajaran</th>
                        <th class="py-2 px-4 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pembayaran->tagihan as $item)
                    <tr>
                        <td class="py-2 px-4 text-slate-800">{{ $item->namaBulan() }}</td>
                        <td class="py-2 px-4 text-slate-500">{{ $item->tahunAjaran->nama ?? '-' }} - Sem {{ $item->tahunAjaran->semester ?? '-' }}</td>
                        <td class="py-2 px-4 text-right text-slate-800">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h4 class="font-medium text-slate-800 mb-3 border-t border-slate-100 pt-4">Bukti Pembayaran</h4>
        <div class="mt-2">
            @if(Str::endsWith($pembayaran->bukti_pembayaran, '.pdf'))
                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center gap-2 text-primary hover:text-navy font-medium">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Lihat PDF Bukti Pembayaran
                </a>
            @else
                <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="max-w-full h-auto rounded-xl border border-slate-200 max-h-[400px] object-contain bg-slate-50">
            @endif
        </div>
    </div>

    <div class="flex">
        <a href="{{ route('wali-siswa.tagihan.index') }}" class="bg-white border border-slate-200 text-slate-700 font-medium px-4 py-2 rounded-xl hover:bg-slate-50 transition">Kembali ke Tagihan</a>
    </div>
</div>
@endsection
