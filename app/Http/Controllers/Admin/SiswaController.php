<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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

        return view('admin.siswa.index', compact('siswaList', 'kelasList'));
    }

    public function create()
    {
        $kelasList = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('admin.siswa.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'nama' => 'required|string|max:100',
            'kelas_id' => 'required|exists:kelas,id',
            'nama_wali' => 'required|string|max:100',
            'telepon_wali' => 'required|string|max:20',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['nama_wali'],
                'username' => $validated['username'],
                'email' => $validated['username'] . '@spp-sukamaju.test',
                'password' => bcrypt($validated['password']),
                'role' => 'wali_siswa',
            ]);

            Siswa::create([
                'nis' => $validated['nis'],
                'nama' => $validated['nama'],
                'kelas_id' => $validated['kelas_id'],
                'nama_wali' => $validated['nama_wali'],
                'telepon_wali' => $validated['telepon_wali'],
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $siswa = Siswa::with(['kelas', 'user'])->findOrFail($id);
        return view('admin.siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        $kelasList = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('admin.siswa.edit', compact('siswa', 'kelasList'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:siswas,nis,' . $siswa->id,
            'nama' => 'required|string|max:100',
            'kelas_id' => 'required|exists:kelas,id',
            'nama_wali' => 'required|string|max:100',
            'telepon_wali' => 'required|string|max:20',
            'username' => 'required|string|max:50|unique:users,username,' . $siswa->user_id,
            'password' => 'nullable|string|min:6',
        ]);

        DB::transaction(function () use ($siswa, $validated) {
            $userData = [
                'name' => $validated['nama_wali'],
                'username' => $validated['username'],
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = bcrypt($validated['password']);
            }

            $siswa->user->update($userData);

            $siswa->update([
                'nis' => $validated['nis'],
                'nama' => $validated['nama'],
                'kelas_id' => $validated['kelas_id'],
                'nama_wali' => $validated['nama_wali'],
                'telepon_wali' => $validated['telepon_wali'],
            ]);
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diubah.');
    }

    public function cetakPdf(Request $request)
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

        $siswaList = $query->orderBy('nama')->get();
        $kelasList = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();

        $filterInfo = [];
        if ($request->filled('cari')) {
            $filterInfo[] = 'Pencarian: ' . $request->cari;
        }
        if ($request->filled('kelas_id')) {
            $kelas = $kelasList->firstWhere('id', $request->kelas_id);
            $filterInfo[] = 'Kelas: ' . ($kelas ? $kelas->nama_kelas : '-');
        }

        $pdf = Pdf::loadView('admin.siswa.cetak-pdf', compact('siswaList', 'filterInfo'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('data-siswa.pdf');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        DB::transaction(function () use ($siswa) {
            $userId = $siswa->user_id;
            $siswa->delete();
            User::destroy($userId);
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
