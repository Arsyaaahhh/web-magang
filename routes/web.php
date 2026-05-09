<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TdgController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembinaanController;
use App\Http\Controllers\PengawasanController;
use App\Http\Controllers\AlkoholController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\SwkController;
use App\Http\Controllers\PumController;
use App\Http\Controllers\PasarController;
use App\Http\Controllers\TokokelontongController;
use App\Http\Controllers\KoperasiController;
use App\Http\Controllers\MetrologiAlatController;
use App\Http\Controllers\MetrologiReparasiController;
use App\Http\Controllers\FrontendMetrologiController;

/*
|--------------------------------------------------------------------------
| LOGIN & AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', fn()=>view('login'))->name('login');
Route::post('/login-process',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);


/*
|--------------------------------------------------------------------------
| DASHBOARD UTAMA
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/admin', function () {
    if(!session('login') || session('role') !== 'admin'){
        return redirect('/');
    }
    return view('admin.index');
});


/*
|--------------------------------------------------------------------------
| HALAMAN USER (PUBLIK)
|--------------------------------------------------------------------------
*/
// Bidang
Route::get('/mikro', [PumController::class, 'index']); // DIPERBARUI KE CONTROLLER
Route::get('/perdagangan', fn()=>view('bidang.perdagangan'));
Route::get('/koperasi', fn()=>view('bidang.koperasi'));
Route::get('/metrologi', fn()=>view('bidang.metrologi'));

// Pembinaan (User)
Route::get('/pembinaan', [PembinaanController::class,'view']);
Route::get('/pembinaan-data', [PembinaanController::class,'index']);

// Sekretariat (User)
Route::get('/sekretariat', [SuratController::class,'sekretariat']);

// UMKM & SWK (User JSON/AJAX Data)
Route::get('/umkm', [UmkmController::class, 'umkm']);
Route::get('/swk', [SwkController::class, 'swk']);


/*
|--------------------------------------------------------------------------
| ADMIN SEKRETARIAT
|--------------------------------------------------------------------------
*/
Route::get('/admin/admin_sekre', [SuratController::class,'index'])->name('surat.index');
Route::get('/admin/admin_sekre/surat', [SuratController::class,'list'])->name('surat.list');
Route::get('/admin/admin_sekre/create', [SuratController::class,'create'])->name('surat.create');
Route::post('/admin/admin_sekre/store', [SuratController::class,'store'])->name('surat.store');
Route::get('/admin/admin_sekre/edit/{id}', [SuratController::class,'edit'])->name('surat.edit');
Route::post('/admin/admin_sekre/update/{id}', [SuratController::class,'update'])->name('surat.update');
Route::get('/admin/admin_sekre/delete/{id}', [SuratController::class,'destroy'])->name('surat.destroy');


/*
|--------------------------------------------------------------------------
| ADMIN MAGANG
|--------------------------------------------------------------------------
*/
Route::get('/admin/magang', [MagangController::class,'index'])->name('magang.index');
Route::get('/admin/magang/create', [MagangController::class,'create'])->name('magang.create');
Route::post('/admin/magang/store', [MagangController::class,'store'])->name('magang.store');
Route::get('/admin/magang/edit/{id}', [MagangController::class,'edit'])->name('magang.edit');
Route::post('/admin/magang/update/{id}', [MagangController::class,'update'])->name('magang.update');
Route::get('/admin/magang/delete/{id}', [MagangController::class,'destroy'])->name('magang.destroy');


/*
|--------------------------------------------------------------------------
| ADMIN PEGAWAI (REKAP)
|--------------------------------------------------------------------------
*/
Route::get('/admin/pegawai', [PegawaiController::class,'rekap'])->name('pegawai.rekap');
Route::get('/admin/pegawai/create', [PegawaiController::class,'createRekap'])->name('pegawai.rekap.create');
Route::post('/admin/pegawai/store', [PegawaiController::class,'storeRekap'])->name('pegawai.rekap.store');
Route::get('/admin/pegawai/edit/{id}', [PegawaiController::class,'editRekap'])->name('pegawai.rekap.edit');
Route::post('/admin/pegawai/update/{id}', [PegawaiController::class,'updateRekap'])->name('pegawai.rekap.update');
Route::get('/admin/pegawai/delete/{id}', [PegawaiController::class,'deleteRekap'])->name('pegawai.rekap.delete');


