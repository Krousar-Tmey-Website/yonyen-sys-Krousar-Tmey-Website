<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\ResourcePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $articles = News::latest()->latest('id')->paginate(12);
        return view('admin.news.index', compact('articles'));
    }

    public function create()
    {
        $presetTags = $this->presetTagsFromResourcePages();
        return view('admin.news.create', compact('presetTags'));
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'excerpt'      => ['nullable', 'string'],
            'content'      => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'image'        => ['nullable', 'image', 'max:2048'],
            'gallery'      => ['nullable', 'array'],
            'gallery.*'    => ['image', 'max:2048'],
            'videos'       => ['nullable', 'array'],
            'videos.*'     => ['file', 'mimes:mp4,mov,webm', 'max:35000'],
            'video_url'    => ['nullable', 'url', 'max:500'],
            'links'        => ['nullable', 'json'],
            'tag_links'    => ['nullable', 'json'],
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

        if ($request->hasFile('gallery')) {
            $data['gallery'] = array_map(
                fn ($file) => $file->store('news/gallery', 'public'),
                $request->file('gallery')
            );
        }

        $videos = [];
        if ($request->hasFile('videos')) {
            $videos = array_map(
                fn ($file) => $file->store('news/videos', 'public'),
                $request->file('videos')
            );
        }
        if (!empty($data['video_url'])) {
            $videos[] = $data['video_url'];
        }
        unset($data['video_url']);
        if (!empty($videos)) {
            $data['videos'] = $videos;
        }

        // Handle links
        if ($request->has('links') && !empty($request->input('links'))) {
            $data['links'] = $request->input('links');
        }

        // Handle tag links
        if ($request->has('tag_links') && !empty($request->input('tag_links'))) {
            $data['tag_links'] = $request->input('tag_links');
        }

        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Article created successfully.');
    }

    public function edit(News $news)
    {
        $presetTags = $this->presetTagsFromResourcePages();
        return view('admin.news.edit', compact('news', 'presetTags'));
    }

    /**
     * Build the "quick add" tag preset list directly from the Resource Pages
     * table, so a tag always points at the corresponding internal page and
     * automatically reflects any renames/additions made there.
     */
    private function presetTagsFromResourcePages(): array
    {
        return ResourcePage::active()->get(['title', 'slug'])->map(fn ($page) => [
            'label' => $page->title,
            'url'   => route('resource-pages.show', $page->slug, absolute: false),
        ])->all();
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'excerpt'        => ['nullable', 'string'],
            'content'        => ['nullable', 'string'],
            'is_published'   => ['nullable', 'boolean'],
            'image'          => ['nullable', 'image', 'max:2048'],
            'gallery'        => ['nullable', 'array'],
            'gallery.*'      => ['image', 'max:2048'],
            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['string'],
            'videos'         => ['nullable', 'array'],
            'videos.*'       => ['file', 'mimes:mp4,mov,webm', 'max:35000'],
            'video_url'      => ['nullable', 'url', 'max:500'],
            'remove_videos'  => ['nullable', 'array'],
            'remove_videos.*' => ['string'],
            'links'          => ['nullable', 'json'],
            'tag_links'      => ['nullable', 'json'],
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
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        // Gallery: start from existing, drop anything marked for removal, append new uploads
        $gallery = $news->gallery;
        $toRemove = $request->input('remove_gallery', []);
        if (!empty($toRemove)) {
            foreach ($toRemove as $path) {
                Storage::disk('public')->delete($path);
            }
            $gallery = array_values(array_diff($gallery, $toRemove));
        }
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('news/gallery', 'public');
            }
        }
        $data['gallery'] = $gallery;
        unset($data['remove_gallery']);

        // Videos: start from existing, drop anything marked for removal, append new uploads
        $videos = $news->videos;
        $toRemoveVideos = $request->input('remove_videos', []);
        if (!empty($toRemoveVideos)) {
            foreach ($toRemoveVideos as $path) {
                Storage::disk('public')->delete($path);
            }
            $videos = array_values(array_diff($videos, $toRemoveVideos));
        }
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $file) {
                $videos[] = $file->store('news/videos', 'public');
            }
        }
        if (!empty($data['video_url'])) {
            $videos[] = $data['video_url'];
        }
        $data['videos'] = $videos;
        unset($data['remove_videos'], $data['video_url']);

        // Handle links
        if ($request->has('links') && !empty($request->input('links'))) {
            $data['links'] = $request->input('links');
        }

        // Handle tag links
        if ($request->has('tag_links')) {
            $data['tag_links'] = $request->input('tag_links') ?: null;
        }

        if ($data['is_published'] && !$news->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(News $news)
    {
        // Delete image and gallery files if they exist
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        foreach ($news->gallery as $path) {
            Storage::disk('public')->delete($path);
        }
        foreach ($news->videos as $path) {
            Storage::disk('public')->delete($path);
        }

        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Article deleted.');
    }
}
