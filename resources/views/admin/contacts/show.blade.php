@extends('admin.layouts.app')

@section('title', 'Inquiry — ' . $contactInquiry->Name)
@section('page-title', 'Contact Inquiry')
@section('breadcrumb', $contactInquiry->Name)

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Back link --}}
    <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors mb-5 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Inquiries
    </a>

    {{-- ── Hero / Sender Info Section ── --}}
    <div class="bg-gradient-to-br from-[#2d6fa3]/5 to-[#2d6fa3]/10 border border-[#2d6fa3]/15 rounded-2xl p-6 mb-6">
        <div class="flex flex-col sm:flex-row items-start gap-5">

            {{-- Avatar --}}
            <div class="w-14 h-14 rounded-full bg-[#2d6fa3] flex items-center justify-center flex-shrink-0 shadow-sm">
                <span class="text-lg font-bold text-white">{{ substr($contactInquiry->Name, 0, 2) }}</span>
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">{{ $contactInquiry->Name }}</h2>
                        <div class="mt-1.5 space-y-1 text-sm">
                            <a href="#" @click.prevent="openEmail('{{ $contactInquiry->Email }}')" class="text-[#2d6fa3] hover:underline inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $contactInquiry->Email }}
                            </a>
                            @if($contactInquiry->TargetEntity)
                            <div class="flex items-center gap-1.5 text-gray-500">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $contactInquiry->TargetEntity }}
                            </div>
                            @endif
                            <div class="flex items-center gap-1.5 text-gray-500">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $contactInquiry->ReceivedDate->format('F j, Y') }}
                            </div>
                            <div class="flex items-center gap-1.5 text-gray-500">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                {{ $contactInquiry->Subject }}
                            </div>
                        </div>
                    </div>
                    {{-- Status badge --}}
                   <span
                        @class([
                            'inline-flex items-center justify-center px-5 py-2 rounded-full text-sm font-semibold min-w-[100px]',
                            'bg-blue-100 text-blue-700' => $contactInquiry->Status === 'New',
                            'bg-gray-100 text-gray-600' => $contactInquiry->Status === 'Read',
                            'bg-green-100 text-green-700' => $contactInquiry->Status === 'Replied',
                            'bg-yellow-100 text-yellow-700' => !in_array($contactInquiry->Status, ['New', 'Read', 'Replied']),
                        ])
                    >
                        {{ $contactInquiry->Status }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Main Content: Two columns ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Message --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Message Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 bg-[#2d6fa3]/5 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    <span class="text-sm font-semibold text-gray-700">Message</span>
                    @if($contactInquiry->updated_at !== $contactInquiry->created_at)
                        <span class="ml-auto text-[10px] text-gray-400">Updated {{ $contactInquiry->updated_at->format('M j, g:i A') }}</span>
                    @endif
                </div>
                <div class="px-6 py-5">
                    <div class="bg-[#2d6fa3]/5 rounded-xl p-5 border border-[#2d6fa3]/10">
                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $contactInquiry->Message }}</p>
                    </div>
                </div>
            </div>

            {{-- Metadata Card (shown on mobile/tablet) --}}
            <div class="lg:hidden bg-white rounded-2xl border border-gray-100 p-5">
                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Details</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="block text-xs text-gray-400">Received</span>
                        <span class="font-medium text-gray-700">{{ $contactInquiry->ReceivedDate->format('M j, Y') }}</span>
                    </div>
                    @if($contactInquiry->TargetEntity)
                    <div>
                        <span class="block text-xs text-gray-400">Source</span>
                        <span class="font-medium text-gray-700">{{ $contactInquiry->TargetEntity }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right: Actions Sidebar --}}
        <div class="space-y-4">

            {{-- Update Status --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-50 bg-[#2d6fa3]/5">
                    <h3 class="text-sm font-bold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Update Status
                    </h3>
                </div>
                <div class="p-4 space-y-2">
                    @php
                        $statuses = [
                            'Read'    => ['color' => 'bg-gray-100 text-gray-700 hover:bg-gray-200', 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
                            'Replied' => ['color' => 'bg-green-100 text-green-700 hover:bg-green-200', 'icon' => 'M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6'],
                            'Archived'=> ['color' => 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200', 'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
                        ];
                    @endphp
                    @foreach($statuses as $status => $attrs)
                        @if($contactInquiry->Status !== $status)
                        <form method="POST" action="{{ route('admin.contacts.status', $contactInquiry) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $status }}">
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all {{ $attrs['color'] }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $attrs['icon'] }}"/>
                                </svg>
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
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium bg-blue-50 text-blue-600 hover:bg-blue-100 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Reset to New
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Delete --}}
            <div class="bg-white rounded-2xl border border-red-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-red-50 bg-red-50/50">
                    <h3 class="text-sm font-bold text-red-700 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        Danger Zone
                    </h3>
                </div>
                <div class="p-4">
                    <form method="POST" action="{{ route('admin.contacts.destroy', $contactInquiry) }}"
                          onsubmit="return confirm('Are you sure you want to delete this inquiry permanently?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium bg-red-50 text-red-600 hover:bg-red-100 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Inquiry
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
