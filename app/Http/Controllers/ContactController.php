<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use App\Models\Office;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        $offices = Office::active()->ordered()->get();
        return view('contact', compact('offices'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:255'],
            'organisation' => ['nullable', 'string', 'max:255'],
            'subject'    => ['required', 'string', 'max:200'],
            'message'    => ['required', 'string'],
            'consent'    => ['accepted'],
        ]);

        ContactInquiry::create([
            'Name'         => $data['first_name'] . ' ' . $data['last_name'],
            'Email'        => $data['email'],
            'Subject'      => $data['subject'],
            'Message'      => $data['message'],
            'TargetEntity' => 'Website',
        ]);

        return back()->with('success', 'Thank you for reaching out! Your message has been sent successfully, and we will be in touch soon.');
    }
}
