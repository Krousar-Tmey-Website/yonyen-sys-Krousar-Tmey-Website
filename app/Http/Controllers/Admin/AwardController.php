<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::ordered()->get();
        return view('admin.awards.index', compact('awards'));
    }

    public function show(Award $award)
    {
        return view('admin.awards.show', compact('award'));
    }

    public function create()
    {
        return view('admin.awards.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'recipient'    => ['nullable', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'image_url'    => ['nullable', 'url', 'max:2048'],
            'sort_order'   => ['nullable', 'integer'],
            'link_url'     => ['nullable', 'url'],
            'link_text'    => ['nullable', 'string', 'max:255'],
            'link_type'    => ['nullable', 'in:website,article,video'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['image']      = $this->resolveImage($request, $data);
        unset($data['image_url']);

        Award::create($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award added.');
    }

    public function edit(Award $award)
    {
        return view('admin.awards.edit', compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'recipient'    => ['nullable', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'image_url'    => ['nullable', 'url', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
            'sort_order'   => ['nullable', 'integer'],
            'link_url'     => ['nullable', 'url'],
            'link_text'    => ['nullable', 'string', 'max:255'],
            'link_type'    => ['nullable', 'in:website,article,video'],
        ]);

        if ($request->boolean('remove_image')) {
            $this->deleteStoredImage($award->image);
            $data['image'] = null;
        } else {
            $newImage = $this->resolveImage($request, $data);
            if ($newImage !== null) {
                $this->deleteStoredImage($award->image);
                $data['image'] = $newImage;
            } else {
                unset($data['image']);
            }
        }
        unset($data['image_url'], $data['remove_image']);

        $award->update($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award updated.');
    }

    public function destroy(Award $award)
    {
        $this->deleteStoredImage($award->image);
        $award->delete();
        return redirect()->route('admin.awards.index')->with('success', 'Award removed.');
    }

    /**
     * Resolve the image value from an uploaded file or an image URL.
     * Returns null when neither was provided.
     */
    private function resolveImage(Request $request, array $data): ?string
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('awards', 'public');
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