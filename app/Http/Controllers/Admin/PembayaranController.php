<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['siswa.kelas', 'tagihan.tahunAjaran', 'verifiedBy']);

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', fn ($q) => $q->where('nama', 'like', "%{$search}%")->orWhere('nis', 'like', "%{$search}%"));
        }

        $pembayarans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function cetakRekapPdf(Request $request)
    {
        $query = Pembayaran::with(['siswa.kelas', 'tagihan.tahunAjaran', 'verifiedBy']);

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', fn ($q) => $q->where('nama', 'like', "%{$search}%")->orWhere('nis', 'like', "%{$search}%"));
        }

        $pembayarans = $query->latest()->get();

        $filterInfo = [];
        if ($request->filled('status') && $request->status !== 'semua') {
            $labels = [
                'pending' => 'Menunggu Verifikasi',
                'diverifikasi' => 'Pembayaran Diterima',
                'ditolak' => 'Pembayaran Ditolak',
            ];
            $filterInfo[] = 'Status: ' . ($labels[$request->status] ?? $request->status);
        }
        if ($request->filled('search')) {
            $filterInfo[] = 'Pencarian: ' . $request->search;
        }

        $pdf = Pdf::loadView('bendahara.verifikasi.rekap-pdf', compact('pembayarans', 'filterInfo'))
            ->setPaper('a4', 'landscape');

        $filename = 'rekap-pembayaran-' . now()->format('Y-m-d') . '.pdf';

        return $pdf->stream($filename);
    }
}
