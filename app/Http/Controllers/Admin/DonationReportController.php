<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DonationReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate     = $request->input('start_date');
        $endDate       = $request->input('end_date');
        $paymentMethod = $request->input('payment_method');

        $donations = $this->buildFilteredQuery($startDate, $endDate, $paymentMethod)
            ->orderByDesc('DonationDate')
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        // Calculate summary stats (respecting filters)
        $statsQuery = $this->buildFilteredQuery($startDate, $endDate, $paymentMethod);

        $totalAmount   = (float) $statsQuery->sum('DonationAmount');
        $totalDonations = $statsQuery->count();
        $totalDonors   = (clone $statsQuery)->distinct('DonorID')->count('DonorID');

        // Recent donations (unfiltered for the dashboard card)
        $recentDonations = Donation::with('donor')
            ->orderByDesc('DonationDate')
            ->take(5)
            ->get();

        // Get distinct payment methods used
        $paymentMethods = Donation::select('PaymentMethod')
            ->distinct()
            ->orderBy('PaymentMethod')
            ->pluck('PaymentMethod');

        return view('admin.donations.reports.index', compact(
            'donations',
            'totalAmount',
            'totalDonations',
            'totalDonors',
            'recentDonations',
            'startDate',
            'endDate',
            'paymentMethod',
            'paymentMethods',
        ));
    }

    public function show(Donation $donation)
    {
        $donation->load('donor');

        return view('admin.donations.reports.show', compact('donation'));
    }

    public function exportCsv(Request $request)
    {
        $startDate     = $request->input('start_date');
        $endDate       = $request->input('end_date');
        $paymentMethod = $request->input('payment_method');

        $donations = $this->buildFilteredQuery($startDate, $endDate, $paymentMethod)
            ->orderByDesc('DonationDate')
            ->get();

        $filename = 'donation_reports_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($donations) {
            $handle = fopen('php://output', 'w');

            // BOM for UTF-8 Excel compatibility
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header row
            fputcsv($handle, [
                'Donation ID',
                'Donor Name',
                'Donor Email',
                'Donor Phone',
                'Amount',
                'Currency',
                'Payment Method',
                'Donation Date',
                'Transaction ID',
                'Status',
                'Is Recurring',
                'Fiscal Residency',
            ]);

            foreach ($donations as $donation) {
                fputcsv($handle, [
                    $donation->DonationID,
                    $donation->donor?->full_name ?? 'N/A',
                    $donation->donor?->Email ?? 'N/A',
                    $donation->donor?->Phone ?? 'N/A',
                    $donation->Amount ?? $donation->DonationAmount,
                    $donation->Currency ?? 'USD',
                    $donation->payment_method_badge,
                    $donation->DonationDate?->format('Y-m-d') ?? '',
                    $donation->TransactionID ?? 'N/A',
                    $donation->status_badge,
                    $donation->IsRecurring ? 'Yes' : 'No',
                    $donation->FiscalResidency ?? 'N/A',
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function exportExcel(Request $request)
    {
        $startDate     = $request->input('start_date');
        $endDate       = $request->input('end_date');
        $paymentMethod = $request->input('payment_method');

        $donations = $this->buildFilteredQuery($startDate, $endDate, $paymentMethod)
            ->orderByDesc('DonationDate')
            ->get();

        $filename = 'donation_reports_' . now()->format('Ymd_His') . '.xls';

        $headers = [
            'Content-Type'        => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($donations) {
            $handle = fopen('php://output', 'w');

            // BOM for UTF-8 Excel compatibility
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Build HTML table for Excel
            $html = '<table>';
            $html .= '<thead><tr>';
            $html .= '<th>Donation ID</th>';
            $html .= '<th>Donor Name</th>';
            $html .= '<th>Donor Email</th>';
            $html .= '<th>Donor Phone</th>';
            $html .= '<th>Amount</th>';
            $html .= '<th>Currency</th>';
            $html .= '<th>Payment Method</th>';
            $html .= '<th>Donation Date</th>';
            $html .= '<th>Transaction ID</th>';
            $html .= '<th>Status</th>';
            $html .= '<th>Is Recurring</th>';
            $html .= '<th>Fiscal Residency</th>';
            $html .= '</tr></thead><tbody>';

            foreach ($donations as $donation) {
                $html .= '<tr>';
                $html .= '<td>' . htmlspecialchars($donation->DonationID) . '</td>';
                $html .= '<td>' . htmlspecialchars($donation->donor?->full_name ?? 'N/A') . '</td>';
                $html .= '<td>' . htmlspecialchars($donation->donor?->Email ?? 'N/A') . '</td>';
                $html .= '<td>' . htmlspecialchars($donation->donor?->Phone ?? 'N/A') . '</td>';
                $html .= '<td>' . htmlspecialchars((string) ($donation->Amount ?? $donation->DonationAmount)) . '</td>';
                $html .= '<td>' . htmlspecialchars($donation->Currency ?? 'USD') . '</td>';
                $html .= '<td>' . htmlspecialchars($donation->payment_method_badge) . '</td>';
                $html .= '<td>' . htmlspecialchars($donation->DonationDate?->format('Y-m-d') ?? '') . '</td>';
                $html .= '<td>' . htmlspecialchars($donation->TransactionID ?? 'N/A') . '</td>';
                $html .= '<td>' . htmlspecialchars($donation->status_badge) . '</td>';
                $html .= '<td>' . ($donation->IsRecurring ? 'Yes' : 'No') . '</td>';
                $html .= '<td>' . htmlspecialchars($donation->FiscalResidency ?? 'N/A') . '</td>';
                $html .= '</tr>';
            }

            $html .= '</tbody></table>';

            fwrite($handle, $html);
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Build a donation query with optional date range and payment method filters.
     */
    private function buildFilteredQuery(?string $startDate, ?string $endDate, ?string $paymentMethod)
    {
        $query = Donation::with('donor');

        if ($startDate && $endDate) {
            $query->byDateRange($startDate, $endDate);
        } elseif ($startDate) {
            $query->where('DonationDate', '>=', $startDate);
        } elseif ($endDate) {
            $query->where('DonationDate', '<=', $endDate);
        }

        if ($paymentMethod) {
            $query->byPaymentMethod($paymentMethod);
        }

        return $query;
    }
}
