<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use Illuminate\Http\Request;

class CoreValueController extends Controller
{
    public function index()
    {
        $coreValues = CoreValue::ordered()->get();
        return view('admin.core_values.index', compact('coreValues'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'icon'        => ['nullable', 'string', 'max:10'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        $data['icon']       = $data['icon'] ?? '⭐';
        $data['sort_order'] = $data['sort_order'] ?? 0;
        CoreValue::create($data);

        return redirect()->route('admin.core-values.index')->with('success', 'Value added.');
    }

    public function update(Request $request, CoreValue $coreValue)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'icon'        => ['nullable', 'string', 'max:10'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        $data['icon'] = $data['icon'] ?? '⭐';
        $coreValue->update($data);

        return redirect()->route('admin.core-values.index')->with('success', 'Value updated.');
    }

    public function destroy(CoreValue $coreValue)
    {
        $coreValue->delete();
        return redirect()->route('admin.core-values.index')->with('success', 'Value removed.');
    }
}
