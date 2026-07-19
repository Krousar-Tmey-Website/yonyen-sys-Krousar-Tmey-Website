<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourcePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResourcePageController extends Controller
{
    public function index()
    {
        $resourcePages = ResourcePage::orderBy('sort_order')->orderBy('title')->get();
        return view('admin.resource-pages.index', compact('resourcePages'));
    }

    public function create()
    {
        return view('admin.resource-pages.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        $data['slug'] = $this->uniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('resource-pages', 'public');
        }
        if ($request->hasFile('detail_image')) {
            $data['detail_image'] = $request->file('detail_image')->store('resource-pages', 'public');
        }

        $data['items'] = $this->buildItems($request, []);
        $data['is_active'] = $request->boolean('is_active', true);

        ResourcePage::create($data);

        return redirect()->route('admin.resource-pages.index')->with('success', 'Resource page created.');
    }

    public function edit(ResourcePage $resourcePage)
    {
        return view('admin.resource-pages.edit', ['page' => $resourcePage]);
    }

    public function update(Request $request, ResourcePage $resourcePage)
    {
        $data = $this->validateRequest($request);

        if ($resourcePage->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $resourcePage->id);
        }

        if ($request->hasFile('image')) {
            if ($resourcePage->image) {
                Storage::disk('public')->delete($resourcePage->image);
            }
            $data['image'] = $request->file('image')->store('resource-pages', 'public');
        }

        if ($request->hasFile('detail_image')) {
            if ($resourcePage->detail_image) {
                Storage::disk('public')->delete($resourcePage->detail_image);
            }
            $data['detail_image'] = $request->file('detail_image')->store('resource-pages', 'public');
        }

        $data['items'] = $this->buildItems($request, $resourcePage->items);
        $data['is_active'] = $request->boolean('is_active');

        $resourcePage->update($data);

        return redirect()->route('admin.resource-pages.index')->with('success', 'Resource page updated.');
    }

    public function destroy(ResourcePage $resourcePage)
    {
        if ($resourcePage->image) {
            Storage::disk('public')->delete($resourcePage->image);
        }
        if ($resourcePage->detail_image) {
            Storage::disk('public')->delete($resourcePage->detail_image);
        }
        foreach ($resourcePage->items as $item) {
            if (!empty($item['image'])) {
                Storage::disk('public')->delete($item['image']);
            }
        }

        $resourcePage->delete();

        return redirect()->route('admin.resource-pages.index')->with('success', 'Resource page deleted.');
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'title'              => ['required', 'string', 'max:255'],
            'description'        => ['nullable', 'string'],
            'image'              => ['nullable', 'image', 'max:2048'],
            'header_text'        => ['nullable', 'string', 'max:255'],
            'detail_image'       => ['nullable', 'image', 'max:2048'],
            'detail_description' => ['nullable', 'string'],
            'sort_order'         => ['nullable', 'integer'],
            'item_1_title'       => ['nullable', 'string', 'max:255'],
            'item_1_description' => ['nullable', 'string'],
            'item_1_image'       => ['nullable', 'image', 'max:2048'],
            'item_2_title'       => ['nullable', 'string', 'max:255'],
            'item_2_description' => ['nullable', 'string'],
            'item_2_image'       => ['nullable', 'image', 'max:2048'],
            'item_3_title'       => ['nullable', 'string', 'max:255'],
            'item_3_description' => ['nullable', 'string'],
            'item_3_image'       => ['nullable', 'image', 'max:2048'],
        ]);
    }

    /**
     * Build the 3-slot items array from the individual item_N_* form fields,
     * uploading any new images and falling back to each existing item's stored
     * image when no replacement file was submitted.
     */
    private function buildItems(Request $request, array $existingItems): array
    {
        $items = [];

        for ($i = 1; $i <= 3; $i++) {
            $title = $request->input("item_{$i}_title");
            $description = $request->input("item_{$i}_description");
            $existingImage = $existingItems[$i - 1]['image'] ?? null;

            $image = $existingImage;
            if ($request->hasFile("item_{$i}_image")) {
                if ($existingImage) {
                    Storage::disk('public')->delete($existingImage);
                }
                $image = $request->file("item_{$i}_image")->store('resource-pages/items', 'public');
            }

            if ($title || $description || $image) {
                $items[] = ['title' => $title, 'description' => $description, 'image' => $image];
            }
        }

        return $items;
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (
            ResourcePage::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
