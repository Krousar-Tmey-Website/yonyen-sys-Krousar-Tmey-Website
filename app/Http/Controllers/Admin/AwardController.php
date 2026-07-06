<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::ordered()->get();
        return view('admin.awards.index', compact('awards'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'recipient'    => ['nullable', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'icon'         => ['nullable', 'string', 'max:10'],
            'sort_order'   => ['nullable', 'integer'],
        ]);

        $data['icon']       = $data['icon'] ?? '🏆';
        $data['sort_order'] = $data['sort_order'] ?? 0;
        Award::create($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award added.');
    }

    public function update(Request $request, Award $award)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'recipient'    => ['nullable', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'icon'         => ['nullable', 'string', 'max:10'],
            'sort_order'   => ['nullable', 'integer'],
        ]);

        $data['icon'] = $data['icon'] ?? '🏆';
        $award->update($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award updated.');
    }

    public function destroy(Award $award)
    {
        $award->delete();
        return redirect()->route('admin.awards.index')->with('success', 'Award removed.');
    }
}
