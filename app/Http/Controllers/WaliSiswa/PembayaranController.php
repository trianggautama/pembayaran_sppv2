<?php

namespace App\Http\Controllers\WaliSiswa;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function create(Request $request)
    {
        $siswa = Auth::user()->siswa;
        
        $tagihans = Tagihan::with('tahunAjaran')
            ->where('siswa_id', $siswa->id)
            ->where('status', 'belum_bayar')
            ->get();
            
        $preselectedTagihans = $request->query('tagihan_ids', []);

        return view('wali-siswa.pembayaran.create', compact('tagihans', 'preselectedTagihans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tagihan_ids' => 'required|array|min:1',
            'tagihan_ids.*' => 'exists:tagihans,id',
            'metode' => 'required|in:transfer_bank,qris,e_wallet',
            'bukti_pembayaran' => 'required|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'catatan' => 'nullable|string|max:500',
        ]);

        $siswa = Auth::user()->siswa;

        $tagihanIds = array_map('intval', $request->tagihan_ids);

        $tagihans = Tagihan::whereIn('id', $tagihanIds)
            ->where('siswa_id', $siswa->id)
            ->where('status', 'belum_bayar')
            ->get();

        if ($tagihans->count() !== count($tagihanIds)) {
            return back()->withErrors(['tagihan_ids' => 'Tagihan tidak valid atau sudah dibayar.']);
        }

        $totalBayar = $tagihans->sum('nominal');

        $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');
        $dbPath = $path; // path sekarang 'bukti-pembayaran/filename.jpg' karena pakai disk 'public'

        $pembayaran = DB::transaction(function () use ($siswa, $totalBayar, $request, $dbPath, $tagihanIds) {
            $pembayaran = Pembayaran::create([
                'siswa_id' => $siswa->id,
                'total_bayar' => $totalBayar,
                'metode' => $request->metode,
                'bukti_pembayaran' => $dbPath,
                'status' => 'pending',
                'catatan' => $request->catatan,
            ]);

            $pembayaran->tagihan()->attach($tagihanIds);

            Tagihan::whereIn('id', $tagihanIds)->update(['status' => 'pending']);

            return $pembayaran;
        });

        $bendaharas = User::where('role', 'bendahara')->get();
        foreach ($bendaharas as $bendahara) {
            Notifikasi::create([
                'user_id' => $bendahara->id,
                'judul' => 'Pembayaran Masuk',
                'pesan' => "Pembayaran dari {$siswa->nama} sebesar Rp " . number_format($totalBayar, 0, ',', '.') . " menunggu verifikasi.",
                'tipe' => 'pembayaran_masuk',
                'link' => route('bendahara.verifikasi.show', $pembayaran->id),
            ]);
        }

        return redirect()->route('wali-siswa.tagihan.index')->with('success', 'Pembayaran berhasil dikirim dan menunggu verifikasi.');
    }

    public function show(Pembayaran $pembayaran)
    {
        if ($pembayaran->siswa_id !== Auth::user()->siswa->id) {
            abort(403);
        }

        $pembayaran->load('tagihan.tahunAjaran');

        return view('wali-siswa.pembayaran.show', compact('pembayaran'));
    }
}
