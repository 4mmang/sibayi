<?php

namespace App\Http\Controllers;

use App\Models\Article;
use DOMDocument;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create() {
        return view('article');
    }

    public function store(Request $request){
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
}
