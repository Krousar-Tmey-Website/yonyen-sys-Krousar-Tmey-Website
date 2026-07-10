<?php

namespace App\Http\Controllers;

use App\Models\SiteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = SiteNotification::ordered()->get();

        $groups = $notifications->groupBy(function (SiteNotification $notification) {
            $date = $notification->created_at;

            if ($date->isToday()) {
                return 'Today';
            }

            if ($date->isYesterday()) {
                return 'Yesterday';
            }

            return $date->format('F j, Y');
        });

        return view('updates', compact('groups'));
    }
}
