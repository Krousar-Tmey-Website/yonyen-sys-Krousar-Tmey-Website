<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    /**
     * Display a listing of all donation campaigns.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status');

        $campaigns = Campaign::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($status === 'active', fn ($q) => $q->active())
            ->when($status === 'inactive', fn ($q) => $q->where('is_active', false))
            ->when($status === 'upcoming', fn ($q) => $q->active()->where('start_date', '>', now()))
            ->when($status === 'ended', fn ($q) => $q->active()->where('end_date', '<', now()->startOfDay()))
            ->ordered()
            ->get();

        // Stats
        $totalCampaigns  = $campaigns->count();
        $activeCampaigns = $campaigns->where('is_active', true)->count();
        $totalGoal       = $campaigns->sum('goal_amount');
        $totalRaised     = $campaigns->sum('collected_amount');
        $avgProgress     = $totalGoal > 0 ? round(($totalRaised / $totalGoal) * 100, 1) : 0;

        return view('admin.campaigns.index', compact(
            'campaigns', 'totalCampaigns', 'activeCampaigns',
            'totalGoal', 'totalRaised', 'avgProgress'
        ) + ['filters' => ['search' => $search, 'status' => $status ?? '']]);
    }

    /**
     * Show the form to create a new campaign.
     */
    public function create()
    {
        return view('admin.campaigns.create');
    }

    /**
     * Store a newly created campaign.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:campaigns,slug',
            'description'      => 'nullable|string',
            'goal_amount'      => 'required|numeric|min:0',
            'collected_amount' => 'nullable|numeric|min:0',
            'start_date'       => 'nullable|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'is_active'        => 'boolean',
            'sort_order'       => 'nullable|integer|min:0',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'video'            => 'nullable|mimes:mp4,avi,mov,mkv,webm|max:307200',
            'youtube_url'      => 'nullable|string|max:500|url',
            'remove_youtube'   => 'boolean',
            'pdf'              => 'nullable|mimes:pdf|max:51200',
        ]);

        // File uploads
        $data['image'] = $request->hasFile('image')
            ? $request->file('image')->store('campaigns', 'public')
            : null;

        // Video: uploaded file takes priority over YouTube URL
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('campaigns/videos', 'public');
            $data['youtube_url'] = null; // Clear YouTube link since we have an uploaded video
        } elseif ($request->filled('youtube_url')) {
            $data['youtube_url'] = $request->youtube_url;
            // If YouTube URL is set, don't keep old uploaded video if it existed
            $data['video'] = null;
        }

        $data['pdf'] = $request->hasFile('pdf')
            ? $request->file('pdf')->store('campaigns/pdfs', 'public')
            : null;

        // Let model boot auto-generate slug from title if not explicitly provided
        if (empty($data['slug'])) {
            unset($data['slug']);
        }

        $data['collected_amount'] = $data['collected_amount'] ?? 0;
        $data['is_active']        = $request->boolean('is_active');
        $data['sort_order']       = $data['sort_order'] ?? Campaign::max('sort_order') + 1;

        Campaign::create($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign created successfully.');
    }

    /**
     * Show the form to edit an existing campaign.
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', ['campaign' => $campaign]);
    }

    /**
     * Update an existing campaign.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:campaigns,slug,' . $campaign->id,
            'description'      => 'nullable|string',
            'goal_amount'      => 'required|numeric|min:0',
            'collected_amount' => 'nullable|numeric|min:0',
            'start_date'       => 'nullable|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'is_active'        => 'boolean',
            'sort_order'       => 'nullable|integer|min:0',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'remove_image'     => 'boolean',
            'video'            => 'nullable|mimes:mp4,avi,mov,mkv,webm|max:307200',
            'remove_video'     => 'boolean',
            'youtube_url'      => 'nullable|string|max:500|url',
            'remove_youtube'   => 'boolean',
            'pdf'              => 'nullable|mimes:pdf|max:51200',
            'remove_pdf'       => 'boolean',
        ]);

        // Don't override slug if not explicitly provided (model boot handles auto-generation)
        if (empty($data['slug'])) {
            unset($data['slug']);
        }

        // Image
        if ($request->hasFile('image')) {
            if ($campaign->image) Storage::disk('public')->delete($campaign->image);
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($campaign->image) Storage::disk('public')->delete($campaign->image);
            $data['image'] = null;
        } else {
            unset($data['image']);
        }

        // Video: if a new file is uploaded, use it and clear YouTube URL
        if ($request->hasFile('video')) {
            if ($campaign->video) Storage::disk('public')->delete($campaign->video);
            $data['video'] = $request->file('video')->store('campaigns/videos', 'public');
            $data['youtube_url'] = null;
        } elseif ($request->boolean('remove_video') && !$request->filled('youtube_url')) {
            if ($campaign->video) Storage::disk('public')->delete($campaign->video);
            $data['video'] = null;
        } else {
            unset($data['video']);
        }

        // YouTube URL: if provided, clear uploaded video
        if ($request->filled('youtube_url')) {
            if ($campaign->video) Storage::disk('public')->delete($campaign->video);
            $data['youtube_url'] = $request->youtube_url;
            $data['video'] = null;
        } elseif ($request->boolean('remove_youtube') && !$request->hasFile('video')) {
            $data['youtube_url'] = null;
        } else {
            unset($data['youtube_url']);
        }

        // PDF
        if ($request->hasFile('pdf')) {
            if ($campaign->pdf) Storage::disk('public')->delete($campaign->pdf);
            $data['pdf'] = $request->file('pdf')->store('campaigns/pdfs', 'public');
        } elseif ($request->boolean('remove_pdf')) {
            if ($campaign->pdf) Storage::disk('public')->delete($campaign->pdf);
            $data['pdf'] = null;
        } else {
            unset($data['pdf']);
        }

        $data['collected_amount'] = $data['collected_amount'] ?? 0;
        $data['is_active']        = $request->boolean('is_active');
        $data['sort_order']       = $data['sort_order'] ?? 0;

        $campaign->update($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign updated successfully.');
    }

    /**
     * Preview a campaign exactly as visitors would see it on the public page.
     * (Shows even inactive campaigns so admins can preview before publishing.)
     */
    public function preview(Campaign $campaign)
    {
        $relatedCampaigns = Campaign::active()
            ->where('id', '!=', $campaign->id)
            ->whereNotNull('slug')
            ->ordered()
            ->take(3)
            ->get();

        return view('campaigns.show', compact('campaign', 'relatedCampaigns'));
    }

    /**
     * Delete a campaign permanently.
     */
    public function destroy(Campaign $campaign)
    {
        if ($campaign->image) Storage::disk('public')->delete($campaign->image);
        if ($campaign->video) Storage::disk('public')->delete($campaign->video);
        if ($campaign->pdf)   Storage::disk('public')->delete($campaign->pdf);

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
                'status'    => $campaign->fresh()->status,
            ]);
        }

        $status = $campaign->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Campaign \"{$campaign->title}\" {$status}.");
    }

    /**
     * Reorder campaigns via AJAX (send sorted IDs).
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:campaigns,id',
            'items.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            Campaign::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['success' => true]);
    }
}
