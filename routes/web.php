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
Route::post('/login-process', [AuthController::class,'login']);
Route::get('/logout', [AuthController::class,'logout']);


/*
|--------------------------------------------------------------------------
| HALAMAN USER (PUBLIK / FRONTEND)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/mikro', [PumController::class, 'index']);
Route::get('/perdagangan', fn()=>view('bidang.perdagangan'));
Route::get('/koperasi', fn()=>view('bidang.koperasi'));
Route::get('/metrologi', fn()=>view('bidang.metrologi'));

// Data AJAX & Frontend
Route::get('/pembinaan', [PembinaanController::class,'view']);
Route::get('/pembinaan-data', [PembinaanController::class,'index']);
Route::get('/sekretariat', [SuratController::class,'sekretariat']);
Route::get('/umkm', [UmkmController::class, 'umkm']);
Route::get('/swk', [SwkController::class, 'swk']);
Route::get('/metrologi-data', [FrontendMetrologiController::class, 'getData']);


/*
|--------------------------------------------------------------------------
| AREA ADMIN (Dikelompokkan menggunakan Prefix '/admin')
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    // 0. DASHBOARD ADMIN
    Route::get('/', function () {
        if(!session('login') || session('role') !== 'admin'){
            return redirect('/');
        }
        return view('admin.index');
    });

    // 1. SEKRETARIAT
    Route::prefix('admin_sekre')->group(function () {
        Route::get('/', [SuratController::class,'index'])->name('surat.index');
        Route::get('/surat', [SuratController::class,'list'])->name('surat.list');
        Route::get('/create', [SuratController::class,'create'])->name('surat.create');
        Route::post('/store', [SuratController::class,'store'])->name('surat.store');
        Route::get('/edit/{id}', [SuratController::class,'edit'])->name('surat.edit');
        Route::post('/update/{id}', [SuratController::class,'update'])->name('surat.update');
        Route::get('/delete/{id}', [SuratController::class,'destroy'])->name('surat.destroy');
    });

    // 2. MAGANG
    Route::prefix('magang')->group(function () {
        Route::get('/', [MagangController::class,'index'])->name('magang.index');
        Route::get('/create', [MagangController::class,'create'])->name('magang.create');
        Route::post('/store', [MagangController::class,'store'])->name('magang.store');
        Route::get('/edit/{id}', [MagangController::class,'edit'])->name('magang.edit');
        Route::post('/update/{id}', [MagangController::class,'update'])->name('magang.update');
        Route::get('/delete/{id}', [MagangController::class,'destroy'])->name('magang.destroy');
    });

    // 3. PEGAWAI (REKAP)
    Route::prefix('pegawai')->group(function () {
        Route::get('/', [PegawaiController::class,'rekap'])->name('pegawai.rekap');
        Route::get('/create', [PegawaiController::class,'createRekap'])->name('pegawai.rekap.create');
        Route::post('/store', [PegawaiController::class,'storeRekap'])->name('pegawai.rekap.store');
        Route::get('/edit/{id}', [PegawaiController::class,'editRekap'])->name('pegawai.rekap.edit');
        Route::post('/update/{id}', [PegawaiController::class,'updateRekap'])->name('pegawai.rekap.update');
        Route::get('/delete/{id}', [PegawaiController::class,'deleteRekap'])->name('pegawai.rekap.delete');
    });

    // 4. PEMBINAAN (ADMIN PUP)
    Route::prefix('admin_pup')->group(function () {
        Route::get('/', fn() => view('admin.admin_pup.index'))->name('admin_pup.index');

        // TDG
        Route::get('/tdg', [TdgController::class,'index'])->name('tdg.index');
        Route::get('/tdg/create', [TdgController::class,'create'])->name('tdg.create');
        Route::post('/tdg/store', [TdgController::class,'store'])->name('tdg.store');
        Route::get('/tdg/edit/{id}', [TdgController::class,'edit'])->name('tdg.edit');
        Route::post('/tdg/update/{id}', [TdgController::class,'update'])->name('tdg.update');
        Route::get('/tdg/delete/{id}', [TdgController::class,'destroy'])->name('tdg.delete');

        // Pengawasan
        Route::get('/pengawasan', [PengawasanController::class,'index'])->name('pengawasan.index');
        Route::get('/pengawasan/create', [PengawasanController::class,'create'])->name('pengawasan.create');
        Route::post('/pengawasan/store', [PengawasanController::class,'store'])->name('pengawasan.store');
        Route::get('/pengawasan/edit/{id}', [PengawasanController::class,'edit'])->name('pengawasan.edit');
        Route::post('/pengawasan/update/{id}', [PengawasanController::class,'update'])->name('pengawasan.update');
        Route::get('/pengawasan/delete/{id}', [PengawasanController::class,'destroy'])->name('pengawasan.delete');

        // Alkohol
        Route::get('/alkohol', [AlkoholController::class,'index'])->name('alkohol.index');
        Route::get('/alkohol/create', [AlkoholController::class,'create'])->name('alkohol.create');
        Route::post('/alkohol/store', [AlkoholController::class,'store'])->name('alkohol.store');
        Route::get('/alkohol/edit/{id}', [AlkoholController::class,'edit'])->name('alkohol.edit');
        Route::post('/alkohol/update/{id}', [AlkoholController::class,'update'])->name('alkohol.update');
        Route::get('/alkohol/delete/{id}', [AlkoholController::class,'destroy'])->name('alkohol.delete');
    });

    // 5. PUM (UMKM & SWK)
    Route::prefix('admin_pum')->group(function () {
        Route::get('/', fn()=>view('admin.admin_pum.adminpum'))->name('admin_pum.adminpum');

        // UMKM
        Route::get('/adminumkm', [UmkmController::class, 'index'])->name('adminumkm');
        Route::get('/umkmcreate', [UmkmController::class,'create']);
        Route::post('/umkmstore', [UmkmController::class,'store']);
        Route::get('/umkmedit/{id}', [UmkmController::class,'edit']);
        Route::post('/umkmupdate/{id}', [UmkmController::class,'update']);
        Route::delete('/umkmdelete/{id}', [UmkmController::class,'destroy']);

        // SWK
        Route::get('/adminswk', [SwkController::class, 'index'])->name('adminswk');
        Route::get('/swkcreate', [SwkController::class,'create']);
        Route::post('/swkstore', [SwkController::class,'store']);
        Route::get('/swkedit/{id}', [SwkController::class,'edit']);
        Route::post('/swkupdate/{id}', [SwkController::class,'update']);
        Route::delete('/swkdelete/{id}', [SwkController::class,'destroy']);
    });

    // 6. PERDAGANGAN (PASAR & TOKO KELONTONG)
    Route::prefix('admin_perdagangan')->group(function () {
        Route::get('/', fn()=>view('admin.admin_perdagangan.adminperdagangan'));

        // Pasar
        Route::get('/pasar/adminpasar', [PasarController::class, 'index'])->name('adminpasar');
        Route::get('/pasar/pasarcreate', [PasarController::class,'create']);
        Route::post('/pasar/pasarstore', [PasarController::class,'store']);
        Route::get('/pasar/pasaredit/{id}', [PasarController::class,'edit']);
        Route::post('/pasar/pasarupdate/{id}', [PasarController::class,'update']);
        Route::delete('/pasar/pasardelete/{id}', [PasarController::class,'destroy']);

        // Toko Kelontong
        Route::get('/tokokelontong/admintokokelontong', [TokokelontongController::class, 'index'])->name('admintokokelontong');
        Route::get('/tokokelontong/tokokelontongcreate', [TokokelontongController::class,'create']);
        Route::post('/tokokelontong/tokokelontongstore', [TokokelontongController::class,'store']);
        Route::get('/tokokelontong/tokokelontongedit/{id}', [TokokelontongController::class,'edit']);
        Route::post('/tokokelontong/tokokelontongupdate/{id}', [TokokelontongController::class,'update']);
        Route::delete('/tokokelontong/tokokelontongdelete/{id}', [TokokelontongController::class,'destroy']);
    });

    // 7. KOPERASI
    Route::prefix('koperasi')->group(function () {
        Route::get('/', [KoperasiController::class, 'index'])->name('koperasi.index');
        Route::get('/create', [KoperasiController::class, 'create'])->name('koperasi.create');
        Route::post('/store', [KoperasiController::class, 'store'])->name('koperasi.store');
        Route::get('/edit/{id}', [KoperasiController::class, 'edit'])->name('koperasi.edit');
        Route::post('/update/{id}', [KoperasiController::class, 'update'])->name('koperasi.update');
        Route::get('/delete/{id}', [KoperasiController::class, 'destroy'])->name('koperasi.delete');
    });

    // 8. METROLOGI LEGAL
    Route::prefix('admin_metro')->group(function () {
        Route::get('/', fn()=>view('admin.admin_metro.index'))->name('admin_metro.index');

        // Alat Ukur
        Route::prefix('alat')->group(function () {
            Route::get('/', [MetrologiAlatController::class, 'index']);
            Route::get('/create', [MetrologiAlatController::class, 'create']);
            Route::post('/store', [MetrologiAlatController::class, 'store']);
            Route::get('/edit/{id}', [MetrologiAlatController::class, 'edit']);
            Route::post('/update/{id}', [MetrologiAlatController::class, 'update']);
            Route::delete('/delete/{id}', [MetrologiAlatController::class, 'destroy']);
        });

        // Tanda Daftar Reparasi
        Route::prefix('reparasi')->group(function () {
            Route::get('/', [MetrologiReparasiController::class, 'index']);
            Route::get('/create', [MetrologiReparasiController::class, 'create']);
            Route::post('/store', [MetrologiReparasiController::class, 'store']);
            Route::get('/edit/{id}', [MetrologiReparasiController::class, 'edit']);
            Route::post('/update/{id}', [MetrologiReparasiController::class, 'update']);
            Route::delete('/delete/{id}', [MetrologiReparasiController::class, 'destroy']);
        });
    });

});

/*
|--------------------------------------------------------------------------
| AJAX GLOBAL
|--------------------------------------------------------------------------
| Rute ini diletakkan di luar karena dipakai oleh banyak tabel.
| Di kode sebelumnya, Anda menulis rute ini 4 kali (untuk UMKM, Koperasi, Pasar, dll)
| Di Laravel, cukup ditulis 1 kali saja menggunakan 1 Controller sebagai pusat pengambil data.
*/
Route::get('/get-kelurahan/{id}', [UmkmController::class, 'getKelurahan']);