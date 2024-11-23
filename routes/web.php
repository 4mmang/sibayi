<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    echo "Terimaksih";
});

Route::get('recipe/create', [RecipeController::class, 'create']);
Route::get('/get-recipe/{id}', [RecipeController::class, 'edit']);
Route::post('/upload-recipe', [RecipeController::class, 'store'])->name('upload-recipe');
Route::put('/recipe/edit/{id}', [RecipeController::class, 'update']);
Route::delete('/recipe/delete/{id}', [RecipeController::class, 'destroy']);

Route::get('article/create', [ArticleController::class, 'create']);
Route::get('/get-article/{id}', [ArticleController::class, 'edit']);
Route::post('/upload-article', [ArticleController::class, 'store'])->name('upload-article');
Route::put('/article/edit/{id}', [ArticleController::class, 'update']);
Route::delete('/article/delete/{id}', [ArticleController::class, 'destroy']);
