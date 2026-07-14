<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PresentationSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresentationSlideController extends Controller
{
    public function index()
    {
        $slides = PresentationSlide::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.presentation_slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.presentation_slides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'subtitle'            => ['nullable', 'string'],
            'badge_text'          => ['nullable', 'string', 'max:80'],
            'image'               => ['nullable', 'image', 'max:4096'],
            'image_url'           => ['nullable', 'url'],
            'cta_primary_text'    => ['nullable', 'string', 'max:80'],
            'cta_primary_url'     => ['nullable', 'string', 'max:255'],
            'cta_secondary_text'  => ['nullable', 'string', 'max:80'],
            'cta_secondary_url'   => ['nullable', 'string', 'max:255'],
            'sort_order'          => ['nullable', 'integer'],
            'is_active'           => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('presentation-slides', 'public');
        } elseif (!empty($data['image_url'])) {
            $data['image'] = $data['image_url'];
        }
        unset($data['image_url']);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        PresentationSlide::create($data);

        return redirect()->route('admin.presentation-slides.index')->with('success', 'Slide added successfully.');
    }

    public function edit(PresentationSlide $slide)
    {
        return view('admin.presentation_slides.edit', compact('slide'));
    }

    public function update(Request $request, PresentationSlide $slide)
    {
        $data = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'subtitle'            => ['nullable', 'string'],
            'badge_text'          => ['nullable', 'string', 'max:80'],
            'image'               => ['nullable', 'image', 'max:4096'],
            'image_url'           => ['nullable', 'url'],
            'cta_primary_text'    => ['nullable', 'string', 'max:80'],
            'cta_primary_url'     => ['nullable', 'string', 'max:255'],
            'cta_secondary_text'  => ['nullable', 'string', 'max:80'],
            'cta_secondary_url'   => ['nullable', 'string', 'max:255'],
            'sort_order'          => ['nullable', 'integer'],
            'is_active'           => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('presentation-slides', 'public');
        } elseif (!empty($data['image_url'])) {
            $data['image'] = $data['image_url'];
        }
        unset($data['image_url']);

        $data['is_active'] = $request->boolean('is_active');

        $slide->update($data);

        return redirect()->route('admin.presentation-slides.index')->with('success', 'Slide updated.');
    }

    public function destroy(PresentationSlide $slide)
    {
        $this->deleteStoredImage($slide->image);
        $slide->delete();
        return redirect()->route('admin.presentation-slides.index')->with('success', 'Slide deleted.');
    }

    private function deleteStoredImage(?string $path): void
    {
        if ($path && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
    }
}