<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorldwidePartner;
use Illuminate\Http\Request;

class WorldwidePartnerController extends Controller
{
    public function index()
    {
        $partners = WorldwidePartner::orderBy('display_order')->orderBy('id')->get();
        return view('admin.worldwide_partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.worldwide_partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'country_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'learn_more_url' => ['nullable', 'url', 'max:2048'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('worldwide', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $data['image_url'];
        }

        unset($data['image_url']);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);

        WorldwidePartner::create($data);

        return redirect()->route('admin.worldwide-partners.index')->with('success', 'Country partner added successfully.');
    }

    public function edit(WorldwidePartner $worldwidePartner)
    {
        return view('admin.worldwide_partners.edit', compact('worldwidePartner'));
    }

    public function update(Request $request, WorldwidePartner $worldwidePartner)
    {
        $data = $request->validate([
            'country_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'learn_more_url' => ['nullable', 'url', 'max:2048'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('worldwide', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $data['image_url'];
        }

        unset($data['image_url']);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);

        $worldwidePartner->update($data);

        return redirect()->route('admin.worldwide-partners.index')->with('success', 'Country partner updated successfully.');
    }

    public function destroy(WorldwidePartner $worldwidePartner)
    {
        $worldwidePartner->delete();
        return redirect()->route('admin.worldwide-partners.index')->with('success', 'Country partner deleted successfully.');
    }
}