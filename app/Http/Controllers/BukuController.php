<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
   public function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required',
            'judul' => 'required',
            'kategori' => 'required',
            'pengarang' => 'required',
            'harga' => 'required',
        ]);

        Buku::create($request->all());
        return redirect()->route('buku.index')->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'kode_buku' => 'required',
            'judul' => 'required',
            'kategori' => 'required',
            'pengarang' => 'required',
            'harga' => 'required',
        ]);

        $buku->update($request->all());
        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diubah.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus.');
    }

    // Fungsi khusus untuk halaman cetak
    public function cetak()
    {
        $buku = Buku::all();
        return view('buku.cetak', compact('buku'));
    }
}
