<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('login');
});

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
| BIDANG
|--------------------------------------------------------------------------
*/

Route::get('/mikro', function () {
    return view('bidang.mikro');
});

Route::get('/perdagangan', function () {
    return view('bidang.perdagangan');
});

Route::get('/koperasi', function () {
    return view('bidang.koperasi');
});

Route::get('/pembinaan', function () {
    return view('bidang.pembinaan');
});

Route::get('/metrologi', function () {
    return view('bidang.metrologi');
});


/*
|--------------------------------------------------------------------------
| SEKRETARIAT
|--------------------------------------------------------------------------
*/

Route::get('/sekretariat', [SuratController::class,'sekretariat']);


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin', [SuratController::class,'index']);
Route::get('/admin/create', [SuratController::class,'create']);
Route::post('/admin/store', [SuratController::class,'store']);
Route::get('/admin/edit/{id}', [SuratController::class,'edit']);
Route::post('/admin/update/{id}', [SuratController::class,'update']);
Route::get('/admin/delete/{id}', [SuratController::class,'destroy']);