<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('category')->orderBy('sort_order')->orderBy('name')->get()->groupBy('category');
        return view('admin.partners.index', compact('partners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'category'   => ['required', 'in:authorities,organizations,companies,towns'],
            'country'    => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner added.');
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'category'   => ['required', 'in:authorities,organizations,companies,towns'],
            'country'    => ['nullable', 'string', 'max:100'],
            'is_active'  => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated.');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partner removed.');
    }
}
