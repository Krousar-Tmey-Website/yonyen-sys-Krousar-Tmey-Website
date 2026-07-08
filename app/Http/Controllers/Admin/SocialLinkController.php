<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::orderBy('sort_order')->get();
        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform_name' => 'required|string|max:255',
            'icon'         => 'nullable|string|max:255',
            'url'          => 'required|url|max:255',
            'is_active'    => 'boolean',
            'sort_order'   => 'integer|min:0',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        SocialLink::create($data);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link created successfully.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $data = $request->validate([
            'platform_name' => 'required|string|max:255',
            'icon'         => 'nullable|string|max:255',
            'url'          => 'required|url|max:255',
            'is_active'    => 'boolean',
            'sort_order'   => 'integer|min:0',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $socialLink->update($data);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link updated successfully.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link deleted successfully.');
    }
}
