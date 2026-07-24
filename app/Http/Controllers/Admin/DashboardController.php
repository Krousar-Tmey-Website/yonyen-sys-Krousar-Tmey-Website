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

        // ── Partner categories for doughnut chart ──
        $partnerStats = Partner::select('category', DB::raw('COUNT(*) as count'))
            ->groupBy('category')
            ->get();

        $groupedPartners = [];
        foreach ($partnerStats as $stat) {
            $label = empty($stat->category) ? 'Uncategorized' : $stat->category;
            if (!isset($groupedPartners[$label])) {
                $groupedPartners[$label] = 0;
            }
            $groupedPartners[$label] += (int) $stat->count;
        }
        arsort($groupedPartners);

        $partnerCategories = collect(array_values($groupedPartners));
        $partnerCategoryLabels = collect(array_keys($groupedPartners));

        // ── Retrieve selected year & available years ──
        $year = request('year', now()->year);

        $currentYear = (int) now()->year;
        if (DB::connection()->getDriverName() === 'sqlite') {
            $yearsFromDb = Donation::selectRaw('strftime("%Y", DonationDate) as year')
                ->whereNotNull('DonationDate')
                ->distinct()
                ->pluck('year')
                ->map(fn($y) => (int)$y)
                ->toArray();
        } else {
            $yearsFromDb = Donation::selectRaw('YEAR(DonationDate) as year')
                ->whereNotNull('DonationDate')
                ->distinct()
                ->pluck('year')
                ->map(fn($y) => (int)$y)
                ->toArray();
        }

        $minYear = min(array_merge([$currentYear - 2], $yearsFromDb));
        $maxYear = max(array_merge([$currentYear + 2], $yearsFromDb));
        $availableYears = range($minYear, $maxYear);

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
            'donationMonths'         => $donationMonths,
            'donationTotals'         => $donationTotals,
            'partnerCategories'      => $partnerCategories,
            'partnerCategoryLabels'  => $partnerCategoryLabels,
            'chartSubtitle'          => $chartSubtitle,
            'year'                   => $year,
            'availableYears'         => $availableYears,
            'donationByType'         => $donationByType,
        ];

        return view('admin.dashboard', compact('stats', 'recentNews', 'chartData', 'recentDonations', 'donationAmountStats'));
    }
}
