@extends('layouts.app')

@section('page-title', 'Tagihan Saya')
@section('page-subtitle', 'Daftar tagihan SPP anak Anda')

@section('content')
<div x-data="{
    selectedMethod: '',
    checkedCount: 0,
    totalBayar: 0,
    fileName: '',
    updateTotal() {
        let total = 0;
        let count = 0;
        document.querySelectorAll('input[name=&quot;tagihan_ids[]&quot;]:checked').forEach(cb => {
            total += parseInt(cb.dataset.nominal);
            count++;
        });
        this.totalBayar = total;
        this.checkedCount = count;
    },
    formatRp(val) {
        return 'Rp ' + val.toLocaleString('id-ID');
    }
}">

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm">
    {{ session('success') }}
</div>
@endif

{{-- Info Siswa --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
        <div class="w-14 h-14 rounded-full bg-primary/10 text-primary flex items-center justify-center text-xl font-bold uppercase">
            {{ substr($siswa->nama, 0, 1) }}
        </div>
        <div>
            <h3 class="text-lg font-display font-semibold text-slate-800">{{ $siswa->nama }}</h3>
            <p class="text-sm text-slate-500">NIS: {{ $siswa->nis }} &middot; Kelas: {{ $siswa->kelas->nama_kelas }}</p>
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

{{-- Form Pembayaran wraps tabel belum bayar + panel pembayaran --}}
<form action="{{ route('wali-siswa.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
@csrf

{{-- Tagihan Belum Bayar --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mt-6">
    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="text-lg font-display font-semibold text-slate-800">Tagihan Belum Dibayar</h3>
        <p class="text-xs text-slate-400 mt-1">Centang tagihan yang ingin dibayar</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-6 py-4 font-medium w-12"></th>
                    <th class="px-6 py-4 font-medium">Bulan</th>
                    <th class="px-6 py-4 font-medium">Tahun Ajaran</th>
                    <th class="px-6 py-4 font-medium text-right">Nominal</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($belumBayar as $tagihan)
                <tr class="hover:bg-slate-50/50 transition cursor-pointer" @click="$refs['cb_{{ $tagihan->id }}'].click()">
                    <td class="px-6 py-4" @click.stop>
                        <input type="checkbox" name="tagihan_ids[]" value="{{ $tagihan->id }}" data-nominal="{{ $tagihan->nominal }}" x-ref="cb_{{ $tagihan->id }}" @change="updateTotal()" class="rounded border-slate-300 text-primary focus:ring-primary">
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-700">{{ $tagihan->namaBulan() }}</td>
                    <td class="px-6 py-4 text-slate-700">{{ $tagihan->tahunAjaran->nama ?? '-' }} - Sem {{ $tagihan->tahunAjaran->semester ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-700 text-right">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">Belum Bayar</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-400">Tidak ada tagihan yang belum dibayar.</td>
                </tr>
                @endforelse
            </tbody>
            @if($belumBayar->count() > 0)
            <tfoot>
                <tr class="bg-slate-50 border-t border-slate-100">
                    <td colspan="3" class="px-6 py-4 text-right font-semibold text-slate-700">Total Pembayaran:</td>
                    <td class="px-6 py-4 text-right font-bold text-lg text-primary" x-text="formatRp(totalBayar)">Rp 0</td>
                    <td></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
    @error('tagihan_ids')
        <div class="px-6 py-3 text-sm text-rose-600 bg-rose-50 border-t border-rose-100">{{ $message }}</div>
    @enderror
</div>

{{-- Panel Pembayaran — muncul ketika ada checkbox tercentang --}}
<div x-show="checkedCount > 0" x-cloak x-transition class="mt-6 space-y-6">

    {{-- Metode Pembayaran --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="text-lg font-display font-semibold text-slate-800">Metode Pembayaran</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Transfer Bank --}}
                <label class="cursor-pointer">
                    <input type="radio" name="metode" value="transfer_bank" x-model="selectedMethod" class="peer sr-only">
                    <div class="p-4 rounded-xl border border-slate-200 hover:border-slate-300 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:ring-1 peer-checked:ring-primary transition h-full flex flex-col items-center text-center">
                        <svg class="w-8 h-8 text-slate-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                        <div class="font-medium text-slate-800">Transfer Bank</div>
                        <div class="text-xs text-slate-500 mt-1">Transfer ke rekening sekolah</div>
                    </div>
                </label>

                {{-- QRIS --}}
                <label class="cursor-pointer">
                    <input type="radio" name="metode" value="qris" x-model="selectedMethod" class="peer sr-only">
                    <div class="p-4 rounded-xl border border-slate-200 hover:border-slate-300 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:ring-1 peer-checked:ring-primary transition h-full flex flex-col items-center text-center">
                        <svg class="w-8 h-8 text-slate-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><path d="M14 14h3v3h-3zM18 18h3v3h-3zM14 18h1v1h-1zM18 14h1v1h-1z"/></svg>
                        <div class="font-medium text-slate-800">QRIS</div>
                        <div class="text-xs text-slate-500 mt-1">Scan QR untuk pembayaran</div>
                    </div>
                </label>

                {{-- E-Wallet --}}
                <label class="cursor-pointer">
                    <input type="radio" name="metode" value="e_wallet" x-model="selectedMethod" class="peer sr-only">
                    <div class="p-4 rounded-xl border border-slate-200 hover:border-slate-300 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:ring-1 peer-checked:ring-primary transition h-full flex flex-col items-center text-center">
                        <svg class="w-8 h-8 text-slate-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M21 12V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7"/><path d="M16 16l2 2 4-4"/></svg>
                        <div class="font-medium text-slate-800">E-Wallet</div>
                        <div class="text-xs text-slate-500 mt-1">GoPay, OVO, DANA, ShopeePay</div>
                    </div>
                </label>
            </div>
            @error('metode')
                <p class="mt-3 text-sm text-rose-600">{{ $message }}</p>
            @enderror

            {{-- Info metode --}}
            <div class="mt-5">
                <div x-show="selectedMethod === 'transfer_bank'" x-cloak class="bg-blue-50 text-blue-800 p-4 rounded-xl text-sm border border-blue-100">
                    <p class="font-semibold mb-2">Informasi Rekening:</p>
                    <div class="space-y-1">
                        <p>Bank: <span class="font-medium">BRI</span></p>
                        <p>No. Rekening: <span class="font-medium">1234-5678-9012-3456</span></p>
                        <p>Atas Nama: <span class="font-medium">SDN 01 Sukamaju</span></p>
                    </div>
                </div>
                <div x-show="selectedMethod === 'qris'" x-cloak class="flex flex-col items-center gap-3 py-4">
                    <div class="w-[200px] h-[200px] bg-slate-100 rounded-xl border-2 border-dashed border-slate-300 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><path d="M14 14h3v3h-3zM18 18h3v3h-3z"/></svg>
                            <p class="text-xs text-slate-400 font-medium">QR Code Dummy</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Scan QR di atas menggunakan aplikasi pembayaran Anda</p>
                </div>
                <div x-show="selectedMethod === 'e_wallet'" x-cloak class="bg-blue-50 text-blue-800 p-4 rounded-xl text-sm border border-blue-100">
                    <p class="font-semibold mb-2">Transfer ke salah satu e-wallet berikut:</p>
                    <div class="space-y-1">
                        <p>GoPay: <span class="font-medium">081234567890</span></p>
                        <p>OVO: <span class="font-medium">081234567890</span></p>
                        <p>DANA: <span class="font-medium">081234567890</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Upload Bukti --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="text-lg font-display font-semibold text-slate-800">Upload Bukti Pembayaran</h3>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Bukti Pembayaran (PNG, JPG, PDF — Maks 2MB)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-primary transition">
                    <div class="space-y-2 text-center">
                        <svg class="mx-auto h-10 w-10 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                        <div class="flex text-sm text-slate-600 justify-center">
                            <label for="bukti_pembayaran" class="relative cursor-pointer rounded-md font-medium text-primary hover:text-navy">
                                <span x-text="fileName || 'Pilih file'">Pilih file</span>
                                <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="sr-only" accept=".png,.jpg,.jpeg,.pdf" @change="fileName = $event.target.files[0]?.name || ''">
                            </label>
                        </div>
                        <p class="text-xs text-slate-400" x-show="!fileName">PNG, JPG, atau PDF</p>
                    </div>
                </div>
                @error('bukti_pembayaran')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="catatan" class="block text-sm font-medium text-slate-700 mb-1">Catatan</label>
                <textarea name="catatan" id="catatan" rows="2" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Catatan tambahan (opsional)"></textarea>
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-3">
        <button type="submit" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition flex items-center gap-2">
            <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
            Kirim Pembayaran (<span x-text="checkedCount">0</span> tagihan)
        </button>
        <span class="text-sm text-slate-500">Total: <span class="font-bold text-primary" x-text="formatRp(totalBayar)">Rp 0</span></span>
    </div>
</div>

</form>

{{-- Riwayat Pembayaran --}}
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
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Terverifikasi</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">Ditolak</span>
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

</div>
@endsection
