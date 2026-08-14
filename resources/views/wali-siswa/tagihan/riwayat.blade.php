@extends('layouts.app')

@section('page-title', 'Riwayat Pembayaran')
@section('page-subtitle', 'Daftar pembayaran SPP yang sudah dilakukan')

@section('content')
{{-- Info Siswa --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
        <div class="w-14 h-14 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl font-bold uppercase">
            {{ substr($siswa->nama, 0, 1) }}
        </div>
        <div>
            <h3 class="text-lg font-display font-semibold text-slate-800">{{ $siswa->nama }}</h3>
            <p class="text-sm text-slate-500">NIS: {{ $siswa->nis }} &middot; Kelas: {{ $siswa->kelas->nama_kelas }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mt-6">
    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="text-lg font-display font-semibold text-slate-800">Riwayat Pembayaran</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-6 py-4 font-medium">Tanggal</th>
                    <th class="px-6 py-4 font-medium">ID / Tagihan</th>
                    <th class="px-6 py-4 font-medium">Metode</th>
                    <th class="px-6 py-4 font-medium">Total</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($riwayatPembayaran as $pembayaran)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 text-slate-700 align-top whitespace-nowrap">{{ $pembayaran->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 align-top">
                        <div class="font-medium text-slate-800 mb-2">#{{ $pembayaran->id }}</div>
                        <ul class="space-y-1">
                            @foreach($pembayaran->tagihan as $t)
                                <li class="text-xs text-slate-600 flex items-center justify-between gap-4">
                                    <span>{{ $t->namaBulan() }} (Sem {{ $t->tahunAjaran->semester ?? '-' }})</span>
                                    <span class="{{ $t->status === 'pending' ? 'text-amber-600' : 'text-emerald-600' }}">{{ $t->status === 'pending' ? 'Pending' : 'Lunas' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-6 py-4 text-slate-700 align-top">{{ $pembayaran->labelMetode() }}</td>
                    <td class="px-6 py-4 text-slate-700 font-medium align-top">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 align-top">
                        @if($pembayaran->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Pending</span>
                        @elseif($pembayaran->status === 'diverifikasi')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Pembayaran Diterima</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">Pembayaran Ditolak</span>
                        @endif
                        
                        <div class="mt-2">
                            <a href="{{ route('wali-siswa.pembayaran.show', $pembayaran->id) }}" class="text-xs text-primary hover:text-navy hover:underline">Lihat Detail &rarr;</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada riwayat pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
