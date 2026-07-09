<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::ordered()->get();
        return view('admin.offices.index', compact('offices'));
    }

    public function create()
    {
        return view('admin.offices.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'country'         => ['nullable', 'string', 'max:255'],
            'flag'            => ['nullable', 'string', 'max:20'],
            'address'         => ['nullable', 'string', 'max:500'],
            'google_maps_link'=> ['nullable', 'string', 'max:1000'],
            'phone'           => ['nullable', 'string', 'max:100'],
            'email'           => ['nullable', 'email', 'max:200'],
            'office_hours'    => ['nullable', 'string', 'max:500'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
            'is_active'       => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Office::create($data);

        return redirect()->route('admin.offices.index')
            ->with('success', 'Office created successfully.');
    }

    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    public function update(Request $request, Office $office)
    {
        $data = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'country'         => ['nullable', 'string', 'max:255'],
            'flag'            => ['nullable', 'string', 'max:20'],
            'address'         => ['nullable', 'string', 'max:500'],
            'google_maps_link'=> ['nullable', 'string', 'max:1000'],
            'phone'           => ['nullable', 'string', 'max:100'],
            'email'           => ['nullable', 'email', 'max:200'],
            'office_hours'    => ['nullable', 'string', 'max:500'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
            'is_active'       => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $office->update($data);

        return redirect()->route('admin.offices.index')
            ->with('success', 'Office updated successfully.');
    }

    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->route('admin.offices.index')
            ->with('success', 'Office deleted successfully.');
    }
}
