<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function create(){
        return view('welcome');
    }

    public function store(Request $request){
        $gambar = $request->file('gambar')->store('gambar', 'public');
        Recipe::create([
            'nama_resep' => $request->nama_resep,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'energi' => $request->energi,
            'protein' => $request->protein,
            'lemak' => $request->lemak,
        ]);

        return back();
    }
}
