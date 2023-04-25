<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LanguageController;

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
Route::get('/country/{id}/delete',[CountryController::class,'destroy'])->name("country.delete");

// Idiomas
Route::get('/language',[LanguageController::class,'index'])->name("language.index");
Route::post('/language',[LanguageController::class,'store'])->name("language.store");
Route::get('/language/{id}/delete',[LanguageController::class,'destroy'])->name("language.delete");
