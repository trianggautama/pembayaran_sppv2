@extends('layouts.app')

@section('page-title', 'Detail Tahun Ajaran')
@section('page-subtitle', 'Informasi lengkap data tahun ajaran')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 max-w-4xl">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
        
        <div>
            <h3 class="text-lg font-display font-semibold text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Umum</h3>
            <div class="space-y-4">
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Nama Tahun Ajaran</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $tahunAjaran->nama }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Semester</span>
                    <span class="text-sm text-slate-900 font-medium">Semester {{ $tahunAjaran->semester }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Status Aktif</span>
                    @if($tahunAjaran->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-sm font-medium bg-emerald-100 text-emerald-700">Aktif</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-sm font-medium bg-slate-100 text-slate-700">Tidak Aktif</span>
                    @endif
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-display font-semibold text-slate-800 mb-4 border-b border-slate-100 pb-2">Periode Akademik</h3>
            <div class="space-y-4">
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Tanggal Mulai</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $tahunAjaran->tanggal_mulai->format('d M Y') }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Tanggal Selesai</span>
                    <span class="text-sm text-slate-900 font-medium">{{ $tahunAjaran->tanggal_selesai->format('d M Y') }}</span>
                </div>
            </div>
        </div>
        
    </div>

    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-3">
        <a href="{{ route('admin.tahun-ajaran.edit', $tahunAjaran->id) }}" class="bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition">Edit Data</a>
        <a href="{{ route('admin.tahun-ajaran.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-slate-50 transition">Kembali ke Daftar</a>
    </div>
</div>
@endsection