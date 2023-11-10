<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\SumberDanaController;
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


Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'logincheck']);

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard-bendahara')->middleware(['akses:bendaharasekolah'])->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/realisasi', [RealisasiController::class, 'index']);
        Route::get('/realisasi/tambah', [RealisasiController::class, 'create']);
        Route::post('/realisasi/simpan', [RealisasiController::class, 'store']);
        Route::get('/realisasi/edit/{id}', [RealisasiController::class, 'edit']);
        Route::post('/realisasi/edit/simpan', [RealisasiController::class, 'update']);
        Route::delete('/realisasi/hapus', [RealisasiController::class, 'destroy']);
        Route::get('/gedung', [GedungController::class, 'index']);
        Route::post('/gedung/tambah/simpan', [GedungController::class, 'store']);
        Route::get('/gedung/edit/{id}', [GedungController::class, 'edit']);
        Route::post('/gedung/edit/simpan', [GedungController::class, 'update']);
        Route::delete('/gedung/hapus', [GedungController::class, 'destroy']);
        Route::get('/sumber-dana', [SumberDanaController::class, 'index']);
        Route::get('/sumber-dana/tambah', [SumberDanaController::class, 'create']);
        Route::post('/sumber-dana/simpan', [SumberDanaController::class, 'store']);
        Route::get('/sumber-dana/edit/{id}', [SumberDanaController::class, 'edit']);
        Route::post('/sumber-dana/edit/simpan', [SumberDanaController::class, 'update']);
        Route::delete('/sumber-dana/hapus', [SumberDanaController::class, 'destroy']);
        Route::get('/pemasukan', [PemasukanController::class, 'index']);
        Route::get('/pemasukan/tambah', [PemasukanController::class, 'create']);
        Route::post('/pemasukan/simpan', [PemasukanController::class, 'store']);
        Route::get('/pemasukan/edit/{id}', [PemasukanController::class, 'edit']);
        Route::post('/pemasukan/edit/simpan', [PemasukanController::class, 'update']);
        Route::delete('/pemasukan/hapus', [PemasukanController::class, 'destroy']);
        Route::get('/logs', [LogsController::class, 'index']);
        Route::delete('/logs/hapus', [LogsController::class, 'destroy']);
        Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
        Route::get('/pengeluaran/tambah', [PengeluaranController::class, 'create']);
        Route::post('/pengeluaran/simpan', [PengeluaranController::class, 'store']);
        Route::get('/pengeluaran/edit/{id}', [PengeluaranController::class, 'edit']);
        Route::post('/pengeluaran/edit/simpan', [PengeluaranController::class, 'update']);
        Route::delete('/pengeluaran/hapus', [PengeluaranController::class, 'destroy']);
        Route::get('/jenis-pengeluaran', [JenisPengeluaranController::class, 'index']);
        Route::get('/jenis-pengeluaran/tambah', [JenisPengeluaranController::class, 'create']);
        Route::post('/jenis-pengeluaran/simpan', [JenisPengeluaranController::class, 'store']);
        Route::get('/jenis-pengeluaran/edit/{id}', [JenisPengeluaranController::class, 'edit']);
        Route::post('/jenis-pengeluaran/edit/simpan', [JenisPengeluaranController::class, 'update']);
        Route::delete('/jenis-pengeluaran/hapus', [JenisPengeluaranController::class, 'destroy']);
    });

    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::get('/akun', function () {
    return view('kelola-akun.index');
});
