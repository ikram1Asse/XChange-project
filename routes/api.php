<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\StatController;


Route::middleware('auth:sanctum')->group(function () {
Route::get('/me', [AuthController::class, 'me']);
Route::apiResource('categories', CategorieController::class)->only(['index', 'store']);
Route::apiResource('films', FilmController::class)->only(['index', 'store']);
Route::apiResource('clients', ClientController::class)->only(['index', 'store']);
Route::apiResource('abonnements', AbonnementController::class)->only(['index', 'store']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/films/films' , [StatController::class , 'showAllFilms']);
Route::get('/films/films/{id}' , [StatController::class , 'showOneFilms']);
Route::get('/films/filter/{word}' , [StatController::class , 'filtreFilm']);
Route::get('/films/cat' , [StatController::class , 'filmCat']);
Route::get('/films/cat2' , [StatController::class , 'filmCat2']);
Route::get('/films/price/{p1}/{p2}' , [StatController::class , 'getFilmbyPirce']);
Route::get('/clients/nophone' , [StatController::class , 'getClientAbsTel']);
Route::get('/films/date/{y}' , [StatController::class ,'getFilmsbyyear']);
Route::get('/films/liste' , [StatController::class ,'listfilm']);
Route::get('/films/abonnements' , [StatController::class ,'ListAbonnementParClient']);
Route::get('/films/stat1/{c}' , [StatController::class ,'NbrAbonnementParClient']);
Route::post('/films/total' ,[StatController::class ,'TotalAbonnementParClient']);
Route::post('/abonnements/by/{nbr}' , [StatController::class ,'ClientsparNbrAbonnements']);




