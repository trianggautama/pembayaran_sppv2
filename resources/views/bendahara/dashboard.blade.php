@extends('layouts.app')

@section('page-title', 'Dashboard Bendahara')
@section('page-subtitle', 'Ringkasan aktivitas hari ini')

@section('content')

  <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-navy via-navy to-primary p-5 sm:p-7 text-white">
    <div class="relative z-10">
      <p class="text-sky text-xs font-semibold uppercase tracking-wider mb-1">{{ now()->translatedFormat('l, d F Y') }}</p>
      <h2 class="font-display font-bold text-xl sm:text-2xl mb-1.5">Selamat datang, {{ Auth::user()->name }}</h2>
      <p class="text-sm text-sky/90 max-w-md">Ada <span class="font-semibold text-white">{{ $menungguVerifikasi }} bukti pembayaran</span> yang menunggu diverifikasi oleh bendahara hari ini.</p>
    </div>
    <svg class="absolute -right-6 -bottom-10 w-56 h-56 text-white/10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="12"/></svg>
    <svg class="absolute right-16 -top-8 w-28 h-28 text-white/10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="12"/></svg>
  </section>
  <!-- Stats Grid -->
  <section class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100 flex items-center justify-between relative overflow-hidden group">
      <div>
        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Tagihan Diterbitkan</p>
        <p class="text-3xl font-display font-bold text-slate-800">{{ $tagihanBulanIni }}</p>
        <div class="flex items-center gap-1.5 mt-2">
          <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded flex items-center gap-1">
            <svg viewBox="0 0 24 24" class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
            Bulan ini
          </span>
        </div>
      </div>
      <div class="w-14 h-14 rounded-2xl bg-pale text-primary flex items-center justify-center rotate-3 group-hover:-rotate-3 transition">
        <svg viewBox="0 0 24 24" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
      </div>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100 flex items-center justify-between relative overflow-hidden group">
      <div>
        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Menunggu Verifikasi</p>
        <p class="text-3xl font-display font-bold text-slate-800">{{ $menungguVerifikasi }}</p>
        <div class="flex items-center gap-1.5 mt-2">
          <span class="text-[10px] font-semibold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded flex items-center gap-1">
            <svg viewBox="0 0 24 24" class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Perlu dicek
          </span>
        </div>
      </div>
      <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center -rotate-3 group-hover:rotate-3 transition">
        <svg viewBox="0 0 24 24" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
      </div>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100 flex items-center justify-between relative overflow-hidden group">
      <div>
        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Pembayaran Lunas</p>
        <p class="text-3xl font-display font-bold text-slate-800 tracking-tight">{{ number_format($pembayaranLunas / 1000000, 1, ',', '.') }}<span class="text-xl text-slate-500 font-medium">Jt</span></p>
        <div class="flex items-center gap-1.5 mt-2">
          <span class="text-[10px] font-semibold text-slate-500 bg-slate-50 px-1.5 py-0.5 rounded">Bulan ini</span>
        </div>
      </div>
      <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center rotate-3 group-hover:-rotate-3 transition">
        <svg viewBox="0 0 24 24" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
      </div>
    </div>
  </section>

  <!-- Quick Actions -->
  <section class="flex flex-wrap items-center gap-3 mb-8">
    <a href="{{ route('bendahara.tagihan.index') }}" class="flex items-center gap-2 bg-primary text-white px-4 py-2.5 rounded-xl font-semibold text-sm hover:bg-navy transition shadow-sm shadow-primary/30">
      <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Kelola Tagihan 
    </a>
    <a href="{{ route('bendahara.verifikasi.index') }}" class="flex items-center gap-2 bg-white text-slate-700 border border-slate-200 px-4 py-2.5 rounded-xl font-semibold text-sm hover:bg-slate-50 hover:border-slate-300 transition">
      <svg viewBox="0 0 24 24" class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
      Verifikasi Pembayaran
    </a>
  </section>

  <section class="mb-8">
    {{-- <div class="flex items-center justify-between mb-4">
      <h2 class="font-display font-bold text-slate-800 text-lg">Menunggu Verifikasi Terbaru</h2>
      <a href="#" class="text-xs font-semibold text-primary hover:text-navy flex items-center gap-1">Lihat Semua <svg viewBox="0 0 24 24" class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></a>
    </div> --}}
{{-- 
    <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm shadow-slate-100">
      <div class="overflow-x-auto">
      <table class="w-full text-left text-sm whitespace-nowrap">
        <thead class="bg-slate-50/50 text-slate-500">
          <tr>
            <th class="font-medium px-6 py-3">Siswa</th>
            <th class="font-medium px-6 py-3">Tagihan</th>
            <th class="font-medium px-6 py-3">Metode</th>
            <th class="font-medium px-6 py-3">Status</th>
            <th class="font-medium px-6 py-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          <tr class="hover:bg-pale/40 transition">
            <td class="px-6 py-3.5">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-pale text-navy flex items-center justify-center text-xs font-bold shrink-0">KA</div>
                <div>
                  <p class="font-medium text-slate-800 leading-tight">Keisha Anindya</p>
                  <p class="text-xs text-slate-400">Kelas 4A</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-3.5 text-slate-600">Rp 250.000</td>
            <td class="px-6 py-3.5 text-slate-500">Transfer Bank</td>
            <td class="px-6 py-3.5"><span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">Menunggu Verifikasi</span></td>
            <td class="px-6 py-3.5 text-right"><button class="text-xs font-semibold text-primary hover:text-navy bg-pale px-3 py-1.5 rounded-lg">Verifikasi</button></td>
          </tr>
          <tr class="hover:bg-pale/40 transition">
            <td class="px-6 py-3.5">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-pale text-navy flex items-center justify-center text-xs font-bold shrink-0">BS</div>
                <div>
                  <p class="font-medium text-slate-800 leading-tight">Bagas Setiawan</p>
                  <p class="text-xs text-slate-400">Kelas 5B</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-3.5 text-slate-600">Rp 250.000</td>
            <td class="px-6 py-3.5 text-slate-500">Transfer Bank</td>
            <td class="px-6 py-3.5"><span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">Menunggu Verifikasi</span></td>
            <td class="px-6 py-3.5 text-right"><button class="text-xs font-semibold text-primary hover:text-navy bg-pale px-3 py-1.5 rounded-lg">Verifikasi</button></td>
          </tr>
          <tr class="hover:bg-pale/40 transition">
            <td class="px-6 py-3.5">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-pale text-navy flex items-center justify-center text-xs font-bold shrink-0">AP</div>
                <div>
                  <p class="font-medium text-slate-800 leading-tight">Aulia Putri</p>
                  <p class="text-xs text-slate-400">Kelas 1A</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-3.5 text-slate-600">Rp 250.000</td>
            <td class="px-6 py-3.5 text-slate-500">Transfer Bank</td>
            <td class="px-6 py-3.5"><span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">Menunggu Verifikasi</span></td>
            <td class="px-6 py-3.5 text-right"><button class="text-xs font-semibold text-primary hover:text-navy bg-pale px-3 py-1.5 rounded-lg">Verifikasi</button></td>
          </tr>
        </tbody>
      </table>
      </div>
    </div> --}}
  </section>

@endsection