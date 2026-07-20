@extends('admin.layouts.app')

@section('title', 'Newsletter Campaigns')
@section('page-title', 'Newsletter Campaigns')
@section('breadcrumb', 'Create and send newsletters to subscribers')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white border border-gray-100 rounded-xl p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $totalSubscribers }}</p>
                <p class="text-sm text-gray-500">Total Subscribers</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-100 rounded-xl p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $campaigns->whereIn('status', ['sent', 'partial'])->count() }}</p>
                <p class="text-sm text-gray-500">Sent Campaigns</p>
            </div>
        </div>
    </div>
    <div class="bg-white border border-gray-100 rounded-xl p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $campaigns->where('status', 'draft')->count() }}</p>
                <p class="text-sm text-gray-500">Draft Campaigns</p>
            </div>
        </div>
    </div>
</div>

{{-- Top actions --}}
<div class="flex items-center justify-end mb-6">
    <a href="{{ route('admin.newsletter.campaigns.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Campaign
    </a>
</div>

{{-- Campaigns Table --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    @if ($campaigns->isEmpty())
        <div class="px-6 py-16 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
            </svg>
            <p class="text-gray-400 text-sm">No campaigns yet.</p>
            <a href="{{ route('admin.newsletter.campaigns.create') }}"
               class="text-[#2d6fa3] text-sm hover:underline mt-2 inline-block">Create your first newsletter campaign</a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#2d6fa3]/10 text-xs text-[#2d6fa3] uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Subject</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-center">Recipients</th>
                        <th class="px-6 py-3 text-center">Sent / Failed</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($campaigns as $campaign)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-800 block max-w-[300px] truncate">{{ $campaign->subject }}</span>
                                        @if($campaign->sent_at)
                                            <span class="text-[10px] text-gray-400">Sent {{ $campaign->sent_at->format('M j, Y') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusStyles = [
                                        'draft'   => 'bg-yellow-50 text-yellow-700',
                                        'sending' => 'bg-blue-50 text-blue-700',
                                        'sent'    => 'bg-green-50 text-green-700',
                                        'partial' => 'bg-orange-50 text-orange-700',
                                        'failed'  => 'bg-red-50 text-red-700',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $statusStyles[$campaign->status] ?? 'bg-gray-100 text-gray-500' }}">
                                    {{ ucfirst($campaign->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-gray-500">{{ $campaign->total_recipients ?: '—' }}</td>
                            <td class="px-6 py-4">
                                @if($campaign->sent_count > 0 || $campaign->failed_count > 0)
                                    <div class="flex items-center justify-center gap-2 text-xs">
                                        <span class="text-green-600 font-medium">{{ $campaign->sent_count }}</span>
                                        <span class="text-gray-300">/</span>
                                        <span class="text-red-500 font-medium">{{ $campaign->failed_count }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-300 text-center block">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-xs whitespace-nowrap">{{ $campaign->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.newsletter.campaigns.show', $campaign) }}"
                                       class="action-btn btn-view" title="View Campaign">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    @if($campaign->isDraft())
                                        <a href="{{ route('admin.newsletter.campaigns.edit', $campaign) }}"
                                           class="action-btn edit" title="Edit Campaign">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.newsletter.campaigns.destroy', $campaign) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Delete this campaign draft?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Delete Campaign">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-links px-6 py-4 border-t border-gray-50">
            {{ $campaigns->links() }}
        </div>
    @endif
</div>

@endsection
