<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerdinController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
 
 
    Route::middleware(['auth','cekrole:admin'])->group(function () {
        Route::get('/admin', [UserController::class, 'index']);
        Route::get('/tambah_user', [UserController::class, 'create'])->name('tambah.user');
        Route::post('/tambah_user', [UserController::class, 'store'])->name('store.user');
        Route::get('/edit_user/{id}', [UserController::class, 'edit'])->name('edit.user');
        Route::post('/edit_user/{id}', [UserController::class, 'update'])->name('update.user');
        Route::delete('delete_user', [UserController::class, 'destroy'])->name('user.delete');
    });
    Route::middleware(['auth','cekrole:sdm'])->group(function () {
        Route::get('/sdm', [KotaController::class, 'index']);
        Route::get('/tambah_kota', [KotaController::class, 'create'])->name('tambah.kota');
        Route::post('/tambah_kota', [KotaController::class, 'store'])->name('store.kota');
        Route::get('/edit_kota/{id}', [KotaController::class, 'edit'])->name('edit.kota');
        Route::post('/edit_kota/{id}', [KotaController::class, 'update'])->name('update.kota');
        Route::delete('delete_kota', [KotaController::class, 'destroy'])->name('kota.delete');

        Route::get('/konfirmasi_perdin', [PerdinController::class, 'konfirmasi_perdin']);
        Route::get('/konfirmasi_perdin/detail/{id}', [PerdinController::class, 'detail_konfirmasi_perdin'])->name('detail.perdin');
        Route::get('/approve_perdin/{id}', [PerdinController::class, 'approve_perdin'])->name('approve.perdin');
        Route::get('/reject_perdin/{id}', [PerdinController::class, 'reject_perdin'])->name('reject.perdin');
        Route::get('/history_perdin', [PerdinController::class, 'history_perdin']);

    });
    Route::middleware(['auth','cekrole:pegawai'])->group(function () {
        Route::get('/pegawai', [PerdinController::class, 'index']);
        Route::get('/tambah_perdin', [PerdinController::class, 'create'])->name('tambah.perdin');
        Route::post('/tambah_perdin', [PerdinController::class, 'store'])->name('store.perdin');

    });
   
});