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
            'label' => 'nullable|string|max:255',
            'label_fr' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_fr' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ] + $this->styleValidationRules());

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data = $this->normalizeStyleColors($data);
        $data['image'] = $this->resolveImage($request, $data);
        unset($data['image_url']);

        ImpactStatistic::create($data);

        return redirect()->route('admin.presentation.index', ['tab' => 'impact'])
            ->with('success', 'Impact statistic created successfully.');
    }

    public function update(Request $request, ImpactStatistic $impactStatistic)
    {
        $data = $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'label_fr' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_fr' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ] + $this->styleValidationRules());

        $data = $this->normalizeStyleColors($data);

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

        return redirect()->route('admin.presentation.index', ['tab' => 'impact'])
            ->with('success', 'Impact statistic updated successfully.');
    }

    public function destroy(ImpactStatistic $impactStatistic)
    {
        $this->deleteStoredImage($impactStatistic->image);
        $impactStatistic->delete();

        return redirect()->route('admin.presentation.index', ['tab' => 'impact'])
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

    private function styleValidationRules(): array
    {
        $hexRule = ['nullable', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'];

        return [
            'accent_color' => $hexRule,
            'card_background_color' => $hexRule,
            'card_border_color' => $hexRule,
            'icon_background_color' => $hexRule,
            'value_color' => $hexRule,
            'label_color' => $hexRule,
        ];
    }

    private function normalizeStyleColors(array $data): array
    {
        foreach (array_keys($this->styleValidationRules()) as $field) {
            $data[$field] = $this->normalizeHexColor($data[$field] ?? null);
        }

        return $data;
    }

    private function normalizeHexColor(?string $color): ?string
    {
        if ($color === null || $color === '') {
            return null;
        }

        $color = strtolower($color);

        if (strlen($color) === 4) {
            return '#' . $color[1] . $color[1] . $color[2] . $color[2] . $color[3] . $color[3];
        }

        return $color;
    }
}
