<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PartnerController extends Controller
{
    private const CATEGORIES = [
        1 => 'Cambodian Authorities',
        2 => 'Organizations / Foundations',
        3 => 'Companies',
        4 => 'Towns & Municipalities',
    ];

    /**
     * Display partner list
     */
    public function index(Request $request)
    {
        $filters = [
            'search' => trim((string) $request->query('search', '')),
            'category_id' => (int) $request->query('category_id', 0),
        ];

        if (! array_key_exists($filters['category_id'], self::CATEGORIES)) {
            $filters['category_id'] = 0;
        }

        $partners = Partner::query()
            ->when($filters['search'] !== '', function ($query) use ($filters) {
                $term = '%' . strtolower($filters['search']) . '%';
                $query->where(function ($q) use ($term) {
                    $q->whereRaw('LOWER(name) LIKE ?', [$term])
                      ->orWhereRaw('LOWER(country) LIKE ?', [$term]);
                });
            })
            ->when($filters['category_id'] !== 0, function ($query) use ($filters) {
                $query->where('category_id', $filters['category_id']);
            })
            ->orderBy('category_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('category_id');

        $activeFilters = ($filters['search'] !== '' ? 1 : 0) + ($filters['category_id'] !== 0 ? 1 : 0);
        $total = $partners->sum(fn ($group) => $group->count());

        if ($request->wantsJson()) {
            return response()->json([
                'html' => view('admin.partners._results', [
                    'partners' => $partners,
                    'filters' => $filters,
                ])->render(),
                'total' => $total,
                'activeFilters' => $activeFilters,
            ]);
        }

        return view('admin.partners.index', [
            'partners' => $partners,
            'filters' => $filters,
            'categories' => self::CATEGORIES,
            'totalPartners' => $total,
            'activeCount' => $activeFilters,
        ]);
    }

    /**
     * Store new partner
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', Rule::in(array_keys(self::CATEGORIES))],
            'country' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = true;

        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner added successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Partner $partner)
    {
        $partners = Partner::orderBy('category_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('category_id');

        return view('admin.partners.index', [
            'partners' => $partners,
            'editPartner' => $partner,
            'filters' => [
                'search' => '',
                'category_id' => 0,
            ],
            'categories' => self::CATEGORIES,
            'totalPartners' => $partners->sum(fn ($group) => $group->count()),
            'activeCount' => 0,
        ]);
    }

    /**
     * Update partner
     */
    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', Rule::in(array_keys(self::CATEGORIES))],
            'country' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }

            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    /**
     * Delete partner
     */
    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner removed successfully.');
    }
}