/*
|--------------------------------------------------------------------------
| ADMIN PEMBINAAN (ADMIN PUP)
|--------------------------------------------------------------------------
*/
Route::get('/admin/admin_pup', function () {
    return view('admin.admin_pup.index'); 
})->name('admin_pup.index');

Route::get('/admin/admin_pup/tdg', [TdgController::class,'index'])->name('tdg.index');
Route::get('/admin/admin_pup/tdg/create', [TdgController::class,'create'])->name('tdg.create');
Route::post('/admin/admin_pup/tdg/store', [TdgController::class,'store'])->name('tdg.store');
Route::get('/admin/admin_pup/tdg/edit/{id}', [TdgController::class,'edit'])->name('tdg.edit');
Route::post('/admin/admin_pup/tdg/update/{id}', [TdgController::class,'update'])->name('tdg.update');
Route::get('/admin/admin_pup/tdg/delete/{id}', [TdgController::class,'destroy'])->name('tdg.delete');

Route::get('/admin/admin_pup/pengawasan', [PengawasanController::class,'index'])->name('pengawasan.index');
Route::get('/admin/admin_pup/pengawasan/create', [PengawasanController::class,'create'])->name('pengawasan.create');
Route::post('/admin/admin_pup/pengawasan/store', [PengawasanController::class,'store'])->name('pengawasan.store');
Route::get('/admin/admin_pup/pengawasan/edit/{id}', [PengawasanController::class,'edit'])->name('pengawasan.edit');
Route::post('/admin/admin_pup/pengawasan/update/{id}', [PengawasanController::class,'update'])->name('pengawasan.update');
Route::get('/admin/admin_pup/pengawasan/delete/{id}', [PengawasanController::class,'destroy'])->name('pengawasan.delete');

Route::get('/admin/admin_pup/alkohol', [AlkoholController::class,'index'])->name('alkohol.index');
Route::get('/admin/admin_pup/alkohol/create', [AlkoholController::class,'create'])->name('alkohol.create');
Route::post('/admin/admin_pup/alkohol/store', [AlkoholController::class,'store'])->name('alkohol.store');
Route::get('/admin/admin_pup/alkohol/edit/{id}', [AlkoholController::class,'edit'])->name('alkohol.edit');
Route::post('/admin/admin_pup/alkohol/update/{id}', [AlkoholController::class,'update'])->name('alkohol.update');
Route::get('/admin/admin_pup/alkohol/delete/{id}', [AlkoholController::class,'destroy'])->name('alkohol.delete');


/*
|--------------------------------------------------------------------------
| ADMIN PUM (UMKM & SWK)
|--------------------------------------------------------------------------
*/
// Menu Utama PUM
Route::get('/admin/admin_pum/', fn()=>view('admin.admin_pum.adminpum'))->name('admin_pum.adminpum');

// ================= ADMIN UMKM =================
Route::get('/admin/admin_pum/adminumkm', [UmkmController::class, 'index'])->name('adminumkm');
Route::get('/admin/admin_pum/umkmcreate', [UmkmController::class,'create']);
Route::post('/admin/admin_pum/umkmstore', [UmkmController::class,'store']);
Route::get('/admin/admin_pum/umkmedit/{id}', [UmkmController::class,'edit']);
Route::post('/admin/admin_pum/umkmupdate/{id}', [UmkmController::class,'update']);
Route::delete('/admin/admin_pum/umkmdelete/{id}', [UmkmController::class,'destroy']);

// ================= ADMIN SWK =================
Route::get('/admin/admin_pum/adminswk', [SwkController::class, 'index'])->name('adminswk');
Route::get('/admin/admin_pum/swkcreate', [SwkController::class,'create']);
Route::post('/admin/admin_pum/swkstore', [SwkController::class,'store']);
Route::get('/admin/admin_pum/swkedit/{id}', [SwkController::class,'edit']);
Route::post('/admin/admin_pum/swkupdate/{id}', [SwkController::class,'update']);
Route::delete('/admin/admin_pum/swkdelete/{id}', [SwkController::class,'destroy']);

// ================= AJAX DROPDOWN (KECAMATAN -> KELURAHAN) =================
Route::get('/get-kelurahan/{id}', [UmkmController::class, 'getKelurahan']);

