<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class NewsletterCampaignController extends Controller
{
    public function index()
    {
        $campaigns = NewsletterCampaign::latest()->paginate(15);
        $totalSubscribers = NewsletterSubscriber::count();

        return view('admin.newsletter.campaigns.index', compact('campaigns', 'totalSubscribers'));
    }

    public function create()
    {
        return view('admin.newsletter.campaigns.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image'   => ['nullable', 'image', 'max:5120'], // max 5MB
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('newsletter-campaigns', 'public');
        }

        $campaign = NewsletterCampaign::create($data);

        return redirect()
            ->route('admin.newsletter.campaigns.show', $campaign)
            ->with('success', 'Newsletter draft created successfully. You can preview and send it.');
    }

    public function show(NewsletterCampaign $campaign)
    {
        return view('admin.newsletter.campaigns.show', compact('campaign'));
    }

    public function edit(NewsletterCampaign $campaign)
    {
        if (! $campaign->isDraft()) {
            return redirect()
                ->route('admin.newsletter.campaigns.show', $campaign)
                ->with('error', 'Only draft campaigns can be edited.');
        }

        return view('admin.newsletter.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, NewsletterCampaign $campaign)
    {
        if (! $campaign->isDraft()) {
            return redirect()
                ->route('admin.newsletter.campaigns.show', $campaign)
                ->with('error', 'Only draft campaigns can be edited.');
        }

        $data = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image'   => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $data['image'] = $request->file('image')->store('newsletter-campaigns', 'public');
        }

        if ($request->boolean('remove_image') && $campaign->image) {
            Storage::disk('public')->delete($campaign->image);
            $data['image'] = null;
        }

        $campaign->update($data);

        return redirect()
            ->route('admin.newsletter.campaigns.show', $campaign)
            ->with('success', 'Campaign updated successfully.');
    }

    public function destroy(NewsletterCampaign $campaign)
    {
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }

        $campaign->delete();

        return redirect()
            ->route('admin.newsletter.campaigns.index')
            ->with('success', 'Campaign deleted.');
    }

    /**
     * Preview the newsletter as HTML in the browser.
     */
    public function preview(NewsletterCampaign $campaign)
    {
        return view('admin.newsletter.campaigns.preview', compact('campaign'));
    }

    /**
     * Send the newsletter to all subscribers.
     */
    public function send(NewsletterCampaign $campaign)
    {
        if (! $campaign->isDraft()) {
            return redirect()
                ->route('admin.newsletter.campaigns.show', $campaign)
                ->with('error', 'This campaign has already been sent.');
        }

        $subscribers = NewsletterSubscriber::all();

        if ($subscribers->isEmpty()) {
            return redirect()
                ->route('admin.newsletter.campaigns.show', $campaign)
                ->with('error', 'No subscribers to send to.');
        }

        $campaign->update([
            'status'           => 'sending',
            'total_recipients' => $subscribers->count(),
            'sent_at'          => now(),
        ]);

        $sentCount = 0;
        $failedCount = 0;

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)
                    ->send(new NewsletterMail($campaign, $subscriber->email));
                $sentCount++;
            } catch (\Exception $e) {
                $failedCount++;
            }
        }

        $finalStatus = $failedCount === 0 ? 'sent' : ($sentCount > 0 ? 'partial' : 'failed');

        $campaign->update([
            'status'       => $finalStatus,
            'sent_count'   => $sentCount,
            'failed_count' => $failedCount,
        ]);

        $message = $finalStatus === 'sent'
            ? "Newsletter sent successfully to {$sentCount} subscriber(s)."
            : "Newsletter sent to {$sentCount} of {$subscribers->count()} subscribers. {$failedCount} failed.";

        return redirect()
            ->route('admin.newsletter.campaigns.show', $campaign)
            ->with('success', $message);
    }
}
