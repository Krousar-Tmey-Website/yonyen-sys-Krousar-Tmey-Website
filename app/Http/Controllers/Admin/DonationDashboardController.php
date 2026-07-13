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
        // ── Overview stats ──
        $totalDonations = Donation::sum(DB::raw('COALESCE(DonationAmount, Amount, 0)'));
        $totalDonors    = Donor::count();
        $totalCount     = Donation::count();
        $recurringCount = Donation::where('IsRecurring', true)->count();
        $avgDonation    = $totalCount > 0 ? $totalDonations / $totalCount : 0;

        // ── Donations by payment method ──
        $byPaymentMethod = Donation::select('PaymentMethod', DB::raw('COUNT(*) as count'), DB::raw('SUM(COALESCE(DonationAmount, Amount, 0)) as total'))
            ->groupBy('PaymentMethod')
            ->orderByDesc('total')
            ->get();

        // ── Monthly donations (current year) ──
        $monthlyDonations = Donation::select(
            DB::raw('MONTH(DonationDate) as month'),
            DB::raw('YEAR(DonationDate) as year'),
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(COALESCE(DonationAmount, Amount, 0)) as total')
        )
            ->whereYear('DonationDate', now()->year)
            ->groupBy(DB::raw('MONTH(DonationDate)'), DB::raw('YEAR(DonationDate)'))
            ->orderBy('month')
            ->get();

        // ── Recent donations (last 20) ──
        $recentDonations = Donation::with('donor')
            ->latest('DonationDate')
            ->take(20)
            ->get();

        // ── Currency breakdown ──
        $byCurrency = Donation::select('Currency', DB::raw('COUNT(*) as count'), DB::raw('SUM(COALESCE(DonationAmount, Amount, 0)) as total'))
            ->whereNotNull('Currency')
            ->groupBy('Currency')
            ->orderByDesc('total')
            ->get();

        return view('admin.donations.dashboard', compact(
            'totalDonations',
            'totalDonors',
            'totalCount',
            'recurringCount',
            'avgDonation',
            'byPaymentMethod',
            'monthlyDonations',
            'recentDonations',
            'byCurrency'
        ));
    }
}
