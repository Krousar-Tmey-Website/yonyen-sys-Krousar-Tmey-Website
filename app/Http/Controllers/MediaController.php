<?php

namespace App\Http\Controllers;

use App\Models\MediaItem;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        // Featured media item = first published, ordered
        $featured = MediaItem::published()->ordered()->first();

        // Latest media items (excluding featured)
        $mediaItems = MediaItem::published()
            ->when($featured, fn ($q) => $q->where('id', '!=', $featured->id))
            ->ordered()
            ->get();

        return view('media', compact('featured', 'mediaItems'));
    }

    public function show(MediaItem $media)
    {
        if (!$media->is_published) {
            abort(404);
        }

        return view('media.show', compact('media'));
    }
}
