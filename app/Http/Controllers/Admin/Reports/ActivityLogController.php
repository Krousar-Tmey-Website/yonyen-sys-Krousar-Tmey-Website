<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $action = $request->input('action');
        $userId = $request->input('user_id');
        $search = trim((string) $request->input('search', ''));

        $logs = ActivityLog::query()
            ->with('user')
            ->when($action, fn ($q) => $q->where('action', $action))
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search) {
                    $nested->where('description', 'like', "%{$search}%")
                        ->orWhere('action', 'like', "%{$search}%")
                        ->orWhere('subject_type', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $actions = ActivityLog::distinct()->orderBy('action')->pluck('action');
        $users = User::orderBy('name')->get(['id', 'name']);

        return view('admin.reports.activity-logs.index', compact(
            'logs', 'actions', 'users', 'action', 'userId', 'search'
        ));
    }

    public function show(ActivityLog $activityLog)
    {
        $activityLog->load('user');

        return view('admin.reports.activity-logs.show', compact('activityLog'));
    }
}
