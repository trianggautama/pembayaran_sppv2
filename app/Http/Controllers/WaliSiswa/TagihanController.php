<?php

namespace App\Http\Controllers\WaliSiswa;

use App\Http\Controllers\Controller;
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