/*
|--------------------------------------------------------------------------
| ADMIN PERDAGANGAN
|--------------------------------------------------------------------------
*/

Route::get('/admin/admin_perdagangan/', fn()=>view('admin.admin_perdagangan.adminperdagangan'));

// pasar
Route::get('/admin/admin_perdagangan/pasar/adminpasar', [PasarController::class, 'index'])->name('adminpasar');
Route::delete('/admin/admin_perdagangan/pasar/pasardelete/{id}', [PasarController::class,'destroy']);
Route::get('/admin/admin_perdagangan/pasar/pasarcreate', [PasarController::class,'create']);
Route::get('/admin/admin_perdagangan/pasar/pasaredit/{id}', [PasarController::class,'edit']);
Route::post('/admin/admin_perdagangan/pasar/pasarstore', [PasarController::class,'store']);
Route::post('/admin/admin_perdagangan/pasar/pasarupdate/{id}', [PasarController::class,'update']);

Route::get('/get-kelurahan/{id}', [PasarController::class, 'getKelurahan']);

// toko kelontong
Route::get('/admin/admin_perdagangan/tokokelontong/admintokokelontong', [TokokelontongController::class, 'index'])->name('admintokokelontong');
Route::delete('/admin/admin_perdagangan/tokokelontong/tokokelontongdelete/{id}', [TokokelontongController::class,'destroy']);
Route::get('/admin/admin_perdagangan/tokokelontong/tokokelontongcreate', [TokokelontongController::class,'create']);
Route::get('/admin/admin_perdagangan/tokokelontong/tokokelontongedit/{id}', [TokokelontongController::class,'edit']);
Route::post('/admin/admin_perdagangan/tokokelontong/tokokelontongstore', [TokokelontongController::class,'store']);
Route::post('/admin/admin_perdagangan/tokokelontong/tokokelontongupdate/{id}', [TokokelontongController::class,'update']);

Route::get('/get-kelurahan/{id}', [TokokelontongController::class, 'getKelurahan']);


/*
|--------------------------------------------------------------------------
| ADMIN KOPERASI
|--------------------------------------------------------------------------
*/
Route::prefix('admin/koperasi')->group(function () {
    Route::get('/', [KoperasiController::class, 'index'])->name('koperasi.index');
    Route::get('/create', [KoperasiController::class, 'create'])->name('koperasi.create');
    Route::post('/store', [KoperasiController::class, 'store'])->name('koperasi.store');
    Route::get('/get-kelurahan/{id}', [KoperasiController::class, 'getKelurahan'])->name('koperasi.getKelurahan');
    Route::get('/edit/{id}', [KoperasiController::class, 'edit'])->name('koperasi.edit');
    Route::post('/update/{id}', [KoperasiController::class, 'update'])->name('koperasi.update');
    Route::get('/delete/{id}', [KoperasiController::class, 'destroy'])->name('koperasi.delete');
});

Route::get('/admin/admin_metro/', fn()=>view('admin.admin_metro.index'))->name('admin_metro.index');

Route::prefix('admin/admin_metro/alat')->group(function () {
    Route::get('/', [MetrologiAlatController::class, 'index']);
    Route::get('/create', [MetrologiAlatController::class, 'create']);
    Route::post('/store', [MetrologiAlatController::class, 'store']);
    Route::get('/edit/{id}', [MetrologiAlatController::class, 'edit']);
    Route::post('/update/{id}', [MetrologiAlatController::class, 'update']);
    Route::delete('/delete/{id}', [MetrologiAlatController::class, 'destroy']);
});

Route::prefix('admin/admin_metro/reparasi')->group(function () {
        Route::get('/', [MetrologiReparasiController::class, 'index']);
        Route::get('/create', [MetrologiReparasiController::class, 'create']);
        Route::post('/store', [MetrologiReparasiController::class, 'store']);
        Route::get('/edit/{id}', [MetrologiReparasiController::class, 'edit']);
        Route::post('/update/{id}', [MetrologiReparasiController::class, 'update']);
        Route::delete('/delete/{id}', [MetrologiReparasiController::class, 'destroy']);
    });

// frontend metro
// Route untuk melempar data JSON ke Frontend Metrologi
Route::get('/metrologi-data', [FrontendMetrologiController::class, 'getData']);