<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class WaliSiswaController extends Controller
{
    public function index()
    {
        $waliSiswaList = Siswa::with(['user', 'kelas'])
            ->whereHas('user', fn ($q) => $q->where('role', 'wali_siswa'))
            ->latest()
            ->paginate(10);

        return view('admin.wali-siswa.index', compact('waliSiswaList'));
    }

    public function create()
    {
        $siswas = \App\Models\Siswa::with('kelas')->get();
        return view('admin.wali-siswa.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wali' => 'required|string|max:255',
            'telepon_wali' => 'required|string|max:20',
            'siswa_id' => 'required|exists:siswas,id',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
            $user = \App\Models\User::create([
                'name' => $request->nama_wali,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'wali_siswa',
            ]);

            $siswa = \App\Models\Siswa::findOrFail($request->siswa_id);
            $siswa->update([
                'nama_wali' => $request->nama_wali,
                'telepon_wali' => $request->telepon_wali,
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('admin.wali-siswa.index')->with('success', 'Wali Siswa berhasil ditambahkan.');
    }

    public function show(Siswa $wali_siswa)
    {
        $wali_siswa->load(['user', 'kelas']);
        return view('admin.wali-siswa.show', ['waliSiswa' => $wali_siswa]);
    }

    public function edit(Siswa $wali_siswa)
    {
        $wali_siswa->load(['user', 'kelas']);
        return view('admin.wali-siswa.edit', ['waliSiswa' => $wali_siswa]);
    }

    public function update(Request $request, Siswa $wali_siswa)
    {
        return redirect()->route('admin.wali-siswa.index')->with('success', 'Wali Siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $wali_siswa)
    {
        return redirect()->route('admin.wali-siswa.index')->with('success', 'Wali Siswa berhasil dihapus.');
    }
}
