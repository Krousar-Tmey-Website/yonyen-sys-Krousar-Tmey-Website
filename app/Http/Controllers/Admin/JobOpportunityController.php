<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Models\JobOpportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobOpportunityController extends Controller
{
    public function index()
    {
        $jobs = JobOpportunity::ordered()->get();
        $settings = HomeSetting::allKeyed();

        return view('admin.jobs.index', compact('jobs', 'settings'));
    }

    public function updateCta(Request $request)
    {
        $data = $request->validate([
            'jobs_cta_heading' => ['nullable', 'string', 'max:255'],
            'jobs_cta_heading_fr' => ['nullable', 'string', 'max:255'],
            'jobs_cta_intro' => ['nullable', 'string'],
            'jobs_cta_intro_fr' => ['nullable', 'string'],
            'jobs_cta_phone_label' => ['nullable', 'string', 'max:255'],
            'jobs_cta_phone_label_fr' => ['nullable', 'string', 'max:255'],
            'jobs_cta_phone_1' => ['nullable', 'string', 'max:50'],
            'jobs_cta_phone_2' => ['nullable', 'string', 'max:50'],
            'jobs_cta_email_label' => ['nullable', 'string', 'max:255'],
            'jobs_cta_email_label_fr' => ['nullable', 'string', 'max:255'],
            'jobs_cta_email' => ['nullable', 'email', 'max:255'],
            'jobs_cta_button_text' => ['nullable', 'string', 'max:255'],
            'jobs_cta_button_text_fr' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value);
        }

        return redirect()->route('admin.jobs.index')->with('success', "Don't see the right fit? section updated.");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'title_fr' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'posted_date' => ['nullable', 'date'],
            'type' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('jobs', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        JobOpportunity::create($data);

        return redirect()->route('admin.jobs.index')->with('success', 'Job opportunity added.');
    }

    public function update(Request $request, JobOpportunity $job)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'title_fr' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'posted_date' => ['nullable', 'date'],
            'type' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($job->image) {
                Storage::disk('public')->delete($job->image);
            }
            $data['image'] = $request->file('image')->store('jobs', 'public');
        } elseif ($request->boolean('remove_image') && $job->image) {
            Storage::disk('public')->delete($job->image);
            $data['image'] = null;
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $job->update($data);

        return redirect()->route('admin.jobs.index')->with('success', 'Job opportunity updated.');
    }

    public function destroy(JobOpportunity $job)
    {
        if ($job->image) {
            Storage::disk('public')->delete($job->image);
        }

        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job opportunity removed.');
    }
}
