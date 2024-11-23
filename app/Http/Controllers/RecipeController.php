<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function create()
    {
        $recipes = Recipe::all();
        return view('recipe', compact('recipes'));
    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return response()->json([
            'data' => $recipe,
        ]);
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        if ($request->file('gambar')) {
            Storage::delete('public/' . $recipe->gambar);
            $gambar = $request->file('gambar')->store('gambar', 'public');
            $recipe->gambar = $gambar;
        }

        $recipe->nama_resep = $request->nama_resep;
        $recipe->energi = $request->energi;
        $recipe->lemak = $request->lemak;
        $recipe->lemak = $request->lemak;
        $recipe->deskripsi = $request->deskripsi;
        $recipe->save();

        return back();
    }

    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        Storage::delete('public/' . $recipe->gambar);
        $recipe->delete();
        return back();
    }

    public function store(Request $request)
    {
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
