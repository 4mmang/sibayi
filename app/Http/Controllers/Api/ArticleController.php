<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json([
            'artikel' => $articles
        ]);
    }
}
