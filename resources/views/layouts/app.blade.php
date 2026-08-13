<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPP Sukamaju') — SPP Sukamaju | Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

<div class="flex min-h-screen">

  <!-- OVERLAY (mobile) -->
  <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm hidden lg:hidden" onclick="toggleSidebar()"></div>

  <!-- SIDEBAR -->
  <aside id="sidebar" class="w-64 shrink-0 bg-navy text-white flex flex-col fixed inset-y-0 left-0 z-50 transition-transform duration-300 -translate-x-full lg:translate-x-0">
    <div class="flex items-center gap-3 px-6 h-20 border-b border-white/10">
      <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center shrink-0">
        <svg viewBox="0 0 24 24" class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5-10-5Z"/><path d="M6 12v5c0 1.5 3 3 6 3s6-1.5 6-3v-5"/></svg>
      </div>
      <div class="leading-tight flex-1">
        <p class="font-display font-bold text-sm tracking-wide">SPP Sukamaju</p>
        <p class="text-[11px] text-sky">SD Negeri 01</p>
      </div>
      <!-- Close button (mobile) -->
      <button onclick="toggleSidebar()" class="lg:hidden w-8 h-8 rounded-lg flex items-center justify-center hover:bg-white/10 transition">
        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
      </button>
    </div>

    <nav class="flex-1 px-3 py-6 space-y-1 text-sm overflow-y-auto">
      <p class="px-3 pb-2 text-[11px] font-semibold text-sky/70 uppercase tracking-wider">Menu Utama</p>

      @php $currentRoute = Route::currentRouteName(); @endphp

      <a href="{{ route('dashboard') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $currentRoute === 'dashboard' ? 'bg-white/10 font-medium' : 'text-sky/90 hover:bg-white/10 hover:text-white transition' }}">
        @if($currentRoute === 'dashboard')
          <span class="absolute left-0 top-1.5 bottom-1.5 w-1 rounded-full bg-primary"></span>
        @endif
        <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V20a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1V9.5"/></svg>
        Beranda
      </a>

      @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.siswa.index') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl {{ Str::startsWith($currentRoute, 'admin.siswa') ? 'bg-white/10 font-medium' : 'text-sky/90 hover:bg-white/10 hover:text-white transition' }}">
          @if(Str::startsWith($currentRoute, 'admin.siswa'))
            <span class="absolute left-0 top-1.5 bottom-1.5 w-1 rounded-full bg-primary"></span>
          @endif
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 20v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M22 20v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          Kelola Data Siswa
        </a>
        <a href="{{ route('admin.kelas.index') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl {{ Str::startsWith($currentRoute, 'admin.kelas') ? 'bg-white/10 font-medium' : 'text-sky/90 hover:bg-white/10 hover:text-white transition' }}">
          @if(Str::startsWith($currentRoute, 'admin.kelas'))
            <span class="absolute left-0 top-1.5 bottom-1.5 w-1 rounded-full bg-primary"></span>
          @endif
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
          Kelola Data Kelas
        </a>
        <a href="{{ route('admin.users.index') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl {{ Str::startsWith($currentRoute, 'admin.users') ? 'bg-white/10 font-medium' : 'text-sky/90 hover:bg-white/10 hover:text-white transition' }}">
          @if(Str::startsWith($currentRoute, 'admin.users'))
            <span class="absolute left-0 top-1.5 bottom-1.5 w-1 rounded-full bg-primary"></span>
          @endif
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          Kelola Akun User
        </a>
      @elseif(Auth::user()->isBendahara())
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sky/90 hover:bg-white/10 hover:text-white transition">
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 20v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M22 20v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          Data Siswa
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sky/90 hover:bg-white/10 hover:text-white transition">
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h6"/></svg>
          Tagihan SPP
        </a>
        <a href="#" class="flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-sky/90 hover:bg-white/10 hover:text-white transition">
          <span class="flex items-center gap-3">
            <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
            Verifikasi Pembayaran
          </span>
          <span class="text-[11px] font-semibold bg-primary text-white rounded-full px-1.5 py-0.5 min-w-[18px] text-center">12</span>
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sky/90 hover:bg-white/10 hover:text-white transition">
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18 17V9M13 17V5M8 17v-3"/></svg>
          Laporan Pembayaran
        </a>
      @elseif(Auth::user()->isWaliSiswa())
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sky/90 hover:bg-white/10 hover:text-white transition">
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6"/><path d="M9 13h6M9 17h6"/></svg>
          Tagihan Saya
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sky/90 hover:bg-white/10 hover:text-white transition">
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18 17V9M13 17V5M8 17v-3"/></svg>
          Riwayat Pembayaran
        </a>
      @endif

      <p class="px-3 pt-6 pb-2 text-[11px] font-semibold text-sky/70 uppercase tracking-wider">Lainnya</p>
      <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sky/90 hover:bg-white/10 hover:text-white transition">
        <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z"/></svg>
        Pengaturan
      </a>
    </nav>

    <div class="p-3 border-t border-white/10">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sky/90 hover:bg-white/10 hover:text-white transition text-sm">
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
          Keluar
        </button>
      </form>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="lg:ml-64 flex-1 flex flex-col min-w-0">

    <!-- TOPBAR -->
    <header class="sticky top-0 z-20 bg-white/90 backdrop-blur border-b border-slate-100 px-4 sm:px-6 lg:px-8 h-16 lg:h-20 flex items-center justify-between gap-4">
      <!-- Hamburger (mobile) -->
      <button onclick="toggleSidebar()" class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center hover:bg-slate-100 transition shrink-0">
        <svg viewBox="0 0 24 24" class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/></svg>
      </button>
      <div class="min-w-0">
        <h1 class="font-display font-bold text-lg lg:text-xl text-slate-900 truncate">@yield('page-title', 'Beranda')</h1>
        <p class="text-xs text-slate-400 truncate hidden sm:block">@yield('page-subtitle', 'Ringkasan aktivitas pembayaran SPP hari ini')</p>
      </div>
      <div class="flex items-center gap-2 sm:gap-4 shrink-0">
        <label class="relative hidden md:block">
          <svg viewBox="0 0 24 24" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
          <input type="text" placeholder="Cari nama siswa..." class="pl-10 pr-4 py-2.5 w-64 rounded-full bg-pale text-sm placeholder:text-slate-400 border border-transparent focus:outline-none focus:border-primary focus:bg-white transition">
        </label>
        <button class="relative w-10 h-10 rounded-full bg-pale flex items-center justify-center hover:bg-sky/40 transition">
          <svg viewBox="0 0 24 24" class="w-[18px] h-[18px] text-navy" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
        </button>
        <div class="w-px h-8 bg-slate-200 hidden sm:block"></div>
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-navy text-white flex items-center justify-center font-display font-semibold text-sm">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
          </div>
          <div class="hidden sm:block leading-tight">
            <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
            <p class="text-xs text-slate-400">{{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}</p>
          </div>
        </div>
      </div>
    </header>

    <main class="p-4 sm:p-6 lg:p-8 space-y-6">
      @yield('content')
    </main>
  </div>
</div>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const isOpen = !sidebar.classList.contains('-translate-x-full');
    if (isOpen) {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    } else {
      sidebar.classList.remove('-translate-x-full');
      overlay.classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }
  }
</script>

</body>
</html>
