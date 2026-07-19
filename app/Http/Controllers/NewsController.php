<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\ResourcePage;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $articles = News::published()->latest('published_at')->latest('id')->paginate(12);
        $krousarThmeyPage = ResourcePage::active()->where('slug', 'krousar-thmey')->first();

        return view('news', compact('articles', 'krousarThmeyPage'));
    }

    public function show($slug)
    {
        $article = News::where('slug', $slug)->published()->firstOrFail();
        $krousarThmeyPage = ResourcePage::active()->where('slug', 'krousar-thmey')->first();

        return view('news.show', compact('article', 'krousarThmeyPage'));
    }
}
