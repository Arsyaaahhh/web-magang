<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\MagangController;
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
use App\Http\Controllers\DatapengawasanController;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', fn()=>view('login'))->name('login');
Route::post('/login-process',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin', function () {
    if(!session('login') || session('role') !== 'admin'){
        return redirect('/');
    }
    return view('admin.index');
});

/*
|--------------------------------------------------------------------------
| USER (PUBLIK)
|--------------------------------------------------------------------------
*/
Route::get('/mikro', [PumController::class, 'index']);
Route::get('/perdagangan', fn()=>view('bidang.perdagangan'));
Route::get('/koperasi', [KoperasiController::class, 'userPage']);
Route::get('/metrologi', fn()=>view('bidang.metrologi'));

Route::get('/pembinaan', [PembinaanController::class,'view']);
Route::get('/pembinaan-data', [PembinaanController::class,'index']);

Route::get('/sekretariat', [SuratController::class,'sekretariat']);

Route::get('/umkm', [UmkmController::class, 'umkm']);
Route::get('/swk', [SwkController::class, 'swk']);

/*
|--------------------------------------------------------------------------
| ADMIN SEKRETARIAT
|--------------------------------------------------------------------------
*/
Route::prefix('admin/admin_sekre')->group(function () {
    Route::get('/', [SuratController::class,'index'])->name('surat.index');
    Route::get('/surat', [SuratController::class,'list'])->name('surat.list');
    Route::get('/create', [SuratController::class,'create'])->name('surat.create');
    Route::post('/store', [SuratController::class,'store'])->name('surat.store');
    Route::get('/edit/{id}', [SuratController::class,'edit'])->name('surat.edit');
    Route::post('/update/{id}', [SuratController::class,'update'])->name('surat.update');
    Route::get('/delete/{id}', [SuratController::class,'destroy'])->name('surat.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN MAGANG
|--------------------------------------------------------------------------
*/
Route::prefix('admin/magang')->group(function () {
    Route::get('/', [MagangController::class,'index'])->name('magang.index');
    Route::get('/create', [MagangController::class,'create'])->name('magang.create');
    Route::post('/store', [MagangController::class,'store'])->name('magang.store');
    Route::get('/edit/{id}', [MagangController::class,'edit'])->name('magang.edit');
    Route::post('/update/{id}', [MagangController::class,'update'])->name('magang.update');
    Route::get('/delete/{id}', [MagangController::class,'destroy'])->name('magang.delete');
});

/*
|--------------------------------------------------------------------------
| ADMIN DATAPENGAWASAN (PEGAWAI)
|--------------------------------------------------------------------------
*/
Route::prefix('admin/pegawai')->group(function () {
    Route::get('/', [DatapengawasanController::class, 'index'])->name('pegawai.index');
    Route::get('/create', [DatapengawasanController::class, 'create'])->name('pegawai.create');
    Route::post('/store', [DatapengawasanController::class, 'store'])->name('pegawai.store');
    Route::get('/edit/{id}', [DatapengawasanController::class, 'edit'])->name('pegawai.edit');
    Route::post('/update/{id}', [DatapengawasanController::class, 'update'])->name('pegawai.update');
    Route::get('/delete/{id}', [DatapengawasanController::class, 'destroy'])->name('pegawai.delete');
});

/*
|--------------------------------------------------------------------------
| ADMIN PUP
|--------------------------------------------------------------------------
*/
Route::prefix('admin/admin_pup')->group(function () {

    Route::get('/', fn()=>view('admin.admin_pup.index'))->name('admin_pup.index');

    Route::resource('tdg', TdgController::class);
    Route::resource('pengawasan', PengawasanController::class);
    Route::resource('alkohol', AlkoholController::class);
});

/*
|--------------------------------------------------------------------------
| ADMIN PUM (UMKM & SWK)
|--------------------------------------------------------------------------
*/
Route::prefix('admin/admin_pum')->group(function () {

    Route::get('/', fn()=>view('admin.admin_pum.adminpum'))->name('admin_pum');

    Route::resource('umkm', UmkmController::class);
    Route::resource('swk', SwkController::class);
});

/*
|--------------------------------------------------------------------------
| ADMIN PERDAGANGAN
|--------------------------------------------------------------------------
*/
Route::prefix('admin/admin_perdagangan')->group(function () {

    Route::get('/', fn()=>view('admin.admin_perdagangan.adminperdagangan'));

    Route::resource('pasar', PasarController::class);
    Route::resource('tokokelontong', TokokelontongController::class);
});

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