<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\CountryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[CalculatorController::class,'index']);
Route::post('/calculator',[CalculatorController::class,'calculator'])->name("calculator");

// Países
Route::get('/country',[CountryController::class,'index'])->name("country.index");
Route::post('/country',[CountryController::class,'store'])->name("country.store");
