<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $articles = News::latest()->paginate(12);
        return view('admin.news.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'excerpt'      => ['nullable', 'string'],
            'content'      => ['nullable', 'string'],
            'category'     => ['required', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'image'        => ['nullable', 'image', 'max:2048'],
        ]);

        $data['slug']         = Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Article created successfully.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'excerpt'      => ['nullable', 'string'],
            'content'      => ['nullable', 'string'],
            'category'     => ['required', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'image'        => ['nullable', 'image', 'max:2048'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if ($data['is_published'] && !$news->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Article deleted.');
    }
}
