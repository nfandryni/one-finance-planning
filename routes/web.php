<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengajuanKebutuhanController;
use App\Http\Controllers\ProfileController;
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





Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'logincheck']);


// Route::get('/profile', [ProfileController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    
    
    Route::middleware(['akses:superadmin'])->group(function () {
        Route::prefix('/dashboard-superadmin')->group(function () {
            Route::get('/', [DashboardController::class, 'index']);
            Route::get('/riwayat', [DashboardController::class, 'loggs']);
            Route::delete('/delete', [DashboardController::class, 'destroy']);
        });

        Route::prefix('/kelola-akun')->group(function () {
            Route::get('/', [AkunController::class, 'index']);
            Route::get('/tambah', [AkunController::class, 'create']);
            Route::get('/detail/{id}', [AkunController::class, 'show']);
            Route::post('simpan', [AkunController::class, 'store']);
            Route::get('/edit/{id}', [AkunController::class, 'edit']);
            Route::post('edit/simpan', [AkunController::class, 'update']);
            Route::delete('hapus', [AkunController::class, 'destroy']);
        });
      
    });

    Route::middleware(['akses:admin'])->group(function () {
        
        Route::prefix('/dashboard-admin')->group(function () {
            Route::get('/', [DashboardAdmin::class, 'index']);
        });
        
        
    });
  

   Route::get('/logout', [LoginController::class, 'logout']);
});
 

