<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index()
    {
        $mediaItems = MediaItem::ordered()->paginate(12);
        return view('admin.media.index', compact('mediaItems'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'source'        => ['nullable', 'string', 'max:255'],
            'external_link' => ['nullable', 'url', 'max:2048'],
            'image'         => ['nullable', 'image', 'max:2048'],
            'is_published'  => ['nullable', 'boolean'],
            'published_at'  => ['nullable', 'date'],
            'sort_order'    => ['nullable', 'integer'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order']   = $data['sort_order'] ?? 0;

        // Resolve image
        $data['image'] = $this->resolveImage($request);

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        MediaItem::create($data);

        return redirect()->route('admin.media.index')->with('success', 'Media item created successfully.');
    }

    public function edit(MediaItem $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, MediaItem $media)
    {
        $data = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'source'        => ['nullable', 'string', 'max:255'],
            'external_link' => ['nullable', 'url', 'max:2048'],
            'image'         => ['nullable', 'image', 'max:2048'],
            'remove_image'  => ['nullable', 'boolean'],
            'is_published'  => ['nullable', 'boolean'],
            'published_at'  => ['nullable', 'date'],
            'sort_order'    => ['nullable', 'integer'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order']   = $data['sort_order'] ?? 0;

        // Handle image
        if ($request->boolean('remove_image')) {
            $this->deleteStoredImage($media->image);
            $data['image'] = null;
        } else {
            $newImage = $this->resolveImage($request);
            if ($newImage !== null) {
                $this->deleteStoredImage($media->image);
                $data['image'] = $newImage;
            } else {
                unset($data['image']);
            }
        }
        unset($data['remove_image']);

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // Update slug if title changed
        if ($media->title !== $data['title']) {
            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (MediaItem::where('slug', $slug)->where('id', '!=', $media->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $data['slug'] = $slug;
        }

        $media->update($data);

        return redirect()->route('admin.media.index')->with('success', 'Media item updated successfully.');
    }

    public function destroy(MediaItem $media)
    {
        $this->deleteStoredImage($media->image);
        $media->delete();

        return redirect()->route('admin.media.index')->with('success', 'Media item deleted.');
    }

    private function resolveImage(Request $request): ?string
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('media', 'public');
        }

        return null;
    }

    private function deleteStoredImage(?string $path): void
    {
        if ($path && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
    }
}
