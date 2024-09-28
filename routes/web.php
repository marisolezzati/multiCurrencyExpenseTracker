<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/currency', [CurrencyController::class, 'index'])->name('currency.index');
Route::get('/currency/create', [CurrencyController::class, 'create'])->name('currency.create');
Route::post('/currency', [CurrencyController::class, 'show'])->name('currency.show');
Route::get('/currency/{id}', [CurrencyController::class, 'store'])->name('currency.store');
Route::get('/currency/{id}/edit', [CurrencyController::class, 'edit'])->name('currency.edit');