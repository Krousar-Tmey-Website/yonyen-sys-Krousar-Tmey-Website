@extends('admin.layouts.app')

@section('title', 'Donation Campaigns')
@section('page-title', 'Donation Campaigns')
@section('breadcrumb', 'Manage campaigns to collect donations from supporters')

@section('content')

<div class="form-container">

    {{-- Page Header --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Donation Campaigns</h1>
                    <p class="text-sm text-gray-400 mt-0.5">Create and manage your fundraising campaigns</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-3 px-4 py-2 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-xs font-medium text-gray-500"><span class="text-gray-800">{{ $activeCampaigns }}</span> active</span>
                    </div>
                    <span class="text-gray-200">|</span>
                    <span class="text-xs font-medium text-gray-500"><span class="text-gray-800">{{ $totalCampaigns }}</span> total</span>
                </div>
                <a href="{{ route('admin.campaigns.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    New Campaign
                </a>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800 leading-none">{{ $totalCampaigns }}</div>
                    <div class="text-xs text-gray-400 mt-1">Total Campaigns</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-50 to-emerald-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800 leading-none">{{ $activeCampaigns }}</div>
                    <div class="text-xs text-gray-400 mt-1">Active</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800 leading-none">${{ number_format($totalGoal, 0) }}</div>
                    <div class="text-xs text-gray-400 mt-1">Total Goal</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-50 to-purple-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800 leading-none">{{ $avgProgress }}%</div>
                    <div class="text-xs text-gray-400 mt-1">Avg Progress</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters Bar --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm mb-6 overflow-hidden">
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
                               class="w-full pl-10 pr-10 py-2.5 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] outline-none bg-white transition-all"
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
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <select name="status" onchange="window.location.href = this.value ? '{{ route('admin.campaigns.index') }}?status=' + this.value : '{{ route('admin.campaigns.index') }}'"
                            class="pl-9 pr-8 py-2.5 border border-gray-200 rounded-lg text-sm bg-white focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] outline-none min-w-[150px] appearance-none cursor-pointer"
                            style="background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%2364748b' d='M5 7L1 3h8z'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px;">
                        <option value="">All statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ended" {{ request('status') === 'ended' ? 'selected' : '' }}>Ended</option>
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
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-50/50 border-b border-gray-100">
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider w-[40%]">Campaign</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Goal</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Progress</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Dates</th>
                        <th class="text-center px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($campaigns as $campaign)
                    <tr class="hover:bg-blue-50/20 transition-colors group">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if($campaign->image_url)
                                <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100 ring-1 ring-gray-200">
                                    <img src="{{ $campaign->image_url }}" alt="" class="w-full h-full object-cover">
                                </div>
                                @else
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#2d6fa3]/10 to-[#8da83a]/10 flex items-center justify-center flex-shrink-0 ring-1 ring-gray-200">
                                    <svg class="w-5 h-5 text-[#2d6fa3]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1.5">
                                        <div class="text-sm font-semibold text-gray-800 truncate max-w-[180px]">{{ $campaign->title }}</div>
                                        @if($campaign->has_video)
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-red-50 text-xs flex-shrink-0" title="Video attached">🎬</span>
                                        @endif
                                        @if($campaign->has_pdf)
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-green-50 text-xs flex-shrink-0" title="PDF attached">📄</span>
                                        @endif
                                    </div>
                                    @if($campaign->description)
                                    <div class="text-xs text-gray-400 truncate max-w-[220px]">{{ Str::limit($campaign->description, 55) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="text-sm font-bold text-gray-800">{{ $campaign->formatted_goal }}</div>
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
                                <span class="text-xs font-semibold text-gray-500 whitespace-nowrap tabular-nums">{{ $campaign->progress_percentage }}%</span>
                            </div>
                            <div class="text-[11px] text-gray-400 mt-1">{{ $campaign->formatted_collected }} raised</div>
                        </td>
                        <td class="px-5 py-4 hidden md:table-cell">
                            <div class="text-xs text-gray-500">
                                @if($campaign->start_date)
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    {{ $campaign->start_date->format('M d, Y') }}
                                </div>
                                @else
                                <div class="text-gray-300">—</div>
                                @endif
                                @if($campaign->end_date)
                                <div class="text-gray-400 flex items-center gap-1 mt-0.5">
                                    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    {{ $campaign->end_date->format('M d, Y') }}
                                </div>
                                @endif
                            </div>
                            @if($campaign->days_remaining !== null)
                            <div class="text-[11px] mt-1 {{ $campaign->days_remaining > 0 ? 'text-blue-500 font-medium' : 'text-gray-400' }}">
                                {{ $campaign->days_remaining_label }}
                            </div>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold leading-none
                                {{ $campaign->status === 'active' ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200' : '' }}
                                {{ $campaign->status === 'upcoming' ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-200' : '' }}
                                {{ $campaign->status === 'ended' ? 'bg-gray-100 text-gray-500 ring-1 ring-gray-200' : '' }}
                                {{ $campaign->status === 'inactive' ? 'bg-gray-50 text-gray-400 ring-1 ring-gray-200' : '' }}">
                                <span class="w-1.5 h-1.5 rounded-full
                                    {{ $campaign->status === 'active' ? 'bg-emerald-500 animate-pulse' : '' }}
                                    {{ $campaign->status === 'upcoming' ? 'bg-blue-500' : '' }}
                                    {{ $campaign->status === 'ended' ? 'bg-gray-400' : '' }}
                                    {{ $campaign->status === 'inactive' ? 'bg-gray-400' : '' }}"></span>
                                {{ $campaign->status_label }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                {{-- Toggle active/inactive --}}
                                <form action="{{ route('admin.campaigns.toggle', $campaign) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="{{ $campaign->is_active ? 'Deactivate' : 'Activate' }}"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110
                                            {{ $campaign->is_active ? 'bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100 hover:text-emerald-700' }}">
                                        @if($campaign->is_active)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        @endif
                                    </button>
                                </form>

                                {{-- Preview --}}
                                <a href="{{ route('admin.campaigns.preview', $campaign) }}" target="_blank" title="Preview campaign"
                                   class="w-8 h-8 rounded-lg flex items-center justify-center bg-purple-50 text-purple-600 hover:bg-purple-100 hover:text-purple-700 transition-all duration-200 hover:scale-110">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('admin.campaigns.edit', $campaign) }}" title="Edit campaign"
                                   class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-200 hover:scale-110">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST"
                                      onsubmit="return confirm('Delete &quot;{{ addslashes($campaign->title) }}&quot;? This will permanently remove it and all attached files.');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete campaign"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 transition-all duration-200 hover:scale-110">
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
        <div class="px-5 py-3 bg-gradient-to-r from-gray-50/50 to-gray-50 border-t border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-4 text-xs text-gray-500">
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    <strong class="text-gray-700">{{ $totalCampaigns }}</strong> total
                </span>
                <span class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <strong class="text-emerald-700">{{ $activeCampaigns }}</strong> active
                </span>
                <span class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                    <strong class="text-gray-500">{{ $totalCampaigns - $activeCampaigns }}</strong> inactive
                </span>
            </div>
            <div class="text-[11px] text-gray-400">
                <span class="hidden sm:inline">Last updated </span>{{ now()->format('M d, Y g:i A') }}
            </div>
        </div>
        @else
        {{-- Empty state --}}
        <div class="text-center py-20 px-6">
            @if(request()->anyFilled(['search', 'status']))
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <p class="text-gray-500 font-semibold">No campaigns match your filters</p>
            <a href="{{ route('admin.campaigns.index') }}" class="mt-3 inline-flex items-center gap-1 text-sm text-[#2d6fa3] hover:underline font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                Clear all filters
            </a>
            @else
            <div class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-[#2d6fa3]/10 to-[#8da83a]/10 border border-gray-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h3 class="text-gray-800 font-bold text-lg">No campaigns yet</h3>
            <p class="text-gray-400 text-sm mt-1 max-w-sm mx-auto">Create your first donation campaign to start collecting funds and sharing your mission.</p>
            <a href="{{ route('admin.campaigns.create') }}" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-[#2d6fa3] text-white text-sm font-semibold rounded-xl hover:bg-[#1d4e7a] transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Create Campaign
            </a>
            @endif
        </div>
        @endif
    </div>

    {{-- Quick Tips --}}
    <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50/50 border border-blue-100 rounded-xl px-5 py-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="text-sm font-semibold text-blue-900">Quick Tips</p>
            <ul class="text-xs text-blue-700/70 mt-1.5 pl-4 list-disc space-y-1">
                <li>Only campaigns marked as <strong>Active</strong> will appear on the public donation page.</li>
                <li>Use the toggle button to quickly activate/deactivate a campaign without opening it.</li>
                <li><strong>Sort order</strong> controls the display priority — lower numbers appear first.</li>
                <li>Upload a video 🎬 or PDF 📄 to provide more campaign information to donors.</li>
                <li>Set a date range to show time-limited campaigns with <strong>days remaining</strong> countdown.</li>
            </ul>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

@endsection
