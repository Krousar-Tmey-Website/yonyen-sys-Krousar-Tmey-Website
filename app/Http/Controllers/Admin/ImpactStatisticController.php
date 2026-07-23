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
        return redirect()->route('admin.presentation.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

        ImpactStatistic::create($data);

        return redirect()->route('admin.presentation.index', ['tab' => 'impact'])
            ->with('success', 'Impact statistic created successfully.');
    }

    public function update(Request $request, ImpactStatistic $impactStatistic)
    {
        $data = $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

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
     * Delete a locally stored image file, ignoring external URLs.
     */
    private function deleteStoredImage(?string $path): void
    {
        if ($path && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
    }
}