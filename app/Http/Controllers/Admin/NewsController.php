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
            'links'        => ['nullable', 'json'],
            'tags'         => ['nullable', 'string'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        // Generate slug with uniqueness check
        $baseSlug = Str::slug($data['title']);
        $slug = $baseSlug;
        $counter = 1;
        
        while (News::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        // Handle links
        if ($request->has('links') && !empty($request->input('links'))) {
            $data['links'] = $request->input('links');
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
            'links'        => ['nullable', 'json'],
            'tags'         => ['nullable', 'string'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        // Only update slug if title changed
        if ($news->title !== $data['title']) {
            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;
            
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $data['slug'] = $slug;
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image) {
                \Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        // Handle links
        if ($request->has('links') && !empty($request->input('links'))) {
            $data['links'] = $request->input('links');
        }

        if ($data['is_published'] && !$news->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(News $news)
    {
        // Delete image if exists
        if ($news->image) {
            \Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Article deleted.');
    }
}