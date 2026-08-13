@extends('layouts.app')

@section('page-title', 'Edit Bendahara')
@section('page-subtitle', 'Ubah data akun bendahara')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden max-w-3xl">
    <form action="{{ route('admin.bendahara.update', $bendahara->id) }}" method="POST" class="p-6 sm:p-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ $bendahara->name }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                <input type="text" id="username" name="username" value="{{ $bendahara->username }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ $bendahara->email }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <hr class="border-slate-100 my-6">

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password Baru <span class="text-slate-400 font-normal">(Opsional)</span></label>
                <input type="password" id="password" name="password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.bendahara.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
