@extends('admin.layouts.app')

@section('title', 'Contact Inquiries')
@section('page-title', 'Contact Inquiries')
@section('breadcrumb', 'Manage messages received from the contact form')

@section('content')

{{-- Search & Filter --}}
<div class="bg-white rounded-2xl border border-gray-100 p-5 mb-6">
    <form method="GET" action="{{ route('admin.contacts.index') }}" id="searchForm">
        <div class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
            {{-- Search by Sender Name --}}
            <div class="flex-[2] w-full">
                <label for="name" class="block text-xs font-medium text-gray-500 mb-1">Search by Sender Name</label>
                <input type="text" name="name" id="name" value="{{ request('name') }}"
                       placeholder="Search sender name..."
                       autocomplete="off"
                       class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm"
                       oninput="debouncedSearch(this)">
            </div>

            {{-- Filter by Status --}}
            <div class="w-full sm:w-48">
                <label for="status" class="block text-xs font-medium text-gray-500 mb-1">Filter by Status</label>
                <select name="status" id="status" onchange="this.form.submit()"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm bg-white">
                    <option value="">All Statuses</option>
                    <option value="New"      {{ request('status') === 'New'      ? 'selected' : '' }}>New</option>
                    <option value="Read"     {{ request('status') === 'Read'     ? 'selected' : '' }}>Read</option>
                    <option value="Replied"  {{ request('status') === 'Replied'  ? 'selected' : '' }}>Replied</option>
                    <option value="Archived" {{ request('status') === 'Archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-[#2d6fa3] text-white text-sm font-medium rounded-xl hover:bg-[#1d4e7a] transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Search
                </button>
                @if(request('name') || request('status'))
                    <a href="{{ route('admin.contacts.index') }}"
                       class="inline-flex items-center gap-1.5 px-5 py-2.5 border border-gray-200 text-gray-500 text-sm font-medium rounded-xl hover:bg-gray-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

<script>
    let searchTimeout;
    function debouncedSearch(input) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            input.form.submit();
        }, 300);
    }
</script>

{{-- Inquiries Table --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    @if($inquiries->isEmpty())
        <div class="px-6 py-16 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-400 text-sm">No contact inquiries found.</p>
            @if(request('name') || request('status'))
                <a href="{{ route('admin.contacts.index') }}" class="text-[#2d6fa3] text-sm hover:underline mt-2 inline-block">Clear filters</a>
            @endif
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#2d6fa3]/10 text-xs text-[#2d6fa3] uppercase tracking-wider">
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
                    <tr class="hover:bg-gray-50/50 transition-colors {{ $inquiry->Status === 'New' ? 'bg-blue-50/30' : '' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                                    <span class="text-xs font-bold text-[#2d6fa3]">{{ substr($inquiry->Name, 0, 2) }}</span>
                                </div>
                                <span class="{{ $inquiry->Status === 'New' ? 'font-semibold text-gray-800' : 'font-medium text-gray-700' }}">{{ $inquiry->Name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="mailto:{{ $inquiry->Email }}" class="text-gray-500 hover:text-[#2d6fa3] transition-colors">{{ $inquiry->Email }}</a>
                        </td>
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
                        <td class="px-6 py-4 text-gray-400 text-xs whitespace-nowrap">{{ $inquiry->ReceivedDate->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <form method="POST" action="{{ route('admin.contacts.destroy', $inquiry) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 text-xs font-medium text-red-500 hover:text-red-600 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-all"
                                            title="Delete inquiry">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('admin.contacts.show', $inquiry) }}"
                                   class="inline-flex items-center gap-1 text-xs font-medium text-[#2d6fa3] hover:text-[#1d4e7a] bg-[#2d6fa3]/5 hover:bg-[#2d6fa3]/10 px-3 py-1.5 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                            </div>
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
