<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaGalleryController extends Controller
{
    public function index()
    {
        $items = MediaGallery::ordered()->get();
        return view('admin.media.index', compact('items'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,video,document',
            'file' => 'nullable|file|max:10240',
            'external_url' => 'nullable|url|max:2048',
            'description' => 'nullable|string',
            'alt_text' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('media-gallery', 'public');
        }

        MediaGallery::create($data);

        return redirect()->route('admin.media.index')->with('success', 'Media item added!');
    }

    public function edit(MediaGallery $media)
    {
        $item = $media;
        return view('admin.media.edit', compact('item'));
    }

    public function update(Request $request, MediaGallery $media)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,video,document',
            'file' => 'nullable|file|max:10240',
            'external_url' => 'nullable|url|max:2048',
            'description' => 'nullable|string',
            'alt_text' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'remove_file' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        // Handle file removal checkbox
        if ($request->boolean('remove_file')) {
            if ($media->file_path && !str_starts_with($media->file_path, 'http')) {
                Storage::disk('public')->delete($media->file_path);
            }
            $data['file_path'] = null;
        }

        if ($request->hasFile('file')) {
            if ($media->file_path && !str_starts_with($media->file_path, 'http')) {
                Storage::disk('public')->delete($media->file_path);
            }
            $data['file_path'] = $request->file('file')->store('media-gallery', 'public');
        }

        $media->update($data);

        return redirect()->route('admin.media.index')->with('success', 'Media item updated!');
    }

    public function destroy(MediaGallery $media)
    {
        if ($media->file_path && !str_starts_with($media->file_path, 'http')) {
            Storage::disk('public')->delete($media->file_path);
        }
        $media->delete();

        return redirect()->route('admin.media.index')->with('success', 'Media item deleted!');
    }
}