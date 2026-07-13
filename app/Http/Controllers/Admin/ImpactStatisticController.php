<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactStatistic;
use Illuminate\Http\Request;

class ImpactStatisticController extends Controller
{
    public function index()
    {
        $statistics = ImpactStatistic::orderBy('sort_order')->get();
        return view('admin.impact_statistics.index', compact('statistics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        ImpactStatistic::create($validated);

        return redirect()->route('admin.impact-statistics.index')
            ->with('success', 'Impact statistic created successfully.');
    }

    public function update(Request $request, ImpactStatistic $impactStatistic)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $impactStatistic->update($validated);

        return redirect()->route('admin.impact-statistics.index')
            ->with('success', 'Impact statistic updated successfully.');
    }

    public function destroy(ImpactStatistic $impactStatistic)
    {
        $impactStatistic->delete();

        return redirect()->route('admin.impact-statistics.index')
            ->with('success', 'Impact statistic deleted successfully.');
    }
}
