<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Bidan\DashboardController as BidanDashboard;
use App\Http\Controllers\Desa\AnakController;
use App\Http\Controllers\Desa\DashboardController as DesaDashboard;
use App\Http\Controllers\Desa\WargaController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Desa\JadwalPosyanduController;
use App\Http\Controllers\Desa\KehadiranPosyanduController;
use App\Http\Controllers\KmsIbuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:bidan'])->group(function () {
    Route::get('/bidan/dashboard', [BidanDashboard::class, 'index'])
        ->name('bidan.dashboard');
    Route::resource('kms-ibu', KmsIbuController::class);
    Route::resource('kms-anak', KmsAnakController::class);
});

Route::middleware(['auth', 'role:petugas_desa'])
    ->prefix('desa')
    ->name('desa.')
    ->group(function () {

        Route::get('/dashboard', [DesaDashboard::class, 'index'])
            ->name('dashboard');

        // MASTER DATA
        Route::resource('/warga', WargaController::class);
        Route::resource('/anak', AnakController::class);

        // ================= JADWAL POSYANDU =================
        Route::resource(
            'jadwal-posyandu',
            JadwalPosyanduController::class
        );

        // Rekap kehadiran bulanan
        Route::get(
            'jadwal-posyandu-rekap',
            [KehadiranPosyanduController::class, 'rekapBulanan']
        )->name('jadwal-posyandu.rekap');

        // Input kehadiran per jadwal
        Route::post(
            'jadwal-posyandu/{jadwal}/kehadiran',
            [KehadiranPosyanduController::class, 'store']
        )->name('jadwal-posyandu.kehadiran.store');
    });


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboard::class, 'index'])
        ->name('user.dashboard');
});
