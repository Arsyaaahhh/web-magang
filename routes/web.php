<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TdgController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembinaanController;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', fn()=>view('login'));
Route::post('/login-process',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);


/*
|--------------------------------------------------------------------------
| DASHBOARD USER
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index']);


/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin', function () {
    if(!session('login') || session('role') !== 'admin'){
        return redirect('/');
    }
    return view('admin.index');
});


/*
|--------------------------------------------------------------------------
| BIDANG USER
|--------------------------------------------------------------------------
*/
Route::get('/mikro', fn()=>view('bidang.mikro'));
Route::get('/perdagangan', fn()=>view('bidang.perdagangan'));
Route::get('/koperasi', fn()=>view('bidang.koperasi'));
Route::get('/metrologi', fn()=>view('bidang.metrologi'));

/*
|--------------------------------------------------------------------------
| PEMBINAAN (🔥 FIX UTAMA)
|--------------------------------------------------------------------------
*/
Route::get('/pembinaan', [PembinaanController::class,'view']); // halaman HTML
Route::get('/pembinaan-data', [PembinaanController::class,'index']); // data JSON


/*
|--------------------------------------------------------------------------
| SEKRETARIAT USER
|--------------------------------------------------------------------------
*/
Route::get('/sekretariat', [SuratController::class,'sekretariat']);


/*
|--------------------------------------------------------------------------
| ADMIN SEKRETARIAT (SURAT)
|--------------------------------------------------------------------------
*/
Route::get('/admin/admin_sekre', [SuratController::class,'index'])->name('surat.index');

Route::get('/admin/admin_sekre/create', [SuratController::class,'create'])->name('surat.create');
Route::post('/admin/admin_sekre/store', [SuratController::class,'store'])->name('surat.store');

Route::get('/admin/admin_sekre/edit/{id}', [SuratController::class,'edit'])->name('surat.edit');
Route::post('/admin/admin_sekre/update/{id}', [SuratController::class,'update'])->name('surat.update');

Route::get('/admin/admin_sekre/surat', [SuratController::class,'list'])->name('surat.list');

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
| ADMIN PEGAWAI
|--------------------------------------------------------------------------
*/
Route::get('/admin/pegawai', [PegawaiController::class,'index'])->name('pegawai.index');

Route::get('/admin/pegawai/create', [PegawaiController::class,'create'])->name('pegawai.create');
Route::post('/admin/pegawai/store', [PegawaiController::class,'store'])->name('pegawai.store');

Route::get('/admin/pegawai/edit/{id}', [PegawaiController::class,'edit'])->name('pegawai.edit');
Route::post('/admin/pegawai/update/{id}', [PegawaiController::class,'update'])->name('pegawai.update');

Route::get('/admin/pegawai/delete/{id}', [PegawaiController::class,'destroy'])->name('pegawai.delete');


/*
|--------------------------------------------------------------------------
| TDG (PEMBINAAN)
|--------------------------------------------------------------------------
*/
Route::get('/tdg', [TdgController::class,'index'])->name('tdg.index');

Route::get('/tdg/create', [TdgController::class,'create'])->name('tdg.create');
Route::post('/tdg/store', [TdgController::class,'store'])->name('tdg.store');

Route::get('/tdg/edit/{id}', [TdgController::class,'edit'])->name('tdg.edit');
Route::post('/tdg/update/{id}', [TdgController::class,'update'])->name('tdg.update');

Route::get('/tdg/delete/{id}', [TdgController::class,'destroy'])->name('tdg.delete');