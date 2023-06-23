<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', [App\Http\Controllers\EspectacularController::class, "token"])->name("token");
Route::post("/login", [App\Http\Controllers\AuthController::class, "login"]);

Route::post('/phrase', [App\Http\Controllers\EspectacularController::class, "phrase"]);
Route::get('/getPhrases', [App\Http\Controllers\EspectacularController::class, "getAllPhrases"]);
Route::get('/getPhraseById/{id}', [App\Http\Controllers\EspectacularController::class, "getPhraseById"]);
Route::delete('/deletePhrase/{id}', [App\Http\Controllers\EspectacularController::class,"deletePhrase"]);
Route::post("/create/images", [App\Http\Controllers\EspectacularController::class,"createImage"]);
Route::get("/images/{size}", [App\Http\Controllers\EspectacularController::class,"imagesSize"]);

