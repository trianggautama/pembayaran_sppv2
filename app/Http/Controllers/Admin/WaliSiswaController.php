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
        return view('admin.wali-siswa.create');
    }

    public function store(Request $request)
    {
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
