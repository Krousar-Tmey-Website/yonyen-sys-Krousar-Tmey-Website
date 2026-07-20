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
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('excerpt', 'like', "%{$s}%")
                  ->orWhere('content', 'like', "%{$s}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $sortField = $request->sort ?? 'created_at';
        $sortDir   = $request->direction ?? 'desc';
        $allowed   = ['title', 'created_at', 'is_published', 'category'];
        if (!in_array($sortField, $allowed)) {
            $sortField = 'created_at';
        }

        $news = $query->orderBy($sortField, $sortDir)->paginate(15);

        $categories = News::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.news.index', compact('news', 'categories'));
    }

    public function create()
    {
        $presetTags = $this->presetTagsFromResourcePages();
        return view('admin.news.create', compact('presetTags'));
    }

    /**
     * Upload a single image from the content editor's Insert > Image button
     * and return its public URL, so editors can pick a file from disk
     * instead of having to already know/paste a storage URL.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:5120'],
        ]);

        $path = $request->file('image')->store('news/gallery', 'public');

        // Root-relative path (not Storage::url()/asset()) so this matches the
        // dev server's actual host:port regardless of the configured APP_URL.
        return response()->json(['url' => '/storage/' . $path]);
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'excerpt'           => ['nullable', 'string'],
            'content'           => ['nullable', 'string'],
            'is_published'      => ['nullable', 'boolean'],
            'image'             => ['nullable', 'image', 'max:2048'],
            'videos'            => ['nullable', 'array'],
            'videos.*'          => ['file', 'mimes:mp4,mov,webm', 'max:35000'],
            'video_url'         => ['nullable', 'url', 'max:500'],
            'links'             => ['nullable', 'json'],
            'tag_links'         => ['nullable', 'json'],
        ]);

        $validated = $request->validate($rules);

        // Generate slug with uniqueness check
        $baseSlug = Str::slug($data['title']);
        $slug = $baseSlug;
        $counter = 1;

        while (News::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        // Handle featured image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
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

        $data['links'] = $this->jsonArrayInput($request, 'links');
        $data['tag_links'] = $this->jsonArrayInput($request, 'tag_links');

        // Handle videos
        $videos = [];
        if ($request->hasFile('videos')) {
            $videos = array_map(
                fn ($file) => $file->store('news/videos', 'public'),
                $request->file('videos')
            );
        }
        if (!empty($request->video_url)) {
            $videos[] = $request->video_url;
        }
        if (!empty($videos)) {
            $data['videos'] = $videos;
        }

        // Handle links
        $data['links'] = $this->jsonArrayInput($request, 'links');
        $data['tag_links'] = $this->jsonArrayInput($request, 'tag_links');

        $news = News::create($data);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Article created successfully.',
                'news' => [
                    'id' => $news->id,
                    'title' => $news->title,
                    'edit_url' => route('admin.news.edit', $news),
                    'update_url' => route('admin.news.update', $news),
                    'index_url' => route('admin.news.index'),
                    'public_url' => route('news.show', $news->slug),
                ],
            ], 201);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Article created successfully', 'redirect' => route('admin.news.index')]);
        }

        return redirect()->route('admin.news.index')->with('success', 'Article created successfully.');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
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

    private function jsonArrayInput(Request $request, string $key): ?array
    {
        if (!$request->has($key) || $request->input($key) === '') {
            return null;
        }

        $value = $request->input($key);
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode((string) $value, true);

        return is_array($decoded) ? $decoded : null;
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'excerpt'           => ['nullable', 'string'],
            'content'           => ['nullable', 'string'],
            'is_published'      => ['nullable', 'boolean'],
            'image'             => ['nullable', 'image', 'max:2048'],
            'videos'            => ['nullable', 'array'],
            'videos.*'          => ['file', 'mimes:mp4,mov,webm', 'max:35000'],
            'video_url'         => ['nullable', 'url', 'max:500'],
            'remove_videos'     => ['nullable', 'array'],
            'remove_videos.*'   => ['string'],
            'links'             => ['nullable', 'json'],
            'tag_links'         => ['nullable', 'json'],
        ]);

        $request->validate($rules);

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

        // Handle featured image
        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

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

        $data['links'] = $this->jsonArrayInput($request, 'links');
        $data['tag_links'] = $this->jsonArrayInput($request, 'tag_links');

        // Keep existing gallery items that are not being removed
        $gallery = array_values(array_filter($existingGallery, fn ($p) => !in_array($p, $removingGallery)));

        // Add new gallery uploads
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('news/gallery', 'public');
            }
        }

        $data['gallery'] = $gallery;

        // Handle videos
        $existingVideos = $news->videos ?? [];
        $removingVideos = $request->input('remove_videos', []);

        foreach ($removingVideos as $path) {
            Storage::disk('public')->delete($path);
        }

        $videos = array_values(array_filter($existingVideos, fn ($p) => !in_array($p, $removingVideos)));

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $file) {
                $videos[] = $file->store('news/videos', 'public');
            }
        }

        if (!empty($request->video_url)) {
            $videos[] = $request->video_url;
        }

        $data['videos'] = $videos;

        // Handle links
        $data['links'] = $this->jsonArrayInput($request, 'links');
        $data['tag_links'] = $this->jsonArrayInput($request, 'tag_links');

        $news->update($data);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Article updated successfully.',
                'news' => [
                    'id' => $news->id,
                    'title' => $news->title,
                    'edit_url' => route('admin.news.edit', $news),
                    'update_url' => route('admin.news.update', $news),
                    'index_url' => route('admin.news.index'),
                    'public_url' => route('news.show', $news->slug),
                ],
            ]);
        }

        return redirect()->route('admin.news.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(News $news)
    {
        // Delete image and video files if they exist
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        foreach ($news->videos as $path) {
            Storage::disk('public')->delete($path);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Article deleted successfully.');
    }
}
