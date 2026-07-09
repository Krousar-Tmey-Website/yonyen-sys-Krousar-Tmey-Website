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

    public function store(Request $request)
    {
        $data = $request->validate([
            'country'      => ['required', 'string', 'max:100'],
            'city'         => ['required', 'string', 'max:100'],
            'flag'         => ['nullable', 'string', 'max:10'],
            'badge'        => ['nullable', 'string', 'max:50'],
            'address'      => ['required', 'string', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:50'],
            'email'        => ['nullable', 'email', 'max:100'],
            'accent_color' => ['nullable', 'string', 'max:100'],
            'badge_color'  => ['nullable', 'string', 'max:100'],
            'sort_order'   => ['nullable', 'integer'],
        ]);

        $data['flag']         = $data['flag'] ?? '🌍';
        $data['sort_order']   = $data['sort_order'] ?? 0;
        $data['accent_color'] = $data['accent_color'] ?? 'border-[#2d6fa3]';
        $data['badge_color']  = $data['badge_color'] ?? 'bg-[#2d6fa3] text-white';

        Office::create($data);
        return redirect()->route('admin.offices.index')->with('success', 'Office added.');
    }

    public function update(Request $request, Office $office)
    {
        $data = $request->validate([
            'country'      => ['required', 'string', 'max:100'],
            'city'         => ['required', 'string', 'max:100'],
            'flag'         => ['nullable', 'string', 'max:10'],
            'badge'        => ['nullable', 'string', 'max:50'],
            'address'      => ['required', 'string', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:50'],
            'email'        => ['nullable', 'email', 'max:100'],
            'accent_color' => ['nullable', 'string', 'max:100'],
            'badge_color'  => ['nullable', 'string', 'max:100'],
            'sort_order'   => ['nullable', 'integer'],
            'is_active'    => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $office->update($data);
        return redirect()->route('admin.offices.index')->with('success', 'Office updated.');
    }

    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route('admin.offices.index')->with('success', 'Office removed.');
    }
}
