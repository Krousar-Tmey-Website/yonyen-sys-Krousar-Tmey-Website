<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index(Request $request)
    {
        $query = Volunteer::query();

        // Search by name, email, phone, or country
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $volunteers = $query->latest()->paginate(15);

        // Stats counts (single query)
        $stats = Volunteer::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = 'Under Review' THEN 1 ELSE 0 END) as under_review,
            SUM(CASE WHEN status = 'Interview Scheduled' THEN 1 ELSE 0 END) as interview_scheduled,
            SUM(CASE WHEN status = 'Approved' THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN status = 'Rejected' THEN 1 ELSE 0 END) as rejected
        ")->first();

        return view('admin.volunteers.index', compact('volunteers', 'stats'));
    }

    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function updateStatus(Request $request, Volunteer $volunteer)
    {
        $data = $request->validate([
            'status' => ['required', 'in:Pending,Under Review,Interview Scheduled,Approved,Rejected'],
        ]);

        $volunteer->update($data);

        return redirect()
            ->route('admin.volunteers.index')
            ->with('success', "Application status updated to {$data['status']}.");
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();

        return redirect()
            ->route('admin.volunteers.index')
            ->with('success', 'Application deleted successfully.');
    }
}
