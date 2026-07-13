<div class="table-container">
    <table class="table-custom">
        <thead>
            <tr>
                <th style="background: #f0f9ff;">Donor</th>
                <th style="background: #f0f9ff;">Amount</th>
                <th style="background: #f0f9ff;">Type</th>
                <th style="background: #f0f9ff;">Payment</th>
                <th style="background: #f0f9ff;">Status</th>
                <th style="background: #f0f9ff;">Date</th>
                <th style="background: #f0f9ff; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donations as $donation)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-500 flex-shrink-0">
                            {{ strtoupper(substr($donation->donor?->full_name ?? '?', 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <span class="font-medium text-slate-800 block truncate">{{ $donation->donor?->full_name ?? 'Anonymous' }}</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="font-semibold text-slate-900">{{ number_format($donation->effective_amount, 2) }} $</span>
                </td>
                <td>
                    @if($donation->DonationType)
                    <span class="text-xs text-slate-500">{{ $donation->DonationType }}</span>
                    @else
                    <span class="text-xs text-slate-300">—</span>
                    @endif
                </td>
                <td>
                    <span class="text-xs text-slate-500">{{ $donation->PaymentMethod ?: '—' }}</span>
                </td>
                <td>
                    @php
                        $status = $donation->Status ?? 'Completed';
                        $ss = [
                            'Completed' => 'bg-emerald-100 text-emerald-600',
                            'Pending'   => 'bg-amber-100 text-amber-600',
                            'Failed'    => 'bg-red-100 text-red-600',
                            'Refunded'  => 'bg-purple-100 text-purple-600',
                        ];
                        $sStyle = $ss[$status] ?? 'bg-slate-100 text-slate-400';
                    @endphp
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $sStyle }}">
                        {{ $status }}
                    </span>
                </td>
                <td class="whitespace-nowrap text-xs text-slate-400">
                    {{ $donation->DonationDate ? $donation->DonationDate->format('d M Y') : '—' }}
                </td>
                <td style="text-align: center;">
                    <div class="flex items-center justify-center gap-1.5">
                        <a href="{{ route('admin.donations.show', $donation) }}" title="View" class="action-btn btn-view">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        <a href="{{ route('admin.donations.edit', $donation) }}" title="Edit" class="action-btn edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" title="Delete" class="action-btn delete" onclick="return confirm('Delete this donation record?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-16 text-center">
                    <div class="text-4xl text-slate-300 mb-3">💝</div>
                    @if($activeCount > 0)
                    <p class="text-sm text-slate-400 font-medium">No donations found.</p>
                    <p class="text-xs text-slate-400 mt-1">Try different search terms or filters.</p>
                    @else
                    <p class="text-sm text-slate-400">No donations recorded yet</p>
                    <p class="text-xs text-slate-400 mt-1">Click <strong>Add New Donation</strong> to record your first donation</p>
                    @endif
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if(method_exists($donations, 'links') && $donations->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Showing <strong>{{ $donations->firstItem() }}</strong> to <strong>{{ $donations->lastItem() }}</strong>
            of <strong>{{ $donations->total() }}</strong> donations
        </div>
        <div class="pagination-links">
            {{ $donations->appends(request()->query())->links() }}
        </div>
    </div>
    @endif
</div>
