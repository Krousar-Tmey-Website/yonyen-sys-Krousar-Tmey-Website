<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PartnerCategory;
use App\Enums\PartnerSubcategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display partner list with optional search & category/subcategory filters.
     */
    public function index(Request $request)
    {
        $viewData = $this->buildListViewData($request);

        if ($request->ajax() || $request->wantsJson()) {
            $html = view('admin.partners._results', $viewData)->render();

            return response()->json([
                'html'          => $html,
                'total'         => $viewData['totalPartners'],
                'activeFilters' => $viewData['activeCount'],
            ]);
        }

        return view('admin.partners.index', $viewData);
    }

    /**
     * Show the page to create a new partner.
     */
    public function create()
    {
        return view('admin.partners.create');
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
        return view('admin.partners.edit', compact('partner'));
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

    /**
     * Shared query + view-data builder for the index/edit list views.
     */
    private function buildListViewData(Request $request): array
    {
        $search      = trim((string) $request->query('search', ''));
        $category    = $request->query('category');
        $subcategory = $request->query('subcategory');

        $partners = Partner::query()
            ->whereNotNull('category')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when(filled($category), function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->when(filled($subcategory), function ($query) use ($subcategory) {
                $query->where('subcategory', $subcategory);
            })
            ->latest()
            ->get();

        $activeFilters = (filled($search) ? 1 : 0) + (filled($category) ? 1 : 0) + (filled($subcategory) ? 1 : 0);

        return [
            'partners'      => $partners,
            'filters'       => ['search' => $search, 'category' => $category ?? '', 'subcategory' => $subcategory ?? ''],
            'mainCategories' => PartnerCategory::cases(),
            'subcategories'  => PartnerSubcategory::cases(),
            'totalPartners' => $partners->count(),
            'activeCount'   => $activeFilters,
        ];
    }
}
