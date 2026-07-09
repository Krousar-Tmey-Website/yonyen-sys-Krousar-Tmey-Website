<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    public function index()
    {
        $events = HistoryEvent::ordered()->get();
        return view('admin.history.index', compact('events'));
    }

    public function create()
    {
        return view('admin.history.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year'       => ['required', 'string', 'max:10'],
            'side'       => ['required', 'in:left,right'],
            'event'      => ['required', 'string'],
            'image'      => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('history', 'public');
        }

        HistoryEvent::create($data);

        return redirect()->route('admin.history.index')
            ->with('success', 'History event added successfully.');
    }

    public function edit(HistoryEvent $history)
    {
        return view('admin.history.edit', compact('history'));
    }

    public function update(Request $request, HistoryEvent $history)
    {
        $data = $request->validate([
            'year'       => ['required', 'string', 'max:10'],
            'side'       => ['required', 'in:left,right'],
            'event'      => ['required', 'string'],
            'image'      => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            if ($history->image) {
                Storage::disk('public')->delete($history->image);
            }
            $data['image'] = $request->file('image')->store('history', 'public');
        }

        $history->update($data);

        return redirect()->route('admin.history.index')
            ->with('success', 'History event updated successfully.');
    }

    public function destroy(HistoryEvent $history)
    {
        if ($history->image) {
            Storage::disk('public')->delete($history->image);
        }
        $history->delete();
        return redirect()->route('admin.history.index')
            ->with('success', 'History event removed successfully.');
    }
}