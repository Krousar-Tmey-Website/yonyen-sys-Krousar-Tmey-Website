<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasHexColorFields;
use App\Http\Controllers\Controller;
use App\Models\PartnershipEmphasis;
use Illuminate\Http\Request;

class PartnershipEmphasisController extends Controller
{
    use HasHexColorFields;

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_fr' => ['nullable', 'string', 'max:255'],
            'title_km' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'description_km' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ] + $this->colorValidationRules());

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data = $this->normalizeColorFields($data);

        PartnershipEmphasis::create($data);

        return redirect()->route('admin.partner-page.index', ['tab' => 'emphasis'])->with('success', 'Emphasis card added.');
    }

    public function update(Request $request, PartnershipEmphasis $partnershipEmphasis)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_fr' => ['nullable', 'string', 'max:255'],
            'title_km' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'description_km' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ] + $this->colorValidationRules());

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data = $this->normalizeColorFields($data);

        $partnershipEmphasis->update($data);

        return redirect()->route('admin.partner-page.index', ['tab' => 'emphasis'])->with('success', 'Emphasis card updated.');
    }

    public function destroy(PartnershipEmphasis $partnershipEmphasis)
    {
        $partnershipEmphasis->delete();

        return redirect()->route('admin.partner-page.index', ['tab' => 'emphasis'])->with('success', 'Emphasis card deleted.');
    }
}
