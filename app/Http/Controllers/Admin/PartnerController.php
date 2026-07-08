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
        'authorities' => 'Cambodian Authorities',
        'organizations' => 'Organizations / Foundations',
        'companies' => 'Companies',
        'towns' => 'Towns & Municipalities',
    ];

    /**
     * Display partner list
     */
    public function index(Request $request)
    {
<<<<<<< HEAD
        $partners = Partner::orderBy('category')->orderBy('sort_order')->orderBy('name')->get()->groupBy('category', false);
        return view('admin.partners.index', compact('partners'));
=======
        $filters = [
            'search' => trim((string) $request->query('search', '')),
            'category' => (string) $request->query('category', ''),
        ];

        if (! array_key_exists($filters['category'], self::CATEGORIES)) {
            $filters['category'] = '';
        }

        $partners = Partner::query()
            ->when($filters['search'] !== '', function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['search'] . '%');
            })
            ->when($filters['category'] !== '', function ($query) use ($filters) {
                $query->where('category', $filters['category']);
            })
            ->orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('category');

        return view('admin.partners.index', [
            'partners' => $partners,
            'filters' => $filters,
            'categories' => self::CATEGORIES,
        ]);
>>>>>>> 184c6e2477c85bc89711a44c4d113990aa2e6159
    }

    /**
     * Store new partner
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(array_keys(self::CATEGORIES))],
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
        $partners = Partner::orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('category');

        return view('admin.partners.index', [
            'partners' => $partners,
            'editPartner' => $partner,
            'filters' => [
                'search' => '',
                'category' => '',
            ],
            'categories' => self::CATEGORIES,
        ]);
    }

    /**
     * Update partner
     */
    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(array_keys(self::CATEGORIES))],
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
<<<<<<< HEAD
        $partner->delete(['*']);
        return redirect()->route('admin.partners.index')->with('success', 'Partner removed.');
=======
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner removed successfully.');
>>>>>>> 184c6e2477c85bc89711a44c4d113990aa2e6159
    }
}
