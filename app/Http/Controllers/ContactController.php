<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
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

        return back()->with('success', 'Your message has been sent successfully. We will get back to you within 2 business days.');
    }
}
