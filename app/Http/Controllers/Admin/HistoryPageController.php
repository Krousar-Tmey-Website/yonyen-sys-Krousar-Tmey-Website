<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryEvent;
use App\Models\HomeSetting;
use Illuminate\Http\Request;

class HistoryPageController extends Controller
{
    public function index(Request $request)
    {
        // ── Banner data ─────────────────────────────────────────
        $bannerSettings = HomeSetting::whereIn('key', [
            'history_banner_image',
            'history_banner_overlay_color',
            'history_banner_badge',
            'history_banner_title',
            'history_banner_subtitle',
            'history_banner_subtitle_fr',
        ])->pluck('value', 'key');

        // ── Timeline data ──────────────────────────────────────
        $search = trim((string) $request->query('search', ''));

        $events = HistoryEvent::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('year', 'like', '%' . $search . '%')
                      ->orWhere('left_text', 'like', '%' . $search . '%')
                      ->orWhere('right_text', 'like', '%' . $search . '%');
            })
            ->orderBy('sort_order')
            ->orderBy('year')
            ->get();

        $totalEvents = $events->count();

        return view('admin.history-page.index', [
            'bannerSettings' => $bannerSettings,
            'events'         => $events,
            'filters'        => ['search' => $search],
            'totalEvents'    => $totalEvents,
        ]);
    }
}
