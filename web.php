<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\WakasekDashboardController;
use App\Http\Controllers\WakasekGuruController;
use App\Http\Controllers\WakasekSiswaController;
use App\Http\Controllers\WakasekMitraController;
use App\Http\Controllers\WakasekPengajuanController;
use App\Http\Controllers\WakasekLaporanController;
use App\Http\Controllers\WakasekAbsensiController;
use App\Http\Controllers\WakasekNilaiController;
use App\Http\Controllers\WakasekLogController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminSiswaController;
use App\Http\Controllers\Admin\AdminGuruController;
use App\Http\Controllers\Admin\AdminIndustriController;
use App\Http\Controllers\Admin\AdminSiswaPklController;
use App\Http\Controllers\Admin\AdminAbsensiController;
use App\Http\Controllers\Admin\AdminBimbinganController;
use App\Http\Controllers\Admin\AdminKompetensiController;
use App\Http\Controllers\Admin\AdminNilaiController;
use App\Http\Controllers\Admin\AdminLogController;

Route::prefix('dashboard/admin')->name('admin.')->group(function () {
    Route::get('/',                             [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users',                        [AdminUserController::class, 'index'])->name('users');
    Route::post('/users',                       [AdminUserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}',               [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/siswa',                        [AdminSiswaController::class, 'index'])->name('siswa');
    Route::post('/siswa',                       [AdminSiswaController::class, 'store'])->name('siswa.store');

    Route::get('/guru',                         [AdminGuruController::class, 'index'])->name('guru');

    Route::get('/industri',                     [AdminIndustriController::class, 'index'])->name('industri');
    Route::post('/industri',                    [AdminIndustriController::class, 'store'])->name('industri.store');
    Route::delete('/industri/{id}',            [AdminIndustriController::class, 'destroy'])->name('industri.destroy');

    Route::get('/siswa-pkl',                    [AdminSiswaPklController::class, 'index'])->name('siswa-pkl');
    Route::patch('/siswa-pkl/{id}/approve',    [AdminSiswaPklController::class, 'approve'])->name('siswa-pkl.approve');
    Route::patch('/siswa-pkl/{id}/reject',     [AdminSiswaPklController::class, 'reject'])->name('siswa-pkl.reject');

    Route::get('/absensi',                      [AdminAbsensiController::class, 'index'])->name('absensi');
    Route::get('/bimbingan',                    [AdminBimbinganController::class, 'index'])->name('bimbingan');

    Route::get('/kompetensi',                   [AdminKompetensiController::class, 'index'])->name('kompetensi');
    Route::post('/kompetensi',                  [AdminKompetensiController::class, 'store'])->name('kompetensi.store');
    Route::delete('/kompetensi/{id}',          [AdminKompetensiController::class, 'destroy'])->name('kompetensi.destroy');

    Route::get('/nilai',                        [AdminNilaiController::class, 'index'])->name('nilai');
    Route::get('/log',                          [AdminLogController::class, 'index'])->name('log');
});


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// Tambahkan ini di web.php
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard/wakasek/nilai', [WakasekNilaiController::class, 'index'])->name('wakasek.nilai');
Route::get('/dashboard/wakasek/log', [WakasekLogController::class, 'index'])->name('wakasek.log');

Route::get('/dashboard/wakasek/absensi', [WakasekAbsensiController::class, 'index'])
    ->name('wakasek.absensi');

Route::get('/dashboard/wakasek/laporan', [WakasekLaporanController::class, 'index'])
    ->name('wakasek.laporan');
Route::patch('/dashboard/wakasek/laporan/{id}/approve', [WakasekLaporanController::class, 'approve'])
    ->name('wakasek.laporan.approve');

Route::get('/dashboard/wakasek/pengajuan', [WakasekPengajuanController::class, 'index'])
    ->name('wakasek.pengajuan');
Route::patch('/dashboard/wakasek/pengajuan/{id}/approve', [WakasekPengajuanController::class, 'approve'])
    ->name('wakasek.pengajuan.approve');
Route::patch('/dashboard/wakasek/pengajuan/{id}/reject', [WakasekPengajuanController::class, 'reject'])
    ->name('wakasek.pengajuan.reject');

Route::get('/dashboard/wakasek/mitra', [WakasekMitraController::class, 'index'])
    ->name('wakasek.mitra');

Route::get('/dashboard/wakasek/siswa', [WakasekSiswaController::class, 'index'])
    ->name('wakasek.siswa');

Route::get('/dashboard/wakasek/guru', [WakasekGuruController::class, 'index'])
    ->name('wakasek.guru');

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard/guru', [DashboardGuruController::class, 'index'])
    ->name('dashboard.guru');

Route::get('/dashboard/wakasek', [WakasekDashboardController::class, 'index'])
    ->name('dashboard.wakasek');

Route::get('/login', [AuthController::class, 'index'])->name('login');