<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    /**
     * Display a listing of all page sections.
     */
    public function index()
    {
        $sections = PageSection::with(['images', 'links'])
            ->orderBy('order')
            ->get();

        return view('admin.page-sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new section.
     */
    public function create()
    {
        return view('admin.page-sections.create');
    }

    /**
     * Store a newly created section with images and links.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'section_name' => ['required', 'string', 'max:100'],
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'order'        => ['nullable', 'integer', 'min:0'],
            'active'       => ['nullable', 'boolean'],

            // Image
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'image_alt'    => ['nullable', 'string', 'max:255'],

            // Links (dynamic JSON)
            'links'        => ['nullable', 'json'],
        ]);

        $data['active'] = $request->boolean('active');
        $data['order']  = $data['order'] ?? 0;

        $section = PageSection::create($data);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('page-sections', 'public');
            $section->images()->create([
                'path'  => $path,
                'alt'   => $data['image_alt'] ?? $section->title,
                'order' => 1,
            ]);
        }

        // Handle links
        $this->syncLinks($section, $request->input('links'));

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Page section created successfully.');
    }

    /**
     * Show the form for editing a section.
     */
    public function edit(PageSection $page_section)
    {
        $page_section->load(['images', 'links']);
        return view('admin.page-sections.edit', compact('page_section'));
    }

    /**
     * Update the section with new data, image, and links.
     */
    public function update(Request $request, PageSection $page_section)
    {
        $data = $request->validate([
            'section_name' => ['required', 'string', 'max:100'],
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'order'        => ['nullable', 'integer', 'min:0'],
            'active'       => ['nullable', 'boolean'],

            // Image
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'image_alt'    => ['nullable', 'string', 'max:255'],

            // Links (dynamic JSON)
            'links'        => ['nullable', 'json'],
        ]);

        $data['active'] = $request->boolean('active');
        $data['order']  = $data['order'] ?? 0;

        $page_section->update($data);

        // Handle image upload — replace existing
        if ($request->hasFile('image')) {
            // Delete old image
            $oldImage = $page_section->images()->first();
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage->path);
                $oldImage->delete();
            }

            $path = $request->file('image')->store('page-sections', 'public');
            $page_section->images()->create([
                'path'  => $path,
                'alt'   => $data['image_alt'] ?? $page_section->title,
                'order' => 1,
            ]);
        }

        // Update image alt text if exists
        if ($request->filled('image_alt')) {
            $existingImage = $page_section->images()->first();
            if ($existingImage) {
                $existingImage->update(['alt' => $data['image_alt']]);
            }
        }

        // Sync links
        $this->syncLinks($page_section, $request->input('links'));

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Page section updated successfully.');
    }

    /**
     * Delete the section along with its images and links.
     */
    public function destroy(PageSection $page_section)
    {
        // Delete associated images from storage
        foreach ($page_section->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        // Delete associated images and links (DB records)
        $page_section->images()->delete();
        $page_section->links()->delete();
        $page_section->delete();

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Page section deleted.');
    }

    /**
     * Parse links JSON and sync Link records for the section.
     */
    private function syncLinks(PageSection $section, ?string $linksJson): void
    {
        $section->links()->delete();

        if (empty($linksJson)) {
            return;
        }

        $decoded = json_decode($linksJson, true);
        if (! is_array($decoded)) {
            return;
        }

        $order = 1;
        foreach ($decoded as $linkData) {
            $text = trim((string) ($linkData['text'] ?? $linkData['title'] ?? ''));
            $url  = trim((string) ($linkData['url'] ?? ''));

            if (empty($text) || empty($url)) {
                continue;
            }

            $section->links()->create([
                'text'   => $text,
                'url'    => $url,
                'type'   => $linkData['type'] ?? 'button',
                'target' => $linkData['target'] ?? '_self',
                'order'  => $order,
                'active' => true,
            ]);

            $order++;
        }
    }
}
