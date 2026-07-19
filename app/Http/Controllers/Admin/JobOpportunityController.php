<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOpportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobOpportunityController extends Controller
{
    public function index()
    {
        $jobs = JobOpportunity::ordered()->get();

        return view('admin.jobs.index', compact('jobs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
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
