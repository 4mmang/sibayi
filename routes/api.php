<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\RekomendasiController;
use Illuminate\Support\Facades\Route;

Route::get('recipes', [RecipeController::class, 'index']);
Route::get('articles', [ArticleController::class, 'index']);
Route::post('rekomendasi', [RekomendasiController::class, 'index']); 