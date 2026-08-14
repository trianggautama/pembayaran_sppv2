@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Tagihan SPP</h2>
            <p class="text-slate-500 mt-1">Daftar tagihan SPP siswa</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('bendahara.tagihan.cetak-pdf', request()->query()) }}" target="_blank" class="inline-flex items-center justify-center bg-slate-700 text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-800 transition whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 9V2h12v7"/>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                    <rect width="12" height="8" x="6" y="14"/>
                </svg>
                Cetak PDF
            </a>
            <a href="{{ route('bendahara.tagihan.create') }}" class="inline-flex items-center justify-center bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition whitespace-nowrap">
                Generate Tagihan
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-100 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('bendahara.tagihan.index') }}" method="GET" class="flex flex-wrap gap-4">
                <div class="w-full sm:w-auto flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa / NIS..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                </div>
                <div class="w-full sm:w-auto flex-1 min-w-[200px]">
                    <select name="tahun_ajaran_id" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        <option value="">Semua Tahun Ajaran</option>
                        @foreach($tahunAjarans as $ta)
                            <option value="{{ $ta->id }}" {{ request('tahun_ajaran_id') == $ta->id ? 'selected' : '' }}>
                                {{ $ta->nama }} - Sem {{ $ta->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full sm:w-auto flex-1 min-w-[150px]">
                    <select name="bulan" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        <option value="">Semua Bulan</option>
                        @php
                            $bulans = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                                4 => 'April', 5 => 'Mei', 6 => 'Juni',
                                7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                                10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                        @endphp
                        @foreach($bulans as $num => $name)
                            <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full sm:w-auto flex-1 min-w-[150px]">
                    <select name="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        <option value="semua">Semua Status</option>
                        <option value="belum_bayar" {{ request('status') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="sudah_bayar" {{ request('status') == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
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
                        <th class="px-6 py-4 font-medium">Nama Siswa</th>
                        <th class="px-6 py-4 font-medium">NIS</th>
                        <th class="px-6 py-4 font-medium">Kelas</th>
                        <th class="px-6 py-4 font-medium">Bulan</th>
                        <th class="px-6 py-4 font-medium">Tahun Ajaran</th>
                        <th class="px-6 py-4 font-medium">Nominal</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tagihans as $tagihan)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $tagihan->siswa->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $tagihan->siswa->nis ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $tagihan->siswa->kelas->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $tagihan->namaBulan() }}</td>
                            <td class="px-6 py-4">{{ $tagihan->tahunAjaran->nama ?? '-' }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($tagihan->status === 'sudah_bayar')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                        Sudah Bayar
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">
                                        Belum Bayar
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('bendahara.tagihan.show', $tagihan) }}" 
                                       class="p-2 text-slate-400 hover:text-primary hover:bg-blue-50 rounded-lg transition"
                                       title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('bendahara.tagihan.destroy', $tagihan) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tagihan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18"/>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-slate-500">
                                Belum ada data tagihan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($tagihans->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $tagihans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
