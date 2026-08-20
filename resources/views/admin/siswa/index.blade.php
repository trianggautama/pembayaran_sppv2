@extends('layouts.app')

@section('page-title', 'Kelola Data Siswa')
@section('page-subtitle', 'Daftar semua siswa yang terdaftar')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <h2 class="text-xl font-display font-semibold text-slate-800">Data Siswa</h2>
    <a href="{{ route('admin.siswa.cetak-pdf', request()->only(['cari', 'kelas_id'])) }}" target="_blank" class="border border-slate-200 text-slate-700 font-semibold text-sm px-4 py-2.5 rounded-xl hover:bg-slate-50 transition flex items-center gap-2">
        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
        Cetak PDF
    </a>
    <a href="{{ route('admin.siswa.create') }}" class="bg-primary text-white font-semibold text-sm px-4 py-2.5 rounded-xl hover:bg-navy transition flex items-center gap-2">
        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        Tambah Siswa
    </a>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-xl mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 mb-4">
    <form action="{{ route('admin.siswa.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-end gap-3">
        <div class="flex-1">
            <label class="block text-xs font-medium text-slate-500 mb-1">Cari NIS / Nama</label>
            <div class="relative">
                <svg viewBox="0 0 24 24" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Ketik NIS atau nama siswa..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
            </div>
        </div>
        <div class="sm:w-48">
            <label class="block text-xs font-medium text-slate-500 mb-1">Filter Kelas</label>
            <select name="kelas_id" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                <option value="">Semua Kelas</option>
                @foreach($kelasList as $kelas)
                    <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center gap-2">
            <button type="submit" class="bg-primary text-white font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-navy transition">Cari</button>
            @if(request('cari') || request('kelas_id'))
                <a href="{{ route('admin.siswa.index') }}" class="border border-slate-200 text-slate-600 font-semibold text-sm px-4 py-2.5 rounded-xl hover:bg-slate-50 transition">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-6 py-4 font-medium">NIS</th>
                    <th class="px-6 py-4 font-medium">Nama Siswa</th>
                    <th class="px-6 py-4 font-medium">Kelas</th>
                    <th class="px-6 py-4 font-medium">Nama Wali</th>
                    <th class="px-6 py-4 font-medium">Telepon</th>
                    <th class="px-6 py-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($siswaList as $siswa)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-medium text-slate-700">{{ $siswa->nis }}</td>
                    <td class="px-6 py-4 text-slate-700">{{ $siswa->nama }}</td>
                    <td class="px-6 py-4 text-slate-700">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pale text-navy">{{ $siswa->kelas->nama_kelas }}</span>
                    </td>
                    <td class="px-6 py-4 text-slate-700">{{ $siswa->nama_wali }}</td>
                    <td class="px-6 py-4 text-slate-700">{{ $siswa->telepon_wali }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.siswa.show', $siswa->id) }}" class="p-1.5 text-sky hover:text-navy hover:bg-pale rounded-lg transition" title="Lihat">
                                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="p-1.5 text-amber-500 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition" title="Edit">
                                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                            </a>
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data siswa ini? Akun login wali siswa juga akan dihapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition" title="Hapus">
                                    <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                        @if(request('cari') || request('kelas_id'))
                            Tidak ada siswa yang cocok dengan pencarian.
                        @else
                            Belum ada data siswa.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($siswaList->hasPages())
    <div class="mt-4">
        {{ $siswaList->links() }}
    </div>
@endif
@endsection
