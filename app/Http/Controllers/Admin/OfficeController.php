<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.offices.index', compact('offices'));
    }

    public function create()
    {
        return view('admin.offices.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        Office::create($validated);

        return redirect()->route('admin.offices.index')->with('success', 'Office created successfully.');
    }

    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    public function update(Request $request, Office $office)
    {
        $validated = $this->validated($request);

        $office->update($validated);

        return redirect()->route('admin.offices.index')->with('success', 'Office updated successfully.');
    }

    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->route('admin.offices.index')->with('success', 'Office deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'country'      => ['required', 'string', 'max:100'],
            'city'         => ['required', 'string', 'max:255'],
            'flag'         => ['nullable', 'string', 'max:10'],
            'badge'        => ['nullable', 'string', 'max:50'],
            'badge_color'  => ['nullable', 'string', 'max:100'],
            'address'      => ['required', 'string', 'max:1000'],
            'phone'        => ['nullable', 'string', 'max:50'],
            'email'        => ['nullable', 'email', 'max:255'],
            'sort_order'   => ['nullable', 'integer', 'min:0'],
            'is_active'    => ['nullable', 'boolean'],
        ]);

        $validated['flag'] = $validated['flag'] ?: '🌍';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
