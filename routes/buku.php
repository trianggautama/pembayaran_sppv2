<?php
// copy to web.phpp
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/buku/cetak', [BukuController::class, 'cetak'])->name('buku.cetak');
Route::resource('buku', BukuController::class);
Route::get('/', function () {
    return redirect()->route('buku.index');
});
