<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userList = [
        ['id' => 1, 'name' => 'Admin SPP', 'username' => 'admin', 'email' => 'admin@sdn01sukamaju.sch.id', 'role' => 'admin'],
        ['id' => 2, 'name' => 'Bendahara Sekolah', 'username' => 'bendahara', 'email' => 'bendahara@sdn01sukamaju.sch.id', 'role' => 'bendahara'],
        ['id' => 3, 'name' => 'Budi Santoso', 'username' => 'budi.santoso', 'email' => 'budi@gmail.com', 'role' => 'wali_siswa'],
        ['id' => 4, 'name' => 'Siti Rahayu', 'username' => 'siti.rahayu', 'email' => 'siti@gmail.com', 'role' => 'wali_siswa'],
        ['id' => 5, 'name' => 'Ahmad Fauzi', 'username' => 'ahmad.fauzi', 'email' => 'ahmad@gmail.com', 'role' => 'wali_siswa'],
    ];

    public function index()
    {
        return view('admin.users.index', ['userList' => $this->userList]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil ditambahkan (Dummy).');
    }

    public function show($id)
    {
        $user = collect($this->userList)->firstWhere('id', $id) ?? $this->userList[0];
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = collect($this->userList)->firstWhere('id', $id) ?? $this->userList[0];
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diubah (Dummy).');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil dihapus (Dummy).');
    }
}
