@extends('admin.layouts.app')

@section('title', 'Donation Campaigns')
@section('page-title', 'Donation Campaigns')
@section('breadcrumb', 'Manage campaigns to collect donations from supporters')

@section('content')

<div class="form-container">

    {{-- Header with create button --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-gray-700 font-semibold">All Campaigns <span class="text-gray-400 font-normal text-sm ml-1">({{ $campaigns->count() }} total)</span></h2>
        </div>
        <a href="{{ route('admin.campaigns.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            New Campaign
        </a>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm mb-5 overflow-hidden">
        <div class="px-5 py-3.5 bg-gray-50/50 border-b border-gray-100">
            <div class="flex flex-wrap items-center gap-3">
                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px]">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <form method="GET" action="{{ route('admin.campaigns.index') }}" id="searchForm">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search by title..."
                               class="w-full pl-10 pr-10 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] outline-none bg-white transition-all"
                               onchange="this.form.submit()">
                        @if(request('search'))
                        <a href="{{ route('admin.campaigns.index', array_filter(request()->except('search'))) }}"
                           class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </a>
                        @endif
                    </form>
                </div>

                {{-- Status filter --}}
                <div>
                    <select name="status" onchange="window.location.href = this.value ? '{{ route('admin.campaigns.index') }}?status=' + this.value : '{{ route('admin.campaigns.index') }}'"
                            class="px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] outline-none min-w-[140px]">
                        <option value="">All statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                @if(request()->anyFilled(['search', 'status']))
                <a href="{{ route('admin.campaigns.index') }}"
                   class="text-xs text-[#2d6fa3] hover:underline font-medium">
                    Clear all filters
                </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Campaigns Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        @if($campaigns->count())
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Campaign</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Goal</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Progress</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dates</th>
                        <th class="text-center px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($campaigns as $campaign)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if($campaign->image_url)
                                <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                                    <img src="{{ $campaign->image_url }}" alt="" class="w-full h-full object-cover">
                                </div>
                                @else
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#2d6fa3]/10 to-[#8da83a]/10 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-[#2d6fa3]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-800 truncate max-w-[200px]">{{ $campaign->title }}</div>
                                    @if($campaign->description)
                                    <div class="text-xs text-gray-400 truncate max-w-[220px]">{{ Str::limit($campaign->description, 60) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="text-sm font-semibold text-gray-800">{{ $campaign->formatted_goal }}</div>
                        </td>
                        <td class="px-5 py-4 min-w-[180px]">
                            <div class="flex items-center gap-3">
                                <div class="flex-1">
                                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full rounded-full transition-all duration-500 ease-out"
                                             style="width: {{ $campaign->progress_percentage }}%; background: {{ $campaign->progress_percentage >= 100 ? '#16a34a' : '#2d6fa3' }};">
                                        </div>
                                    </div>
                                </div>
                                <span class="text-xs font-medium text-gray-500 whitespace-nowrap">
                                    {{ $campaign->progress_percentage }}%
                                </span>
                            </div>
                            <div class="text-[11px] text-gray-400 mt-1">
                                {{ $campaign->formatted_collected }} raised
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="text-xs text-gray-500">
                                @if($campaign->start_date)
                                <div>{{ $campaign->start_date->format('M d, Y') }}</div>
                                @else
                                <div class="text-gray-300">—</div>
                                @endif
                                @if($campaign->end_date)
                                <div class="text-gray-400">→ {{ $campaign->end_date->format('M d, Y') }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <div class="flex flex-col items-center gap-1.5">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $campaign->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $campaign->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                    {{ $campaign->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                {{-- Toggle active/inactive --}}
                                <form action="{{ route('admin.campaigns.toggle', $campaign) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="{{ $campaign->is_active ? 'Deactivate' : 'Activate' }}"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center transition-all
                                            {{ $campaign->is_active ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}">
                                        @if($campaign->is_active)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        @endif
                                    </button>
                                </form>

                                {{-- Edit --}}
                                <a href="{{ route('admin.campaigns.edit', $campaign) }}"
                                   class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-100 transition-all"
                                   title="Edit campaign">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST"
                                      onsubmit="return confirm('Delete &quot;{{ addslashes($campaign->title) }}&quot;? This will permanently remove it.');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-100 transition-all"
                                            title="Delete campaign">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Summary footer --}}
        <div class="px-5 py-3 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-4 text-xs text-gray-500">
                <span><strong class="text-gray-700">{{ $campaigns->count() }}</strong> total campaigns</span>
                <span><strong class="text-emerald-700">{{ $campaigns->where('is_active', true)->count() }}</strong> active</span>
                <span><strong class="text-gray-500">{{ $campaigns->where('is_active', false)->count() }}</strong> inactive</span>
            </div>
            <div class="text-[11px] text-gray-400">
                Updated {{ now()->format('M d, Y g:i A') }}
            </div>
        </div>
        @else
        {{-- Empty state --}}
        <div class="text-center py-20 px-6">
            @if(request()->anyFilled(['search', 'status']))
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <p class="text-gray-500 font-medium">No campaigns match your filters</p>
            <a href="{{ route('admin.campaigns.index') }}" class="mt-2 inline-block text-sm text-[#2d6fa3] hover:underline">Clear all filters</a>
            @else
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-[#2d6fa3]/10 to-[#8da83a]/10 border border-gray-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h3 class="text-gray-700 font-semibold text-lg">No campaigns yet</h3>
            <p class="text-gray-400 text-sm mt-1">Create your first donation campaign to start collecting funds.</p>
            <a href="{{ route('admin.campaigns.create') }}" class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] text-white text-sm font-medium rounded-xl hover:bg-[#1d4e7a] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Create Campaign
            </a>
            @endif
        </div>
        @endif
    </div>

    {{-- Quick Tips --}}
    <div class="mt-5 bg-blue-50 border border-blue-100 rounded-xl px-5 py-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="text-sm font-medium text-blue-900">Quick Tips</p>
            <ul class="text-xs text-blue-700/70 mt-1 pl-4 list-disc space-y-0.5">
                <li>Only campaigns marked as <strong>Active</strong> will appear on the public donation page.</li>
                <li>Use the toggle button to quickly activate/deactivate a campaign without opening it.</li>
                <li>The progress bar shows the percentage of the goal that has been collected.</li>
                <li>You can set a date range for time-limited campaigns.</li>
            </ul>
        </div>
    </div>
</div>

@endsection
