@extends('layouts.app')

@section('page-title', 'Tambah Wali Siswa')
@section('page-subtitle', 'Tambahkan data akun wali siswa baru')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden max-w-3xl">
    <form action="{{ route('admin.wali-siswa.store') }}" method="POST" class="p-6 sm:p-8">
        @csrf

        <div class="space-y-6">
            <div>
                <label for="nama_wali" class="block text-sm font-medium text-slate-700 mb-2">Nama Wali</label>
                <input type="text" id="nama_wali" name="nama_wali" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                <input type="text" id="username" name="username" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label for="telepon_wali" class="block text-sm font-medium text-slate-700 mb-2">Telepon Wali</label>
                <input type="text" id="telepon_wali" name="telepon_wali" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <hr class="border-slate-100 my-6">

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.wali-siswa.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
