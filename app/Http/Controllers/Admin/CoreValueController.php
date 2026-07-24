<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoreValueController extends Controller
{
    public function index()
    {
        $coreValues = CoreValue::ordered()->get();
        return view('admin.core_values.index', compact('coreValues'));
    }

    public function create()
    {
        return view('admin.core_values.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'                     => ['required', 'string', 'max:255'],
            'title_fr'                  => ['nullable', 'string', 'max:255'],
            'headline'                  => ['nullable', 'string', 'max:255'],
            'headline_fr'               => ['nullable', 'string', 'max:255'],
            'icon'                      => ['nullable', 'string', 'max:10'],
            'image'                     => ['nullable', 'image', 'max:2048'],
            'description'               => ['nullable', 'string'],
            'description_fr'            => ['nullable', 'string'],
            'supporting_description'    => ['nullable', 'string'],
            'supporting_description_fr' => ['nullable', 'string'],
            'sort_order'                => ['nullable', 'integer'],
        ]);

        $data['icon']       = $data['icon'] ?? '⭐';
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('core-values', 'public');
        }

        CoreValue::create($data);

        return redirect()->route('admin.core-values.index')->with('success', 'Value added.');
    }

    public function update(Request $request, CoreValue $coreValue)
    {
        $data = $request->validate([
            'title'                     => ['required', 'string', 'max:255'],
            'title_fr'                  => ['nullable', 'string', 'max:255'],
            'headline'                  => ['nullable', 'string', 'max:255'],
            'headline_fr'               => ['nullable', 'string', 'max:255'],
            'icon'                      => ['nullable', 'string', 'max:10'],
            'image'                     => ['nullable', 'image', 'max:2048'],
            'description'               => ['nullable', 'string'],
            'description_fr'            => ['nullable', 'string'],
            'supporting_description'    => ['nullable', 'string'],
            'supporting_description_fr' => ['nullable', 'string'],
            'sort_order'                => ['nullable', 'integer'],
        ]);

        $data['icon'] = $data['icon'] ?? '⭐';

        if ($request->hasFile('image')) {
            if ($coreValue->image && !str_starts_with($coreValue->image, 'http')) {
                Storage::disk('public')->delete($coreValue->image);
            }
            $data['image'] = $request->file('image')->store('core-values', 'public');
        } else {
            unset($data['image']);
        }

        $coreValue->update($data);

        return redirect()->route('admin.core-values.index')->with('success', 'Value updated.');
    }

    public function destroy(CoreValue $coreValue)
    {
        if ($coreValue->image && !str_starts_with($coreValue->image, 'http')) {
            Storage::disk('public')->delete($coreValue->image);
        }
        $coreValue->delete();
        return redirect()->route('admin.core-values.index')->with('success', 'Value removed.');
    }
}
