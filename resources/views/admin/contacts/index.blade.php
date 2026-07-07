@extends('admin.layouts.app')

@section('title', 'Contact Inquiries')
@section('page-title', 'Contact Inquiries')
@section('breadcrumb', 'Manage messages received from the contact form')

@section('content')

{{-- Search & Filter --}}
<div class="bg-white rounded-2xl border border-gray-100 p-5 mb-6">
    <form method="GET" action="{{ route('admin.contacts.index') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
        {{-- Search --}}
        <div class="relative flex-1 w-full">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or subject..."
                   class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm">
        </div>

        {{-- Filters --}}
        <div class="flex items-center gap-2 w-full sm:w-auto">
            <select name="status" onchange="this.form.submit()"
                    class="px-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm bg-white">
                <option value="">All Statuses</option>
                <option value="New"      {{ request('status') === 'New'      ? 'selected' : '' }}>New</option>
                <option value="Read"     {{ request('status') === 'Read'     ? 'selected' : '' }}>Read</option>
                <option value="Replied"  {{ request('status') === 'Replied'  ? 'selected' : '' }}>Replied</option>
                <option value="Archived" {{ request('status') === 'Archived' ? 'selected' : '' }}>Archived</option>
            </select>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2.5 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all text-sm whitespace-nowrap">
                    Clear
                </a>
            @endif
        </div>
    </form>
</div>

{{-- Inquiries Table --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    @if($inquiries->isEmpty())
        <div class="px-6 py-16 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-400 text-sm">No contact inquiries found.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Subject</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Received</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($inquiries as $inquiry)
                    <tr class="hover:bg-gray-50/50 {{ $inquiry->Status === 'New' ? 'bg-blue-50/30' : '' }}">
                        <td class="px-6 py-4 font-medium text-gray-700">
                            <span class="{{ $inquiry->Status === 'New' ? 'font-semibold' : '' }}">{{ $inquiry->Name }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $inquiry->Email }}</td>
                        <td class="px-6 py-4 text-gray-500 max-w-[200px] truncate">{{ $inquiry->Subject }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'New'      => 'bg-blue-50 text-blue-600',
                                    'Read'     => 'bg-gray-100 text-gray-600',
                                    'Replied'  => 'bg-green-50 text-green-600',
                                    'Archived' => 'bg-yellow-50 text-yellow-600',
                                ][$inquiry->Status] ?? 'bg-gray-100 text-gray-400';
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClasses }}">
                                {{ $inquiry->Status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-xs">{{ $inquiry->ReceivedDate->format('d/m/y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.contacts.show', $inquiry) }}"
                               class="inline-flex items-center gap-1.5 text-xs font-medium text-[#2d6fa3] hover:text-[#1d4e7a] bg-[#2d6fa3]/5 hover:bg-[#2d6fa3]/10 px-3 py-1.5 rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-gray-50">
            {{ $inquiries->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
