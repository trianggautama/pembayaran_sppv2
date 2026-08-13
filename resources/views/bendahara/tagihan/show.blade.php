@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Detail Tagihan</h2>
            <p class="text-slate-500 mt-1">Informasi lengkap tagihan SPP siswa</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('bendahara.tagihan.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">
                Kembali
            </a>
            <form action="{{ route('bendahara.tagihan.destroy', $tagihan) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tagihan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-rose-500 text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-rose-600 transition">
                    Hapus Tagihan
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                <div>
                    <h3 class="text-sm font-medium text-slate-500 mb-1">Nama Siswa</h3>
                    <p class="text-lg font-semibold text-slate-800">{{ $tagihan->siswa->nama ?? '-' }}</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-slate-500 mb-1">NIS</h3>
                    <p class="text-base text-slate-800">{{ $tagihan->siswa->nis ?? '-' }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-slate-500 mb-1">Kelas</h3>
                    <p class="text-base text-slate-800">{{ $tagihan->siswa->kelas->nama ?? '-' }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-slate-500 mb-1">Tahun Ajaran</h3>
                    <p class="text-base text-slate-800">{{ $tagihan->tahunAjaran->nama ?? '-' }} (Semester {{ $tagihan->tahunAjaran->semester ?? '-' }})</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-slate-500 mb-1">Bulan</h3>
                    <p class="text-base text-slate-800">{{ $tagihan->namaBulan() }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-slate-500 mb-1">Nominal</h3>
                    <p class="text-xl font-bold text-slate-800">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-slate-500 mb-1">Status</h3>
                    <div class="mt-1">
                        @if($tagihan->status === 'sudah_bayar')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">
                                Sudah Bayar
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-rose-100 text-rose-700">
                                Belum Bayar
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
