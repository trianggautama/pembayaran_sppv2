<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\Kelas;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function pembayaran(Request $request)
    {
        if ($request->has('cetak')) {
            $query = Pembayaran::with(['siswa.kelas', 'tagihan', 'verifiedBy'])->where('status', 'diverifikasi');
            
            if ($request->bulan && $request->tahun) {
                $query->whereMonth('created_at', $request->bulan)
                      ->whereYear('created_at', $request->tahun);
            }
            
            $pembayarans = $query->orderBy('created_at', 'desc')->get();
            $pdf = Pdf::loadView('bendahara.laporan.pembayaran-pdf', compact('pembayarans', 'request'));
            return $pdf->stream('laporan-pembayaran.pdf');
        }

        return view('bendahara.laporan.pembayaran');
    }

    public function tunggakan(Request $request)
    {
        if ($request->has('cetak')) {
            $query = Tagihan::with(['siswa.kelas', 'tahunAjaran'])->where('status', 'belum_dibayar');
            
            if ($request->kelas_id) {
                $query->whereHas('siswa', function ($q) use ($request) {
                    $q->where('kelas_id', $request->kelas_id);
                });
            }
            
            $tunggakans = $query->orderBy('siswa_id')->orderBy('bulan')->get();
            $pdf = Pdf::loadView('bendahara.laporan.tunggakan-pdf', compact('tunggakans', 'request'));
            return $pdf->stream('laporan-tunggakan.pdf');
        }

        $kelass = Kelas::all();
        return view('bendahara.laporan.tunggakan', compact('kelass'));
    }

    public function kelas(Request $request)
    {
        if ($request->has('cetak')) {
            $kelas = Kelas::with(['siswa.pembayaran' => function ($q) {
                $q->where('status', 'diverifikasi');
            }, 'siswa.pembayaran.tagihan'])->findOrFail($request->kelas_id);
            
            $pdf = Pdf::loadView('bendahara.laporan.kelas-pdf', compact('kelas', 'request'));
            return $pdf->stream('laporan-pembayaran-kelas.pdf');
        }

        $kelass = Kelas::all();
        return view('bendahara.laporan.kelas', compact('kelass'));
    }
}
