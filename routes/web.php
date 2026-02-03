<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Bidan\ArtikelKesehatanController;
use App\Http\Controllers\Bidan\DashboardController as BidanDashboard;
use App\Http\Controllers\Desa\AnakController;
use App\Http\Controllers\Desa\DashboardController as DesaDashboard;
use App\Http\Controllers\Desa\WargaController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\ChatbotController;
use App\Http\Controllers\Desa\JadwalPosyanduController;
use App\Http\Controllers\Desa\KehadiranPosyanduController;
use App\Http\Controllers\KmsAnakController;
use App\Http\Controllers\KmsIbuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ====================== BIDAN ROUTES ======================
Route::middleware(['auth', 'role:bidan'])->group(function () {
    Route::get('/bidan/dashboard', [BidanDashboard::class, 'index'])
        ->name('bidan.dashboard');
    Route::resource('kms-ibu', KmsIbuController::class);
    Route::resource('kms-anak', KmsAnakController::class);

    Route::get('/bidan/warga', [WargaController::class, 'index'])
        ->name('bidan.warga.index');

    Route::get('/bidan/anak', [AnakController::class, 'index'])
        ->name('bidan.anak.index');
    Route::resource('artikel', ArtikelKesehatanController::class);

    Route::get('/bidan/anak/{anak}/grafik', [AnakController::class, 'grafik'])
        ->name('bidan.anak.grafik');

    Route::get('/bidan/anak/{anak}/cetak', [AnakController::class, 'cetak'])
        ->name('bidan.anak.cetak');
    Route::get('/bidan/warga/{warga}/grafik', [WargaController::class, 'grafik'])
        ->name('bidan.warga.grafik');
});

// ====================== PETUGAS DESA ROUTES ======================
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

        Route::get('/anak/{anak}/grafik', [AnakController::class, 'grafik'])
            ->name('anak.grafik');

        Route::get('/anak/{anak}/cetak', [AnakController::class, 'cetak'])
            ->name('anak.cetak');
        Route::get('/warga/{warga}/grafik', [WargaController::class, 'grafik'])
            ->name('warga.grafik');
    });

// ====================== USER ROUTES ======================
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard - Menampilkan beberapa artikel terbaru
        Route::get('/dashboard', [UserDashboard::class, 'index'])
            ->name('dashboard');

        // Halaman daftar semua artikel
        Route::get('/artikel', [UserDashboard::class, 'artikelIndex'])
            ->name('artikel.index');

        // Detail artikel
        Route::get('/artikel/{id}', [UserDashboard::class, 'show'])
            ->name('artikel.show');

        // ================= CHATBOT ROUTES =================
        Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])
            ->name('chatbot.send');

        Route::get('/chatbot/history', [ChatbotController::class, 'getHistory'])
            ->name('chatbot.history');

        Route::delete('/chatbot/history', [ChatbotController::class, 'clearHistory'])
            ->name('chatbot.clear');
    });
