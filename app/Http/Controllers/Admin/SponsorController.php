<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::orderBy('sort_order')->latest()->get();
        return view('admin.sponsors.index', compact('sponsors'));
    }

    public function create()
    {
        return view('admin.sponsors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo_file' => 'nullable|image|max:2048',
            'logo_url' => 'nullable|url|max:2048',
            'url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        if ($request->hasFile('logo_file')) {
            $validated['logo'] = $request->file('logo_file')->store('sponsors', 'public');
        } elseif ($request->filled('logo_url')) {
            $validated['logo'] = $validated['logo_url'];
        }

        Sponsor::create($validated);

        return redirect()->route('admin.sponsors.index')->with('success', 'Sponsor created successfully.');
    }

    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsors.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo_file' => 'nullable|image|max:2048',
            'logo_url' => 'nullable|url|max:2048',
            'url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        if ($request->hasFile('logo_file')) {
            if ($sponsor->logo && !str_starts_with($sponsor->logo, 'http')) {
                Storage::disk('public')->delete($sponsor->logo);
            }
            $validated['logo'] = $request->file('logo_file')->store('sponsors', 'public');
        } elseif ($request->filled('logo_url')) {
             if ($sponsor->logo && !str_starts_with($sponsor->logo, 'http') && $sponsor->logo !== $request->logo_url) {
                Storage::disk('public')->delete($sponsor->logo);
            }
            $validated['logo'] = $validated['logo_url'];
        }

        $sponsor->update($validated);

        return redirect()->route('admin.sponsors.index')->with('success', 'Sponsor updated successfully.');
    }

    public function destroy(Sponsor $sponsor)
    {
        if ($sponsor->logo && !str_starts_with($sponsor->logo, 'http')) {
            Storage::disk('public')->delete($sponsor->logo);
        }
        $sponsor->delete();

        return redirect()->route('admin.sponsors.index')->with('success', 'Sponsor deleted successfully.');
    }
}
