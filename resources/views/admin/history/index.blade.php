@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'History')
@section('page-title', 'History')
@section('breadcrumb', 'Manage history events displayed on the About page')

@section('content')

<style>
    .form-container {
        max-width: 100%;
        padding: 0;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .form-card {
        background: #ffffff;
        border: none;
        border-bottom: 1px solid #e9ecef;
        overflow: hidden;
    }
    .form-card:last-child {
        border-bottom: none;
    }

    .card-header {
        padding: 14px 24px;
        background: #e3f0ff;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .card-header .icon {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .card-header .icon.blue { background: #e3f0ff; color: #1a73e8; }

    .card-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    .card-header .badge {
        font-size: 11px;
        color: #94a3b8;
        margin-left: auto;
        background: #f1f4f9;
        padding: 2px 12px;
        border-radius: 12px;
    }

    .card-body {
        padding: 20px 24px;
    }

    .form-group {
        margin-bottom: 16px;
    }
    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #334155;
        margin-bottom: 5px;
    }
    .form-label .required {
        color: #ef4444;
    }
    .form-label .optional {
        font-weight: 400;
        color: #94a3b8;
        font-size: 12px;
    }

    .form-control {
        width: 100%;
        padding: 9px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
        background: #fafbfc;
        color: #0f172a;
    }
    .form-control:focus {
        outline: none;
        border-color: #2d6fa3;
        box-shadow: 0 0 0 3px rgba(45, 111, 163, 0.08);
        background: #ffffff;
    }
    .form-control:hover {
        background: #ffffff;
    }
    .form-control::placeholder {
        color: #a0aec0;
    }
    .form-control.error {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .form-control.textarea {
        min-height: 80px;
        resize: vertical;
        line-height: 1.6;
    }

    .form-helper {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 5px;
    }

    .form-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 4px;
    }

    .form-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        padding: 16px 24px;
        background: #fafbfc;
        border-top: 1px solid #e9ecef;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 28px;
        background: #2d6fa3;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background: #1a4a7a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(45,111,163,0.25);
    }
    .btn-primary svg {
        width: 18px;
        height: 18px;
    }

    .btn-cancel {
        padding: 10px 20px;
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        background: none;
        border: none;
        cursor: pointer;
        border-radius: 6px;
    }
    .btn-cancel:hover {
        color: #0f172a;
        background: #f1f5f9;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }
    .table-custom thead th {
        padding: 12px 20px;
        text-align: left;
        font-size: 11px;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: #f8fafc;
        border-bottom: 1px solid #eef2f6;
    }
    .table-custom tbody tr {
        border-bottom: 1px solid #f1f4f9;
        transition: background 0.15s ease;
    }
    .table-custom tbody tr:last-child {
        border-bottom: none;
    }
    .table-custom tbody tr:hover {
        background: #fafbfc;
    }
    .table-custom tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 14px;
        color: #1e293b;
    }

    .action-btn {
        padding: 6px 10px;
        border-radius: 8px;
        border: none;
        background: transparent;
        color: #94a3b8;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .action-btn:hover {
        background: #f1f4f9;
        color: #475569;
    }
    .action-btn.edit:hover {
        background: #eff6ff;
        color: #2563eb;
    }
    .action-btn.delete:hover {
        background: #fef2f2;
        color: #ef4444;
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }
    .empty-state .empty-icon {
        width: 72px;
        height: 72px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid #eef2f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .empty-state .empty-icon svg {
        color: #cbd5e1;
    }
    .empty-state .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 4px;
    }
    .empty-state .empty-desc {
        font-size: 14px;
        color: #94a3b8;
    }
</style>

<div class="form-container">
    {{-- Header with Add Button --}}
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-400">{{ $events->count() }} event(s) · displayed on About page</p>
        <a href="{{ route('admin.history.create') }}" class="btn-primary text-sm">+ Add Event</a>
    </div>

    {{-- Events List --}}
    <div class="form-card">
        <div class="card-header">
            <div class="icon blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 >History Events</h3>
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
                            <th style="width: 100px; text-align: right;">Actions</th>
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
<td style="text-align: right;">
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
