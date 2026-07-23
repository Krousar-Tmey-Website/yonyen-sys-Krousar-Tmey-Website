<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AwardController extends Controller
{
    /**
     * Display award list with optional search.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $awards = Award::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('organization', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        $totalAwards = $awards->count();

        $viewData = [
            'awards'      => $awards,
            'filters'     => ['search' => $search],
            'totalAwards' => $totalAwards,
        ];

        if ($request->ajax() || $request->wantsJson()) {
            $html = view('admin.awards._results', $viewData)->render();

            return response()->json([
                'html'  => $html,
                'total' => $totalAwards,
            ]);
        }

        return view('admin.awards.index', $viewData);
    }

    /**
     * Adding is handled via a modal on the index page.
     */
    public function create()
    {
        return redirect()->route('admin.awards.index');
    }

    /**
     * Editing is handled via a modal on the index page.
     */
    public function edit(Award $award)
    {
        return redirect()->route('admin.awards.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'          => ['nullable', 'string', 'max:255'],
            'title_fr'       => ['nullable', 'string', 'max:255'],
            'year'           => ['nullable', 'string', 'max:10'],
            'recipient'      => ['nullable', 'string', 'max:255'],
            'organization'   => ['nullable', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'image'          => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'image_url'      => ['nullable', 'url', 'max:2048'],
            'website_url'    => ['nullable', 'url', 'max:2048'],
            'article_url'    => ['nullable', 'url', 'max:2048'],
            'video_url'      => ['nullable', 'url', 'max:2048'],
            'sort_order'     => ['nullable', 'integer'],
        ]);

        $data['sort_order']  = $data['sort_order'] ?? 0;
        $data['is_active']   = true;
        $data['image']       = $this->resolveImage($request, $data, 'image');
        unset($data['image_url']);

        Award::create($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award added.');
    }

    public function update(Request $request, Award $award)
    {
        $data = $request->validate([
            'title'             => ['nullable', 'string', 'max:255'],
            'title_fr'          => ['nullable', 'string', 'max:255'],
            'year'              => ['nullable', 'string', 'max:10'],
            'recipient'         => ['nullable', 'string', 'max:255'],
            'organization'      => ['nullable', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
            'description_fr'    => ['nullable', 'string'],
            'image'             => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'image_url'         => ['nullable', 'url', 'max:2048'],
            'website_url'       => ['nullable', 'url', 'max:2048'],
            'article_url'       => ['nullable', 'url', 'max:2048'],
            'video_url'         => ['nullable', 'url', 'max:2048'],
            'remove_image'      => ['nullable', 'boolean'],
            'sort_order'        => ['nullable', 'integer'],
            'is_active'         => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_image')) {
            $this->deleteStoredImage($award->image);
            $data['image'] = null;
        } else {
            $newImage = $this->resolveImage($request, $data, 'image');
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
     * Resolve an image value from an uploaded file for the given field, falling back to
     * 'image_url' when resolving the primary 'image' field. Returns null when nothing was provided.
     */
    private function resolveImage(Request $request, array $data, string $field = 'image'): ?string
    {
        if ($request->hasFile($field)) {
            return $request->file($field)->store('awards', 'public');
        }

        if ($field === 'image' && !empty($data['image_url'])) {
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
