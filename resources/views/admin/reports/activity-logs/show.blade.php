@extends('admin.layouts.app')

@section('title', 'Activity Log — #' . $activityLog->id)
@section('page-title', 'Activity Log')
@section('breadcrumb', 'Activity Logs / #' . $activityLog->id)

@push('styles')
<style>
    /* ── Detail page ── */
    .al-detail {
        max-width: 900px;
        margin: 0 auto;
    }

    /* ── Back button ── */
    .al-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        color: #475569;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        margin-bottom: 20px;
    }
    .al-back:hover {
        border-color: #1d4e7a;
        color: #1d4e7a;
        background: #f0f7ff;
        transform: translateX(-2px);
    }
    .al-back svg { width: 16px; height: 16px; transition: transform 0.2s; }
    .al-back:hover svg { transform: translateX(-2px); }

    /* ── Card ── */
    .al-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e9edf2;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04), 0 4px 16px rgba(0,0,0,0.03);
        overflow: hidden;
        margin-bottom: 20px;
    }
    .al-card-header {
        padding: 14px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .al-card-header svg { width: 16px; height: 16px; color: #64748b; flex-shrink: 0; }
    .al-card-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
        margin: 0;
    }
    .al-card-body {
        padding: 24px;
    }

    /* ── Detail grid ── */
    .al-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .al-detail-field {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .al-detail-field.full-width {
        grid-column: 1 / -1;
    }
    .al-detail-field .label {
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .al-detail-field .value {
        font-size: 15px;
        font-weight: 500;
        color: #0f172a;
        padding: 8px 12px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #f1f4f9;
    }
    .al-detail-field .value.user-agent {
        font-size: 12px;
        word-break: break-all;
        font-family: 'SF Mono', 'Fira Code', 'Consolas', monospace;
        color: #475569;
    }

    /* ── Action badge (inline) ── */
    .al-badge-inline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .al-badge-inline::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .al-badge-inline.created { background: #dcfce7; color: #166534; }
    .al-badge-inline.created::before { background: #22c55e; }
    .al-badge-inline.updated { background: #dbeafe; color: #1e40af; }
    .al-badge-inline.updated::before { background: #3b82f6; }
    .al-badge-inline.deleted { background: #fecaca; color: #991b1b; }
    .al-badge-inline.deleted::before { background: #ef4444; }
    .al-badge-inline.login { background: #ede9fe; color: #6d28d9; }
    .al-badge-inline.login::before { background: #8b5cf6; }
    .al-badge-inline.logout { background: #fed7aa; color: #9a3412; }
    .al-badge-inline.logout::before { background: #f97316; }
    .al-badge-inline.other { background: #f1f5f9; color: #475569; }
    .al-badge-inline.other::before { background: #94a3b8; }

    /* ── JSON / properties ── */
    .al-json {
        background: #0f172a;
        border-radius: 12px;
        padding: 20px 24px;
        overflow-x: auto;
        font-family: 'SF Mono', 'Fira Code', 'Consolas', monospace;
        font-size: 13px;
        line-height: 1.7;
        color: #e2e8f0;
        margin: 0;
        border: 1px solid #1e293b;
    }
    .al-json .key { color: #93c5fd; }
    .al-json .string { color: #a7f3d0; }
    .al-json .number { color: #fde68a; }
    .al-json .boolean { color: #c4b5fd; }
    .al-json .null { color: #fca5a5; }
    .al-json .bracket { color: #94a3b8; }

    .al-empty-json {
        padding: 32px;
        text-align: center;
        color: #94a3b8;
        font-size: 14px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px dashed #e2e8f0;
    }

    /* ── Responsive ── */
    @media (max-width: 640px) {
        .al-detail-grid { grid-template-columns: 1fr; }
        .al-card-body { padding: 16px; }
    }
</style>
@endpush

@section('content')
<div class="al-detail">

    {{-- ── Back link ── --}}
    <a href="{{ route('admin.reports.activity-logs.index') }}" class="al-back">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Activity Logs
    </a>

    {{-- ── Details card ── --}}
    <div class="al-card">
        <div class="al-card-header">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3>Log Details — #{{ $activityLog->id }}</h3>
        </div>
        <div class="al-card-body">
            <div class="al-detail-grid">
                <div class="al-detail-field">
                    <span class="label">Action</span>
                    <span class="value">
                        <span class="al-badge-inline
                            @if($activityLog->action === 'created') created
                            @elseif($activityLog->action === 'updated') updated
                            @elseif($activityLog->action === 'deleted') deleted
                            @elseif($activityLog->action === 'login') login
                            @elseif($activityLog->action === 'logout') logout
                            @else other @endif">
                            {{ ucfirst($activityLog->action) }}
                        </span>
                    </span>
                </div>
                <div class="al-detail-field">
                    <span class="label">Date &amp; Time</span>
                    <span class="value">{{ $activityLog->created_at->format('d M Y, H:i:s') }}</span>
                </div>
                <div class="al-detail-field">
                    <span class="label">User</span>
                    <span class="value">{{ $activityLog->user?->name ?? 'System' }}</span>
                </div>
                <div class="al-detail-field">
                    <span class="label">Subject</span>
                    <span class="value">
                        @if($activityLog->subject_type)
                            <span>{{ class_basename($activityLog->subject_type) }}</span>
                            <span style="color:#94a3b8;font-weight:400;">#{{ $activityLog->subject_id }}</span>
                        @else
                            <span style="color:#94a3b8;">—</span>
                        @endif
                    </span>
                </div>
                <div class="al-detail-field">
                    <span class="label">IP Address</span>
                    <span class="value" style="font-family:monospace;">{{ $activityLog->ip_address ?? '—' }}</span>
                </div>
                <div class="al-detail-field">
                    <span class="label">Log ID</span>
                    <span class="value">#{{ $activityLog->id }}</span>
                </div>
                <div class="al-detail-field full-width">
                    <span class="label">Description</span>
                    <span class="value">{{ $activityLog->description ?? '—' }}</span>
                </div>
                <div class="al-detail-field full-width">
                    <span class="label">User Agent</span>
                    <span class="value user-agent">{{ $activityLog->user_agent ?? '—' }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Properties card ── --}}
    <div class="al-card">
        <div class="al-card-header">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
            </svg>
            <h3>Properties</h3>
        </div>
        <div class="al-card-body">
            @if($activityLog->properties)
                <pre class="al-json">{{ json_encode($activityLog->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
            @else
                <div class="al-empty-json">
                    <p style="margin:0;">No properties recorded for this action.</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
