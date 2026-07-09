<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $exists = NewsletterSubscriber::where('email', $data['email'])->exists();

        if ($exists) {
            return back()->with('info', 'You are already subscribed to our newsletter.');
        }

        NewsletterSubscriber::create([
            'email' => $data['email'],
        ]);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }

    public function unsubscribe(string $email)
    {
        $subscriber = NewsletterSubscriber::where('email', $email)->first();

        if ($subscriber) {
            $subscriber->delete();
        }

        return redirect()->route('home')->with('info', 'You have been unsubscribed from our newsletter.');
    }
}
