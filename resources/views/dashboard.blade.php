@extends('layouts.app')

@section('title', 'Beranda')
@section('page-title', 'Beranda')
@section('page-subtitle', 'Ringkasan aktivitas pembayaran SPP hari ini')

@section('content')

  <!-- WELCOME BANNER -->
  <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-navy via-navy to-primary p-5 sm:p-7 text-white">
    <div class="relative z-10">
      <p class="text-sky text-xs font-semibold uppercase tracking-wider mb-1">{{ now()->translatedFormat('l, d F Y') }}</p>
      <h2 class="font-display font-bold text-xl sm:text-2xl mb-1.5">Selamat datang, {{ Auth::user()->name }}</h2>
      <p class="text-sm text-sky/90 max-w-md">Ada <span class="font-semibold text-white">{{ $menungguVerifikasi }} bukti pembayaran</span> yang menunggu diverifikasi oleh bendahara hari ini.</p>
    </div>
    <svg class="absolute -right-6 -bottom-10 w-56 h-56 text-white/10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="12"/></svg>
    <svg class="absolute right-16 -top-8 w-28 h-28 text-white/10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="12"/></svg>
  </section>

  <!-- STAT CARDS -->
  <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100">
      <div class="flex items-center justify-between mb-4">
        <div class="w-10 h-10 rounded-xl bg-pale flex items-center justify-center">
          <svg viewBox="0 0 24 24" class="w-5 h-5 text-navy" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 20v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/></svg>
        </div>
        @if($siswaBaruBulanIni > 0)
          <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+{{ $siswaBaruBulanIni }} siswa</span>
        @endif
      </div>
      <p class="text-2xl font-display font-bold text-slate-900">{{ number_format($totalSiswa) }}</p>
      <p class="text-xs text-slate-400 mt-1">Total Siswa Aktif</p>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100">
      <div class="flex items-center justify-between mb-4">
        <div class="w-10 h-10 rounded-xl bg-pale flex items-center justify-center">
          <svg viewBox="0 0 24 24" class="w-5 h-5 text-navy" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h6"/></svg>
        </div>
        <span class="text-[11px] font-semibold text-slate-400 bg-slate-50 px-2 py-1 rounded-full">Bulan ini</span>
      </div>
      <p class="text-2xl font-display font-bold text-slate-900">{{ number_format($tagihanBulanIni) }}</p>
      <p class="text-xs text-slate-400 mt-1">Tagihan Diterbitkan</p>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100">
      <div class="flex items-center justify-between mb-4">
        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
          <svg viewBox="0 0 24 24" class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        </div>
        @if($menungguVerifikasi > 0)
          <span class="text-[11px] font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Perlu aksi</span>
        @endif
      </div>
      <p class="text-2xl font-display font-bold text-slate-900">{{ $menungguVerifikasi }}</p>
      <p class="text-xs text-slate-400 mt-1">Menunggu Verifikasi</p>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100">
      <div class="flex items-center justify-between mb-4">
        <div class="w-10 h-10 rounded-xl bg-pale flex items-center justify-center">
          <svg viewBox="0 0 24 24" class="w-5 h-5 text-navy" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
        </div>
        @if($persenLunas > 0)
          <span class="text-[11px] font-semibold text-primary bg-pale px-2 py-1 rounded-full">{{ $persenLunas }}%</span>
        @endif
      </div>
      <p class="text-2xl font-display font-bold text-slate-900">Rp {{ number_format($pembayaranLunas / 1000000, 1, ',', '.') }}Jt</p>
      <p class="text-xs text-slate-400 mt-1">Pembayaran Lunas &mdash; {{ $namaBulan }}</p>
    </div>
  </section>

  <!-- ALUR PEMBAYARAN -->
  <section class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-100 shadow-sm shadow-slate-100">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-2">
      <div>
        <h3 class="font-display font-bold text-slate-900">Alur Pembayaran SPP</h3>
        <p class="text-xs text-slate-400 mt-0.5">Posisi tagihan bulan {{ $namaBulan }} di setiap tahapan proses</p>
      </div>
      <a href="{{ route('admin.tagihan.index') }}" class="text-xs font-semibold text-primary hover:text-navy">Lihat semua tagihan &rarr;</a>
    </div>

    <div class="overflow-x-auto pb-2">
      <div class="flex items-start min-w-[920px]">

        <!-- step 1 -->
        <div class="flex flex-col items-center text-center w-[115px] shrink-0">
          <div class="w-11 h-11 rounded-full bg-navy text-white flex items-center justify-center">
            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 20v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M20 8v6M23 11h-6"/></svg>
          </div>
          <p class="text-xs font-semibold text-slate-800 mt-2.5 leading-tight">Input Data<br>Siswa</p>
          <p class="text-[10px] text-slate-400 mt-0.5">Admin</p>
        </div>

        <div class="flex-1 h-11 flex items-center"><div class="w-full h-0.5 bg-navy"></div></div>

        <!-- step 2 -->
        <div class="flex flex-col items-center text-center w-[115px] shrink-0">
          <div class="w-11 h-11 rounded-full bg-navy text-white flex items-center justify-center">
            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h6"/></svg>
          </div>
          <p class="text-xs font-semibold text-slate-800 mt-2.5 leading-tight">Buat<br>Tagihan</p>
          <p class="text-[10px] text-slate-400 mt-0.5">Bendahara</p>
        </div>

        <div class="flex-1 h-11 flex items-center"><div class="w-full h-0.5 bg-navy"></div></div>

        <!-- step 3 -->
        <div class="flex flex-col items-center text-center w-[115px] shrink-0">
          <div class="w-11 h-11 rounded-full bg-navy text-white flex items-center justify-center">
            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/></svg>
          </div>
          <p class="text-xs font-semibold text-slate-800 mt-2.5 leading-tight">Wali Murid<br>Login</p>
          <p class="text-[10px] text-slate-400 mt-0.5">Selesai</p>
        </div>

        <div class="flex-1 h-11 flex items-center"><div class="w-full h-0.5 bg-navy"></div></div>

        <!-- step 4 -->
        <div class="flex flex-col items-center text-center w-[115px] shrink-0">
          <div class="w-11 h-11 rounded-full bg-primary text-white flex items-center justify-center ring-4 ring-pale">
            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
          </div>
          <p class="text-xs font-semibold text-slate-800 mt-2.5 leading-tight">Lihat<br>Tagihan</p>
          <span class="text-[10px] font-semibold text-primary mt-0.5">{{ $tagihanBulanIni }} diterbitkan</span>
        </div>

        <div class="flex-1 h-11 flex items-center"><div class="w-full h-0.5 bg-sky"></div></div>

        <!-- step 5 -->
        <div class="flex flex-col items-center text-center w-[125px] shrink-0">
          <div class="relative">
            <div class="w-11 h-11 rounded-full bg-primary text-white flex items-center justify-center ring-4 ring-pale">
              <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="M17 8l-5-5-5 5"/><path d="M12 3v12"/></svg>
            </div>
            @if($menungguVerifikasi > 0)
              <span class="absolute -top-1.5 -right-1.5 text-[10px] font-bold bg-navy text-white rounded-full w-5 h-5 flex items-center justify-center">{{ $menungguVerifikasi }}</span>
            @endif
          </div>
          <p class="text-xs font-semibold text-slate-800 mt-2.5 leading-tight">Upload Bukti<br>Pembayaran</p>
          <p class="text-[10px] text-slate-400 mt-0.5">Wali murid</p>
        </div>

        <div class="flex-1 h-11 flex items-center"><div class="w-full h-0.5 border-t-2 border-dashed border-sky"></div></div>

        <!-- step 6 -->
        <div class="flex flex-col items-center text-center w-[115px] shrink-0">
          <div class="relative">
            <div class="w-11 h-11 rounded-full bg-white text-primary border-2 border-sky flex items-center justify-center">
              <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
            </div>
            @if($menungguVerifikasi > 0)
              <span class="absolute -top-1.5 -right-1.5 text-[10px] font-bold bg-amber-500 text-white rounded-full w-5 h-5 flex items-center justify-center">{{ $menungguVerifikasi }}</span>
            @endif
          </div>
          <p class="text-xs font-semibold text-slate-800 mt-2.5 leading-tight">Verifikasi<br>Bendahara</p>
          <p class="text-[10px] text-amber-500 font-medium mt-0.5">{{ $menungguVerifikasi > 0 ? 'Menunggu' : 'Selesai' }}</p>
        </div>

        <div class="flex-1 h-11 flex items-center"><div class="w-full h-0.5 border-t-2 border-dashed border-sky"></div></div>

        <!-- step 7 -->
        <div class="flex flex-col items-center text-center w-[115px] shrink-0">
          <div class="w-11 h-11 rounded-full bg-white text-sky border-2 border-sky flex items-center justify-center">
            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          </div>
          <p class="text-xs font-semibold text-slate-800 mt-2.5 leading-tight">Status<br>Lunas</p>
          <p class="text-[10px] text-slate-400 mt-0.5">{{ $tagihanLunasBulanIni }} lunas</p>
        </div>

        <div class="flex-1 h-11 flex items-center"><div class="w-full h-0.5 border-t-2 border-dashed border-sky"></div></div>

        <!-- step 8 -->
        <div class="flex flex-col items-center text-center w-[115px] shrink-0">
          <div class="w-11 h-11 rounded-full bg-white text-sky border-2 border-sky flex items-center justify-center">
            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18 17V9M13 17V5M8 17v-3"/></svg>
          </div>
          <p class="text-xs font-semibold text-slate-800 mt-2.5 leading-tight">Laporan<br>Pembayaran</p>
          <p class="text-[10px] text-slate-400 mt-0.5">Otomatis</p>
        </div>

      </div>
    </div>
  </section>

  <!-- BOTTOM: TABLE + SIDE PANEL -->
  <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Recent table -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100 overflow-hidden">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between px-4 sm:px-6 pt-5 pb-4 gap-2">
        <div>
          <h3 class="font-display font-bold text-slate-900">Aktivitas Pembayaran Terbaru</h3>
          <p class="text-xs text-slate-400 mt-0.5">Bukti pembayaran yang baru diunggah wali murid</p>
        </div>
        <a href="#" class="text-xs font-semibold text-primary hover:text-navy">Lihat semua &rarr;</a>
      </div>
      <div class="overflow-x-auto">
      <table class="w-full text-sm min-w-[640px]">
        <thead>
          <tr class="text-left text-[11px] text-slate-400 uppercase tracking-wider border-y border-slate-100 bg-slate-50/60">
            <th class="px-6 py-3 font-semibold">Siswa</th>
            <th class="px-6 py-3 font-semibold">Tagihan</th>
            <th class="px-6 py-3 font-semibold">Tanggal Upload</th>
            <th class="px-6 py-3 font-semibold">Status</th>
            <th class="px-6 py-3 font-semibold text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($pembayaranTerbaru as $p)
            @php
              $initials = collect(explode(' ', $p->siswa->nama ?? ''))->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))->take(2)->join('');
              $kelasNama = $p->siswa->kelas->nama_kelas ?? '-';
              $tagihanLabel = $p->tagihan->first() ? 'SPP ' . $p->tagihan->first()->namaBulan() . ' ' . $p->created_at->year : '-';
              $statusMap = [
                  'pending' => ['label' => 'Menunggu Verifikasi', 'class' => 'text-amber-600 bg-amber-50'],
                  'diverifikasi' => ['label' => 'Lunas', 'class' => 'text-emerald-600 bg-emerald-50'],
                  'ditolak' => ['label' => 'Ditolak', 'class' => 'text-rose-500 bg-rose-50'],
              ];
              $st = $statusMap[$p->status] ?? $statusMap['pending'];
            @endphp
            <tr class="hover:bg-pale/40 transition">
              <td class="px-6 py-3.5">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-pale text-navy flex items-center justify-center text-xs font-bold shrink-0">{{ $initials }}</div>
                  <div>
                    <p class="font-medium text-slate-800 leading-tight">{{ $p->siswa->nama ?? '-' }}</p>
                    <p class="text-xs text-slate-400">{{ $kelasNama }}</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-3.5 text-slate-600">{{ $tagihanLabel }}</td>
              <td class="px-6 py-3.5 text-slate-500">{{ $p->created_at->translatedFormat('d M Y, H:i') }}</td>
              <td class="px-6 py-3.5"><span class="text-xs font-semibold {{ $st['class'] }} px-2.5 py-1 rounded-full">{{ $st['label'] }}</span></td>
              <td class="px-6 py-3.5 text-right"><button class="text-xs font-semibold text-primary hover:text-navy">Lihat Bukti</button></td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-8 text-center text-slate-400 text-sm">Belum ada aktivitas pembayaran</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      </div>
    </div>

    <!-- Side panel -->
    <div class="flex flex-col gap-6">

      <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm shadow-slate-100">
        <div class="flex items-center justify-between mb-4">
          <h3 class="font-display font-bold text-slate-900 text-sm">Menunggu Verifikasi</h3>
          <span class="text-[11px] font-semibold text-navy bg-pale px-2 py-0.5 rounded-full">{{ $menungguVerifikasi }} baru</span>
        </div>
        <div class="space-y-3.5">
          @forelse($pendingVerifikasi as $pv)
            @php
              $pvInitials = collect(explode(' ', $pv->siswa->nama ?? ''))->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))->take(2)->join('');
            @endphp
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-full bg-pale text-navy flex items-center justify-center text-xs font-bold shrink-0">{{ $pvInitials }}</div>
              <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-slate-800 truncate">{{ $pv->siswa->nama ?? '-' }}</p>
                <p class="text-xs text-slate-400">Rp {{ number_format($pv->total_bayar, 0, ',', '.') }} · {{ $pv->siswa->kelas->nama_kelas ?? '-' }}</p>
              </div>
              <button class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-100 transition">
                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
              </button>
            </div>
          @empty
            <p class="text-sm text-slate-400 text-center py-3">Tidak ada pembayaran menunggu</p>
          @endforelse
        </div>
      </div>

      <div class="bg-navy rounded-2xl p-5 text-white">
        <h3 class="font-display font-bold text-sm mb-1">Progres Pelunasan {{ $namaBulan }}</h3>
        <p class="text-xs text-sky/80 mb-4">{{ $tagihanLunasBulanIni }} dari {{ $tagihanBulanIni }} tagihan telah lunas</p>
        <div class="w-full h-2.5 rounded-full bg-white/15 overflow-hidden">
          <div class="h-full rounded-full bg-primary" style="width:{{ $persenLunas }}%"></div>
        </div>
        <div class="flex justify-between mt-2 text-xs">
          <span class="text-sky/80">{{ $persenLunas }}% tercapai</span>
          <span class="font-semibold">Rp {{ number_format($pembayaranLunas / 1000000, 1, ',', '.') }}Jt / {{ number_format($totalNominalTagihan / 1000000, 1, ',', '.') }}Jt</span>
        </div>
      </div>

    </div>
  </section>

@endsection
