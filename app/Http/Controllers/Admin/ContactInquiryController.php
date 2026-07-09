<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactInquiry::query();

        // Search by sender name (independent from status filter)
        if ($name = $request->input('name')) {
            $query->where('Name', 'like', "%{$name}%");
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('Status', $status);
        }

        // Filter by target entity
        if ($entity = $request->input('entity')) {
            $query->where('TargetEntity', $entity);
        }

        $inquiries = $query->latest('ReceivedDate')->paginate(8);

        return view('admin.contacts.index', compact('inquiries'));
    }

    public function show(ContactInquiry $contactInquiry)
    {
        return view('admin.contacts.show', compact('contactInquiry'));
    }

    public function updateStatus(Request $request, ContactInquiry $contactInquiry)
    {
        $data = $request->validate([
            'status' => ['required', 'in:New,Read,Replied,Archived'],
        ]);

        $contactInquiry->update(['Status' => $data['status']]);

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', "Inquiry status updated to {$data['status']}.");
    }

    public function destroy(ContactInquiry $contactInquiry)
    {
        $contactInquiry->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}
