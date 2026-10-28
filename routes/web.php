<?php

use App\Http\Controllers\BelajarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('route', [class, 'function']);
// Route::get('/belajar', [BelajarController::class, 'index']);
Route::get('/belajar', [BelajarController::class, 'index']);

Route::get('/tambah', [BelajarController::class, 'tambah'])->name('tambah');
Route::post('/actionTambah', [BelajarController::class, 'actionTambah'])->name('actionTambah');

Route::get('/kurang', [BelajarController::class, 'kurang'])->name('kurang');
Route::post('/actionKurang', [BelajarController::class, 'actionKurang'])->name('actionKurang');

Route::get('/kali', [BelajarController::class, 'kali'])->name('kali');
Route::post('/actionKali', [BelajarController::class, 'actionKali'])->name('actionKali');

Route::get('/bagi', [BelajarController::class, 'bagi'])->name('bagi');
Route::post('/actionBagi', [BelajarController::class, 'actionBagi'])->name('actionBagi');

// prefix
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'login']);
    Route::post('/actionLogin', [\App\Http\Controllers\LoginController::class, 'actionLogin'])->name('actionLogin');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('user', UserController::class);

    Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');
});
