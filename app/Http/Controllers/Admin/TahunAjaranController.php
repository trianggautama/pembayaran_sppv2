<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaranList = TahunAjaran::orderByDesc('is_active')
            ->orderByDesc('nama')
            ->orderBy('semester')
            ->get();
            
        return view('admin.tahun-ajaran.index', compact('tahunAjaranList'));
    }

    public function create()
    {
        return view('admin.tahun-ajaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:20',
            'semester' => 'required|in:1,2',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $isActive = $request->boolean('is_active');

        DB::transaction(function () use ($validated, $isActive) {
            if ($isActive) {
                TahunAjaran::query()->update(['is_active' => false]);
            }
            
            TahunAjaran::create(array_merge($validated, ['is_active' => $isActive]));
        });

        return redirect()->route('admin.tahun-ajaran.index')->with('success', 'Data tahun ajaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        return view('admin.tahun-ajaran.show', compact('tahunAjaran'));
    }

    public function edit($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        return view('admin.tahun-ajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:20',
            'semester' => 'required|in:1,2',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $tahunAjaran = TahunAjaran::findOrFail($id);
        $isActive = $request->boolean('is_active');

        DB::transaction(function () use ($tahunAjaran, $validated, $isActive) {
            if ($isActive) {
                TahunAjaran::where('id', '!=', $tahunAjaran->id)->update(['is_active' => false]);
            }
            
            $tahunAjaran->update(array_merge($validated, ['is_active' => $isActive]));
        });

        return redirect()->route('admin.tahun-ajaran.index')->with('success', 'Data tahun ajaran berhasil diubah.');
    }

    public function destroy($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->delete();
        
        return redirect()->route('admin.tahun-ajaran.index')->with('success', 'Data tahun ajaran berhasil dihapus.');
    }
}
