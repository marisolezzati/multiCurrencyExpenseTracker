<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExpenseController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('currency', CurrencyController::class);
Route::resource('expense', ExpenseController::class);