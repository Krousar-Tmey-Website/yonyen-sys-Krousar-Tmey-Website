<?php

namespace App\Http\Controllers;

use App\Mail\DonationRequestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DonationController extends Controller
{
    public function show()
    {
        return view('donate');
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
            ->with('success', true)
            ->with('donor_name', $data['name']);
    }
}
