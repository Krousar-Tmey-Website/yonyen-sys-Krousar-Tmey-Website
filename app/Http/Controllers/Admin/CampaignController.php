<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status');

        $campaigns = Campaign::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($status === 'active', fn ($q) => $q->where('is_active', true))
            ->when($status === 'inactive', fn ($q) => $q->where('is_active', false))
            ->latest()
            ->get();

        return view('admin.campaigns.index', [
            'campaigns' => $campaigns,
            'filters'   => ['search' => $search, 'status' => $status ?? ''],
        ]);
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'goal_amount'      => 'required|numeric|min:0',
            'collected_amount' => 'nullable|numeric|min:0',
            'start_date'       => 'nullable|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'is_active'        => 'boolean',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        } else {
            $data['image'] = null;
        }

        $data['collected_amount'] = $data['collected_amount'] ?? 0;
        $data['is_active']        = $request->boolean('is_active');

        Campaign::create($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign created successfully.');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', ['campaign' => $campaign]);
    }

    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'goal_amount'      => 'required|numeric|min:0',
            'collected_amount' => 'nullable|numeric|min:0',
            'start_date'       => 'nullable|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'is_active'        => 'boolean',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'remove_image'     => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $data['image'] = null;
        } else {
            unset($data['image']);
        }

        $data['collected_amount'] = $data['collected_amount'] ?? 0;
        $data['is_active']        = $request->boolean('is_active');

        $campaign->update($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign updated successfully.');
    }

    public function destroy(Campaign $campaign)
    {
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign deleted successfully.');
    }

    /**
     * Quick toggle for campaign active status (AJAX-friendly).
     */
    public function toggle(Campaign $campaign)
    {
        $campaign->update(['is_active' => !$campaign->is_active]);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success'   => true,
                'is_active' => $campaign->fresh()->is_active,
            ]);
        }

        $status = $campaign->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Campaign \"{$campaign->title}\" {$status}.");
    }
}
