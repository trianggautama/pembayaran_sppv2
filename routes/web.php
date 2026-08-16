<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\BendaharaController;
use App\Http\Controllers\Admin\WaliSiswaController;
use App\Http\Controllers\Admin\TagihanController as AdminTagihanController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Bendahara\TagihanController;
use App\Http\Controllers\Bendahara\SiswaController as BendaharaSiswaController;
use App\Http\Controllers\WaliSiswa\TagihanController as WaliSiswaTagihanController;
use App\Http\Controllers\WaliSiswa\PembayaranController as WaliSiswaPembayaranController;
use App\Http\Controllers\Bendahara\VerifikasiController;
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('notifikasi/{notifikasi}/baca', [NotifikasiController::class, 'bacaDanRedirect'])->name('notifikasi.baca');
    Route::post('notifikasi/baca-semua', [NotifikasiController::class, 'bacaSemua'])->name('notifikasi.baca-semua');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');
        Route::get('profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::put('profil', [ProfilController::class, 'update'])->name('profil.update');
        Route::resource('bendahara', BendaharaController::class);
        Route::resource('wali-siswa', WaliSiswaController::class)->parameters(['wali-siswa' => 'wali_siswa:id']);
        
        Route::resource('siswa', SiswaController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('users', UserController::class);
        Route::resource('tahun-ajaran', TahunAjaranController::class);
        Route::resource('data', DataController::class);

        Route::get('tagihan', [AdminTagihanController::class, 'index'])->name('tagihan.index');
        Route::get('tagihan/cetak-pdf', [AdminTagihanController::class, 'cetakPdf'])->name('tagihan.cetak-pdf');

        Route::get('pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('pembayaran/cetak-pdf', [AdminPembayaranController::class, 'cetakRekapPdf'])->name('pembayaran.cetak-pdf');
    });

    Route::middleware('bendahara')->prefix('bendahara')->name('bendahara.')->group(function () {
        Route::get('siswa', [BendaharaSiswaController::class, 'index'])->name('siswa.index');
        Route::get('siswa/{siswa}', [BendaharaSiswaController::class, 'show'])->name('siswa.show');

        Route::get('tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
        Route::get('tagihan/create', [TagihanController::class, 'create'])->name('tagihan.create');
        Route::get('tagihan/cetak-pdf', [TagihanController::class, 'cetakPdf'])->name('tagihan.cetak-pdf');
        Route::post('tagihan/generate', [TagihanController::class, 'generate'])->name('tagihan.generate');
        Route::get('tagihan/{tagihan}', [TagihanController::class, 'show'])->name('tagihan.show');
        Route::delete('tagihan/{tagihan}', [TagihanController::class, 'destroy'])->name('tagihan.destroy');

        Route::get('verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
        Route::get('verifikasi/riwayat', [VerifikasiController::class, 'riwayat'])->name('verifikasi.riwayat');
        Route::get('verifikasi/rekap-pdf', [VerifikasiController::class, 'cetakRekapPdf'])->name('verifikasi.rekap-pdf');
        Route::get('verifikasi/{pembayaran}/kwitansi', [VerifikasiController::class, 'kwitansi'])->name('verifikasi.kwitansi');
        Route::get('verifikasi/{pembayaran}', [VerifikasiController::class, 'show'])->name('verifikasi.show');
        Route::post('verifikasi/{pembayaran}/terima', [VerifikasiController::class, 'terima'])->name('verifikasi.terima');
        Route::post('verifikasi/{pembayaran}/tolak', [VerifikasiController::class, 'tolak'])->name('verifikasi.tolak');

        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('pembayaran', [App\Http\Controllers\Bendahara\LaporanController::class, 'pembayaran'])->name('pembayaran');
            Route::get('tunggakan', [App\Http\Controllers\Bendahara\LaporanController::class, 'tunggakan'])->name('tunggakan');
            Route::get('kelas', [App\Http\Controllers\Bendahara\LaporanController::class, 'kelas'])->name('kelas');
        });
    });

    Route::middleware('wali_siswa')->prefix('wali-siswa')->name('wali-siswa.')->group(function () {
        Route::get('tagihan', [WaliSiswaTagihanController::class, 'index'])->name('tagihan.index');
        Route::get('pembayaran/create', [WaliSiswaPembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('pembayaran', [WaliSiswaPembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('pembayaran/{pembayaran}', [WaliSiswaPembayaranController::class, 'show'])->name('pembayaran.show');
        Route::get('pembayaran/{pembayaran}/kwitansi', [WaliSiswaPembayaranController::class, 'kwitansi'])->name('pembayaran.kwitansi');
        Route::get('riwayat', [WaliSiswaTagihanController::class, 'riwayat'])->name('tagihan.riwayat');
    });
});
