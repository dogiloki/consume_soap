<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoapCountriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Países
Route::get('/full_country_info',[SoapCountriesController::class,'getFullCountryInfo'])->name("country.full_country_info");
Route::get('/list_country_name',[SoapCountriesController::class,'getListCountryName'])->name("country.list_country_name");

// Idiomas
Route::get('/list_language_name',[SoapCountriesController::class,'getListLanguageName'])->name("language.full_language_info");