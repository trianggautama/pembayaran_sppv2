@extends('layouts.app')

@section('page-title', 'Notifikasi')
@section('page-subtitle', 'Semua notifikasi untuk Anda')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Semua Notifikasi</h2>
        </div>
        @if($notifikasis->where('read_at', null)->count() > 0)
        <form action="{{ route('notifikasi.baca-semua') }}" method="POST">
            @csrf
            <button type="submit" class="inline-flex items-center justify-center bg-primary text-white font-semibold text-sm px-6 py-2.5 rounded-xl hover:bg-navy transition whitespace-nowrap">
                Tandai Semua Dibaca
            </button>
        </form>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="divide-y divide-slate-100">
            @forelse($notifikasis as $notif)
            <form action="{{ route('notifikasi.baca', $notif) }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-6 py-4 hover:bg-slate-50 transition {{ $notif->read_at ? '' : 'bg-primary/5' }}">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 mt-0.5">
                            @if($notif->tipe === 'tagihan_baru')
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6"/></svg>
                            </div>
                            @elseif($notif->tipe === 'pembayaran_masuk')
                            <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            </div>
                            @elseif($notif->tipe === 'pembayaran_diterima')
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
                            </div>
                            @else
                            <div class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-sm font-semibold {{ $notif->read_at ? 'text-slate-800' : 'text-navy' }}">{{ $notif->judul }}</p>
                                @if(!$notif->read_at)
                                <span class="w-2 h-2 rounded-full bg-primary shrink-0"></span>
                                @endif
                            </div>
                            <p class="text-sm text-slate-600 mt-1">{{ $notif->pesan }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </button>
            </form>
            @empty
            <div class="px-6 py-12 text-center text-slate-400">
                Belum ada notifikasi.
            </div>
            @endforelse
        </div>
        @if($notifikasis->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $notifikasis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection