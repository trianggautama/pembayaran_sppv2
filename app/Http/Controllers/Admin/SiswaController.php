<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    private $siswaList = [
        ['id' => 1, 'nis' => '2024001', 'nama' => 'Keisha Anindya', 'kelas' => '4A', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Merdeka No. 12', 'nama_wali' => 'Budi Santoso', 'telepon_wali' => '081234567890'],
        ['id' => 2, 'nis' => '2024002', 'nama' => 'Raka Pratama', 'kelas' => '2B', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Sudirman No. 45', 'nama_wali' => 'Siti Rahayu', 'telepon_wali' => '081298765432'],
        ['id' => 3, 'nis' => '2024003', 'nama' => 'Naila Fitri', 'kelas' => '6A', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Gatot Subroto No. 8', 'nama_wali' => 'Ahmad Fauzi', 'telepon_wali' => '085612345678'],
        ['id' => 4, 'nis' => '2024004', 'nama' => 'Dimas Saputra', 'kelas' => '3C', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Pahlawan No. 23', 'nama_wali' => 'Dewi Lestari', 'telepon_wali' => '087856781234'],
        ['id' => 5, 'nis' => '2024005', 'nama' => 'Aulia Putri', 'kelas' => '1A', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Diponegoro No. 15', 'nama_wali' => 'Hendra Wijaya', 'telepon_wali' => '081345678901'],
    ];

    public function index()
    {
        return view('admin.siswa.index', ['siswaList' => $this->siswaList]);
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan (Dummy).');
    }

    public function show($id)
    {
        $siswa = collect($this->siswaList)->firstWhere('id', $id) ?? $this->siswaList[0];
        return view('admin.siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = collect($this->siswaList)->firstWhere('id', $id) ?? $this->siswaList[0];
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diubah (Dummy).');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus (Dummy).');
    }
}
