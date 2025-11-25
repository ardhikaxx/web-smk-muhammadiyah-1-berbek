<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('landing-page');

Route::get('/profil-sekolah', function () {
    return view('profil');
})->name('profil');