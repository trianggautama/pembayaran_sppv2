<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['siswa.kelas', 'tagihan.tahunAjaran']);

        // Filter by status (default: pending)
        $status = $request->get('status', 'pending');
        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        // Search by student name/NIS
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', fn ($q) => $q->where('nama', 'like', "%{$search}%")->orWhere('nis', 'like', "%{$search}%"));
        }

        $pembayarans = $query->latest()->paginate(10)->withQueryString();

        $countPending = Pembayaran::where('status', 'pending')->count();

        return view('bendahara.verifikasi.index', compact('pembayarans', 'status', 'countPending'));
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load(['siswa.kelas', 'tagihan.tahunAjaran', 'verifiedBy']);
        return view('bendahara.verifikasi.show', compact('pembayaran'));
    }

    public function kwitansi(Pembayaran $pembayaran)
    {
        $pembayaran->load(['siswa.kelas', 'tagihan.tahunAjaran', 'verifiedBy']);

        $pdf = Pdf::loadView('bendahara.verifikasi.kwitansi-pdf', compact('pembayaran'))
            ->setPaper('a5', 'landscape');

        $filename = 'kwitansi-' . ($pembayaran->siswa->nis ?? 'unknown') . '-' . $pembayaran->created_at->format('Ymd') . '.pdf';

        return $pdf->stream($filename);
    }

    public function terima(Pembayaran $pembayaran)
    {
        if ($pembayaran->status !== 'pending') {
            return back()->withErrors(['status' => 'Pembayaran sudah diproses sebelumnya.']);
        }

        DB::transaction(function () use ($pembayaran) {
            $pembayaran->update([
                'status' => 'diverifikasi',
                'verified_by' => Auth::id(),
                'verified_at' => now(),
            ]);

            // Update semua tagihan terkait menjadi sudah_bayar
            Tagihan::whereIn('id', $pembayaran->tagihan->pluck('id'))->update(['status' => 'sudah_bayar']);
        });

        $waliUser = $pembayaran->siswa->user;
        if ($waliUser) {
            Notifikasi::create([
                'user_id' => $waliUser->id,
                'judul' => 'Pembayaran Diterima',
                'pesan' => "Pembayaran sebesar Rp " . number_format($pembayaran->total_bayar, 0, ',', '.') . " telah diterima.",
                'tipe' => 'pembayaran_diterima',
                'link' => route('wali-siswa.pembayaran.show', $pembayaran->id),
            ]);
        }

        return redirect()->route('bendahara.verifikasi.show', $pembayaran)
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function riwayat(Request $request)
    {
        $query = Pembayaran::with(['siswa.kelas', 'tagihan.tahunAjaran', 'verifiedBy'])
            ->whereIn('status', ['diverifikasi', 'ditolak']);

        $status = $request->get('status', 'semua');
        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', fn ($q) => $q->where('nama', 'like', "%{$search}%")->orWhere('nis', 'like', "%{$search}%"));
        }

        $pembayarans = $query->latest('verified_at')->paginate(10)->withQueryString();

        return view('bendahara.verifikasi.riwayat', compact('pembayarans', 'status'));
    }

    public function cetakRekapPdf(Request $request)
    {
        $query = Pembayaran::with(['siswa.kelas', 'tagihan.tahunAjaran', 'verifiedBy'])
            ->whereIn('status', ['diverifikasi', 'ditolak']);

        $status = $request->get('status', 'semua');
        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', fn ($q) => $q->where('nama', 'like', "%{$search}%")->orWhere('nis', 'like', "%{$search}%"));
        }

        $pembayarans = $query->latest('verified_at')->get();

        $filterInfo = [];
        if ($status !== 'semua') {
            $filterInfo[] = 'Status: ' . ($status === 'diverifikasi' ? 'Pembayaran Diterima' : 'Pembayaran Ditolak');
        }
        if ($request->filled('search')) {
            $filterInfo[] = 'Pencarian: ' . $request->search;
        }

        $pdf = Pdf::loadView('bendahara.verifikasi.rekap-pdf', compact('pembayarans', 'filterInfo'))
            ->setPaper('a4', 'landscape');

        $filename = 'rekap-pembayaran-' . now()->format('Y-m-d') . '.pdf';

        return $pdf->stream($filename);
    }

    public function tolak(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'alasan_ditolak' => 'required|string|max:500',
        ]);

        if ($pembayaran->status !== 'pending') {
            return back()->withErrors(['status' => 'Pembayaran sudah diproses sebelumnya.']);
        }

        DB::transaction(function () use ($request, $pembayaran) {
            $pembayaran->update([
                'status' => 'ditolak',
                'alasan_ditolak' => $request->alasan_ditolak,
                'verified_by' => Auth::id(),
                'verified_at' => now(),
            ]);

            // Kembalikan status tagihan ke belum_bayar
            Tagihan::whereIn('id', $pembayaran->tagihan->pluck('id'))->update(['status' => 'belum_bayar']);
        });

        $waliUser = $pembayaran->siswa->user;
        if ($waliUser) {
            Notifikasi::create([
                'user_id' => $waliUser->id,
                'judul' => 'Pembayaran Ditolak',
                'pesan' => "Pembayaran sebesar Rp " . number_format($pembayaran->total_bayar, 0, ',', '.') . " ditolak. Alasan: {$request->alasan_ditolak}",
                'tipe' => 'pembayaran_ditolak',
                'link' => route('wali-siswa.pembayaran.show', $pembayaran->id),
            ]);
        }

        return redirect()->route('bendahara.verifikasi.show', $pembayaran)
            ->with('success', 'Pembayaran telah ditolak.');
    }
}
