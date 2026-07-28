<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasHexColorFields;
use App\Http\Controllers\Controller;
use App\Models\PartnerPrinciple;
use Illuminate\Http\Request;

class PartnerPrincipleController extends Controller
{
    use HasHexColorFields;

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'content_fr' => ['nullable', 'string', 'max:255'],
            'content_km' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ] + $this->colorValidationRules());

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data = $this->normalizeColorFields($data);

        PartnerPrinciple::create($data);

        return redirect()->route('admin.partner-page.index', ['tab' => 'principles'])->with('success', 'Principle added.');
    }

    public function update(Request $request, PartnerPrinciple $partnerPrinciple)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'content_fr' => ['nullable', 'string', 'max:255'],
            'content_km' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ] + $this->colorValidationRules());

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data = $this->normalizeColorFields($data);

        $partnerPrinciple->update($data);

        return redirect()->route('admin.partner-page.index', ['tab' => 'principles'])->with('success', 'Principle updated.');
    }

    public function destroy(PartnerPrinciple $partnerPrinciple)
    {
        $partnerPrinciple->delete();

        return redirect()->route('admin.partner-page.index', ['tab' => 'principles'])->with('success', 'Principle deleted.');
    }
}
