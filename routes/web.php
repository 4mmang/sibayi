<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RecipeController::class, 'create']);
Route::post('/upload-recipe', [RecipeController::class, 'store'])->name('upload-recipe');

Route::get('article/create', [ArticleController::class, 'create']);
Route::post('/upload-article', [ArticleController::class, 'store'])->name('upload-article');
