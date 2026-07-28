<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasHexColorFields;
use App\Http\Controllers\Controller;
use App\Models\InvolvedQuickLink;
use Illuminate\Http\Request;

class InvolvedQuickLinkController extends Controller
{
    use HasHexColorFields;

    public function index()
    {
        $items = InvolvedQuickLink::ordered()->get();

        return view('admin.involved-quick-links.index', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data = $this->normalizeColorFields($data);

        InvolvedQuickLink::create($data);

        return redirect()->route('admin.involved-quick-links.index')->with('success', 'Quick link card added.');
    }

    public function update(Request $request, InvolvedQuickLink $involvedQuickLink)
    {
        $data = $request->validate($this->rules());
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data = $this->normalizeColorFields($data);

        $involvedQuickLink->update($data);

        return redirect()->route('admin.involved-quick-links.index')->with('success', 'Quick link card updated.');
    }

    public function destroy(InvolvedQuickLink $involvedQuickLink)
    {
        $involvedQuickLink->delete();

        return redirect()->route('admin.involved-quick-links.index')->with('success', 'Quick link card deleted.');
    }

    private function rules(): array
    {
        return [
            'icon_key' => ['required', 'string', 'in:'.implode(',', array_keys(InvolvedQuickLink::ICONS))],
            'title' => ['required', 'string', 'max:255'],
            'title_km' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_km' => ['nullable', 'string'],
            'link_url' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ] + $this->colorValidationRules();
    }
}
