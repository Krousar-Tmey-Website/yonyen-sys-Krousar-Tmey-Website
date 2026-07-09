<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\News;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Volunteer;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'news_total'     => News::count(),
            'news_published' => News::published()->count(),
            'programs'       => Program::count(),
            'projects'       => Project::count(),
            'partners'       => Partner::count(),
            'awards'         => Award::count(),
            'page_items'     => ProgramPageItem::count(),
        ];

        $recentNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentNews'));
    }
}
