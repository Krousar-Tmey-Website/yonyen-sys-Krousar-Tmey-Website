<?php

namespace App\Http\Controllers;

use App\Mail\DonationRequestMail;
use App\Mail\ThankYouDonationMail;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DonationController extends Controller
{
    public function show(Request $request)
    {
        $paymentMethods = PaymentMethod::active()->ordered()->get();

        $raisedFromDb = (float) \App\Models\Donation::sum(\Illuminate\Support\Facades\DB::raw('COALESCE(DonationAmount, Amount, 0)'));
        $countFromDb = (int) \App\Models\Donation::count();

        $raised = $raisedFromDb + 160.00;
        $count = $countFromDb + 8;
        $goal = 1000.00;

        return view('donate', compact('paymentMethods', 'raised', 'count', 'goal'));
    }

    public function showInternational(Request $request)
    {
        $residency = $request->query('residency', 'france');
        return redirect()->route('donate', ['residency' => $residency]);
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|max:150',
            'phone'     => 'nullable|string|max:30',
            'amount'    => 'required|numeric|min:1',
            'currency'  => 'required|in:USD,EUR,KHR',
            'frequency' => 'required|in:one-time,monthly,annual',
            'message'   => 'nullable|string|max:1000',
        ]);

        // Notify the KT team
        Mail::to(config('mail.donation_recipient', 'info@krousar-thmey.org'))
            ->send(new DonationRequestMail($data, forTeam: true));

        // Send confirmation copy to the donor
        Mail::to($data['email'])
            ->send(new DonationRequestMail($data, forTeam: false));

        return back()
            ->with('success', 'Declaration submitted successfully! Please check your email.')
            ->with('donor_name', $data['name']);
    }

    public function continueDonation(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:150',
            'amount'     => 'required|numeric|min:1',
            'currency'   => 'required|in:USD,EUR,KHR',
            'frequency'  => 'required|in:one-time,monthly,annual',
            'message'    => 'nullable|string|max:1000',
        ]);

        // Send "Thank You" email to donor using Gmail SMTP
        Mail::to($data['email'])
            ->send(new ThankYouDonationMail($data['first_name'], $data['last_name'], $data['amount'], $data['currency']));

        // Prepare data for the KT team notification
        $teamData = [
            'name'      => $data['first_name'] . ' ' . $data['last_name'],
            'email'     => $data['email'],
            'phone'     => '',
            'amount'    => $data['amount'],
            'currency'  => $data['currency'],
            'frequency' => $data['frequency'],
            'message'   => $data['message'] ?? '',
        ];

        // Notify the KT team
        Mail::to(config('mail.donation_recipient', 'info@krousar-thmey.org'))
            ->send(new DonationRequestMail($teamData, forTeam: true));

        return response()->json([
            'message' => 'Thank you email sent successfully.',
        ]);
    }
}
