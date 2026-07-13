<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $search   = trim((string) $request->query('search', ''));
        $dateFrom = $request->query('date_from');
        $dateTo   = $request->query('date_to');
        $type     = $request->query('type');
        $payment  = $request->query('payment');

        $query = Donation::with('donor');

        // Search by donor name, email, or transaction ID
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('TransactionID', 'like', '%' . $search . '%')
                  ->orWhere('DonationID', 'like', '%' . $search . '%')
                  ->orWhereHas('donor', function ($dq) use ($search) {
                      $dq->where('FullName', 'like', '%' . $search . '%')
                         ->orWhere('FirstName', 'like', '%' . $search . '%')
                         ->orWhere('LastName', 'like', '%' . $search . '%')
                         ->orWhere('Email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by date range
        if ($dateFrom) {
            $query->whereDate('DonationDate', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('DonationDate', '<=', $dateTo);
        }

        // Filter by donation type
        if ($type && $type !== '') {
            $query->where('DonationType', $type);
        }

        // Filter by payment method
        if ($payment && $payment !== '') {
            $query->where('PaymentMethod', $payment);
        }

        $donations = $query->orderBy('DonationDate', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Get distinct values for filter dropdowns
        $donationTypes  = Donation::select('DonationType')->distinct()->whereNotNull('DonationType')->pluck('DonationType');
        $paymentMethods = Donation::select('PaymentMethod')->distinct()->whereNotNull('PaymentMethod')->pluck('PaymentMethod');

        $activeFilters = (filled($search) ? 1 : 0)
            + ($dateFrom ? 1 : 0) + ($dateTo ? 1 : 0)
            + (filled($type) ? 1 : 0) + (filled($payment) ? 1 : 0);

        $viewData = [
            'donations'      => $donations,
            'filters'        => [
                'search'    => $search,
                'date_from' => $dateFrom ?? '',
                'date_to'   => $dateTo ?? '',
                'type'      => $type ?? '',
                'payment'   => $payment ?? '',
            ],
            'donationTypes'  => $donationTypes,
            'paymentMethods' => $paymentMethods,
            'totalDonations' => $donations->total(),
            'activeCount'    => $activeFilters,
        ];

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html'          => view('admin.donations._results', $viewData)->render(),
                'total'         => $donations->total(),
                'activeFilters' => $activeFilters,
            ]);
        }

        return view('admin.donations.index', $viewData);
    }

    public function create()
    {
        return view('admin.donations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'DonorName'      => 'required|string|max:255',
            'DonationAmount' => 'required|numeric|min:0',
            'DonationType'   => 'required|string|max:100',
            'DonationDate'   => 'required|date',
            'PaymentMethod'  => 'required|string|max:100',
            'Status'         => 'required|string|max:50',
        ]);

        // Parse donor name into first/last
        $nameParts = explode(' ', trim($data['DonorName']), 2);
        $firstName = $nameParts[0];
        $lastName  = $nameParts[1] ?? '';
        $fullName  = trim($data['DonorName']);

        // Find or create donor by name
        $donor = Donor::where('FullName', $fullName)->first();

        if (! $donor) {
            $donor = Donor::create([
                'FirstName' => $firstName,
                'LastName'  => $lastName,
                'FullName'  => $fullName,
            ]);
        }

        // Create donation
        $donationData = [
            'DonorID'           => $donor->DonorID,
            'DonationAmount'    => $data['DonationAmount'],
            'DonationType'      => $data['DonationType'],
            'DonationDate'      => $data['DonationDate'],
            'PaymentMethod'     => $data['PaymentMethod'],
            'Status'            => $data['Status'],
            'Currency'          => 'USD',
            'IsRecurring'       => false,
            'TaxReceiptIssued'  => false,
            'FiscalResidency'   => '',
        ];

        Donation::create($donationData);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation recorded successfully.');
    }

    public function show(Donation $donation)
    {
        $donation->load('donor');
        return view('admin.donations.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        $donation->load('donor');
        return view('admin.donations.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
        $data = $request->validate([
            'DonorName'      => 'required|string|max:255',
            'DonationAmount' => 'required|numeric|min:0',
            'DonationType'   => 'required|string|max:100',
            'DonationDate'   => 'required|date',
            'PaymentMethod'  => 'required|string|max:100',
            'Status'         => 'required|string|max:50',
        ]);

        // Parse donor name into first/last
        $nameParts = explode(' ', trim($data['DonorName']), 2);
        $firstName = $nameParts[0];
        $lastName  = $nameParts[1] ?? '';
        $fullName  = trim($data['DonorName']);

        // Update donor
        $donor = $donation->donor;
        if ($donor) {
            $donor->update([
                'FirstName' => $firstName,
                'LastName'  => $lastName,
                'FullName'  => $fullName,
            ]);
        }

        // Update donation
        $donation->update([
            'DonationAmount'    => $data['DonationAmount'],
            'DonationType'      => $data['DonationType'],
            'DonationDate'      => $data['DonationDate'],
            'PaymentMethod'     => $data['PaymentMethod'],
            'Status'            => $data['Status'],
            'Currency'          => 'USD',
            'IsRecurring'       => false,
            'TaxReceiptIssued'  => false,
            'FiscalResidency'   => '',
        ]);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation updated successfully.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation removed successfully.');
    }
}
