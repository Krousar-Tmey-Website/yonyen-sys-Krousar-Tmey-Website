<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryEvent;
use Illuminate\Http\Request;

class HistoryEventController extends Controller
{
    public function index()
    {
        $events = HistoryEvent::orderBy('sort_order')->orderBy('year')->get();
        return view('admin.history_events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year'       => ['required', 'string', 'max:10'],
            'left_text'  => ['required', 'string'],
            'right_text' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        HistoryEvent::create($data);
        return redirect()->route('admin.history-events.index')->with('success', 'History event added.');
    }

    public function update(Request $request, HistoryEvent $historyEvent)
    {
        $data = $request->validate([
            'year'       => ['required', 'string', 'max:10'],
            'left_text'  => ['required', 'string'],
            'right_text' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active'  => ['nullable', 'boolean'],
        ]);
        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $historyEvent->update($data);
        return redirect()->route('admin.history-events.index')->with('success', 'History event updated.');
    }

    public function destroy(HistoryEvent $historyEvent)
    {
        $historyEvent->delete();
        return redirect()->route('admin.history-events.index')->with('success', 'History event deleted.');
    }
}
