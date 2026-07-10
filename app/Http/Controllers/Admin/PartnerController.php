<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Partner;
use App\Models\PartnerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display partner list with optional search & category filter.
     */
    public function index(Request $request)
    {
        $search     = trim((string) $request->query('search', ''));
        $categoryId = $request->query('category_id');

        $categories = PartnerCategory::orderBy('name')->get();

        $partners = Partner::with('partnerCategory')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when(filled($categoryId), function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->get();

        $viewData = [
            'partners'   => $partners,
            'search'     => $search,
            'categoryId' => $categoryId,
            'categories' => $categories,
        ];

        if ($request->ajax()) {
            $html = view('admin.partners._results', $viewData)->render();

            return response()->json([
                'html'      => $html,
                'total'     => $partners->count(),
                'hasSearch' => filled($search),
            ]);
        }

        $partners = Partner::query()
            ->when($filters['search'] !== '', function ($query) use ($filters) {
                $term = '%' . strtolower($filters['search']) . '%';
                $query->where(function ($q) use ($term) {
                    $q->whereRaw('LOWER(name) LIKE ?', [$term])
                      ->orWhereRaw('LOWER(country) LIKE ?', [$term]);
                });
            })
            ->when($filters['category'] !== '', function ($query) use ($filters) {
                $query->where('category', $filters['category']);
            })
            ->orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('category');

        $activeFilters = ($filters['search'] !== '' ? 1 : 0) + ($filters['category'] !== '' ? 1 : 0);
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
     * Store a new partner.
     */
    public function store(StorePartnerRequest $request)
    {
        $data = $request->validated();

        // Handle optional logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        } else {
            $data['logo'] = null;
        }

        $data['is_active']  = true;
        $data['sort_order'] = 0;

        Partner::create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Partner $partner)
    {
        $categories = PartnerCategory::orderBy('name')->get();

        return view('admin.partners.index', [
            'partners' => $partners,
            'editPartner' => $partner,
            'filters' => [
                'search' => '',
                'category' => '',
            ],
            'categories' => self::CATEGORIES,
            'totalPartners' => $partners->sum(fn ($group) => $group->count()),
            'activeCount' => 0,
        ]);
    }

    /**
     * Update partner.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $data = $request->validated();

        // Handle logo upload / removal
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        } elseif ($request->boolean('remove_logo')) {
            // User explicitly chose to remove the logo
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $data['logo'] = null;
        } else {
            // Keep existing logo
            unset($data['logo']);
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner updated successfully.');
    }

    /**
     * Delete partner.
     */
    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner removed successfully.');
    }
}
