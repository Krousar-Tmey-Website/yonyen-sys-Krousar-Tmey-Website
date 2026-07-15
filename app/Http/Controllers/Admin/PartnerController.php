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
        $search  = trim((string) $request->query('search', ''));
        $category = $request->query('category');

        $partnerCategoryModels = PartnerCategory::orderBy('name')->get();

        $partners = Partner::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when(filled($category), function ($query) use ($category) {
                $query->whereHas('categoryModel', fn ($q) => $q->where('name', $category));
            })
            ->latest()
            ->get()
            ->groupBy(fn ($p) => $p->category ?? 'Individual Donor');

        $activeFilters = (filled($search) ? 1 : 0) + (filled($category) ? 1 : 0);
        $totalPartners = $partners->sum(fn ($group) => $group->count());

        $viewData = [
            'partners'      => $partners,
            'filters'       => ['search' => $search, 'category' => $category ?? ''],
            'categories'    => $partnerCategoryModels,
            'totalPartners' => $totalPartners,
            'activeCount'   => $activeFilters,
        ];

        if ($request->ajax() || $request->wantsJson()) {
            $html = view('admin.partners._results', $viewData)->render();

            return response()->json([
                'html'          => $html,
                'total'         => $totalPartners,
                'activeFilters' => $activeFilters,
            ]);
        }

        return view('admin.partners.index', $viewData);
    }

    /**
     * Show the page to create a new partner.
     */
    public function create()
    {
        $partnerCategoryModels = PartnerCategory::orderBy('name')->get();

        return view('admin.partners.create', [
            'categories' => $partnerCategoryModels,
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

        $partner = Partner::create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Partner $partner)
    {
        $partnerCategoryModels = PartnerCategory::orderBy('name')->get();

        $partners = Partner::latest()
            ->get()
            ->groupBy(fn ($p) => $p->category ?? 'Individual Donor');

        $totalPartners = $partners->sum(fn ($group) => $group->count());

        return view('admin.partners.index', [
            'partners'      => $partners,
            'editPartner'   => $partner,
            'filters'       => ['search' => '', 'category' => ''],
            'categories'    => $partnerCategoryModels,
            'totalPartners' => $totalPartners,
            'activeCount'   => 0,
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
