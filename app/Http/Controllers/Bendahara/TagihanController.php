<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\TahunAjaran;
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

        return view('bendahara.tagihan.index', compact('tagihans', 'tahunAjarans'));
    }

    public function create()
    {
        $tahunAjarans = TahunAjaran::all();
        return view('bendahara.tagihan.create', compact('tahunAjarans'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'bulan' => 'required|integer|min:1|max:12',
            'nominal' => 'required|integer|min:1',
        ]);

        $siswas = Siswa::with('user')->get();
        $created = 0;
        $skipped = 0;
        $bulanNama = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
        $namaBulan = $bulanNama[(int)$request->bulan] ?? '';

        foreach ($siswas as $siswa) {
            $tagihan = Tagihan::firstOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'tahun_ajaran_id' => $request->tahun_ajaran_id,
                    'bulan' => $request->bulan,
                ],
                [
                    'nominal' => $request->nominal,
                    'status' => 'belum_bayar',
                ]
            );

            if ($tagihan->wasRecentlyCreated) {
                $created++;
                if ($siswa->user) {
                    Notifikasi::create([
                        'user_id' => $siswa->user->id,
                        'judul' => 'Tagihan Baru',
                        'pesan' => "Tagihan SPP bulan {$namaBulan} telah diterbitkan. Segera lakukan pembayaran.",
                        'tipe' => 'tagihan_baru',
                        'link' => route('wali-siswa.tagihan.index'),
                    ]);
                }
            } else {
                $skipped++;
            }
        }

        return redirect()->route('bendahara.tagihan.index')
            ->with('success', "Tagihan berhasil digenerate untuk {$created} siswa. {$skipped} siswa sudah memiliki tagihan.");
    }

    public function show(Tagihan $tagihan)
    {
        $tagihan->load(['siswa.kelas', 'tahunAjaran']);
        return view('bendahara.tagihan.show', compact('tagihan'));
    }

    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();
        return redirect()->route('bendahara.tagihan.index')
            ->with('success', 'Tagihan berhasil dihapus.');
    }
}
