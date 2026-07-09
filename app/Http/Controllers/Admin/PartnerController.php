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

        return view('admin.partners.index', $viewData);
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $categories = PartnerCategory::orderBy('name')->get();

        return view('admin.partners.create', compact('categories'));
    }

    /**
     * Display partner details.
     */
    public function show(Partner $partner)
    {
        $partner->load('partnerCategory');

        return view('admin.partners.show', [
            'partner' => $partner,
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

        return view('admin.partners.edit', [
            'partner'    => $partner,
            'categories' => $categories,
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
