<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LogsController;
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
    
    Route::prefix('dashboard-bendahara')->middleware(['akses:bendaharasekolah'])->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
        Route::get('/pengeluaran/tambah', [PengeluaranController::class, 'create']);
        Route::post('/pengeluaran/simpan', [PengeluaranController::class, 'store']);
        Route::get('/pengeluaran/edit/{id}', [PengeluaranController::class, 'edit']);
        Route::post('/pengeluaran/edit/simpan', [PengeluaranController::class, 'update']);
        Route::delete('/pengeluaran/hapus', [PengeluaranController::class, 'destroy']);
    });
    Route::prefix('dashboard-bendahara')->middleware(['akses:bendaharasekolah'])->group(function () {
        Route::get('/jenis-pengeluaran', [JenisPengeluaranController::class, 'index']);
        Route::get('/jenis-pengeluaran/tambah', [JenisPengeluaranController::class, 'create']);
        Route::post('/jenis-pengeluaran/simpan', [JenisPengeluaranController::class, 'store']);
        Route::get('/jenis-pengeluaran/edit/{id}', [JenisPengeluaranController::class, 'edit']);
        Route::post('/jenis-pengeluaran/edit/simpan', [JenisPengeluaranController::class, 'update']);
        Route::delete('/jenis-pengeluaran/hapus', [JenisPengeluaranController::class, 'destroy']);
    });
    Route::prefix('dashboard-bendahara')->middleware(['akses:bendaharasekolah'])->group(function () {
        Route::get('/sumber-dana', [SumberDanaController::class, 'index']);
        Route::get('/sumber-dana/tambah', [SumberDanaController::class, 'create']);
        Route::post('/sumber-dana/simpan', [SumberDanaController::class, 'store']);
        Route::get('/sumber-dana/edit/{id}', [SumberDanaController::class, 'edit']);
        Route::post('/sumber-dana/edit/simpan', [SumberDanaController::class, 'update']);
        Route::delete('/sumber-dana/hapus', [SumberDanaController::class, 'destroy']);
    });
    Route::prefix('dashboard-bendahara')->middleware(['akses:bendaharasekolah'])->group(function () {
        Route::get('/logs', [LogsController::class, 'index']);
        Route::delete('/logs/hapus', [LogsController::class, 'destroy']);
    });
    
    Route::prefix('dashboard-superadmin')->middleware(['akses:superadmin'])->group(function () { 
        Route::get('/', [AkunController::class, 'index']);
        Route::get('/tambah', [AkunController::class, 'create']);
        Route::post('/simpan', [AkunController::class, 'store']);
        Route::get('/edit/{id}', [AkunController::class, 'edit']);
        Route::post('/edit/simpan', [AkunController::class, 'update']);
        Route::delete('/hapus', [AkunController::class, 'destroy']);
    });

    Route::prefix('dashboard-pemohon')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/pengajuan-kebutuhan', [PengajuanKebutuhanController::class, 'index']);
        Route::get('/pengajuan-kebutuhan/tambah', [PengajuanKebutuhanController::class, 'create']);
        Route::post('/pengajuan-kebutuhan/simpan', [PengajuanKebutuhanController::class, 'store']);
        Route::get('/pengajuan-kebutuhan/edit/{id}', [PengajuanKebutuhanController::class, 'edit']);
        Route::post('/pengajuan-kebutuhan/edit/simpan', [PengajuanKebutuhanController::class, 'update']);
        Route::delete('/pengajuan-kebutuhan/hapus', [PengajuanKebutuhanController::class, 'destroy']);
    });


    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::get('/akun', function () {
    return view('kelola-akun.index');
});


