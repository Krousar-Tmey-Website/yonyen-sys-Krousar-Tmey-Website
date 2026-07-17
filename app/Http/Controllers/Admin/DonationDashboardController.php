<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Support\Facades\DB;

class DonationDashboardController extends Controller
{
    public function index()
    {
        // ── Base query excluding THB (preserves NULL-currency records) ──
        $baseQuery = Donation::where(function ($q) {
            $q->where('Currency', '!=', 'THB')->orWhereNull('Currency');
        });

        // ── Overview stats ──
        $totalDonations = (clone $baseQuery)->sum(DB::raw('COALESCE(DonationAmount, Amount, 0)'));
        $totalDonors    = Donor::count();
        $totalCount     = (clone $baseQuery)->count();
        $nonMoneyCount  = (clone $baseQuery)->where('DonationType', '!=', 'Money')->whereNotNull('DonationType')->count();
        $avgDonation    = $totalCount > 0 ? $totalDonations / $totalCount : 0;

        // ── Donations by payment method ──
        $byPaymentMethod = (clone $baseQuery)
            ->select('PaymentMethod', DB::raw('COUNT(*) as count'), DB::raw('SUM(COALESCE(DonationAmount, Amount, 0)) as total'))
            ->groupBy('PaymentMethod')
            ->orderByDesc('total')
            ->get();

        // ── Retrieve selected year & available years ──
        $year = request('year', now()->year);
        $availableYears = range(2026, 2030);

        // ── Monthly donations (filtered by year) ──
        $rawMonthly = (clone $baseQuery)
            ->select(
                DB::raw('MONTH(DonationDate) as month'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(COALESCE(DonationAmount, Amount, 0)) as total')
            )
            ->whereYear('DonationDate', $year)
            ->groupBy(DB::raw('MONTH(DonationDate)'))
            ->get();

        $keyed = $rawMonthly->keyBy('month');
        $donationMonths = collect();
        $donationTotals = collect();
        $donationCounts = collect();

        for ($m = 1; $m <= 12; $m++) {
            $monthName = date('M', mktime(0, 0, 0, $m, 1));
            $data = $keyed->get($m);
            $donationMonths->push($monthName);
            $donationTotals->push((float) ($data->total ?? 0));
            $donationCounts->push((int) ($data->count ?? 0));
        }
 
        // ── Recent donations (last 20) ──
        $recentDonations = (clone $baseQuery)
            ->with('donor')
            ->latest('DonationDate')
            ->take(20)
            ->get();

        // ── Donation Type breakdown ──
        $byType = (clone $baseQuery)
            ->select(DB::raw("COALESCE(DonationType, 'Other') as DonationType"), DB::raw('COUNT(*) as count'), DB::raw('SUM(COALESCE(DonationAmount, Amount, 0)) as total'))
            ->groupBy('DonationType')
            ->orderByDesc('total')
            ->get();
 
        return view('admin.donations.dashboard', compact(
            'totalDonations',
            'totalDonors',
            'totalCount',
            'nonMoneyCount',
            'avgDonation',
            'byPaymentMethod',
            'donationMonths',
            'donationTotals',
            'donationCounts',
            'recentDonations',
            'byType',
            'year',
            'availableYears'
        ));
    }
}
