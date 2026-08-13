<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profil.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('admin.profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Dummy update behavior
        return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }
}