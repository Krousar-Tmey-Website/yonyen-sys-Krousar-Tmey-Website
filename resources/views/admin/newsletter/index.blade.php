@extends('admin.layouts.app')

@section('title', 'Newsletter Subscribers')
@section('page-title', 'Newsletter Subscribers')
@section('breadcrumb', 'Manage email subscribers for newsletter communications')

@section('content')
    {{-- Toolbar --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-gray-800">Subscribers</h3>
                <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                    {{ $totalCount }}
                </span>
            </div>
            <a href="{{ route('admin.newsletter.export') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-full text-sm font-semibold transition-colors border border-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export CSV
            </a>
        </div>
    </div>
<div class="flex flex-col lg:flex-row gap-4 mb-6">
    {{-- Total Subscribers --}}
    <div class="w-full lg:w-1/2 bg-white border border-gray-100 rounded-xl p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $totalCount }}</p>
                <p class="text-sm text-gray-500">Total Subscribers</p>
            </div>
        </div>
    </div>
    {{-- Search --}}
    <div class="w-full lg:w-1/2 bg-white border border-gray-100 rounded-xl p-4">
        <form method="GET" action="{{ route('admin.newsletter.index') }}" id="searchForm">
            <div class="flex flex-col gap-3">
                <label for="searchEmail" class="text-sm text-gray-500">Search by email</label>
                <div class="flex items-center gap-3">
                    <input
                        id="searchEmail"
                        type="text"
                        name="email"
                        value="{{ request('email') }}"
                        placeholder="Search by email..."
                        autocomplete="off"
                        oninput="debouncedSearch(this)"
                        class="flex-1 px-4 py-2 text-sm border border-gray-200 rounded-lg focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20">

                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-[#2d6fa3] rounded-lg hover:bg-[#245a87] transition-all">
                        Search
                    </button>
                    @if(request('email'))
                        <a href="{{ route('admin.newsletter.index') }}"
                            class="px-4 py-2 text-sm border border-gray-200 rounded-lg hover:bg-gray-50">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
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

    {{-- Subscribers Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        @if ($subscribers->isEmpty())
            <div class="py-16 text-center text-gray-400">
                <div class="text-4xl mb-3">📧</div>
                <p class="text-sm font-medium text-gray-500">No subscribers yet</p>
                <p class="text-xs mt-1">Newsletter sign-ups from the public site will appear here.</p>
                @if (request('email'))
                    <a href="{{ route('admin.newsletter.index') }}"
                        class="text-[#2d6fa3] text-sm hover:underline mt-2 inline-block">Clear search</a>
                @endif
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#2d6fa3]/10 text-xs text-[#2d6fa3] uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Subscribed Date</th>
                            <th class="px-6 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($subscribers as $subscriber)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-gray-700">{{ $subscriber->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs whitespace-nowrap">
                                    {{ $subscriber->subscribed_at?->format('d M Y') ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form method="POST" action="{{ route('admin.newsletter.destroy', $subscriber) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Delete this subscriber? This cannot be undone.')"
                                            class="action-btn btn-delete"
                                            title="Delete Subscriber">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="pagination-links px-6 py-4 border-t border-gray-50">
                {{ $subscribers->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
