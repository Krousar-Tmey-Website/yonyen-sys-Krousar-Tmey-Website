<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImpactStatisticController extends Controller
{
    public function index()
    {
        $statistics = ImpactStatistic::orderBy('sort_order')->get();
        return view('admin.impact_statistics.index', compact('statistics'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'image_url' => 'nullable|url|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['image'] = $this->resolveImage($request, $data);
        unset($data['image_url']);

        ImpactStatistic::create($data);

        return redirect()->route('admin.impact-statistics.index')
            ->with('success', 'Impact statistic created successfully.');
    }

    public function update(Request $request, ImpactStatistic $impactStatistic)
    {
        $data = $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'image_url' => 'nullable|url|max:2048',
            'remove_image' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($request->boolean('remove_image')) {
            $this->deleteStoredImage($impactStatistic->image);
            $data['image'] = null;
        } else {
            $newImage = $this->resolveImage($request, $data);
            if ($newImage !== null) {
                $this->deleteStoredImage($impactStatistic->image);
                $data['image'] = $newImage;
            } else {
                unset($data['image']);
            }
        }
        unset($data['image_url'], $data['remove_image']);

        $impactStatistic->update($data);

        return redirect()->route('admin.impact-statistics.index')
            ->with('success', 'Impact statistic updated successfully.');
    }

    public function destroy(ImpactStatistic $impactStatistic)
    {
        $this->deleteStoredImage($impactStatistic->image);
        $impactStatistic->delete();

        return redirect()->route('admin.impact-statistics.index')
            ->with('success', 'Impact statistic deleted successfully.');
    }

    /**
     * Resolve the image value from an uploaded file or an image URL.
     * Returns null when neither was provided.
     */
    private function resolveImage(Request $request, array $data): ?string
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('impact-statistics', 'public');
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