@extends('layouts.app')

@section('page-title', 'Detail Siswa')
@section('page-subtitle', 'Informasi lengkap data siswa')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 max-w-4xl">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
        
        <div>
            <h3 class="text-lg font-display font-semibold text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Siswa</h3>
            <div class="space-y-4">
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">NIS</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa['nis'] }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Nama Lengkap</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa['nama'] }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Kelas</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-sm font-medium bg-pale text-navy">{{ $siswa['kelas'] }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Jenis Kelamin</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Alamat</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa['alamat'] }}</span>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-display font-semibold text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Wali Murid</h3>
            <div class="space-y-4">
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Nama Wali</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa['nama_wali'] }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">No. Telepon</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $siswa['telepon_wali'] }}</span>
                </div>
            </div>
        </div>
        
    </div>

    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-3">
        <a href="{{ route('admin.siswa.edit', $siswa['id']) }}" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">Edit Data</a>
        <a href="{{ route('admin.siswa.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">Kembali ke Daftar</a>
    </div>
</div>
@endsection
