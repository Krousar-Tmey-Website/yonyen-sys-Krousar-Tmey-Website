<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a paginated, searchable, filterable list of media.
     */
    public function index(Request $request)
    {
        $search  = trim((string) $request->query('search', ''));
        $type    = $request->query('type', ''); // 'image', 'video', or ''
        $categoryId = $request->query('category_id', '');
        $dateFrom   = $request->query('date_from', '');
        $dateTo     = $request->query('date_to', '');
        $viewMode   = $request->query('view', 'grid'); // 'grid' or 'list'

        $query = Media::query()->with('categories');

        // Search by title or description
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter by media type
        if (in_array($type, ['image', 'video'])) {
            $query->where('file_type', $type);
        }

        // Filter by category (supports multi-category items)
        if ($categoryId !== '') {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.CategoryID', $categoryId);
            });
        }

        // Filter by date range
        if ($dateFrom !== '') {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo !== '') {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $items = $query->latest()->paginate(12)->withQueryString();

        $categories = Category::orderBy('CategoryName')->get();

        $activeFilters = (filled($search) ? 1 : 0)
                       + (filled($type) ? 1 : 0)
                       + (filled($categoryId) ? 1 : 0)
                       + (filled($dateFrom) ? 1 : 0)
                       + (filled($dateTo) ? 1 : 0);

        $viewData = compact(
            'items', 'categories', 'search', 'type', 'categoryId',
            'dateFrom', 'dateTo', 'viewMode', 'activeFilters'
        );

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html'  => view('admin.media._results', $viewData)->render(),
                'total' => $items->total(),
                'activeFilters' => $activeFilters,
            ]);
        }

        return view('admin.media.index', $viewData);
    }

    /**
     * Show the form for creating new media.
     */
    public function create()
    {
        $categories = Category::orderBy('CategoryName')->get();
        return view('admin.media.create', compact('categories'));
    }

    /**
     * Store newly uploaded media.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string|max:2000',
            'file'         => 'required|file|max:102400', // 100MB max
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,CategoryID',
            'is_active'    => 'nullable|boolean',
            'thumbnail'    => 'nullable|image|max:4096', // manually uploaded thumbnail
        ]);

        // Validate file type
        $file = $request->file('file');
        $mimeType = $file->getMimeType();
        $extension = strtolower($file->getClientOriginalExtension());

        $allowedImages = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
        $allowedVideos = ['mp4', 'mov', 'avi', 'webm', 'ogg'];

        if (in_array($extension, $allowedImages)) {
            $fileType = 'image';
            $allowedMimePrefix = 'image/';
        } elseif (in_array($extension, $allowedVideos)) {
            $fileType = 'video';
            $allowedMimePrefix = 'video/';
        } else {
            return back()->withErrors(['file' => 'Invalid file type. Allowed: JPG, PNG, WebP, GIF, SVG (images) or MP4, MOV, AVI, WebM, OGG (videos).'])->withInput();
        }

        // Double-check mime type
        if (!str_starts_with($mimeType, $allowedMimePrefix)) {
            return back()->withErrors(['file' => "File appears to be a {$mimeType} which is not allowed for the {$fileType} type."])->withInput();
        }

        // Store the file
        $storagePath = $fileType === 'image' ? 'media/images' : 'media/videos';
        $filePath = $file->store($storagePath, 'public');

        $mediaData = [
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path'   => $filePath,
            'file_type'   => $fileType,
            'mime_type'   => $mimeType,
            'file_size'   => $file->getSize(),
            'is_active'   => $request->boolean('is_active'),
        ];

        // Handle thumbnail upload (for videos or custom thumbnail)
        if ($request->hasFile('thumbnail')) {
            $thumbPath = $request->file('thumbnail')->store('media/thumbnails', 'public');
            $mediaData['thumbnail_path'] = $thumbPath;
        } elseif ($fileType === 'image') {
            // For images, use the image itself as thumbnail
            $mediaData['thumbnail_path'] = $filePath;
        } elseif ($fileType === 'video') {
            // Attempt auto-generated thumbnail via FFmpeg (if available)
            $mediaData['thumbnail_path'] = $this->generateVideoThumbnail($filePath);
        }

        $media = Media::create($mediaData);

        // Attach categories
        if (!empty($data['category_ids'])) {
            $media->categories()->attach($data['category_ids']);
        }

        return redirect()->route('admin.media.index')
            ->with('success', 'Media uploaded successfully.');
    }

    /**
     * Show the form for editing media.
     */
    public function edit(Media $media)
    {
        $media->load('categories');
        $categories = Category::orderBy('CategoryName')->get();
        return view('admin.media.edit', compact('media', 'categories'));
    }

    /**
     * Update the specified media.
     */
    public function update(Request $request, Media $media)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string|max:2000',
            'file'         => 'nullable|file|max:102400',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,CategoryID',
            'is_active'    => 'nullable|boolean',
            'thumbnail'    => 'nullable|image|max:4096',
            'remove_thumbnail' => 'nullable|boolean',
        ]);

        $updateData = [
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'is_active'   => $request->boolean('is_active'),
        ];

        // Handle file replacement
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mimeType = $file->getMimeType();
            $extension = strtolower($file->getClientOriginalExtension());

            $allowedImages = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
            $allowedVideos = ['mp4', 'mov', 'avi', 'webm', 'ogg'];

            if (in_array($extension, $allowedImages)) {
                $fileType = 'image';
            } elseif (in_array($extension, $allowedVideos)) {
                $fileType = 'video';
            } else {
                return back()->withErrors(['file' => 'Invalid file type.'])->withInput();
            }

            // Delete old file
            if ($media->file_path && !str_starts_with($media->file_path, 'http')) {
                Storage::disk('public')->delete($media->file_path);
            }

            $storagePath = $fileType === 'image' ? 'media/images' : 'media/videos';
            $updateData['file_path'] = $file->store($storagePath, 'public');
            $updateData['file_type'] = $fileType;
            $updateData['mime_type'] = $mimeType;
            $updateData['file_size'] = $file->getSize();
        }

        // Handle thumbnail
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($media->thumbnail_path && !str_starts_with($media->thumbnail_path, 'http') && $media->thumbnail_path !== $media->file_path) {
                Storage::disk('public')->delete($media->thumbnail_path);
            }
            $updateData['thumbnail_path'] = $request->file('thumbnail')->store('media/thumbnails', 'public');
        } elseif ($request->boolean('remove_thumbnail')) {
            if ($media->thumbnail_path && !str_starts_with($media->thumbnail_path, 'http') && $media->thumbnail_path !== $media->file_path) {
                Storage::disk('public')->delete($media->thumbnail_path);
            }
            $updateData['thumbnail_path'] = null;
        } elseif ($request->hasFile('file') && isset($fileType) && $fileType === 'video') {
            // Auto-generate thumbnail for replaced video file
            $autoThumb = $this->generateVideoThumbnail($updateData['file_path']);
            if ($autoThumb) {
                $updateData['thumbnail_path'] = $autoThumb;
            }
        }

        $media->update($updateData);

        // Sync categories
        $categoryIds = $data['category_ids'] ?? [];
        $media->categories()->sync($categoryIds);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified media.
     */
    public function destroy(Media $media)
    {
        // Delete file
        if ($media->file_path && !str_starts_with($media->file_path, 'http')) {
            Storage::disk('public')->delete($media->file_path);
        }

        // Delete thumbnail (if separate from file)
        if ($media->thumbnail_path
            && $media->thumbnail_path !== $media->file_path
            && !str_starts_with($media->thumbnail_path, 'http')) {
            Storage::disk('public')->delete($media->thumbnail_path);
        }

        // Detach categories
        $media->categories()->detach();
        $media->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Media deleted successfully.');
    }

    /**
     * Bulk delete action.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:media,id',
        ]);

        $mediaItems = Media::whereIn('id', $request->ids)->get();

        foreach ($mediaItems as $media) {
            if ($media->file_path && !str_starts_with($media->file_path, 'http')) {
                Storage::disk('public')->delete($media->file_path);
            }
            if ($media->thumbnail_path
                && $media->thumbnail_path !== $media->file_path
                && !str_starts_with($media->thumbnail_path, 'http')) {
                Storage::disk('public')->delete($media->thumbnail_path);
            }
            $media->categories()->detach();
            $media->delete();
        }

        return redirect()->route('admin.media.index')
            ->with('success', count($request->ids) . ' media items deleted successfully.');
    }

    /**
     * Attempt to auto-generate a video thumbnail using FFmpeg.
     * Falls back gracefully if FFmpeg is not available.
     */
    private function generateVideoThumbnail(string $filePath): ?string
    {
        // Check if FFmpeg is available
        $ffmpegPath = exec('which ffmpeg 2>/dev/null || where ffmpeg 2>nul');
        if (!$ffmpegPath) {
            return null;
        }

        $videoFullPath = Storage::disk('public')->path($filePath);
        if (!file_exists($videoFullPath)) {
            return null;
        }

        $thumbFilename = pathinfo($filePath, PATHINFO_FILENAME) . '.jpg';
        $thumbPath = 'media/thumbnails/' . $thumbFilename;
        $thumbFullPath = Storage::disk('public')->path($thumbPath);

        // Ensure thumbnails directory exists
        $thumbDir = dirname($thumbFullPath);
        if (!is_dir($thumbDir)) {
            mkdir($thumbDir, 0755, true);
        }

        // Capture frame at 1 second
        $cmd = sprintf(
            '%s -i %s -ss 00:00:01 -vframes 1 -q:v 2 %s 2>&1',
            escapeshellcmd($ffmpegPath),
            escapeshellarg($videoFullPath),
            escapeshellarg($thumbFullPath)
        );

        exec($cmd, $output, $exitCode);

        if ($exitCode === 0 && file_exists($thumbFullPath)) {
            return $thumbPath;
        }

        return null;
    }
}
