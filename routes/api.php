<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\AktorController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\FilmController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
//Route Kategori
Route::resource('kategori', KategoriController::class);
//Route Aktor
Route::resource('aktor', AktorController::class);
//Route genre
Route::resource('genre', GenreController::class);
//Route Film
Route::resource('film', FilmController::class);
});

//Route login dan logout
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
