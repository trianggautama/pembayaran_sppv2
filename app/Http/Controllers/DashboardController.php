<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role ?? 'admin';

        if ($role === 'bendahara') {
            return view('bendahara.dashboard');
        } elseif ($role === 'wali_siswa') {
            return view('wali-siswa.dashboard');
        }

        return view('dashboard');
    }
}
