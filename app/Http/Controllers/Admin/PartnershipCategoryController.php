<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasHexColorFields;
use App\Http\Controllers\Controller;
use App\Models\PartnershipCategory;
use Illuminate\Http\Request;

class PartnershipCategoryController extends Controller
{
    use HasHexColorFields;

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_fr' => ['nullable', 'string', 'max:255'],
            'name_km' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'description_km' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ] + $this->colorValidationRules());

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data = $this->normalizeColorFields($data);

        PartnershipCategory::create($data);

        return redirect()->route('admin.partner-page.index', ['tab' => 'categories'])->with('success', 'Category added.');
    }

    public function update(Request $request, PartnershipCategory $partnershipCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_fr' => ['nullable', 'string', 'max:255'],
            'name_km' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'description_km' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ] + $this->colorValidationRules());

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data = $this->normalizeColorFields($data);

        $partnershipCategory->update($data);

        return redirect()->route('admin.partner-page.index', ['tab' => 'categories'])->with('success', 'Category updated.');
    }

    public function destroy(PartnershipCategory $partnershipCategory)
    {
        $partnershipCategory->delete();

        return redirect()->route('admin.partner-page.index', ['tab' => 'categories'])->with('success', 'Category deleted.');
    }
}
