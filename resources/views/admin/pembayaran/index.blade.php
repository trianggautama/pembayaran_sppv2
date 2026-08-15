@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Data Pembayaran</h2>
            <p class="text-slate-500 mt-1">Seluruh riwayat pembayaran SPP siswa (hanya lihat)</p>
        </div>
        <a href="{{ route('admin.pembayaran.cetak-pdf', request()->query()) }}" target="_blank" class="inline-flex items-center justify-center bg-slate-700 text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-800 transition whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9V2h12v7"/>
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                <rect width="12" height="8" x="6" y="14"/>
            </svg>
            Cetak Rekap PDF
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('admin.pembayaran.index') }}" method="GET" class="flex flex-wrap gap-4">
                <div class="w-full sm:w-auto flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa / NIS..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                </div>
                <div class="w-full sm:w-auto flex-1 min-w-[150px]">
                    <select name="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        <option value="semua" {{ request('status', 'semua') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Pembayaran Diterima</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Pembayaran Ditolak</option>
                    </select>
                </div>
                <button type="submit" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition w-full sm:w-auto">
                    Filter
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/50 text-slate-500 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 font-medium">Tanggal Bayar</th>
                        <th class="px-6 py-4 font-medium">Siswa</th>
                        <th class="px-6 py-4 font-medium">Tagihan</th>
                        <th class="px-6 py-4 font-medium">Metode</th>
                        <th class="px-6 py-4 font-medium">Total</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Diproses</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pembayarans as $pembayaran)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pembayaran->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-800">{{ $pembayaran->siswa->nama ?? '-' }}</div>
                                <div class="text-xs text-slate-500">{{ $pembayaran->siswa->nis ?? '-' }} &bull; {{ $pembayaran->siswa->kelas->nama ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <ul class="list-disc list-inside text-xs">
                                    @foreach($pembayaran->tagihan as $tagihan)
                                        <li>{{ $tagihan->namaBulan() }} {{ $tagihan->tahunAjaran->nama ?? '' }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4">{{ $pembayaran->labelMetode() }}</td>
                            <td class="px-6 py-4 font-medium">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($pembayaran->status === 'diverifikasi')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                        Diterima
                                    </span>
                                @elseif($pembayaran->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                        Menunggu
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($pembayaran->verified_at)
                                    <div class="text-xs text-slate-800 font-medium">{{ $pembayaran->verifiedBy->name ?? '-' }}</div>
                                    <div class="text-xs text-slate-500">{{ $pembayaran->verified_at->format('d M Y H:i') }}</div>
                                @else
                                    <span class="text-xs text-slate-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                Belum ada data pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pembayarans->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $pembayarans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
