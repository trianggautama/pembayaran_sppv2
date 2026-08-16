<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $dataList = collect([]);
        return view('admin.data.index', compact('dataList'));
    }

    public function create()
    {
        return view('admin.data.create');
    }

    public function store(Request $request)
    {

        return redirect()->route('admin.data.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function show($id)
    {
        return view('admin.kelas.show', compact('kelas'));
    }

    public function edit($id)
    {
        $data = null;
        return view('admin.data.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {

        return redirect()->route('admin.data.index')->with('success', 'Data kelas berhasil diubah.');
    }

    public function destroy($id)
    {

        return redirect()->route('admin.data.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
