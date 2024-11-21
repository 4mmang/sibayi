<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // get data recipes
    public function index()
    {
        $recipes = Recipe::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json([
            'resep' => $recipes
        ], 200);
    }
}
