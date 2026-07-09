@extends('admin.layouts.app')

@section('title', 'Offices')
@section('page-title', 'Offices')
@section('breadcrumb', 'Manage office locations, Google Maps links, phone, email, and hours')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Manage your office locations worldwide.</p>
    <a href="{{ route('admin.offices.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] text-white text-sm font-medium rounded-xl hover:bg-[#1d4e7a] transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Office
    </a>
</div>

@if($offices->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 p-12 text-center shadow-sm">
    <div class="text-5xl mb-4">🏢</div>
    <h3 class="text-lg font-bold text-gray-800 mb-2">No offices yet</h3>
    <p class="text-gray-400 text-sm mb-6">Add your first office location to display on the contact page.</p>
    <a href="{{ route('admin.offices.create') }}" class="btn-primary inline-flex">Add Office</a>
</div>
@else
<div class="space-y-4">
    @foreach($offices as $office)
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-shadow {{ !$office->is_active ? 'opacity-60' : '' }}">
        <div class="flex items-start justify-between gap-4">
            <div class="flex items-start gap-4 flex-1 min-w-0">
                <div class="text-3xl flex-shrink-0 mt-1">{{ $office->flag ?? '🏢' }}</div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <h4 class="font-bold text-gray-800 text-base">{{ $office->name }}</h4>
                        @if(!$office->is_active)
                        <span class="text-[10px] uppercase tracking-wider font-bold px-2 py-0.5 rounded-full bg-gray-100 text-gray-500">Inactive</span>
                        @endif
                    </div>
                    @if($office->address)
                    <p class="text-gray-500 text-xs mb-2 leading-relaxed">{{ Str::limit($office->address, 100) }}</p>
                    @endif
                    <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-400">
                        @if($office->phone)
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $office->phone }}
                        </span>
                        @endif
                        @if($office->email)
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ $office->email }}
                        </span>
                        @endif
                        @if($office->google_maps_link)
                        <span class="flex items-center gap-1 text-[#2d6fa3]">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Map link set
                        </span>
                        @endif
                        @if($office->office_hours)
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Hours set
                        </span>
                        @endif
                        <span class="text-gray-300">·</span>
                        <span>Order: {{ $office->sort_order }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('admin.offices.edit', $office) }}"
                   class="p-2 rounded-lg text-gray-400 hover:text-[#2d6fa3] hover:bg-blue-50 transition-all"
                   title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </a>
                <form method="POST" action="{{ route('admin.offices.destroy', $office) }}"
                      onsubmit="return confirm('Delete this office? This cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all"
                            title="Delete">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
