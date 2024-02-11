<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\PengajuanKebutuhanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardPemohonController;
use App\Http\Controllers\DashboardBendaharaController;
use App\Http\Controllers\KonfirmasiPengajuanController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\ItemKebutuhanController;
use App\Http\Controllers\ItemPerencanaanController;
use App\Http\Controllers\PerencanaanKeuanganController;
use Illuminate\Support\Facades\Route;   

/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
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
            Route::get('/generate/{id}', [AkunController::class, 'print']);
        });
      
    });

    Route::middleware(['akses:admin'])->group(function () {
        
        Route::prefix('/dashboard-admin')->group(function () {
            Route::get('/', [DashboardAdmin::class, 'index']);
            Route::get('/riwayat', [KonfirmasiPengajuanController::class, 'logs']);
        });

        Route::prefix('/pemasukan')->group(function () {
             Route::get('/', [PemasukanController::class, 'index']);
             Route::get('/detail/{id}', [PemasukanController::class, 'show']);
             Route::get('/print', [PemasukanController::class, 'print']);
        });

        Route::prefix('/pengeluaran')->group(function () {
            Route::get('/', [PengeluaranController::class, 'index']);
            Route::get('/detail/{id}', [PengeluaranController::class, 'show']);
            Route::get('/print', [PengeluaranController::class, 'print']);
        });
        Route::prefix('/realisasi')->group(function () {
            Route::get('/', [RealisasiController::class, 'index']);
            // Route::get('/detail/{id}', [RealisasiController::class, 'show']);
            Route::get('/detail/1', [RealisasiController::class, 'detail']);
            Route::get('/print', [RealisasiController::class, 'print']);
            Route::get('/print-item/{id}', [RealisasiController::class, 'print_item']);

        });

        Route::prefix('/konfirmasi-pengajuan')->group(function () {
            Route::get('/', [KonfirmasiPengajuanController::class, 'index']);
            Route::get('/detail/{id}', [KonfirmasiPengajuanController::class, 'show']);
            Route::post('/konfirmasi/{id}', [KonfirmasiPengajuanController::class, 'konfirmasi']);
            Route::get('/print', [KonfirmasiPengajuanController::class, 'print']);
            
        });

        Route::prefix('/perencanaan-keuangan')->group(function () {
            Route::get('/', [PerencanaanKeuanganController::class, 'index']);
            // Route::get('/detail/{id}', [PerencanaanKeuanganController::class, 'show']);
            Route::get('/detail/1', [PerencanaanKeuanganController::class, 'detail']);
            // Route::get('/print', [PerencanaanKeuanganController::class, 'print']);
            Route::get('/print', [PerencanaanKeuanganController::class, 'printay']);
            Route::get('/print-item/{id}', [PerencanaanKeuanganController::class, 'print_item']);
       });
       
    });
  
    Route::prefix('dashboard-bendahara')->middleware(['akses:bendaharasekolah'])->group(function () {
        Route::get('/chart-data', [DashboardBendaharaController::class, 'index']);
        Route::get('/', [DashboardBendaharaController::class, 'index']);
        Route::get('/realisasi', [RealisasiController::class, 'index']);
        Route::get('/realisasi/tambah', [RealisasiController::class, 'create']);
        Route::post('/realisasi/simpan', [RealisasiController::class, 'store']);
        Route::get('/realisasi/edit-realisasi/{id}', [RealisasiController::class, 'edit_realisasi']);
        Route::post('/realisasi/edit-realisasi/simpan', [RealisasiController::class, 'update_realisasi']);
        Route::get('/realisasi/edit-item/{id}', [RealisasiController::class, 'edit_item']);
        Route::post('/realisasi/edit-item/simpan', [RealisasiController::class, 'update_item']);
        Route::get('/realisasi/detail/{id}', [RealisasiController::class, 'show']);
        Route::delete('/realisasi/hapus', [RealisasiController::class, 'destroy']);
        Route::get('/realisasi/print', [RealisasiController::class, 'print']);
        Route::get('/realisasi/print-item/{id}', [RealisasiController::class, 'print_item']);
        
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
        Route::get('/pemasukan/detail/{id}', [PemasukanController::class, 'show']);
        Route::post('/pemasukan/edit/simpan', [PemasukanController::class, 'update']);
        Route::delete('/pemasukan/hapus', [PemasukanController::class, 'destroy']);
        Route::get('/pemasukan/print', [PemasukanController::class, 'print']);

        Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
        Route::get('/pengeluaran/tambah', [PengeluaranController::class, 'create']);
        Route::post('/pengeluaran/simpan', [PengeluaranController::class, 'store']);
        Route::get('/pengeluaran/edit/{id}', [PengeluaranController::class, 'edit']);
        Route::get('/pengeluaran/detail/{id}', [PengeluaranController::class, 'show']);
        Route::post('/pengeluaran/edit/simpan', [PengeluaranController::class, 'update']);
        Route::delete('/pengeluaran/hapus', [PengeluaranController::class, 'destroy']);
        Route::get('/pengeluaran/print', [PengeluaranController::class, 'print']);
        
        Route::get('/logs', [LogsController::class, 'index']);
        Route::get('/konfirmasi-pengajuan', [KonfirmasiPengajuanController::class, 'index']);
        Route::get('/konfirmasi-pengajuan/detail/{id}', [KonfirmasiPengajuanController::class, 'show']);
        Route::post('/konfirmasi-pengajuan/tolak-item/{id}', [KonfirmasiPengajuanController::class, 'update']);
        Route::post('/konfirmasi-pengajuan/konfirmasi/{id}', [KonfirmasiPengajuanController::class, 'filter']);
        Route::post('/konfirmasi-pengajuan/tolak-pengajuan/{id}', [KonfirmasiPengajuanController::class, 'reject']);
        Route::get('/konfirmasi-pengajuan/edit-item/{id}', [KonfirmasiPengajuanController::class, 'edit_item']);
        Route::post('/konfirmasi-pengajuan/edit-item/simpan', [KonfirmasiPengajuanController::class, 'update_item']);
        Route::get('/konfirmasi-pengajuan/print', [KonfirmasiPengajuanController::class, 'print']);
        
        Route::get('/jenis-pengeluaran', [JenisPengeluaranController::class, 'index']);
        Route::get('/jenis-pengeluaran/tambah', [JenisPengeluaranController::class, 'create']);
        Route::post('/jenis-pengeluaran/simpan', [JenisPengeluaranController::class, 'store']);
        Route::get('/jenis-pengeluaran/edit/{id}', [JenisPengeluaranController::class, 'edit']);
        Route::post('/jenis-pengeluaran/edit/simpan', [JenisPengeluaranController::class, 'update']);
        Route::delete('/jenis-pengeluaran/hapus', [JenisPengeluaranController::class, 'destroy']);
        
        Route::get('/perencanaan-keuangan', [PerencanaanKeuanganController::class, 'index']);
        Route::get('/perencanaan-keuangan/tambah', [PerencanaanKeuanganController::class, 'create']);
        Route::post('/perencanaan-keuangan/simpan', [PerencanaanKeuanganController::class, 'store']);
        Route::get('/perencanaan-keuangan/edit/{id}', [PerencanaanKeuanganController::class, 'edit']);
        Route::post('/perencanaan-keuangan/edit/simpan', [PerencanaanKeuanganController::class, 'update']);
        Route::get('/perencanaan-keuangan/detail/{id}', [PerencanaanKeuanganController::class, 'show']);
        Route::delete('/perencanaan-keuangan/hapus', [PerencanaanKeuanganController::class, 'destroy']);
        Route::get('/perencanaan-keuangan/print', [PerencanaanKeuanganController::class, 'print']);
        Route::get('/perencanaan-keuangan/print-item/{id}', [PerencanaanKeuanganController::class, 'print_item']);
        
        Route::get('/item-perencanaan', [ItemPerencanaanController::class, 'index']);
        Route::get('/item-perencanaan/tambah/{id}', [ItemPerencanaanController::class, 'create']);
        Route::post('/item-perencanaan/tambah/simpan', [ItemPerencanaanController::class, 'store']);
        Route::get('/item-perencanaan/edit/{id}', [ItemPerencanaanController::class, 'edit']);
        Route::post('/item-perencanaan/edit/simpan', [ItemPerencanaanController::class, 'update']);
        Route::delete('/item-perencanaan/hapus', [ItemPerencanaanController::class, 'destroy']);
   
        Route::get('/item-perencanaan', [ItemPerencanaanController::class, 'index']);
        Route::get('/item-perencanaan/tambah', [ItemPerencanaanController::class, 'create']);
        Route::post('/item-perencanaan/tambah/simpan', [ItemPerencanaanController::class, 'store']);
        Route::get('/item-perencanaan/edit/{id}', [ItemPerencanaanController::class, 'edit']);
        Route::post('/item-perencanaan/edit/simpan', [ItemPerencanaanController::class, 'update']);
        Route::delete('/item-perencanaan/hapus', [ItemPerencanaanController::class, 'destroy']);
    });
    
    Route::prefix('dashboard-pemohon')->middleware(['akses:pemohon'])->group(function () {
        Route::get('/logs', [LogsController::class, 'index']);
        Route::delete('/logs/hapus', [LogsController::class, 'destroy']);

        Route::get('/', [DashboardPemohonController::class, 'index']);
        Route::get('/pengajuan-kebutuhan', [PengajuanKebutuhanController::class, 'index']);
        Route::get('/pengajuan-kebutuhan/tambah', [PengajuanKebutuhanController::class, 'create']);
        Route::post('/pengajuan-kebutuhan/simpan', [PengajuanKebutuhanController::class, 'store']);
        Route::get('/pengajuan-kebutuhan/detail/{id}', [PengajuanKebutuhanController::class, 'show']);
        Route::get('/pengajuan-kebutuhan/edit/{id}', [PengajuanKebutuhanController::class, 'edit']);
        Route::post('/pengajuan-kebutuhan/edit/simpan', [PengajuanKebutuhanController::class, 'update']);
        Route::post('/pengajuan-kebutuhan/ajukan/{id}', [PengajuanKebutuhanController::class, 'send']);
        Route::delete('/pengajuan-kebutuhan/hapus', [PengajuanKebutuhanController::class, 'destroy']);
        Route::get('/cetak', [PengajuanKebutuhanController::class, 'cetak']);

        Route::get('/', [DashboardPemohonController::class, 'index']);
        Route::get('/item-kebutuhan', [ItemKebutuhanController::class, 'index']);
        Route::get('/item-kebutuhan/tambah/{id}', [ItemKebutuhanController::class, 'create']);
        Route::post('/item-kebutuhan/simpan', [ItemKebutuhanController::class, 'store']);
        Route::get('/item-kebutuhan/edit/{id}', [ItemKebutuhanController::class, 'edit']);
        Route::post('/item-kebutuhan/edit/simpan', [ItemKebutuhanController::class, 'update']);
        Route::delete('/item-kebutuhan/hapus', [ItemKebutuhanController::class, 'destroy']);

        Route::get('/realisasi', [RealisasiController::class, 'index']);
        Route::get('/realisasi/detail/{id}', [RealisasiController::class, 'show']);
        Route::get('/realisasi/print', [RealisasiController::class, 'print']);
        Route::get('/realisasi/print-item/{id}', [RealisasiController::class, 'print_item']);
    });


Route::get('/logout', [LoginController::class, 'logout']);

});
