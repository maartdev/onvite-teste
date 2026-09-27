<?php

use App\Http\Controllers\SugestaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/sugestoes', [SugestaoController::class, 'criar']);

Route::get('/sugestoes/ranking', [SugestaoController::class, 'ranking']);

Route::get('/sugestoes/{status}', [SugestaoController::class, 'listarSugestoes']);

Route::patch('/sugestoes/{id}/aprovar', [SugestaoController::class, 'aprovar']);
Route::patch('/sugestoes/{id}/negar', [SugestaoController::class, 'negar']);

Route::post('/sugestoes/{id}/curtir', [SugestaoController::class, 'curtida']);

Route::post('/sugestoes/{id}/depositar', [SugestaoController::class, 'depositar']);