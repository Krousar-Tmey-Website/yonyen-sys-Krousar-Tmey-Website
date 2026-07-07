<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $articles = News::published()->latest('published_at')->get();
        return view('news', compact('articles'));
    }

    public function show($slug)
    {
        $article = News::where('slug', $slug)->published()->firstOrFail();
        return view('news.show', compact('article'));
    }
}