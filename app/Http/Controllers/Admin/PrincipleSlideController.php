<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrincipleSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrincipleSlideController extends Controller
{
    public function index()
    {
        $slides = PrincipleSlide::orderBy('sort_order')->get();
        return view('admin.principle_slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.principle_slides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'image_url' => 'nullable|url|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['image'] = $this->resolveImage($request, $data);
        unset($data['image_url']);

        PrincipleSlide::create($data);

        return redirect()->route('admin.principle-slides.index')
            ->with('success', 'Principle slide created successfully.');
    }

    public function edit(PrincipleSlide $principleSlide)
    {
        return view('admin.principle_slides.edit', compact('principleSlide'));
    }

    public function update(Request $request, PrincipleSlide $principleSlide)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'image_url' => 'nullable|url|max:2048',
            'remove_image' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->boolean('remove_image')) {
            $this->deleteStoredImage($principleSlide->image);
            $data['image'] = null;
        } else {
            $newImage = $this->resolveImage($request, $data);
            if ($newImage !== null) {
                $this->deleteStoredImage($principleSlide->image);
                $data['image'] = $newImage;
            } else {
                unset($data['image']);
            }
        }
        unset($data['image_url'], $data['remove_image']);

        $principleSlide->update($data);

        return redirect()->route('admin.principle-slides.index')
            ->with('success', 'Principle slide updated successfully.');
    }

    public function destroy(PrincipleSlide $principleSlide)
    {
        $this->deleteStoredImage($principleSlide->image);
        $principleSlide->delete();

        return redirect()->route('admin.principle-slides.index')
            ->with('success', 'Principle slide deleted successfully.');
    }

    private function resolveImage(Request $request, array $data): ?string
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('principle-slides', 'public');
        }

        if (!empty($data['image_url'])) {
            return $data['image_url'];
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