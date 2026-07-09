<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255'],
            'organisation' => ['nullable', 'string', 'max:255'],
            'subject'    => ['required', 'string', 'max:255'],
            'message'    => ['required', 'string'],
            'consent'    => ['accepted'],
        ]);

        ContactInquiry::create($data);

        return back()->with('success', 'Thank you for your message. We will get back to you soon.');
    }
}