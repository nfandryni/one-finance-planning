<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengajuanKebutuhanController;
use App\Http\Controllers\RealisasiController;
use Illuminate\Support\Facades\Route;


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

Route::get('/layout', function () {
    return view('layout.layout');
});

Route::get('/', function () {
    return view('welcome');

});


Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('login',[AuthController::class,'check']);
Route::middleware(['auth'])->group(function () {

    Route::prefix('dashboard-superadmin')->middleware(['akses:superadmin'])->group(function () {
        Route::get('/', [AkunController::class, 'index']);
        Route::get('/tambah', [AkunController::class, 'create']);
        Route::post('/simpan', [AkunController::class, 'store']);
        Route::get('/edit/{id}', [AkunController::class, 'edit']);
        Route::post('/edit/simpan', [AkunController::class, 'update']);
        Route::delete('/hapus', [AkunController::class, 'destroy']);
    });

 
    Route::prefix('dashboard-bendahara')->middleware(['akses:bendahara'])->group(function () {
        Route::get('/', [RealisasiController::class, 'index']);
        Route::get('/tambah', [RealisasiController::class, 'create']);
        Route::post('/simpan', [RealisasiController::class, 'store']);
        Route::get('/edit/{id}', [RealisasiController::class, 'edit']);
        Route::post('/edit/simpan', [RealisasiController::class, 'update']);
        Route::delete('/hapus', [RealisasiController::class, 'destroy']);
    });

    Route::prefix('dashboard-pemohon')->middleware(['akses:pemohon'])->group(function () {
        Route::get('/', [PengajuanKebutuhanController::class, 'index']);
        Route::post('/hapus', [PengajuanKebutuhanController::class, 'destroy']);
    });

    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::get('/akun', function () {
    return view('kelola-akun.index');
});

Route::get('/akun', function () {
    return view('kelola-akun.index');
});


Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('login',[AuthController::class,'check']);
Route::middleware(['auth'])->group(function () {

    Route::prefix('dashboard-superadmin')->middleware(['akses:superadmin'])->group(function () {
        Route::get('/', [AkunController::class, 'index']);
        Route::get('/tambah', [AkunController::class, 'create']);
        Route::post('/simpan', [AkunController::class, 'store']);
        Route::get('/edit/{id}', [AkunController::class, 'edit']);
        Route::post('/edit/simpan', [AkunController::class, 'update']);
        Route::delete('/hapus', [AkunController::class, 'destroy']);
    });

 
    Route::prefix('dashboard-bendahara')->middleware(['akses:bendahara'])->group(function () {
        Route::get('/', [RealisasiController::class, 'index']);
        Route::get('/tambah', [RealisasiController::class, 'create']);
        Route::post('/simpan', [RealisasiController::class, 'store']);
        Route::get('/edit/{id}', [RealisasiController::class, 'edit']);
        Route::post('/edit/simpan', [RealisasiController::class, 'update']);
        Route::delete('/hapus', [RealisasiController::class, 'destroy']);
    });

    Route::prefix('dashboard-pemohon')->middleware(['akses:pemohon'])->group(function () {
        Route::get('/', [PengajuanKebutuhanController::class, 'index']);
        Route::post('/hapus', [PengajuanKebutuhanController::class, 'destroy']);
    });

    Route::get('/logout', [AuthController::class, 'logout']);
});

