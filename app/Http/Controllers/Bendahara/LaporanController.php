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
            $query = Kelas::with(['siswas' => function($q) {
                $q->with(['tagihans' => function($qt) {
                    $qt->where('status', 'belum_bayar')->with('tahunAjaran');
                }]);
            }]);
            
            if ($request->kelas_id) {
                $query->where('id', $request->kelas_id);
            }
            
            $kelassData = $query->get();
            $pdf = Pdf::loadView('bendahara.laporan.tunggakan-pdf', compact('kelassData', 'request'));
            return $pdf->stream('laporan-tunggakan.pdf');
        }

        $kelass = Kelas::all();
        return view('bendahara.laporan.tunggakan', compact('kelass'));
    }

    public function kelas(Request $request)
    {
        if ($request->has('cetak')) {
            $kelas = Kelas::with(['siswas.pembayaran' => function ($q) {
                $q->where('status', 'diverifikasi');
            }, 'siswas.pembayaran.tagihan'])->findOrFail($request->kelas_id);
            
            $pdf = Pdf::loadView('bendahara.laporan.kelas-pdf', compact('kelas', 'request'));
            return $pdf->stream('laporan-pembayaran-kelas.pdf');
        }

        $kelass = Kelas::all();
        return view('bendahara.laporan.kelas', compact('kelass'));
    }
}
