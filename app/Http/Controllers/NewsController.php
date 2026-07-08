<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('CategoryName')->get();
        
        $query = News::published()->latest('published_at');
        
        // Filter by category if provided - convert CategoryID to CategoryName if needed
        if ($request->filled('category')) {
            $category = Category::where('CategoryID', $request->category)->first();
            $categoryName = $category ? $category->CategoryName : $request->category;
            $query->where('category', $categoryName);
        }
        
        $articles = $query->get();
        
        return view('news', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = News::where('slug', $slug)->published()->firstOrFail();
        return view('news.show', compact('article'));
    }
}