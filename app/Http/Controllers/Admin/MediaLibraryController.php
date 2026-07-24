<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaLibraryController extends Controller
{
    public function index()
    {
        $directories = [
            'media-gallery' => 'Media Gallery',
            'downloads' => 'Downloads',
            'gallery' => 'Gallery',
            'awards' => 'Awards',
            'books' => 'Books',
            'logos' => 'Logos',
            'partners' => 'Partners',
            'slides' => 'Slides',
            'social' => 'Social Icons',
        ];

        $files = [];
        foreach ($directories as $dir => $label) {
            $path = $dir;
            if (Storage::disk('public')->exists($path)) {
                $dirFiles = Storage::disk('public')->allFiles($path);
                foreach ($dirFiles as $file) {
                    $files[] = [
                        'name' => basename($file),
                        'path' => $file,
                        'url' => asset('storage/' . $file),
                        'size' => Storage::disk('public')->size($file),
                        'type' => File::mimeType(Storage::disk('public')->path($file)) ?? 'unknown',
                        'directory' => $label,
                    ];
                }
            }
        }

        return view('admin.media-library.index', compact('files', 'directories'));
    }
}