<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::ordered()->paginate(12);
        $banner = [
            'title'    => HomeSetting::getValue('campaigns_banner_title', 'Our Campaigns'),
            'subtitle' => HomeSetting::getValue('campaigns_banner_subtitle', 'Every campaign is a promise kept to a child in Cambodia. Discover the causes we are championing this year.'),
            'image'    => HomeSetting::getValue('campaigns_banner_image', ''),
        ];

        return view('admin.campaigns.index', compact('campaigns', 'banner'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) $request->input('sort_order', 0);
        $data['slug'] = Campaign::uniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        $data = $this->applyVideoInput($request, $data);
        $data = $this->applyFileInput($request, $data);

        Campaign::create($data);

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign created successfully.');
    }

    public function update(Request $request, Campaign $campaign)
    {
        $data = $this->validated($request);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) $request->input('sort_order', 0);

        if ($campaign->title !== $data['title']) {
            $data['slug'] = Campaign::uniqueSlug($data['title'], $campaign->id);
        }

        if ($request->hasFile('image')) {
            $this->deleteStored($campaign->image);
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        } elseif ($request->boolean('remove_image')) {
            $this->deleteStored($campaign->image);
            $data['image'] = null;
        }

        if ($request->hasFile('video') || $request->filled('video_url')) {
            $this->deleteStored($campaign->video);
            $data = $this->applyVideoInput($request, $data);
        } elseif ($request->boolean('remove_video')) {
            $this->deleteStored($campaign->video);
            $data['video'] = null;
        }

        if ($request->hasFile('file')) {
            $this->deleteStored($campaign->file);
            $data = $this->applyFileInput($request, $data);
        } elseif ($request->boolean('remove_file')) {
            $this->deleteStored($campaign->file);
            $data['file'] = null;
            $data['file_original_name'] = null;
        }

        $campaign->update($data);

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign updated successfully.');
    }

    public function destroy(Campaign $campaign)
    {
        $this->deleteStored($campaign->image);
        $this->deleteStored($campaign->video);
        $this->deleteStored($campaign->file);

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign deleted.');
    }

    /**
     * Upload a single image from the CKEditor toolbar and return its public URL,
     * so editors can pick a file from disk instead of pasting a storage URL.
     */
    public function uploadImage(Request $request)
    {
        $request->validate(['image' => ['required', 'image', 'max:5120']]);

        $path = $request->file('image')->store('campaigns/gallery', 'public');

        // Root-relative (not asset()) so it matches the dev server's host:port.
        return response()->json(['url' => '/storage/' . $path]);
    }

    /** Banner shown at the top of the public /campaigns page. */
    public function updateBanner(Request $request)
    {
        $request->validate([
            'campaigns_banner_title'     => ['required', 'string', 'max:255'],
            'campaigns_banner_subtitle'  => ['nullable', 'string', 'max:1000'],
            'campaigns_banner_image'     => ['nullable', 'image', 'max:6144'],
            'campaigns_banner_image_url' => ['nullable', 'url', 'max:2048'],
        ]);

        HomeSetting::setValue('campaigns_banner_title', $request->input('campaigns_banner_title'));
        HomeSetting::setValue('campaigns_banner_subtitle', $request->input('campaigns_banner_subtitle', ''));

        $existing = HomeSetting::getValue('campaigns_banner_image', '');

        if ($request->hasFile('campaigns_banner_image')) {
            $this->deleteStored($existing);
            HomeSetting::setValue('campaigns_banner_image', $request->file('campaigns_banner_image')->store('banners', 'public'));
        } elseif ($request->filled('campaigns_banner_image_url')) {
            $this->deleteStored($existing);
            HomeSetting::setValue('campaigns_banner_image', $request->input('campaigns_banner_image_url'));
        } elseif ($request->boolean('campaigns_banner_image_clear')) {
            $this->deleteStored($existing);
            HomeSetting::setValue('campaigns_banner_image', '');
        }

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaigns page banner updated.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'title_fr'       => ['nullable', 'string', 'max:255'],
            'year'           => ['required', 'string', 'max:20'],
            'description'    => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'image'          => ['nullable', 'image', 'max:4096'],
            'video'          => ['nullable', 'file', 'mimes:mp4,mov,webm', 'max:51200'],
            'video_url'      => ['nullable', 'url', 'max:2048'],
            'file'           => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx', 'max:20480'],
            'sort_order'     => ['nullable', 'integer', 'min:0'],
            'is_active'      => ['nullable', 'boolean'],
        ]);

        // An untouched <input type="file"> still validates as a present-but-null key,
        // which would blank the stored path on update. Media is applied from hasFile()
        // / the explicit remove_* flags instead, so drop these here.
        unset($data['image'], $data['video'], $data['video_url'], $data['file']);

        return $data;
    }

    /** An uploaded video wins over a pasted link; `video_url` is never itself a column. */
    private function applyVideoInput(Request $request, array $data): array
    {
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('campaigns/videos', 'public');
        } elseif ($request->filled('video_url')) {
            $data['video'] = $request->input('video_url');
        }

        unset($data['video_url']);

        return $data;
    }

    private function applyFileInput(Request $request, array $data): array
    {
        if ($request->hasFile('file')) {
            $upload = $request->file('file');
            $data['file'] = $upload->store('campaigns/files', 'public');
            $data['file_original_name'] = $upload->getClientOriginalName();
        }

        return $data;
    }

    private function deleteStored(?string $path): void
    {
        if ($path && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
    }
}
