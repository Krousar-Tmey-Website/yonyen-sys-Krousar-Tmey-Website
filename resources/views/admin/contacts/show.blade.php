@extends('admin.layouts.app')

@section('title', 'Inquiry — ' . $contactInquiry->Name)
@section('page-title', 'Contact Inquiry')
@section('breadcrumb', $contactInquiry->Name)

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Back link --}}
    <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors mb-5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Inquiries
    </a>

    {{-- Inquiry Information --}}
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
            <h2 class="font-bold text-gray-800">Message Details</h2>
            <span class="px-3 py-1 rounded-full text-xs font-medium
                @if($contactInquiry->Status === 'New') bg-blue-50 text-blue-600
                @elseif($contactInquiry->Status === 'Read') bg-gray-100 text-gray-600
                @elseif($contactInquiry->Status === 'Replied') bg-green-50 text-green-600
                @else bg-yellow-50 text-yellow-600 @endif">
                {{ $contactInquiry->Status }}
            </span>
        </div>

        {{-- Details --}}
        <div class="px-6 py-5 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Name</label>
                    <p class="text-gray-800 font-medium">{{ $contactInquiry->Name }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Email</label>
                    <p class="text-gray-800">
                        <a href="mailto:{{ $contactInquiry->Email }}" class="text-[#2d6fa3] hover:underline">{{ $contactInquiry->Email }}</a>
                    </p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Subject</label>
                    <p class="text-gray-800">{{ $contactInquiry->Subject }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Source</label>
                    <p class="text-gray-800">{{ $contactInquiry->TargetEntity }}</p>
                </div>
            </div>

            <hr class="border-gray-100">

            <div>
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Message</label>
                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $contactInquiry->Message }}</p>
                </div>
            </div>

            <hr class="border-gray-100">

            <div>
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Received</label>
                <p class="text-gray-600 text-sm">{{ $contactInquiry->ReceivedDate->format('F j, Y') }}</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Inquiry ID</label>
                <p class="text-gray-600 text-sm font-mono">{{ $contactInquiry->InquiryID }}</p>
            </div>
            @if($contactInquiry->updated_at !== $contactInquiry->created_at)
            <div>
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Last Updated</label>
                <p class="text-gray-600 text-sm">{{ $contactInquiry->updated_at->format('F j, Y \a\t g:i A') }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">

        {{-- Update Status --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4">Update Status</h3>
            <div class="flex flex-wrap gap-3">
                @php
                    $statuses = ['Read', 'Replied', 'Archived'];
                @endphp
                @foreach($statuses as $status)
                    @if($contactInquiry->Status !== $status)
                    <form method="POST" action="{{ route('admin.contacts.status', $contactInquiry) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="{{ $status }}">
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium transition-all
                                    @if($status === 'Read') bg-gray-100 text-gray-600 hover:bg-gray-200
                                    @elseif($status === 'Replied') bg-green-50 text-green-600 hover:bg-green-100
                                    @elseif($status === 'Archived') bg-yellow-50 text-yellow-600 hover:bg-yellow-100 @endif">
                            @if($status === 'Read')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            @elseif($status === 'Replied')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                            @endif
                            Mark as {{ $status }}
                        </button>
                    </form>
                    @endif
                @endforeach
                @if($contactInquiry->Status !== 'New')
                    <form method="POST" action="{{ route('admin.contacts.status', $contactInquiry) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="New">
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-blue-50 text-blue-600 hover:bg-blue-100 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Reset to New
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- Quick Reply & Delete --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-2">Quick Reply</h3>
            <p class="text-gray-400 text-sm mb-4">Reply to this inquiry via email.</p>
            <a href="mailto:{{ $contactInquiry->Email }}?subject=Re: {{ $contactInquiry->Subject }}"
               class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-[#2d6fa3] text-white text-sm font-medium rounded-xl hover:bg-[#1d4e7a] transition-all mb-4 w-full justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Open in Mail Client
            </a>
            <hr class="border-gray-100 my-4">
            <form method="POST" action="{{ route('admin.contacts.destroy', $contactInquiry) }}"
                  onsubmit="return confirm('Delete this inquiry permanently?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-red-50 text-red-600 text-sm font-medium rounded-xl hover:bg-red-100 transition-all w-full justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete Inquiry
                </button>
            </form>
        </div>
    </div>

</div>

@endsection
