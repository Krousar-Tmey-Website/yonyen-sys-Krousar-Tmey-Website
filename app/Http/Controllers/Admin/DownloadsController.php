<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadsController extends Controller
{
    public function index()
    {
        $items = MediaGallery::where('type', 'document')->ordered()->get();
        return view('admin.downloads.index', compact('items'));
    }

    public function create()
    {
        return view('admin.downloads.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|max:20480',
            'external_url' => 'nullable|url|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['type'] = 'document';
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('downloads', 'public');
        }

        MediaGallery::create($data);

        return redirect()->route('admin.downloads.index')->with('success', 'Download added!');
    }

    public function edit(MediaGallery $download)
    {
        $item = $download;
        return view('admin.downloads.edit', compact('item'));
    }

    public function update(Request $request, MediaGallery $download)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|max:20480',
            'external_url' => 'nullable|url|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            if ($download->file_path && !str_starts_with($download->file_path, 'http')) {
                Storage::disk('public')->delete($download->file_path);
            }
            $data['file_path'] = $request->file('file')->store('downloads', 'public');
        }

        $download->update($data);

        return redirect()->route('admin.downloads.index')->with('success', 'Download updated!');
    }

    public function destroy(MediaGallery $download)
    {
        if ($download->file_path && !str_starts_with($download->file_path, 'http')) {
            Storage::disk('public')->delete($download->file_path);
        }
        $download->delete();

        return redirect()->route('admin.downloads.index')->with('success', 'Download deleted!');
    }
}