@extends('layouts.app')

@section('page-title', 'Tambah Data User')
@section('page-subtitle', 'Masukkan informasi pengguna baru')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 max-w-4xl">
    <form action="#" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Nama lengkap pengguna" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Username</label>
                <input type="text" name="username" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Username untuk login" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                <input type="email" name="email" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Alamat email aktif" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                <select name="role" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="bendahara">Bendahara</option>
                    <option value="wali_siswa">Wali Siswa</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                <input type="password" name="password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Masukkan password" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Ulangi password" required>
            </div>
        </div>

        <div class="mt-8 flex items-center gap-3">
            <button type="submit" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">Simpan Data</button>
            <a href="{{ route('admin.users.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
