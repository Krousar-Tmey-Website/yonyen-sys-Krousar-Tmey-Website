@extends('admin.layouts.app')

@section('title', 'Volunteer — ' . $volunteer->full_name)
@section('page-title', 'Volunteer Application')
@section('breadcrumb', $volunteer->full_name)

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Back link --}}
    <a href="{{ route('admin.volunteers.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors mb-5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Applications
    </a>

    {{-- Applicant Header Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden mb-6">
        <div class="px-6 py-6 flex items-center gap-5">
            <div class="w-16 h-16 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                <span class="text-xl font-bold text-[#2d6fa3]">{{ substr($volunteer->full_name, 0, 2) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="text-xl font-bold text-gray-800">{{ $volunteer->full_name }}</h2>
                <p class="text-gray-500 text-sm mt-0.5">Applied {{ $volunteer->created_at->diffForHumans() }}</p>
                @if($volunteer->interested_program)
                    <span class="inline-flex items-center gap-1 mt-1.5 text-xs bg-[#2d6fa3]/10 text-[#2d6fa3] px-2.5 py-0.5 rounded-full font-medium">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Interested in: {{ $volunteer->interested_program }}
                    </span>
                @endif
            </div>
            <div class="flex items-center gap-2">
                <span class="px-4 py-1.5 rounded-full text-sm font-medium
                    @if($volunteer->status === 'Pending') bg-yellow-50 text-yellow-600
                    @elseif($volunteer->status === 'Under Review') bg-blue-50 text-blue-600
                    @elseif($volunteer->status === 'Interview Scheduled') bg-purple-50 text-purple-600
                    @elseif($volunteer->status === 'Approved') bg-green-50 text-green-600
                    @else bg-red-50 text-red-600 @endif">
                    {{ $volunteer->status }}
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Personal Information --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50">
                    <h3 class="font-bold text-gray-800">Personal Information</h3>
                </div>
                <div class="px-6 py-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Email</label>
                            <p class="text-gray-800">
                                <a href="mailto:{{ $volunteer->email }}" class="text-[#2d6fa3] hover:underline">{{ $volunteer->email }}</a>
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Phone</label>
                            <p class="text-gray-800">
                                <a href="tel:{{ $volunteer->phone }}" class="hover:text-[#2d6fa3] transition-colors">{{ $volunteer->phone }}</a>
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Date of Birth</label>
                            <p class="text-gray-800">{{ $volunteer->date_of_birth ? $volunteer->date_of_birth->format('F j, Y') : 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Gender</label>
                            <p class="text-gray-800">{{ $volunteer->gender ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Country</label>
                            <p class="text-gray-800">{{ $volunteer->country }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Availability</label>
                            <p class="text-gray-800">{{ $volunteer->availability ?? 'Not specified' }}</p>
                        </div>
                    </div>

                    @if($volunteer->address)
                    <div class="mt-5 pt-5 border-t border-gray-100">
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Address</label>
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $volunteer->address }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Volunteer Information --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50">
                    <h3 class="font-bold text-gray-800">Volunteer Information</h3>
                </div>
                <div class="px-6 py-5 space-y-5">
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Interested Program</label>
                        <p class="text-gray-800">{{ $volunteer->interested_program ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Motivation</label>
                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap bg-gray-50 rounded-xl p-4">{{ $volunteer->motivation }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Skills</label>
                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap bg-gray-50 rounded-xl p-4">{{ $volunteer->skills }}</p>
                    </div>
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50">
                    <h3 class="font-bold text-gray-800">Additional Information</h3>
                </div>
                <div class="px-6 py-5 space-y-5">
                    @if($volunteer->previous_experience)
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Previous Volunteer Experience</label>
                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap bg-gray-50 rounded-xl p-4">{{ $volunteer->previous_experience }}</p>
                    </div>
                    @endif

                    @if($volunteer->emergency_contact)
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Emergency Contact</label>
                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap bg-gray-50 rounded-xl p-4">{{ $volunteer->emergency_contact }}</p>
                    </div>
                    @endif

                    @if($volunteer->resume)
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Resume / CV</label>
                        <a href="{{ asset('storage/' . $volunteer->resume) }}" target="_blank"
                           class="inline-flex items-center gap-3 text-sm text-[#2d6fa3] hover:text-[#1d4e7a] bg-[#2d6fa3]/5 px-5 py-3 rounded-xl hover:bg-[#2d6fa3]/10 transition-all font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download Resume / CV
                        </a>
                    </div>
                    @endif

                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Agreed to Terms</label>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium {{ $volunteer->agreed_to_terms ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($volunteer->agreed_to_terms)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                @endif
                            </svg>
                            {{ $volunteer->agreed_to_terms ? 'Accepted' : 'Not accepted' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Submission Info --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50">
                    <h3 class="font-bold text-gray-800">Submission Info</h3>
                </div>
                <div class="px-6 py-5 grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Applied</label>
                        <p class="text-gray-700 text-sm">{{ $volunteer->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    @if($volunteer->updated_at !== $volunteer->created_at)
                    <div>
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Last Updated</label>
                        <p class="text-gray-700 text-sm">{{ $volunteer->updated_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar Actions --}}
        <div class="space-y-6">

            {{-- Update Status --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50">
                    <h3 class="font-bold text-gray-800">Update Status</h3>
                </div>
                <div class="px-6 py-5 space-y-2">
                    @php
                        $allStatuses = ['Pending', 'Under Review', 'Interview Scheduled', 'Approved', 'Rejected'];
                        $statusMeta = [
                            'Pending'             => ['btn' => 'bg-yellow-50 text-yellow-600 hover:bg-yellow-100 border-yellow-100'],
                            'Under Review'        => ['btn' => 'bg-blue-50 text-blue-600 hover:bg-blue-100 border-blue-100'],
                            'Interview Scheduled' => ['btn' => 'bg-purple-50 text-purple-600 hover:bg-purple-100 border-purple-100'],
                            'Approved'            => ['btn' => 'bg-green-50 text-green-600 hover:bg-green-100 border-green-100'],
                            'Rejected'            => ['btn' => 'bg-red-50 text-red-600 hover:bg-red-100 border-red-100'],
                        ];
                    @endphp
                    @foreach($allStatuses as $status)
                        @if($volunteer->status !== $status)
                        <form method="POST" action="{{ route('admin.volunteers.status', $volunteer) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $status }}">
                            <button type="submit"
                                    class="w-full text-left px-4 py-2.5 rounded-xl text-sm font-medium border transition-all {{ $statusMeta[$status]['btn'] }}">
                                <span class="flex items-center gap-2">
                                    @if($status === 'Under Review')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @elseif($status === 'Interview Scheduled')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    @elseif($status === 'Approved')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    @elseif($status === 'Rejected')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    @endif
                                    Mark as {{ $status }}
                                </span>
                            </button>
                        </form>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Contact Applicant --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50">
                    <h3 class="font-bold text-gray-800">Contact Applicant</h3>
                </div>
                <div class="px-6 py-5 space-y-3">
                    <a href="mailto:{{ $volunteer->email }}?subject=Volunteer Application - {{ $volunteer->full_name }}"
                       class="w-full inline-flex items-center justify-center gap-2.5 px-4 py-3 rounded-xl text-sm font-medium bg-[#2d6fa3] text-white hover:bg-[#1d4e7a] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Send Email
                    </a>
                    <a href="tel:{{ $volunteer->phone }}"
                       class="w-full inline-flex items-center justify-center gap-2.5 px-4 py-3 rounded-xl text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        Call {{ $volunteer->phone }}
                    </a>
                </div>
            </div>

            {{-- Danger Zone --}}
            <div class="bg-white rounded-2xl border border-red-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-red-50 bg-red-50/30">
                    <h3 class="font-bold text-red-700">Danger Zone</h3>
                </div>
                <div class="px-6 py-5">
                    <p class="text-gray-400 text-xs mb-4">Permanently delete this application and all uploaded documents.</p>
                    <form method="POST" action="{{ route('admin.volunteers.destroy', $volunteer) }}"
                          onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 text-red-600 text-sm font-medium rounded-xl hover:bg-red-100 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete Application
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
