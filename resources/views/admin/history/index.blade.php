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
    {{-- Events List --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-gray-800">All Events</h3>
                <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                    {{ $events->count() }}
                </span>
            </div>
            <a href="{{ route('admin.history.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Event
            </a>
        </div>
        <div class="card-body">
            @if($events->isEmpty())
            <div class="py-16 text-center text-gray-400">
                <div class="text-4xl mb-3">🕒</div>
                <p class="text-sm font-medium text-gray-500">No history events yet</p>
                <p class="text-xs mt-1">Click <strong>Add Event</strong> to display your first event on the About page.</p>
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
                                <span class="history-year">{{ $event->year }}</span>
                            </td>
                            <td>
                                <span class="text-sm text-gray-600">{{ $event->side == 'left' ? 'Left' : 'Right' }}</span>
                            </td>
                            <td>
                                <span class="text-sm text-gray-600">{{ Str::limit($event->event, 60) ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.history.edit', $event) }}"
                                       class="action-btn edit"
                                       title="Edit event">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('admin.history.destroy', $event) }}" method="POST"
                                          onsubmit="return confirm('Remove this history event?')"
                                          class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete event">
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
            @endif
        </div>
    </div>
</div>

@endsection