<?php

namespace App\Http\Controllers\WaliSiswa;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        $siswa->load('kelas');

        $tagihans = $siswa->tagihans()
            ->with('tahunAjaran')
            ->orderByDesc('bulan')
            ->get();

        $belumBayar = $tagihans->where('status', 'belum_bayar');

        $riwayatPembayaran = $siswa->pembayaran()
            ->with('tagihan.tahunAjaran')
            ->orderByDesc('created_at')
            ->get();

        $totalTagihan = $tagihans->sum('nominal');
        $totalBayar = $tagihans->where('status', 'sudah_bayar')->sum('nominal');
        $totalTunggakan = $belumBayar->sum('nominal');

        return view('wali-siswa.tagihan.index', compact(
            'siswa', 'belumBayar', 'riwayatPembayaran',
            'totalTagihan', 'totalBayar', 'totalTunggakan'
        ));
    }

    public function cetakPdf(Request $request)
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        $siswa->load('kelas');

        $tagihans = $siswa->tagihans()
            ->with('tahunAjaran')
            ->orderByDesc('bulan')
            ->get();

        $tipe = $request->query('tipe', 'belum_bayar');

        if ($tipe === 'sudah_bayar') {
            $data = $tagihans->where('status', 'sudah_bayar');
            $judul = 'Tagihan Sudah Dibayar';
        } else {
            $data = $tagihans->where('status', 'belum_bayar');
            $judul = 'Tagihan Belum Dibayar';
        }

        $pdf = Pdf::loadView('wali-siswa.tagihan.cetak-pdf', compact('siswa', 'data', 'judul'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('tagihan-' . $tipe . '.pdf');
    }

    public function riwayat()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        $siswa->load('kelas');

        $riwayatPembayaran = $siswa->pembayaran()
            ->with('tagihan.tahunAjaran')
            ->orderByDesc('created_at')
            ->get();

        return view('wali-siswa.tagihan.riwayat', compact('siswa', 'riwayatPembayaran'));
    }
}
