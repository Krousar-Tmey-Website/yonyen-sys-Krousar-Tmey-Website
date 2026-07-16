<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoreValueController extends Controller
{
    public function index()
    {
        $coreValues = CoreValue::ordered()->get();
        return view('admin.core_values.index', compact('coreValues'));
    }

    public function create()
    {
        return view('admin.core_values.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'                 => ['required', 'string', 'max:255'],
            'headline'              => ['nullable', 'string', 'max:255'],
            'icon'                  => ['nullable', 'string', 'max:10'],
            'description'           => ['nullable', 'string'],
            'supporting_description'  => ['nullable', 'string'],
            'image'                 => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'image_url'             => ['nullable', 'url', 'max:2048'],
            'sort_order'            => ['nullable', 'integer'],
        ]);

        $data['icon']       = $data['icon'] ?? '⭐';
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['image']      = $this->resolveImage($request, $data);
        unset($data['image_url']);

        CoreValue::create($data);

        return redirect()->route('admin.core-values.index')->with('success', 'Value added.');
    }

    public function update(Request $request, CoreValue $coreValue)
    {
        $data = $request->validate([
            'title'                 => ['required', 'string', 'max:255'],
            'headline'              => ['nullable', 'string', 'max:255'],
            'icon'                  => ['nullable', 'string', 'max:10'],
            'description'           => ['nullable', 'string'],
            'supporting_description'  => ['nullable', 'string'],
            'image'                 => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'image_url'             => ['nullable', 'url', 'max:2048'],
            'remove_image'          => ['nullable', 'boolean'],
            'sort_order'            => ['nullable', 'integer'],
        ]);

        $data['icon'] = $data['icon'] ?? '⭐';

        if ($request->boolean('remove_image')) {
            $this->deleteStoredImage($coreValue->image);
            $data['image'] = null;
        } else {
            $newImage = $this->resolveImage($request, $data);
            if ($newImage !== null) {
                $this->deleteStoredImage($coreValue->image);
                $data['image'] = $newImage;
            } else {
                unset($data['image']);
            }
        }
        unset($data['image_url'], $data['remove_image']);

        $coreValue->update($data);

        return redirect()->route('admin.core-values.index')->with('success', 'Value updated.');
    }

    public function destroy(CoreValue $coreValue)
    {
        $this->deleteStoredImage($coreValue->image);
        $coreValue->delete();
        return redirect()->route('admin.core-values.index')->with('success', 'Value removed.');
    }

    /**
     * Resolve the image value from an uploaded file or an image URL.
     * Returns null when neither was provided.
     */
    private function resolveImage(Request $request, array $data): ?string
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('core-values', 'public');
        }

        if (!empty($data['image_url'])) {
            return $data['image_url'];
        }

        return null;
    }

    /**
     * Delete a locally stored image file, ignoring external URLs.
     */
    private function deleteStoredImage(?string $path): void
    {
        if ($path && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
    }
}
