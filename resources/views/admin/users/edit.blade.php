@extends('layouts.app')

@section('page-title', 'Edit Data User')
@section('page-subtitle', 'Perbarui informasi pengguna')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 max-w-4xl">
    <form action="#" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user['name'] }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Username</label>
                <input type="text" name="username" value="{{ $user['username'] }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ $user['email'] }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                <select name="role" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ $user['role'] === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="bendahara" {{ $user['role'] === 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                    <option value="wali_siswa" {{ $user['role'] === 'wali_siswa' ? 'selected' : '' }}>Wali Siswa</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru (Opsional)</label>
                <input type="password" name="password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Kosongkan jika tidak ingin mengubah">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="Kosongkan jika tidak ingin mengubah">
            </div>
        </div>

        <div class="mt-8 flex items-center gap-3">
            <button type="submit" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">Simpan Perubahan</button>
            <a href="{{ route('admin.users.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
