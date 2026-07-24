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
        $data = $this->validateData($request);

        $baseSlug = Str::slug($request->filled('slug') ? $request->input('slug') : $data['title']);
        $data['slug'] = $this->uniqueSlug($baseSlug);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('resource-pages', 'public');
        }
        if ($request->hasFile('detail_image')) {
            $data['detail_image'] = $request->file('detail_image')->store('resource-pages', 'public');
        }

        $data['items'] = $this->buildItems($request);

        ResourcePage::create($data);

        return redirect()->route('admin.resource-pages.index')
            ->with('success', 'Topic created successfully.');
    }

    public function edit(ResourcePage $resourcePage)
    {
        return view('admin.resource-pages.edit', ['resourcePage' => $resourcePage]);
    }

    public function update(Request $request, ResourcePage $resourcePage)
    {
        $data = $this->validateData($request, $resourcePage->id);

        if ($request->filled('slug') || $resourcePage->title !== $data['title']) {
            $baseSlug = Str::slug($request->filled('slug') ? $request->input('slug') : $data['title']);
            $data['slug'] = $this->uniqueSlug($baseSlug, $resourcePage->id);
        } else {
            unset($data['slug']);
        }

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            if ($resourcePage->image) {
                Storage::disk('public')->delete($resourcePage->image);
            }
            $data['image'] = $request->file('image')->store('resource-pages', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($resourcePage->image) {
                Storage::disk('public')->delete($resourcePage->image);
            }
            $data['image'] = null;
        } else {
            unset($data['image']);
        }

        if ($request->hasFile('detail_image')) {
            if ($resourcePage->detail_image) {
                Storage::disk('public')->delete($resourcePage->detail_image);
            }
            $data['detail_image'] = $request->file('detail_image')->store('resource-pages', 'public');
        } elseif ($request->boolean('remove_detail_image')) {
            if ($resourcePage->detail_image) {
                Storage::disk('public')->delete($resourcePage->detail_image);
            }
            $data['detail_image'] = null;
        } else {
            unset($data['detail_image']);
        }

        $data['items'] = $this->buildItems($request, $resourcePage);

        $resourcePage->update($data);

        return redirect()->route('admin.resource-pages.index')
            ->with('success', 'Topic updated successfully.');
    }

    public function destroy(ResourcePage $resourcePage)
    {
        if ($resourcePage->image) {
            Storage::disk('public')->delete($resourcePage->image);
        }
        if ($resourcePage->detail_image) {
            Storage::disk('public')->delete($resourcePage->detail_image);
        }
        foreach ($resourcePage->items ?? [] as $item) {
            if (!empty($item['image'])) {
                Storage::disk('public')->delete($item['image']);
            }
        }

        $resourcePage->delete();

        return redirect()->route('admin.resource-pages.index')
            ->with('success', 'Topic deleted.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'                 => ['required', 'string', 'max:255'],
            'title_fr'              => ['nullable', 'string', 'max:255'],
            'slug'                  => ['nullable', 'string', 'max:255'],
            'description'           => ['nullable', 'string', 'max:1000'],
            'description_fr'        => ['nullable', 'string', 'max:1000'],
            'header_text'           => ['nullable', 'string', 'max:255'],
            'header_text_fr'        => ['nullable', 'string', 'max:255'],
            'detail_description'    => ['nullable', 'string'],
            'detail_description_fr' => ['nullable', 'string'],
            'image'                 => ['nullable', 'image', 'max:2048'],
            'detail_image'          => ['nullable', 'image', 'max:4096'],
            'sort_order'            => ['nullable', 'integer'],
            'is_active'             => ['nullable', 'boolean'],
            'items'                 => ['nullable', 'array', 'max:3'],
            'items.*.title'         => ['nullable', 'string', 'max:255'],
            'items.*.title_fr'      => ['nullable', 'string', 'max:255'],
            'items.*.description'   => ['nullable', 'string', 'max:500'],
            'items.*.description_fr' => ['nullable', 'string', 'max:500'],
            'items.*.image'         => ['nullable', 'image', 'max:2048'],
        ]);
    }

    /**
     * Fixed 3 "feature item" slots (title, description, image). Keeps the
     * existing stored image for a slot unless a new file is uploaded or the
     * admin explicitly removes it — mirrors how the top-level image fields
     * behave so partially-filled items don't lose their picture on save.
     */
    private function buildItems(Request $request, ?ResourcePage $resourcePage = null): array
    {
        $existing = $resourcePage->items ?? [];
        $items = [];

        foreach (range(0, 2) as $i) {
            $title = trim((string) $request->input("items.$i.title"));
            $titleFr = trim((string) $request->input("items.$i.title_fr"));
            $description = trim((string) $request->input("items.$i.description"));
            $descriptionFr = trim((string) $request->input("items.$i.description_fr"));
            $imagePath = $existing[$i]['image'] ?? null;

            if ($request->hasFile("items.$i.image")) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $request->file("items.$i.image")->store('resource-pages/items', 'public');
            } elseif ($request->boolean("remove_item_image.$i")) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = null;
            }

            if ($title === '' && $description === '' && !$imagePath) {
                continue;
            }

            $items[] = [
                'title' => $title,
                'title_fr' => $titleFr,
                'description' => $description,
                'description_fr' => $descriptionFr,
                'image' => $imagePath,
            ];
        }

        return $items;
    }

    private function uniqueSlug(string $baseSlug, ?int $ignoreId = null): string
    {
        $slug = $baseSlug;
        $counter = 1;

        while (ResourcePage::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
