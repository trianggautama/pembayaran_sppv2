<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $query = Tagihan::with(['siswa.kelas', 'tahunAjaran']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', fn ($q) => $q->where('nama', 'like', "%{$search}%")->orWhere('nis', 'like', "%{$search}%"));
        }

        if ($request->filled('tahun_ajaran_id')) {
            $query->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        }

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $tagihans = $query->latest()->paginate(10)->withQueryString();
        $tahunAjarans = TahunAjaran::all();

        return view('admin.tagihan.index', compact('tagihans', 'tahunAjarans'));
    }

    public function cetakPdf(Request $request)
    {
        $query = Tagihan::with(['siswa.kelas', 'tahunAjaran']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', fn ($q) => $q->where('nama', 'like', "%{$search}%")->orWhere('nis', 'like', "%{$search}%"));
        }

        if ($request->filled('tahun_ajaran_id')) {
            $query->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        }

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $tagihans = $query->latest()->get();

        $bulans = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $filterInfo = [];
        if ($request->filled('bulan')) {
            $filterInfo[] = 'Bulan: ' . ($bulans[(int)$request->bulan] ?? '-');
        }
        if ($request->filled('status') && $request->status !== 'semua') {
            $filterInfo[] = 'Status: ' . ($request->status === 'sudah_bayar' ? 'Sudah Bayar' : 'Belum Bayar');
        }
        if ($request->filled('tahun_ajaran_id')) {
            $ta = TahunAjaran::find($request->tahun_ajaran_id);
            if ($ta) {
                $filterInfo[] = 'Tahun Ajaran: ' . $ta->nama . ' - Sem ' . $ta->semester;
            }
        }

        $pdf = Pdf::loadView('bendahara.tagihan.cetak-pdf', compact('tagihans', 'filterInfo'))
            ->setPaper('a4', 'landscape');

        $filename = 'laporan-tagihan-spp-' . now()->format('Y-m-d') . '.pdf';

        return $pdf->stream($filename);
    }
}
