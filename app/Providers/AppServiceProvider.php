<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->isBendahara()) {
                    $view->with('pendingPembayaranCount', Pembayaran::where('status', 'pending')->count());
                }
                $view->with('unreadNotifCount', \App\Models\Notifikasi::where('user_id', $user->id)->whereNull('read_at')->count());
                $view->with('latestNotifikasis', \App\Models\Notifikasi::where('user_id', $user->id)->latest()->limit(5)->get());
            }
        });
    }
}
