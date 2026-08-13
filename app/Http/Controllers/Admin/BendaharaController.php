<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function index()
    {
        $bendaharaList = User::where('role', 'bendahara')
            ->latest()
            ->paginate(10);

        return view('admin.bendahara.index', compact('bendaharaList'));
    }

    public function create()
    {
        return view('admin.bendahara.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.bendahara.index')->with('success', 'Bendahara berhasil ditambahkan.');
    }

    public function show(User $bendahara)
    {
        return view('admin.bendahara.show', compact('bendahara'));
    }

    public function edit(User $bendahara)
    {
        return view('admin.bendahara.edit', compact('bendahara'));
    }

    public function update(Request $request, User $bendahara)
    {
        return redirect()->route('admin.bendahara.index')->with('success', 'Bendahara berhasil diperbarui.');
    }

    public function destroy(User $bendahara)
    {
        return redirect()->route('admin.bendahara.index')->with('success', 'Bendahara berhasil dihapus.');
    }
}
