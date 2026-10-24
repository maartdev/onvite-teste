<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/projetos', function () {
    return view('projetos.index');
})->name('projetos');
