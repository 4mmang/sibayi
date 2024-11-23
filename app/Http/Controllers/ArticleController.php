<?php

namespace App\Http\Controllers;

use App\Models\Article;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Termwind\Components\Raw;

class ArticleController extends Controller
{
    public function create()
    {
        $articles = Article::all();
        return view('article', compact('articles'));
    }

    public function store(Request $request)
    {
        $sampul = $request->file('sampul')->store('sampul', 'public');

        $deskripsi = $request->deskripsi;
        // $dom = new DOMDocument();
        // $dom->loadHTML($deskripsi, 9);

        // $images = $dom->getElementsByTagName('img');

        // foreach ($images as $key => $img) {
        //     $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
        //     $image_name = '/upload/' . time() . $key . '.png';
        //     file_put_contents(public_path() . $image_name, $data);

        //     $img->removeAttribute('src');
        //     $img->setAttribute('src', url($image_name));
        // }
        // $deskripsi = $dom->saveHTML();

        Article::create([
            'judul' => $request->judul,
            'sampul' => $sampul,
            'deskripsi' => $deskripsi,
        ]);

        return back();
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return response()->json([
            'data' => $article,
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        if ($request->file('sampul')) {
            Storage::delete('public/' . $article->sampul);
            $sampul = $request->file('sampul')->store('sampul', 'public');
            $article->sampul = $sampul;
        }
        $article->judul = $request->judul;
        $article->deskripsi = $request->deskripsi;
        $article->save();

        return back();
    }

    public function destroy($id){
        $article = Article::findOrFail($id);
        Storage::delete('public/' . $article->sampul);
        $article->delete();
        return back();
    }
}
