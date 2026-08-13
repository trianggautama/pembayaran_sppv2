@extends('layouts.app')

@section('page-title', 'Profil User')
@section('page-subtitle', 'Informasi profil pengguna yang sedang login')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <h2 class="text-xl font-display font-semibold text-slate-800">Detail Profil</h2>
    <a href="{{ route('admin.profil.edit') }}" class="bg-primary text-white font-semibold text-sm px-4 py-2.5 rounded-xl hover:bg-navy transition flex items-center gap-2">
        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
        Edit Profil
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 max-w-3xl">
    <div class="flex flex-col sm:flex-row items-center gap-6 mb-8 pb-8 border-b border-slate-100">
        <div class="w-24 h-24 rounded-full bg-primary/10 text-primary flex items-center justify-center text-3xl font-bold uppercase tracking-wider">
            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
        </div>
        <div class="text-center sm:text-left">
            <h3 class="text-2xl font-display font-semibold text-slate-800 mb-1">{{ Auth::user()->name ?? 'Admin User' }}</h3>
            <p class="text-slate-500 mb-3">{{ Auth::user()->email ?? 'admin@sekolah.com' }}</p>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-navy text-white">
                {{ ucfirst(Auth::user()->role ?? 'Admin') }}
            </span>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <h4 class="text-sm font-medium text-slate-500 mb-1">Nama Lengkap</h4>
            <p class="text-slate-800 font-medium">{{ Auth::user()->name ?? 'Admin User' }}</p>
        </div>
        <div>
            <h4 class="text-sm font-medium text-slate-500 mb-1">Username</h4>
            <p class="text-slate-800 font-medium">{{ Auth::user()->username ?? 'admin' }}</p>
        </div>
        <div>
            <h4 class="text-sm font-medium text-slate-500 mb-1">Email</h4>
            <p class="text-slate-800 font-medium">{{ Auth::user()->email ?? 'admin@sekolah.com' }}</p>
        </div>
    </div>
</div>
@endsection