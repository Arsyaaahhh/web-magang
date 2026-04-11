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