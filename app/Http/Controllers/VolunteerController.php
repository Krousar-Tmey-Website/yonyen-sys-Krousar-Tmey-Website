<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function show()
    {
        return view('volunteer.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'           => ['required', 'string', 'max:255'],
            'email'               => ['required', 'email', 'max:255'],
            'phone'               => ['required', 'string', 'max:50'],
            'date_of_birth'       => ['nullable', 'date', 'before:today'],
            'gender'              => ['nullable', 'string', 'in:Male,Female,Other,Prefer not to say'],
            'country'             => ['required', 'string', 'max:255'],
            'address'             => ['nullable', 'string', 'max:500'],
            'availability'        => ['nullable', 'string', 'max:255'],
            'interested_program'  => ['nullable', 'string', 'max:255'],
            'skills'              => ['required', 'string'],
            'motivation'          => ['required', 'string'],
            'previous_experience' => ['nullable', 'string'],
            'resume'              => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'emergency_contact'   => ['nullable', 'string', 'max:500'],
            'agreed_to_terms'     => ['accepted'],
        ]);

        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('volunteer-resumes', 'public');
        }

        $data['agreed_to_terms'] = true;

        Volunteer::create($data);

        return back()->with('success', true);
    }
}
