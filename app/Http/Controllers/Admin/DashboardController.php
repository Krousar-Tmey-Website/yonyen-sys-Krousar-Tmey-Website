<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Donation;
use App\Models\News;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Project;
use App\Models\ProgramPageItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'news_total'        => News::count(),
            'news_published'    => News::published()->count(),
            'programs'          => Program::count(),
            'projects'          => Project::count(),
            'partners'          => Partner::count(),
            'awards'            => Award::count(),
            'page_items'        => ProgramPageItem::count(),
            'donations'         => Donation::count(),
            'donations_amount'  => Donation::sum('DonationAmount') + Donation::sum('Amount'),
        ];

        $recentNews = News::latest()->take(5)->get();

        // ── Article categories for pie chart ──
        $categoryStats = News::select('category', DB::raw('COUNT(*) as count'))
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderByDesc('count')
            ->get();

        // ── Retrieve selected year & available years ──
        $year = request('year', now()->year);
        $availableYears = range(2026, 2030);

        // ── Donation Trends Chart Data (filtered by year) ──
        $rawDonations = Donation::select(
            DB::raw('MONTH(DonationDate) as month'),
            DB::raw('COALESCE(SUM(DonationAmount), 0) + COALESCE(SUM(Amount), 0) as total')
        )
            ->whereYear('DonationDate', $year)
            ->groupBy(DB::raw('MONTH(DonationDate)'))
            ->get();

        $keyed = $rawDonations->keyBy('month');
        $donationMonths = collect();
        $donationTotals = collect();

        for ($m = 1; $m <= 12; $m++) {
            $monthName = date('M', mktime(0, 0, 0, $m, 1));
            $data = $keyed->get($m);
            $donationMonths->push($monthName);
            $donationTotals->push((float) ($data->total ?? 0));
        }

        $chartSubtitle = 'Monthly donation amounts';

        // ── Donation by Type ──
        $donationByType = Donation::select(
            'DonationType',
            DB::raw('COUNT(*) as count'),
            DB::raw('COALESCE(SUM(DonationAmount), 0) + COALESCE(SUM(Amount), 0) as total')
        )
            ->whereNotNull('DonationType')
            ->where('DonationType', '!=', '')
            ->groupBy('DonationType')
            ->orderByDesc('total')
            ->get();

        // ── Recent Donations ──
        $recentDonations = Donation::orderBy('DonationDate', 'desc')->take(5)->get();

        // ── Donation Amount Stats (derived from donationByType query) ──
        $donationAmountStats = [];
        foreach (['Food', 'Money', 'Clothes'] as $type) {
            $row = $donationByType->firstWhere('DonationType', $type);
            $donationAmountStats[strtolower($type) . '_total'] = (float) ($row->total ?? 0);
            $donationAmountStats[strtolower($type) . '_count'] = (int) ($row->count ?? 0);
        }

        $chartData = [
            'donationMonths'    => $donationMonths,
            'donationTotals'    => $donationTotals,
            'categories'        => $categoryStats->pluck('count'),
            'categoryLabels'    => $categoryStats->pluck('category'),
            'chartSubtitle'     => $chartSubtitle,
            'year'              => $year,
            'availableYears'    => $availableYears,
            'donationByType'    => $donationByType,
        ];

        return view('admin.dashboard', compact('stats', 'recentNews', 'chartData', 'recentDonations', 'donationAmountStats'));
    }
}
