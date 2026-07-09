<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        Newsletter::create($data);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}