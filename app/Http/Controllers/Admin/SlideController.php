<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::latest()->orderBy('sort_order')->get();
        return view('admin.slides.index', compact('slides'));
    }

    public function show(Slide $slide)
    {
        return view('admin.slides.show', compact('slide'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'subtitle'            => ['nullable', 'string'],
            'badge_text'          => ['nullable', 'string', 'max:80'],
            'image'               => ['nullable', 'image', 'max:4096'],
            'image_url'           => ['nullable', 'url'],
            'cta_primary_text'    => ['nullable', 'string', 'max:80'],
            'cta_primary_url'     => ['nullable', 'string', 'max:255'],
            'cta_secondary_text'  => ['nullable', 'string', 'max:80'],
            'cta_secondary_url'   => ['nullable', 'string', 'max:255'],
            'sort_order'          => ['nullable', 'integer'],
            'is_active'           => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slides', 'public');
        } elseif (!empty($data['image_url'])) {
            $data['image'] = $data['image_url'];
        }
        unset($data['image_url']);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Slide::create($data);

        return redirect()->route('admin.slides.index')->with('success', 'Slide added successfully.');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $data = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'subtitle'            => ['nullable', 'string'],
            'badge_text'          => ['nullable', 'string', 'max:80'],
            'image'               => ['nullable', 'image', 'max:4096'],
            'image_url'           => ['nullable', 'url'],
            'cta_primary_text'    => ['nullable', 'string', 'max:80'],
            'cta_primary_url'     => ['nullable', 'string', 'max:255'],
            'cta_secondary_text'  => ['nullable', 'string', 'max:80'],
            'cta_secondary_url'   => ['nullable', 'string', 'max:255'],
            'sort_order'          => ['nullable', 'integer'],
            'is_active'           => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slides', 'public');
        } elseif (!empty($data['image_url'])) {
            $data['image'] = $data['image_url'];
        }
        unset($data['image_url']);

        $data['is_active'] = $request->boolean('is_active');

        $slide->update($data);

        return redirect()->route('admin.slides.index')->with('success', 'Slide updated.');
    }

    public function destroy(Slide $slide)
    {
        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Slide deleted.');
    }
}
