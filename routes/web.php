<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\LoginController;
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


Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'logincheck']);
Route::prefix('dashboard-bendahara')->group(function () {
    Route::get('/', [RealisasiController::class, 'index']);
    Route::get('/tambah', [RealisasiController::class, 'create']);
    Route::post('/simpan', [RealisasiController::class, 'store']);
    Route::get('/edit/{id}', [RealisasiController::class, 'edit']);
    Route::post('/edit/simpan', [RealisasiController::class, 'update']);
    Route::delete('/hapus', [RealisasiController::class, 'destroy']);
});

Route::middleware(['auth'])->group(function () {

    Route::prefix('dashboard-superadmin')->middleware(['akses:superadmin'])->group(function () {
        Route::get('/', [AkunController::class, 'index']);
        Route::get('/tambah', [AkunController::class, 'create']);
        Route::post('/simpan', [AkunController::class, 'store']);
        Route::get('/edit/{id}', [AkunController::class, 'edit']);
        Route::post('/edit/simpan', [AkunController::class, 'update']);
        Route::delete('/hapus', [AkunController::class, 'destroy']);
    });
//->middleware(['akses:bendahara'])
 
   
    Route::prefix('dashboard-pemohon')->middleware(['akses:pemohon'])->group(function () {
        Route::get('/', [PengajuanKebutuhanController::class, 'index']);
        Route::post('/hapus', [PengajuanKebutuhanController::class, 'destroy']);
    });

    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::get('/akun', function () {
    return view('kelola-akun.index');
});


