<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/sekretariat', function () {
    return view('bidang.sekretariat');
});

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