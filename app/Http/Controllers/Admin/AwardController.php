<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::ordered()->get();
        return view('admin.awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.awards.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'recipient'    => ['nullable', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'icon'         => ['nullable', 'string', 'max:10'],
            'image'        => ['nullable', 'image', 'max:2048'],
            'sort_order'   => ['nullable', 'integer'],
            'link_url'     => ['nullable', 'url'],
            'link_text'    => ['nullable', 'string', 'max:255'],
            'link_type'    => ['nullable', 'in:website,article,video'],
        ]);

        $data['icon']       = $data['icon'] ?? '🏆';
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('awards', 'public');
        }

        Award::create($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award added.');
    }

    public function edit(Award $award)
    {
        return view('admin.awards.edit', compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'recipient'    => ['nullable', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'icon'         => ['nullable', 'string', 'max:10'],
            'image'        => ['nullable', 'image', 'max:2048'],
            'sort_order'   => ['nullable', 'integer'],
            'link_url'     => ['nullable', 'url'],
            'link_text'    => ['nullable', 'string', 'max:255'],
            'link_type'    => ['nullable', 'in:website,article,video'],
        ]);

        $data['icon'] = $data['icon'] ?? '🏆';

        // Handle image removal
        if ($request->has('remove_image') && $award->image) {
            Storage::disk('public')->delete($award->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($award->image) {
                Storage::disk('public')->delete($award->image);
            }
            $data['image'] = $request->file('image')->store('awards', 'public');
        }

        $award->update($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award updated.');
    }

    public function destroy(Award $award)
    {
        if ($award->image) {
            Storage::disk('public')->delete($award->image);
        }
        $award->delete();
        return redirect()->route('admin.awards.index')->with('success', 'Award removed.');
    }
}