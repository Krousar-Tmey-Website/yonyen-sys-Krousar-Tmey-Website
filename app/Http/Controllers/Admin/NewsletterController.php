<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        // Search by email
        if ($email = $request->input('email')) {
            $query->where('email', 'like', "%{$email}%");
        }

        $subscribers = $query->latest('subscribed_at')->paginate(15);
        $totalCount = NewsletterSubscriber::count();

        return view('admin.newsletter.index', compact('subscribers', 'totalCount'));
    }

    public function destroy(NewsletterSubscriber $newsletterSubscriber)
    {
        $newsletterSubscriber->delete();

        return redirect()
            ->route('admin.newsletter.index')
            ->with('success', 'Subscriber deleted successfully.');
    }

    public function export()
    {
        $subscribers = NewsletterSubscriber::orderBy('subscribed_at')->get();

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="newsletter_subscribers.csv"',
        ];

        $callback = function () use ($subscribers) {
            $handle = fopen('php://output', 'w');

            // BOM for UTF-8 Excel compatibility
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header row
            fputcsv($handle, ['Email', 'Subscribed At']);

            foreach ($subscribers as $subscriber) {
                fputcsv($handle, [
                    $subscriber->email,
                    $subscriber->subscribed_at?->format('Y-m-d H:i:s') ?? '',
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }
}
