@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('bendahara.verifikasi.index') }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Detail Pembayaran</h2>
            <p class="text-slate-500 mt-1">ID Pembayaran: #{{ str_pad($pembayaran->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-100 text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-rose-50 text-rose-700 p-4 rounded-xl border border-rose-100 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Informasi Pembayaran</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <div class="text-sm text-slate-500 mb-1">Tanggal Bayar</div>
                            <div class="font-medium text-slate-800">{{ $pembayaran->created_at->format('d F Y, H:i') }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-slate-500 mb-1">Metode Pembayaran</div>
                            <div class="font-medium text-slate-800">{{ $pembayaran->labelMetode() }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-slate-500 mb-1">Total Bayar</div>
                            <div class="font-bold text-xl text-primary">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-slate-500 mb-1">Status</div>
                            @if($pembayaran->status === 'diverifikasi')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                    Pembayaran Diterima
                                </span>
                            @elseif($pembayaran->status === 'ditolak')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">
                                    Pembayaran Ditolak
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                    Pending
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($pembayaran->status !== 'pending')
                    <div class="bg-slate-50 rounded-xl p-4 mt-6">
                        <div class="text-sm text-slate-500 mb-1">Diproses Oleh</div>
                        <div class="font-medium text-slate-800">{{ $pembayaran->verifiedBy->name ?? 'Admin' }} pada {{ $pembayaran->verified_at ? $pembayaran->verified_at->format('d F Y, H:i') : '-' }}</div>
                        
                        @if($pembayaran->status === 'ditolak' && $pembayaran->alasan_ditolak)
                            <div class="mt-4">
                                <div class="text-sm font-semibold text-rose-600 mb-1">Alasan Penolakan:</div>
                                <div class="text-sm text-slate-700">{{ $pembayaran->alasan_ditolak }}</div>
                            </div>
                        @endif
                    </div>
                    @endif

                    @if($pembayaran->catatan)
                        <div class="pt-6 border-t border-slate-100">
                            <div class="text-sm text-slate-500 mb-2">Catatan dari Wali Siswa</div>
                            <div class="p-4 bg-slate-50 rounded-xl text-sm text-slate-700">
                                {{ $pembayaran->catatan }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Tagihan yang Dibayar</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50/50 text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 font-medium">Bulan</th>
                                <th class="px-6 py-4 font-medium">Tahun Ajaran</th>
                                <th class="px-6 py-4 font-medium text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($pembayaran->tagihan as $tagihan)
                                <tr>
                                    <td class="px-6 py-4 font-medium text-slate-800">{{ $tagihan->namaBulan() }}</td>
                                    <td class="px-6 py-4">{{ $tagihan->tahunAjaran->nama ?? '-' }}</td>
                                    <td class="px-6 py-4 text-right">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-slate-50/50 font-bold text-slate-800 border-t border-slate-200">
                                <td colspan="2" class="px-6 py-4 text-right">Total:</td>
                                <td class="px-6 py-4 text-right text-primary">Rp {{ number_format($pembayaran->tagihan->sum('nominal'), 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($pembayaran->status === 'pending')
                <div x-data="{ showTolak: false }" class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden p-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">Aksi Verifikasi</h3>
                    
                    <div x-show="!showTolak" class="flex flex-col sm:flex-row gap-4">
                        <form action="{{ route('bendahara.verifikasi.terima', $pembayaran) }}" method="POST" class="flex-1" onsubmit="return confirm('Anda yakin ingin memverifikasi pembayaran ini? Tagihan terkait akan ditandai lunas.');">
                            @csrf
                            <button type="submit" class="w-full bg-emerald-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-emerald-700 transition flex justify-center items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                                Terima Pembayaran
                            </button>
                        </form>
                        
                        <button @click="showTolak = true" type="button" class="flex-1 bg-rose-50 text-rose-600 font-semibold px-6 py-3 rounded-xl hover:bg-rose-100 transition flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18M6 6l12 12"/>
                            </svg>
                            Tolak Pembayaran
                        </button>
                    </div>

                    <div x-show="showTolak" style="display: none;" class="space-y-4">
                        <form action="{{ route('bendahara.verifikasi.tolak', $pembayaran) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="alasan_ditolak" class="block text-sm font-medium text-slate-700 mb-2">Alasan Penolakan <span class="text-rose-500">*</span></label>
                                <textarea name="alasan_ditolak" id="alasan_ditolak" rows="3" required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition"
                                    placeholder="Masukkan alasan mengapa pembayaran ditolak..."></textarea>
                            </div>
                            
                            <div class="flex gap-4">
                                <button type="submit" class="flex-1 bg-rose-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-rose-700 transition">
                                    Konfirmasi Tolak
                                </button>
                                <button @click="showTolak = false" type="button" class="px-6 py-3 text-slate-500 font-semibold hover:bg-slate-100 rounded-xl transition">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Data Siswa</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <div class="text-sm text-slate-500 mb-1">Nama Lengkap</div>
                        <div class="font-medium text-slate-800">{{ $pembayaran->siswa->nama ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-slate-500 mb-1">NIS</div>
                        <div class="font-medium text-slate-800">{{ $pembayaran->siswa->nis ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-slate-500 mb-1">Kelas</div>
                        <div class="font-medium text-slate-800">{{ $pembayaran->siswa->kelas->nama ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Bukti Pembayaran</h3>
                </div>
                <div class="p-6">
                    @if($pembayaran->bukti_pembayaran)
                        <a href="{{ Storage::url($pembayaran->bukti_pembayaran) }}" target="_blank" class="block group relative rounded-xl overflow-hidden border border-slate-200">
                            @if(Str::endsWith($pembayaran->bukti_pembayaran, ['.pdf']))
                                <div class="p-8 flex flex-col items-center justify-center bg-slate-50 text-slate-500 group-hover:bg-slate-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                        <line x1="16" y1="13" x2="8" y2="13"/>
                                        <line x1="16" y1="17" x2="8" y2="17"/>
                                        <polyline points="10 9 9 9 8 9"/>
                                    </svg>
                                    <span class="font-medium">Lihat Dokumen PDF</span>
                                </div>
                            @else
                                <img src="{{ Storage::url($pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-full h-auto object-cover">
                                <div class="absolute inset-0 bg-slate-900/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center backdrop-blur-[2px]">
                                    <span class="text-white font-medium bg-white/20 px-4 py-2 rounded-lg backdrop-blur-md">Lihat Gambar Penuh</span>
                                </div>
                            @endif
                        </a>
                    @else
                        <div class="p-8 text-center bg-slate-50 rounded-xl border border-slate-100 text-slate-500 text-sm">
                            Tidak ada bukti pembayaran yang dilampirkan.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection