@extends('layouts.app')

@section('page-title', 'Detail Bendahara')
@section('page-subtitle', 'Informasi lengkap akun bendahara')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 max-w-3xl">
    <div class="flex flex-col sm:flex-row items-center gap-6 mb-8 pb-8 border-b border-slate-100">
        <div class="w-24 h-24 rounded-full bg-primary/10 text-primary flex items-center justify-center text-3xl font-bold uppercase tracking-wider">
            {{ substr($bendahara->name, 0, 1) }}
        </div>
        <div class="text-center sm:text-left">
            <h3 class="text-2xl font-display font-semibold text-slate-800 mb-1">{{ $bendahara->name }}</h3>
            <p class="text-slate-500 mb-3">{{ $bendahara->email }}</p>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                Bendahara
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <h4 class="text-sm font-medium text-slate-500 mb-1">Nama Lengkap</h4>
            <p class="text-slate-800 font-medium">{{ $bendahara->name }}</p>
        </div>
        <div>
            <h4 class="text-sm font-medium text-slate-500 mb-1">Username</h4>
            <p class="text-slate-800 font-medium">{{ $bendahara->username }}</p>
        </div>
        <div>
            <h4 class="text-sm font-medium text-slate-500 mb-1">Email</h4>
            <p class="text-slate-800 font-medium">{{ $bendahara->email }}</p>
        </div>
    </div>

    <div class="mt-8 pt-6 border-t border-slate-100 flex gap-3">
        <a href="{{ route('admin.bendahara.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">
            Kembali
        </a>
        <a href="{{ route('admin.bendahara.edit', $bendahara->id) }}" class="bg-amber-500 text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-amber-600 transition">
            Edit
        </a>
    </div>
</div>
@endsection
