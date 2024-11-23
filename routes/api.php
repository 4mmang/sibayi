<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\RekomendasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('recipes', [RecipeController::class, 'index'])->middleware('auth:sanctum');
Route::get('articles', [ArticleController::class, 'index'])->middleware('auth:sanctum');
Route::post('rekomendasi', [RekomendasiController::class, 'index'])->middleware('auth:sanctum');

Route::post('registration', [RegistrationController::class, 'store']);

Route::post('validation', [LoginController::class, 'validation']);
Route::post('logout', function (Request $request) {
    try {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return response()->json(
            [
                'message' => 'Logout berhasil',
            ],
            200,
        );
    } catch (\Throwable $th) {
        return response()->json([
            'message' => 'Terjadi kesalahan',
        ]);
    }
})->middleware('auth:sanctum');

Route::get('login', function () {
    return response()->json(
        [
            'message' => 'Anda belum login',
        ],
        401,
    );
})->name('login');