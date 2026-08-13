<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with('kelas');

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nis', 'like', "%{$cari}%")
                  ->orWhere('nama', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $siswaList = $query->orderBy('nama')->paginate(15)->withQueryString();
        $kelasList = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();

        return view('bendahara.siswa.index', compact('siswaList', 'kelasList'));
    }

    public function show(Siswa $siswa)
    {
        $siswa->load(['kelas', 'user']);

        $tagihans = $siswa->tagihans()
            ->with('tahunAjaran')
            ->orderByDesc('created_at')
            ->get();

        $belumBayar = $tagihans->where('status', 'belum_bayar');
        $sudahBayar = $tagihans->where('status', 'sudah_bayar');

        $totalTagihan = $tagihans->sum('nominal');
        $totalBayar = $sudahBayar->sum('nominal');
        $totalTunggakan = $belumBayar->sum('nominal');

        return view('bendahara.siswa.show', compact(
            'siswa', 'tagihans', 'belumBayar', 'sudahBayar',
            'totalTagihan', 'totalBayar', 'totalTunggakan'
        ));
    }
}
