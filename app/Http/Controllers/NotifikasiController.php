<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('notifikasi.index', compact('notifikasis'));
    }

    public function bacaDanRedirect(Notifikasi $notifikasi)
    {
        if ($notifikasi->user_id !== Auth::id()) {
            abort(403);
        }

        $notifikasi->update(['read_at' => now()]);

        return redirect($notifikasi->link ?? route('dashboard'));
    }

    public function bacaSemua()
    {
        Notifikasi::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return back();
    }
}