<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregaController;

Route::post('/pesquisar', [EntregaController::class, 'pesquisarPorCpf'])->name('entregas.pesquisar');
Route::get('/entregas/{id}', [EntregaController::class, 'mostrarDetalhes'])->name('entregas.detalhes');

Route::view('/pesquisa', 'entregas.pesquisa')->name('entregas.pesquisa');
