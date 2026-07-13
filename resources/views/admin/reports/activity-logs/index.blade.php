@extends('admin.layouts.app')

@section('title', 'Activity Logs')
@section('page-title', 'Activity Logs')
@section('breadcrumb', 'Track all administrative actions performed across the system')

@push('styles')
<style>
    .al-page { max-width: 100%; }

    .fw-600 { font-weight: 600 !important; }
    .fw-500 { font-weight: 500 !important; }
    .text-dark { color: #0f172a !important; }
    .truncate-text {
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .al-stats {
        display: flex;
        gap: 8px;
    }
    .al-stats .stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        color: #475569;
        background: #f1f4f9;
        border: 1px solid #e2e8f0;
    }
    .al-stats .stat-pill strong {
        font-weight: 700;
        color: #1d4e7a;
        font-size: 14px;
    }
    .al-stats .stat-pill .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .al-stats .stat-pill .dot.total { background: #1d4e7a; }
    .al-stats .stat-pill .dot.page { background: #22c55e; }

    .al-filter {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e9edf2;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04), 0 4px 16px rgba(0,0,0,0.03);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .al-filter-header {
        padding: 14px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .al-filter-header svg { width: 16px; height: 16px; color: #64748b; }
    .al-filter-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
        margin: 0;
    }
    .al-filter-body { padding: 20px 24px; }
    .al-filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 14px;
    }
    .al-filter-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .al-filter-group label {
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .al-filter-group input,
    .al-filter-group select {
        padding: 10px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.2s ease;
        background: #fafbfc;
        color: #0f172a;
        outline: none;
    }
    .al-filter-group input:focus,
    .al-filter-group select:focus {
        border-color: #1d4e7a;
        box-shadow: 0 0 0 3px rgba(29, 78, 122, 0.1);
        background: #fff;
    }
    .al-filter-group select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%2364748b' d='M5 7L1 3h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 36px;
        cursor: pointer;
    }
    .al-filter-actions {
        display: flex;
        gap: 10px;
        padding: 16px 24px;
        background: #f8fafc;
        border-top: 1px solid #edf2f7;
    }
    .al-filter-actions .btn-filter {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: #1d4e7a;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .al-filter-actions .btn-filter:hover {
        background: #0f3a5c;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(29, 78, 122, 0.25);
    }
    .al-filter-actions .btn-filter svg { width: 16px; height: 16px; }
    .al-filter-actions .btn-reset {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        background: transparent;
        color: #64748b;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .al-filter-actions .btn-reset:hover {
        background: #f1f5f9;
        color: #0f172a;
        border-color: #cbd5e1;
    }

    .al-table-wrap {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e9edf2;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04), 0 4px 16px rgba(0,0,0,0.03);
        overflow: hidden;
    }
    .al-table-header {
        padding: 16px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .al-table-header h3 {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .al-table-header .count-badge {
        font-size: 12px;
        font-weight: 600;
        color: #1d4e7a;
        background: #e8f0fe;
        padding: 3px 14px;
        border-radius: 20px;
    }

    .al-table {
        width: 100%;
        border-collapse: collapse;
    }
    .al-table thead th {
        padding: 12px 20px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        background: #f1f4f9;
        border-bottom: 2px solid #e2e8f0;
    }
    .al-table tbody tr {
        border-bottom: 1px solid #f1f4f9;
        transition: background 0.12s ease;
    }
    .al-table tbody tr:last-child { border-bottom: none; }
    .al-table tbody tr:hover { background: #f0f7ff; }
    .al-table tbody tr:nth-child(even) { background: #fafbfc; }
    .al-table tbody tr:nth-child(even):hover { background: #f0f7ff; }
    .al-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 14px;
        color: #1e293b;
    }

    .al-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }
    .al-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .al-badge.created { background: #dcfce7; color: #166534; }
    .al-badge.created::before { background: #22c55e; }
    .al-badge.updated { background: #dbeafe; color: #1e40af; }
    .al-badge.updated::before { background: #3b82f6; }
    .al-badge.deleted { background: #fecaca; color: #991b1b; }
    .al-badge.deleted::before { background: #ef4444; }
    .al-badge.login { background: #ede9fe; color: #6d28d9; }
    .al-badge.login::before { background: #8b5cf6; }
    .al-badge.logout { background: #fed7aa; color: #9a3412; }
    .al-badge.logout::before { background: #f97316; }
    .al-badge.other { background: #f1f5f9; color: #475569; }
    .al-badge.other::before { background: #94a3b8; }

    .al-user {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .al-user .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
        color: #fff;
        background: #1d4e7a;
    }
    .al-user .avatar.system { background: #64748b; }
    .al-user .name { font-weight: 600; color: #0f172a; }

    .al-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        border: none;
        background: #eff6ff;
        color: #1d4e7a;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .al-view-btn:hover {
        background: #1d4e7a;
        color: #fff;
        transform: scale(1.08);
        box-shadow: 0 4px 12px rgba(29, 78, 122, 0.25);
    }
    .al-view-btn svg { width: 16px; height: 16px; }

    .al-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        white-space: nowrap;
    }
    .al-action-btn svg {
        width: 16px;
        height: 16px;
        transition: transform 0.25s ease;
    }
    .al-action-btn.primary {
        background: linear-gradient(135deg, #1d4e7a 0%, #2d6fa3 100%);
        color: #fff;
        box-shadow: 0 2px 8px rgba(29, 78, 122, 0.2);
    }
    .al-action-btn.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(29, 78, 122, 0.3);
    }
    .al-action-btn.primary:hover svg {
        transform: translateY(-1px);
    }
    .al-action-btn.primary:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(29, 78, 122, 0.2);
    }
    .al-action-btn.secondary {
        background: #fff;
        color: #1d4e7a;
        border: 1.5px solid #dde7f0;
    }
    .al-action-btn.secondary:hover {
        background: #f8fafc;
        border-color: #1d4e7a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    .al-empty {
        padding: 60px 20px;
        text-align: center;
    }
    .al-empty .icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1.5px solid #eef2f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .al-empty .icon svg { width: 28px; height: 28px; color: #cbd5e1; }
    .al-empty h4 {
        font-size: 16px;
        font-weight: 600;
        color: #0f172a;
        margin: 0 0 4px 0;
    }
    .al-empty p { font-size: 14px; color: #94a3b8; margin: 0; }

    @media (max-width: 768px) {
        .al-filter-body { padding: 16px; }
        .al-filter-grid { grid-template-columns: 1fr; }
        .al-filter-actions { flex-direction: column; }
        .al-filter-actions .btn-filter,
        .al-filter-actions .btn-reset { justify-content: center; }
        .al-table-header { flex-direction: column; align-items: flex-start; }
        .al-table thead th,
        .al-table tbody td { padding: 10px 14px; }
    }
</style>
@endpush

@section('content')
<div class="al-page">

    {{-- Filters --}}
    <div class="al-filter">
        <div class="al-filter-header">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            <h3>Filter Logs</h3>
        </div>
        <form method="GET" action="{{ route('admin.reports.activity-logs.index') }}">
            <div class="al-filter-body">
                <div class="al-filter-grid">
                    <div class="al-filter-group">
                        <label for="search">Search</label>
                        <input id="search" name="search" type="text" value="{{ $search }}" placeholder="Description, action, subject…">
                    </div>
                    <div class="al-filter-group">
                        <label for="action">Action</label>
                        <select id="action" name="action">
                            <option value="">All actions</option>
                            @foreach($actions as $a)
                                <option value="{{ $a }}" @selected($a === $action)>{{ ucfirst($a) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="al-filter-group">
                        <label for="user_id">User</label>
                        <select id="user_id" name="user_id">
                            <option value="">All users</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" @selected($u->id == $userId)>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="al-filter-actions">
                <button type="submit" class="btn-filter">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Apply Filters
                </button>
                <a href="{{ route('admin.reports.activity-logs.index') }}" class="btn-reset">Reset</a>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="al-table-wrap">
        <div class="al-table-header">
            <h3>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18" style="color:#64748b;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Activity Logs
            </h3>
            <div class="flex items-center gap-3" style="flex-wrap:wrap;">
                <div class="al-stats">
                    <span class="stat-pill">
                        <span class="dot total"></span>
                        Total: <strong>{{ $logs->total() }}</strong>
                    </span>
                    <span class="stat-pill">
                        <span class="dot page"></span>
                        This page: <strong>{{ $logs->count() }}</strong>
                    </span>
                </div>
                <a href="{{ request()->fullUrl() }}" class="al-action-btn secondary" title="Refresh current view">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Refresh
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="al-table">
                <thead>
                    <tr>
                        <th style="width:140px">Date</th>
                        <th style="width:180px">User</th>
                        <th style="width:110px">Action</th>
                        <th style="width:160px">Subject</th>
                        <th>Description</th>
                        <th style="width:60px;text-align:center">View</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td class="whitespace-nowrap">
                                <div class="fw-600 text-dark">{{ $log->created_at->format('d M Y') }}</div>
                                <div style="font-size:12px;color:#94a3b8;">{{ $log->created_at->format('H:i') }}</div>
                            </td>
                            <td>
                                <div class="al-user">
                                    <span class="avatar {{ !$log->user?->name || $log->user->name === 'System' ? 'system' : '' }}">
                                        {{ strtoupper(substr($log->user?->name ?? 'S', 0, 1)) }}
                                    </span>
                                    <span class="name">{{ $log->user?->name ?? 'System' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="al-badge {{ in_array($log->action, ['created', 'updated', 'deleted', 'login', 'logout']) ? $log->action : 'other' }}">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td>
                                @if($log->subject_type)
                                    <div class="fw-500 text-dark">{{ class_basename($log->subject_type) }}</div>
                                    <div style="font-size:12px;color:#94a3b8;">ID: {{ $log->subject_id }}</div>
                                @else
                                    <span style="color:#94a3b8;">—</span>
                                @endif
                            </td>
                            <td style="max-width:320px;">
                                <p class="truncate-text" title="{{ $log->description }}">
                                    {{ $log->description ?? '—' }}
                                </p>
                            </td>
                            <td style="text-align:center;">
                                <a href="{{ route('admin.reports.activity-logs.show', $log) }}" class="al-view-btn" title="View details">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="al-empty">
                                    <div class="icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="28" height="28">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <h4>No activity logs found</h4>
                                    <p>Try adjusting your search or filter criteria.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $logs->links('admin.partials.pagination-pills') }}
            </div>
        @endif
    </div>

</div>
@endsection
