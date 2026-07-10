@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@php use Illuminate\Support\Str; @endphp

@section('title', 'History')
@section('page-title', 'History')
@section('breadcrumb', 'Manage history events displayed on the About page')

@section('content')
<div class="form-container">
    {{-- Header with Add Button --}}
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-400">{{ $events->count() }} event(s) · displayed on About page</p>
        <a href="{{ route('admin.history.create') }}" class="btn-primary text-sm">+ Add Event</a>
    </div>

    {{-- Events List --}}
    <div class="form-card">
        <div class="card-header table-header--blue">
            <div class="icon blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3>History Events</h3>
            <span class="badge">{{ $events->count() }} total</span>
        </div>
        <div class="card-body">
            @if($events->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="empty-title">No history events yet</h4>
                <p class="empty-desc">Add your first history event to display on the About page.</p>
                <a href="{{ route('admin.history.create') }}" class="inline-flex items-center gap-2 mt-4 text-[#2d6fa3] font-medium hover:text-[#1a4a7a] transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add your first event
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Side</th>
                            <th>Event</th>
                            <th class="th-width-100 th-text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>
                                <span class="font-bold text-[#2d6fa3]">{{ $event->year }}</span>
                            </td>
                            <td>
                                <span class="text-sm text-gray-600">{{ $event->side == 'left' ? 'Left' : 'Right' }}</span>
                            </td>
                            <td>
                                <span class="text-sm text-gray-600">{{ Str::limit($event->event, 60) ?? '-' }}</span>
                            </td>
                             <td>
                                 <div class="flex items-center justify-end gap-1">
                                     {{-- View Button --}}
                                     <a href="{{ route('about') }}" 
                                        class="action-btn btn-view" 
                                        title="View About page"
                                        target="_blank">
                                         <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"/>
                                         </svg>
                                     </a>

                                     {{-- Edit Button --}}
                                     <a href="{{ route('admin.history.edit', $event) }}"
                                        class="action-btn btn-edit"
                                        title="Edit event">
                                         <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                         </svg>
                                     </a>

                                     {{-- Delete Button --}}
                                     <form action="{{ route('admin.history.destroy', $event) }}" method="POST"
                                           onsubmit="return confirm('Remove this history event?')"
                                           class="inline">
                                         @csrf @method('DELETE')
                                         <button type="submit" class="action-btn btn-delete" title="Delete event">
                                             <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            @endif
        </div>
    </div>
</div>

@endsection