<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Tagihan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role ?? 'admin';


        $now = Carbon::now();
        $bulanIni = $now->month;
        $tahunIni = $now->year;

        // Stat cards
        $totalSiswa = Siswa::count();
        $siswaBaruBulanIni = Siswa::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();

        $tagihanBulanIni = Tagihan::where('bulan', $bulanIni)
            ->whereHas('tahunAjaran', fn($q) => $q->where('is_active', true))
            ->count();

        $menungguVerifikasi = Pembayaran::where('status', 'pending')->count();

        // Pembayaran lunas bulan ini
        $pembayaranLunas = Pembayaran::where('status', 'diverifikasi')
            ->whereMonth('verified_at', $bulanIni)
            ->whereYear('verified_at', $tahunIni)
            ->sum('total_bayar');

        // Total nominal tagihan bulan ini (untuk progres)
        $totalNominalTagihan = Tagihan::where('bulan', $bulanIni)
            ->whereHas('tahunAjaran', fn($q) => $q->where('is_active', true))
            ->sum('nominal');

        $tagihanLunasBulanIni = Tagihan::where('bulan', $bulanIni)
            ->where('status', 'sudah_bayar')
            ->whereHas('tahunAjaran', fn($q) => $q->where('is_active', true))
            ->count();

        $persenLunas = $tagihanBulanIni > 0
            ? round(($tagihanLunasBulanIni / $tagihanBulanIni) * 100)
            : 0;

        // Aktivitas pembayaran terbaru (4 terbaru)
        $pembayaranTerbaru = Pembayaran::with(['siswa.kelas', 'tagihan'])
            ->latest()
            ->take(4)
            ->get();

        // Menunggu verifikasi (side panel, 5 terbaru)
        $pendingVerifikasi = Pembayaran::with(['siswa.kelas'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $namaBulan = $now->translatedFormat('F');

         if ($role === 'bendahara') {
            return view('bendahara.dashboard',compact(
                'totalSiswa',
                'siswaBaruBulanIni',
                'tagihanBulanIni',
                'menungguVerifikasi',
                'pembayaranLunas',
                'totalNominalTagihan',
                'tagihanLunasBulanIni',
                'persenLunas',
                'pembayaranTerbaru',
                'pendingVerifikasi',
                'namaBulan',
            ));
        } elseif ($role === 'wali_siswa') {
            return view('wali-siswa.dashboard');
        }
        return view('dashboard', compact(
            'totalSiswa',
            'siswaBaruBulanIni',
            'tagihanBulanIni',
            'menungguVerifikasi',
            'pembayaranLunas',
            'totalNominalTagihan',
            'tagihanLunasBulanIni',
            'persenLunas',
            'pembayaranTerbaru',
            'pendingVerifikasi',
            'namaBulan',
        ));
    }
}
