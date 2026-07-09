<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public const CATEGORIES = [
        'authorities'   => 'Authorities',
        'organizations' => 'Organizations',
        'companies'     => 'Companies',
        'towns'         => 'Towns',
    ];

    public function index(Request $request)
    {
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
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner removed successfully.');
    }
}