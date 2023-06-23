<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/phrase', [App\Http\Controllers\EspectacularController::class, "phrase"]);
    Route::get('/getPhrases', [App\Http\Controllers\EspectacularController::class, "getAllPhrases"]);
    Route::get('/getPhraseById/{id}', [App\Http\Controllers\EspectacularController::class, "getPhraseById"]);
    Route::delete('/deletePhrase/{id}', [App\Http\Controllers\EspectacularController::class,"deletePhrase"]);
    Route::post("/create/images", [App\Http\Controllers\EspectacularController::class,"createImage"]);
    Route::put("/editPhrase/{id}" ,[App\Http\Controllers\EspectacularController::class,"editPhrase"]);
    Route::post("/logout", [App\Http\Controllers\AuthController::class, "logout"]);
});

Route::get("/images/{size}", [App\Http\Controllers\EspectacularController::class,"imagesSize"]);
Route::post("/login", [App\Http\Controllers\AuthController::class, "login"]);