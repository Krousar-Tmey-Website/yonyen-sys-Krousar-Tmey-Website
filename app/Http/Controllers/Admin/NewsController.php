<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\ResourcePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        return view('admin.news.index', compact('news', 'categories'))->with('articles', $news);
    }

    public function create()
    {
        $categories = Category::where('CategoryStatus', 1)->orderBy('CategoryName')->get();
        $presetTags = ResourcePage::active()
            ->select('title', 'slug')
            ->orderBy('title')
            ->get()
            ->map(function ($page) {
                return ['label' => $page->title, 'url' => $page->resolveUrl()];
            });

        return view('admin.news.create', compact('categories', 'presetTags'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title'       => 'required|max:255',
            'excerpt'     => 'nullable|max:500',
            'content'     => 'nullable',
            'category'    => 'nullable|max:100',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery'     => 'nullable|array',
            'gallery.*'   => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'videos'      => 'nullable|array',
            'videos.*'    => 'mimetypes:video/mp4,video/quicktime,video/webm|max:35840',
            'video_url'   => 'nullable|url|max:500',
            'is_published'=> 'nullable|boolean',
            'links'       => 'nullable|json',
            'tag_links'   => 'nullable|json',
        ];

        $validated = $request->validate($rules);

        $data = [
            'title'        => $request->title,
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'category'     => $request->category,
            'is_published' => $request->has('is_published'),
        ];

        // Handle featured image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        // Handle gallery images
        if ($request->hasFile('gallery')) {
            $data['gallery'] = array_map(
                fn ($file) => $file->store('news/gallery', 'public'),
                $request->file('gallery')
            );
        }

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

        News::create($data);

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
        $presetTags = ResourcePage::active()
            ->select('title', 'slug')
            ->orderBy('title')
            ->get()
            ->map(fn ($page) => ['label' => $page->title, 'url' => $page->resolveUrl()]);

        return view('admin.news.edit', compact('news', 'presetTags'));
    }

    public function update(Request $request, News $news)
    {
        $rules = [
            'title'               => 'required|max:255',
            'excerpt'             => 'nullable|max:500',
            'content'             => 'nullable',
            'category'            => 'nullable|max:100',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery'             => 'nullable|array',
            'gallery.*'           => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_gallery'      => 'nullable|array',
            'remove_gallery.*'    => 'string',
            'videos'              => 'nullable|array',
            'videos.*'            => 'mimetypes:video/mp4,video/quicktime,video/webm|max:35840',
            'remove_videos'       => 'nullable|array',
            'remove_videos.*'     => 'string',
            'video_url'           => 'nullable|url|max:500',
            'is_published'        => 'nullable|boolean',
            'links'               => 'nullable|json',
            'tag_links'           => 'nullable|json',
        ];

        $request->validate($rules);

        $data = [
            'title'        => $request->title,
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'category'     => $request->category,
            'is_published' => $request->has('is_published'),
        ];

        // Handle featured image
        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        // Handle gallery images
        $existingGallery = $news->gallery ?? [];
        $removingGallery = $request->input('remove_gallery', []);

        // Remove marked images from storage
        foreach ($removingGallery as $path) {
            Storage::disk('public')->delete($path);
        }

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

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Article updated successfully', 'redirect' => route('admin.news.index')]);
        }

        return redirect()->route('admin.news.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(News $news)
    {
        // Clean up files
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        if (!empty($news->gallery)) {
            foreach ($news->gallery as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        if (!empty($news->videos)) {
            foreach ($news->videos as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Article deleted successfully.');
    }

    /**
     * Upload a single image from the content editor's Insert > Image button
     * and return its public URL, so editors can pick a file from disk
     * instead of having to already know/paste a storage URL.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $path = $request->file('image')->store('news/content-images', 'public');

        return response()->json([
            'url' => Storage::url($path),
        ]);
    }

    public function presetTagsFromResourcePages()
    {
        $tags = ResourcePage::active()
            ->select('title', 'slug')
            ->orderBy('title')
            ->get()
            ->map(fn ($page) => ['label' => $page->title, 'url' => $page->resolveUrl()]);

        return response()->json($tags);
    }

    /**
     * Safely parse a JSON array input (e.g. links, tag_links).
     */
    private function jsonArrayInput(Request $request, string $key): array
    {
        if (!$request->filled($key)) {
            return [];
        }

        $decoded = json_decode($request->input($key), true);

        return is_array($decoded) ? $decoded : [];
    }
}
