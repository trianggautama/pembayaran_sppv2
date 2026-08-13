@extends('layouts.app')

@section('page-title', 'Kelola Data Kelas')
@section('page-subtitle', 'Daftar semua kelas yang tersedia')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <h2 class="text-xl font-display font-semibold text-slate-800">Data Kelas</h2>
    <a href="{{ route('admin.kelas.create') }}" class="bg-primary text-white font-semibold text-sm px-4 py-2.5 rounded-xl hover:bg-navy transition flex items-center gap-2">
        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        Tambah Kelas
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-6 py-4 font-medium">Nama Kelas</th>
                    <th class="px-6 py-4 font-medium">Tingkat</th>
                    <th class="px-6 py-4 font-medium">Wali Kelas</th>
                    <th class="px-6 py-4 font-medium">Jumlah Siswa</th>
                    <th class="px-6 py-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @foreach($kelasList as $kelas)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-medium text-slate-700">{{ $kelas['nama_kelas'] }}</td>
                    <td class="px-6 py-4 text-slate-700">{{ $kelas['tingkat'] }}</td>
                    <td class="px-6 py-4 text-slate-700">{{ $kelas['wali_kelas'] }}</td>
                    <td class="px-6 py-4 text-slate-700">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pale text-navy">{{ $kelas['jumlah_siswa'] }} Siswa</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.kelas.show', $kelas['id']) }}" class="p-1.5 text-sky hover:text-navy hover:bg-pale rounded-lg transition" title="Lihat">
                                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                            <a href="{{ route('admin.kelas.edit', $kelas['id']) }}" class="p-1.5 text-amber-500 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition" title="Edit">
                                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                            </a>
                            <form action="#" method="POST" class="inline" onsubmit="return confirm('Hapus data kelas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition" title="Hapus">
                                    <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
