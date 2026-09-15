<?php

use App\Http\Controllers\SugestaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/sugestoes', [SugestaoController::class, 'criar']);
Route::get('/sugestoes/pendentes', [SugestaoController::class, 'listarPendentes']);
Route::put('/sugestoes/{id}/aprovar', [SugestaoController::class, 'aprovar']);