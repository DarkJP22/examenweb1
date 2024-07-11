<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApuestaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/apuestas', [ApuestaController::class, 'index'])->name('apuestas.index');
Route::get('/apuestas/create', [ApuestaController::class, 'create'])->name('apuestas.create');
Route::post('/apuestas', [ApuestaController::class, 'store'])->name('apuestas.store');
Route::get('/apuestas/filter/players', [ApuestaController::class, 'filterByPlayers'])->name('apuestas.filterByPlayers');
Route::get('/apuestas/checkMoney', [ApuestaController::class, 'checkMoney'])->name('apuestas.checkMoney');
Route::get('/apuestas/filter/game/{id_juego}', [ApuestaController::class, 'filterByGame'])->name('apuestas.filterByGame');


