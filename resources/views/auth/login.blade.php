<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SPP Sukamaju</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex items-center justify-center">

<div class="w-full max-w-md px-6">

  <!-- LOGO -->
  <div class="text-center mb-8">
    <div class="w-14 h-14 rounded-2xl bg-navy flex items-center justify-center mx-auto mb-4">
      <svg viewBox="0 0 24 24" class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5-10-5Z"/><path d="M6 12v5c0 1.5 3 3 6 3s6-1.5 6-3v-5"/></svg>
    </div>
    <h1 class="font-display font-bold text-2xl text-slate-900">SPP Sukamaju</h1>
    <p class="text-sm text-slate-400 mt-1">SD Negeri 01 — Sistem Pembayaran SPP</p>
  </div>

  <!-- LOGIN CARD -->
  <div class="bg-white rounded-2xl border border-slate-100 shadow-sm shadow-slate-100 p-8">
    <h2 class="font-display font-bold text-lg text-slate-900 mb-1">Masuk ke Akun</h2>
    <p class="text-sm text-slate-400 mb-6">Gunakan username dan password Anda</p>

    @if ($errors->any())
      <div class="bg-rose-50 border border-rose-200 text-rose-600 text-sm rounded-xl px-4 py-3 mb-5">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
      @csrf

      <div>
        <label for="username" class="block text-sm font-medium text-slate-700 mb-1.5">Username</label>
        <input
          type="text"
          id="username"
          name="username"
          value="{{ old('username') }}"
          required
          autofocus
          placeholder="Masukkan username"
          class="w-full px-4 py-3 rounded-xl bg-slate-50 text-sm border border-slate-200 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:bg-white focus:ring-2 focus:ring-primary/20 transition"
        >
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          required
          placeholder="Masukkan password"
          class="w-full px-4 py-3 rounded-xl bg-slate-50 text-sm border border-slate-200 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:bg-white focus:ring-2 focus:ring-primary/20 transition"
        >
      </div>

      <div class="flex items-center justify-between">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-primary focus:ring-primary/30">
          <span class="text-sm text-slate-500">Ingat saya</span>
        </label>
      </div>

      <button
        type="submit"
        class="w-full bg-navy text-white font-semibold text-sm py-3 rounded-xl hover:bg-navy/90 active:scale-[0.98] transition"
      >
        Masuk
      </button>
    </form>
  </div>

  <p class="text-center text-xs text-slate-400 mt-6">&copy; {{ date('Y') }} SPP Sukamaju — SD Negeri 01</p>
</div>

</body>
</html>
