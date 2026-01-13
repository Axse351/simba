<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Bidan\DashboardController as BidanDashboard;
use App\Http\Controllers\Desa\DashboardController as DesaDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
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
});

Route::middleware(['auth', 'role:petugas_desa'])->group(function () {
    Route::get('/desa/dashboard', [DesaDashboard::class, 'index'])
        ->name('desa.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboard::class, 'index'])
        ->name('user.dashboard');
});
