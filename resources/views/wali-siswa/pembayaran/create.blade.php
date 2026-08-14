@extends('layouts.app')

@section('page-title', 'Bayar Tagihan SPP')
@section('page-subtitle', 'Pilih tagihan dan metode pembayaran')

@section('content')
<div x-data="{ 
    selectedMethod: '', 
    updateTotal() {
        let total = 0;
        document.querySelectorAll('input[name=\'tagihan_ids[]\']:checked').forEach(cb => {
            total += parseInt(cb.dataset.nominal);
        });
        document.getElementById('total-bayar').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }
}" x-init="updateTotal()">

    @if($tagihans->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center">
            <p class="text-slate-500">Tidak ada tagihan yang belum dibayar.</p>
        </div>
    @else
        <form action="{{ route('wali-siswa.pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Step 1: Pilih Tagihan -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="text-lg font-display font-semibold text-slate-800">Pilih Tagihan yang Akan Dibayar</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-sm font-medium border-b border-slate-100">
                                <th class="py-3 px-6 w-12"></th>
                                <th class="py-3 px-6">Bulan</th>
                                <th class="py-3 px-6">Tahun Ajaran</th>
                                <th class="py-3 px-6 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($tagihans as $tagihan)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="py-3 px-6">
                                    <input type="checkbox" name="tagihan_ids[]" value="{{ $tagihan->id }}" data-nominal="{{ $tagihan->nominal }}" @change="updateTotal" class="rounded border-slate-300 text-primary focus:ring-primary" {{ in_array($tagihan->id, $preselectedTagihans) ? 'checked' : '' }}>
                                </td>
                                <td class="py-3 px-6 text-slate-800 font-medium">{{ $tagihan->namaBulan() }}</td>
                                <td class="py-3 px-6 text-slate-500">{{ $tagihan->tahunAjaran->nama ?? '-' }} - Sem {{ $tagihan->tahunAjaran->semester ?? '-' }}</td>
                                <td class="py-3 px-6 text-right text-slate-800 font-medium">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-slate-50 font-medium border-t border-slate-100 text-slate-800">
                                <td colspan="3" class="py-4 px-6 text-right">Total Pembayaran:</td>
                                <td class="py-4 px-6 text-right text-primary font-bold text-lg" id="total-bayar">Rp 0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @error('tagihan_ids')
                    <div class="px-6 py-3 text-sm text-rose-600 bg-rose-50">{{ $message }}</div>
                @enderror
            </div>

            <!-- Step 2: Metode Pembayaran -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="text-lg font-display font-semibold text-slate-800">Pilih Metode Pembayaran</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Transfer Bank -->
                        <label class="cursor-pointer">
                            <input type="radio" name="metode" value="transfer_bank" x-model="selectedMethod" class="peer sr-only">
                            <div class="p-4 rounded-xl border border-slate-200 hover:border-slate-300 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:ring-1 peer-checked:ring-primary transition h-full flex flex-col items-center text-center">
                                <svg class="w-8 h-8 text-slate-600 mb-2 peer-checked:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                <div class="font-medium text-slate-800">Transfer Bank</div>
                                <div class="text-xs text-slate-500 mt-1">Transfer ke rekening sekolah</div>
                            </div>
                        </label>

                        <!-- QRIS -->
                        <label class="cursor-pointer">
                            <input type="radio" name="metode" value="qris" x-model="selectedMethod" class="peer sr-only">
                            <div class="p-4 rounded-xl border border-slate-200 hover:border-slate-300 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:ring-1 peer-checked:ring-primary transition h-full flex flex-col items-center text-center">
                                <svg class="w-8 h-8 text-slate-600 mb-2 peer-checked:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                <div class="font-medium text-slate-800">QRIS</div>
                                <div class="text-xs text-slate-500 mt-1">Scan QR untuk pembayaran</div>
                            </div>
                        </label>

                        <!-- E-Wallet -->
                        <label class="cursor-pointer">
                            <input type="radio" name="metode" value="e_wallet" x-model="selectedMethod" class="peer sr-only">
                            <div class="p-4 rounded-xl border border-slate-200 hover:border-slate-300 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:ring-1 peer-checked:ring-primary transition h-full flex flex-col items-center text-center">
                                <svg class="w-8 h-8 text-slate-600 mb-2 peer-checked:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                <div class="font-medium text-slate-800">E-Wallet</div>
                                <div class="text-xs text-slate-500 mt-1">GoPay, OVO, DANA, ShopeePay</div>
                            </div>
                        </label>
                    </div>
                    @error('metode')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror

                    <!-- Info Boxes -->
                    <div class="mt-6">
                        <div x-show="selectedMethod === 'transfer_bank'" style="display: none;" class="bg-blue-50 text-blue-800 p-4 rounded-xl text-sm whitespace-pre-line border border-blue-100">
                            Bank: BRI
                            No. Rekening: 1234-5678-9012-3456
                            Atas Nama: SDN 01 Sukamaju
                        </div>
                        <div x-show="selectedMethod === 'qris'" style="display: none;" class="flex justify-center mt-4">
                            <div class="w-[200px] h-[200px] bg-slate-100 rounded-xl border-2 border-dashed border-slate-300 flex items-center justify-center text-slate-400 font-medium">
                                QR Code
                            </div>
                        </div>
                        <div x-show="selectedMethod === 'e_wallet'" style="display: none;" class="bg-blue-50 text-blue-800 p-4 rounded-xl text-sm whitespace-pre-line border border-blue-100">
                            Silakan transfer ke salah satu e-wallet berikut:
                            GoPay: 081234567890
                            OVO: 081234567890
                            DANA: 081234567890
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Upload Bukti -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="text-lg font-display font-semibold text-slate-800">Upload Bukti Pembayaran</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Bukti Pembayaran (PNG, JPG, PDF — Maks 2MB)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-primary transition">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <label for="bukti_pembayaran" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-navy focus-within:outline-none">
                                        <span>Upload file</span>
                                        <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="sr-only" accept=".png,.jpg,.jpeg,.pdf">
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('bukti_pembayaran')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="catatan" class="block text-sm font-medium text-slate-700 mb-1">Catatan</label>
                        <textarea name="catatan" id="catatan" rows="3" class="w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary text-sm placeholder-slate-400" placeholder="Catatan tambahan (opsional)"></textarea>
                        @error('catatan')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4">
                <button type="submit" class="bg-primary text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-navy transition">Kirim Pembayaran</button>
                <a href="{{ route('wali-siswa.tagihan.index') }}" class="text-slate-500 hover:text-slate-700 font-medium">Batal</a>
            </div>
        </form>
    @endif
</div>
@endsection
