<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    private $kelasList = [
        ['id' => 1, 'nama_kelas' => '1A', 'tingkat' => 1, 'wali_kelas' => 'Ibu Sri Wahyuni', 'jumlah_siswa' => 28],
        ['id' => 2, 'nama_kelas' => '2A', 'tingkat' => 2, 'wali_kelas' => 'Bapak Agus Riyanto', 'jumlah_siswa' => 30],
        ['id' => 3, 'nama_kelas' => '2B', 'tingkat' => 2, 'wali_kelas' => 'Ibu Ratna Sari', 'jumlah_siswa' => 29],
        ['id' => 4, 'nama_kelas' => '3A', 'tingkat' => 3, 'wali_kelas' => 'Bapak Joko Susilo', 'jumlah_siswa' => 31],
        ['id' => 5, 'nama_kelas' => '3C', 'tingkat' => 3, 'wali_kelas' => 'Ibu Nurul Hidayah', 'jumlah_siswa' => 27],
        ['id' => 6, 'nama_kelas' => '4A', 'tingkat' => 4, 'wali_kelas' => 'Bapak Dedi Kurniawan', 'jumlah_siswa' => 32],
        ['id' => 7, 'nama_kelas' => '5A', 'tingkat' => 5, 'wali_kelas' => 'Ibu Mega Puspita', 'jumlah_siswa' => 30],
        ['id' => 8, 'nama_kelas' => '6A', 'tingkat' => 6, 'wali_kelas' => 'Bapak Rudi Hartono', 'jumlah_siswa' => 26],
    ];

    public function index()
    {
        return view('admin.kelas.index', ['kelasList' => $this->kelasList]);
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil ditambahkan (Dummy).');
    }

    public function show($id)
    {
        $kelas = collect($this->kelasList)->firstWhere('id', $id) ?? $this->kelasList[0];
        return view('admin.kelas.show', compact('kelas'));
    }

    public function edit($id)
    {
        $kelas = collect($this->kelasList)->firstWhere('id', $id) ?? $this->kelasList[0];
        return view('admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diubah (Dummy).');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus (Dummy).');
    }
}
