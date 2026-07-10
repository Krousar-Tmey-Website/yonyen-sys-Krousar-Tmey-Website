@extends('admin.layouts.app')

@section('title', 'Volunteer Applications')
@section('page-title', 'Volunteer Applications')
@section('breadcrumb', 'Manage volunteer applications')

@section('content')

{{-- Stats Summary --}}
<div class="grid grid-cols-2 md:grid-cols-6 gap-3 mb-6">
    @php
        $statItems = [
            ['label' => 'Total',              'count' => $stats->total,              'status' => null],
            ['label' => 'Pending',            'count' => $stats->pending,            'status' => 'Pending'],
            ['label' => 'Under Review',       'count' => $stats->under_review,       'status' => 'Under Review'],
            ['label' => 'Interview Scheduled','count' => $stats->interview_scheduled,'status' => 'Interview Scheduled'],
            ['label' => 'Approved',           'count' => $stats->approved,           'status' => 'Approved'],
            ['label' => 'Rejected',           'count' => $stats->rejected,           'status' => 'Rejected'],
        ];
    @endphp
    @foreach($statItems as $item)
    <a href="{{ $item['status'] ? route('admin.volunteers.index', ['status' => $item['status']]) : route('admin.volunteers.index') }}"
       class="bg-white rounded-xl border border-gray-100 p-4 text-center hover:shadow-sm transition-shadow {{ request('status') === $item['status'] ? 'ring-2 ring-[#2d6fa3]/20 border-[#2d6fa3]/30' : '' }}">
        <p class="text-2xl font-bold text-gray-800">{{ $item['count'] }}</p>
        <p class="text-xs text-gray-500 mt-0.5">{{ $item['label'] }}</p>
    </a>
    @endforeach
</div>

{{-- Search & Filter --}}
<div class="bg-white rounded-2xl border border-gray-100 p-5 mb-6">
    <form method="GET" action="{{ route('admin.volunteers.index') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
        {{-- Search --}}
        <div class="relative flex-1 w-full">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" id="volunteerSearch" value="{{ request('search') }}" placeholder="Search by name, email, phone, or country..."
                   class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm"
                   autocomplete="off">
        </div>

        {{-- Filter --}}
        <div class="flex items-center gap-2 w-full sm:w-auto">
            <select name="status" onchange="this.form.submit()"
                    class="px-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm bg-white">
                <option value="">All Statuses</option>
                <option value="Pending"              {{ request('status') === 'Pending'              ? 'selected' : '' }}>Pending</option>
                <option value="Under Review"         {{ request('status') === 'Under Review'         ? 'selected' : '' }}>Under Review</option>
                <option value="Interview Scheduled"  {{ request('status') === 'Interview Scheduled'  ? 'selected' : '' }}>Interview Scheduled</option>
                <option value="Approved"             {{ request('status') === 'Approved'             ? 'selected' : '' }}>Approved</option>
                <option value="Rejected"             {{ request('status') === 'Rejected'             ? 'selected' : '' }}>Rejected</option>
            </select>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.volunteers.index') }}" class="px-4 py-2.5 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all text-sm whitespace-nowrap">Clear</a>
            @endif
        </div>
    </form>
</div>

{{-- Applications Table --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    @if($volunteers->isEmpty())
        <div class="px-6 py-16 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-gray-400 text-sm">No volunteer applications found.</p>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.volunteers.index') }}" class="text-[#2d6fa3] text-sm hover:underline mt-2 inline-block">Clear filters</a>
            @endif
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Program</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($volunteers as $volunteer)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                                    <span class="text-xs font-bold text-[#2d6fa3]">{{ substr($volunteer->full_name, 0, 2) }}</span>
                                </div>
                                <span class="font-medium text-gray-700">{{ $volunteer->full_name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="mailto:{{ $volunteer->email }}" class="text-gray-500 hover:text-[#2d6fa3] transition-colors">{{ $volunteer->email }}</a>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            @if($volunteer->interested_program)
                                <span class="inline-flex items-center gap-1 text-xs bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full font-medium">{{ $volunteer->interested_program }}</span>
                            @else
                                <span class="text-gray-300">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'Pending'             => 'bg-yellow-50 text-yellow-600',
                                    'Under Review'        => 'bg-blue-50 text-blue-600',
                                    'Interview Scheduled' => 'bg-purple-50 text-purple-600',
                                    'Approved'            => 'bg-green-50 text-green-600',
                                    'Rejected'            => 'bg-red-50 text-red-600',
                                ][$volunteer->status] ?? 'bg-gray-100 text-gray-400';
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClasses }}">{{ $volunteer->status }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center gap-2 justify-end">
                                <a href="{{ route('admin.volunteers.show', $volunteer) }}" title="View"
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>

                                <form action="{{ route('admin.volunteers.destroy', $volunteer) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-gray-50">
            {{ $volunteers->appends(request()->query())->links() }}
        </div>
    @endif
</div>


{{-- Debounced live search: submits form 350ms after user stops typing --}}
<script>
(function() {
    'use strict';
    const input = document.getElementById('volunteerSearch');
    if (!input) return;
    const form = input.closest('form');
    if (!form) return;
    let timer;
    input.addEventListener('input', function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
            form.submit();
        }, 350);
    });
})();
</script>

@endsection
