<?php

use App\Http\Controllers\BelajarController;
use Illuminate\Support\Facades\Route;

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
