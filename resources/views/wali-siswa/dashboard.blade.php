@extends('layouts.app')

@section('page-title', 'Dashboard Wali Murid')
@section('page-subtitle', 'Informasi SPP anak Anda')

@section('content')
  <!-- WELCOME BANNER -->
  <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-navy via-navy to-primary p-5 sm:p-7 text-white mb-6">
    <div class="relative z-10">
      <p class="text-sky text-xs font-semibold uppercase tracking-wider mb-1">{{ now()->translatedFormat('l, d F Y') }}</p>
      <h2 class="font-display font-bold text-xl sm:text-2xl mb-1.5">Selamat datang, {{ Auth::user()->name }}</h2>
      <p class="text-sm text-sky/90 max-w-md">Pantau tagihan dan riwayat pembayaran SPP anak Anda dengan mudah melalui dashboard ini.</p>
    </div>
    <svg class="absolute -right-6 -bottom-10 w-56 h-56 text-white/10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="12"/></svg>
    <svg class="absolute right-16 -top-8 w-28 h-28 text-white/10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="12"/></svg>
  </section>

  <!-- Stats Grid -->
  <section class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100 flex items-center justify-between relative overflow-hidden group">
      <div>
        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Tunggakan</p>
        <p class="text-3xl font-display font-bold text-slate-800 tracking-tight">Rp 500<span class="text-xl text-slate-500 font-medium">Rb</span></p>
        <div class="flex items-center gap-1.5 mt-2">
          <span class="text-[10px] font-semibold text-rose-600 bg-rose-50 px-1.5 py-0.5 rounded flex items-center gap-1">
            <svg viewBox="0 0 24 24" class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Perlu dibayar
          </span>
        </div>
      </div>
      <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center -rotate-3 group-hover:rotate-3 transition">
        <svg viewBox="0 0 24 24" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 15h0M2 9.5h20"/></svg>
      </div>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100 flex items-center justify-between relative overflow-hidden group">
      <div>
        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Menunggu Verifikasi</p>
        <p class="text-3xl font-display font-bold text-slate-800">1</p>
        <div class="flex items-center gap-1.5 mt-2">
          <span class="text-[10px] font-semibold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded flex items-center gap-1">
            <svg viewBox="0 0 24 24" class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Dalam proses
          </span>
        </div>
      </div>
      <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center -rotate-3 group-hover:rotate-3 transition">
        <svg viewBox="0 0 24 24" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
      </div>
    </div>
    
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100 flex items-center justify-between relative overflow-hidden group">
      <div>
        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Lunas Bulan Ini</p>
        <p class="text-3xl font-display font-bold text-slate-800 tracking-tight">Rp 250<span class="text-xl text-slate-500 font-medium">Rb</span></p>
        <div class="flex items-center gap-1.5 mt-2">
          <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded flex items-center gap-1">
            <svg viewBox="0 0 24 24" class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
            Agustus 2026
          </span>
        </div>
      </div>
      <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center rotate-3 group-hover:-rotate-3 transition">
        <svg viewBox="0 0 24 24" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
      </div>
    </div>
  </section>

  <!-- Main Content Grid -->
  <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Actions and Information -->
    <div class="lg:col-span-2 flex flex-col gap-6">
      
      <!-- Quick Actions -->
      <div class="flex flex-wrap items-center gap-3">
        <a href="{{ route('wali-siswa.tagihan.index') }}" class="flex items-center gap-2 bg-primary text-white px-4 py-2.5 rounded-xl font-semibold text-sm hover:bg-navy transition shadow-sm shadow-primary/30">
          <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 15h0M2 9.5h20"/></svg>
          Bayar Tagihan
        </a>
        <a href="{{ route('wali-siswa.tagihan.riwayat') }}" class="flex items-center gap-2 bg-white text-slate-700 border border-slate-200 px-4 py-2.5 rounded-xl font-semibold text-sm hover:bg-slate-50 hover:border-slate-300 transition">
          <svg viewBox="0 0 24 24" class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
          Riwayat Pembayaran
        </a>
      </div>

      <!-- Informasi Tunggakan Bulan -->
      <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100">
        <div class="flex items-center justify-between mb-4">
          <h3 class="font-display font-bold text-slate-900 text-sm">Informasi Tunggakan (Tahun Ajaran Berjalan)</h3>
        </div>
        <div class="space-y-3">
          <div class="flex items-center justify-between p-3 rounded-xl border border-rose-100 bg-rose-50/50">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              </div>
              <div>
                <p class="text-sm font-semibold text-slate-800">Juli 2026</p>
                <p class="text-xs text-rose-500 font-medium">Belum dibayar</p>
              </div>
            </div>
            <span class="text-sm font-bold text-slate-800">Rp 250.000</span>
          </div>
          <div class="flex items-center justify-between p-3 rounded-xl border border-rose-100 bg-rose-50/50">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              </div>
              <div>
                <p class="text-sm font-semibold text-slate-800">Agustus 2026</p>
                <p class="text-xs text-rose-500 font-medium">Belum dibayar</p>
              </div>
            </div>
            <span class="text-sm font-bold text-slate-800">Rp 250.000</span>
          </div>
        </div>
      </div>

    </div>

    <!-- Right Column: Side panel -->
    <div class="flex flex-col gap-6">

      <!-- Informasi Siswa Panel -->
      <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100">
        <h3 class="font-display font-bold text-slate-900 text-sm mb-4">Informasi Siswa</h3>
        <div class="flex items-center gap-4 mb-4 pb-4 border-b border-slate-100">
          <div class="w-12 h-12 rounded-full bg-pale text-navy flex items-center justify-center text-lg font-bold shrink-0">KA</div>
          <div>
            <p class="font-medium text-slate-800">Keisha Anindya</p>
            <p class="text-xs text-slate-500">NIS: 1029384756</p>
          </div>
        </div>
        <div class="space-y-3">
          <div class="flex justify-between">
            <span class="text-xs text-slate-500">Kelas</span>
            <span class="text-xs font-semibold text-slate-800">4A</span>
          </div>
          <div class="flex justify-between">
            <span class="text-xs text-slate-500">Tahun Ajaran</span>
            <span class="text-xs font-semibold text-slate-800">2026/2027</span>
          </div>
          <div class="flex justify-between">
            <span class="text-xs text-slate-500">Tarif SPP</span>
            <span class="text-xs font-semibold text-slate-800">Rp 250.000 / bulan</span>
          </div>
        </div>
      </div>

    </div>
  </section>

@endsection