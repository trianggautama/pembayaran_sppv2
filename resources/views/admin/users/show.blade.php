@extends('layouts.app')

@section('page-title', 'Detail User')
@section('page-subtitle', 'Informasi lengkap data pengguna')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 max-w-4xl">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
        
        <div>
            <h3 class="text-lg font-display font-semibold text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Akun</h3>
            <div class="space-y-4">
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Nama Lengkap</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $user['name'] }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Username</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $user['username'] }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Email</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $user['email'] }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Role</span>
                    @if($user['role'] === 'admin')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-navy text-white">Admin</span>
                    @elseif($user['role'] === 'bendahara')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">Bendahara</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Wali Siswa</span>
                    @endif
                </div>
            </div>
        </div>
        
    </div>

    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-3">
        <a href="{{ route('admin.users.edit', $user['id']) }}" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">Edit Data</a>
        <a href="{{ route('admin.users.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">Kembali ke Daftar</a>
    </div>
</div>
@endsection
