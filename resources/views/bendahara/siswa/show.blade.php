@extends('layouts.app')

@section('page-title', 'Detail Siswa')
@section('page-subtitle', 'Informasi siswa, tagihan, dan riwayat pembayaran')

@section('content')
{{-- Info Siswa --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
        <div>
            <h3 class="text-lg font-display font-semibold text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Siswa</h3>
            <div class="space-y-4">
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">NIS</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa->nis }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Nama Lengkap</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa->nama }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Kelas</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-sm font-medium bg-pale text-navy">{{ $siswa->kelas->nama_kelas }}</span>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-display font-semibold text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Wali Murid</h3>
            <div class="space-y-4">
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Nama Wali</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa->nama_wali }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">No. Telepon</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa->telepon_wali }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Username</span>
                    <span class="text-sm text-slate-900 font-medium font-mono bg-slate-50 px-2 py-0.5 rounded">{{ $siswa->user->username }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Ringkasan Keuangan --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Total Tagihan</p>
        <p class="text-xl font-display font-bold text-slate-800">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-emerald-100 shadow-sm p-5">
        <p class="text-xs font-medium text-emerald-600 uppercase tracking-wider mb-1">Sudah Dibayar</p>
        <p class="text-xl font-display font-bold text-emerald-700">Rp {{ number_format($totalBayar, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-rose-100 shadow-sm p-5">
        <p class="text-xs font-medium text-rose-600 uppercase tracking-wider mb-1">Tunggakan</p>
        <p class="text-xl font-display font-bold text-rose-700">Rp {{ number_format($totalTunggakan, 0, ',', '.') }}</p>
    </div>
</div>

{{-- Tagihan Belum Bayar --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mt-6">
    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="text-lg font-display font-semibold text-slate-800">Tagihan Belum Dibayar</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-6 py-4 font-medium">Bulan</th>
                    <th class="px-6 py-4 font-medium">Tahun Ajaran</th>
                    <th class="px-6 py-4 font-medium">Nominal</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($belumBayar as $tagihan)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-medium text-slate-700">{{ $tagihan->namaBulan() }}</td>
                    <td class="px-6 py-4 text-slate-700">{{ $tagihan->tahunAjaran->nama ?? '-' }} - Sem {{ $tagihan->tahunAjaran->semester ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-700">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">Belum Bayar</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-400">Tidak ada tagihan yang belum dibayar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Riwayat Pembayaran (Sudah Bayar) --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mt-6">
    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="text-lg font-display font-semibold text-slate-800">Riwayat Pembayaran</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-6 py-4 font-medium">Bulan</th>
                    <th class="px-6 py-4 font-medium">Tahun Ajaran</th>
                    <th class="px-6 py-4 font-medium">Nominal</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($sudahBayar as $tagihan)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-medium text-slate-700">{{ $tagihan->namaBulan() }}</td>
                    <td class="px-6 py-4 text-slate-700">{{ $tagihan->tahunAjaran->nama ?? '-' }} - Sem {{ $tagihan->tahunAjaran->semester ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-700">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Sudah Bayar</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada riwayat pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    <a href="{{ route('bendahara.siswa.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">Kembali ke Daftar</a>
</div>
@endsection
