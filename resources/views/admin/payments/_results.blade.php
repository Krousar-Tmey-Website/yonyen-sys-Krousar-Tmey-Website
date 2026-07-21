<div class="payments-table-container" x-data="{ qrModal: null, deleteModal: null, deleteForm: null }">
    @if($paymentMethods->isEmpty())
        {{-- Modern Empty State --}}
        <div class="payments-empty">
            <div class="payments-empty-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <h3 class="payments-empty-title">No payment methods found</h3>
            <p class="payments-empty-desc">
                @if(filled($filters['search'] ?? '') || filled($filters['status'] ?? ''))
                    No results match your current filters. Try adjusting your search or filter criteria.
                @else
                    Get started by adding your first payment method. Active methods will be visible to donors on the Donate page.
                @endif
            </p>
            @if(!filled($filters['search'] ?? '') && !filled($filters['status'] ?? ''))
                <a href="{{ route('admin.payments.create') }}" class="payments-empty-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Payment Method
                </a>
            @endif
        </div>
    @else
        {{-- Table --}}
        <div class="payments-table-scroll">
            <table class="payments-table">
                <thead>
                    <tr>
                        <th class="col-id">#</th>
                        <th class="col-name">Name</th>
                        <th class="col-qr">QR Code</th>
                        <th class="col-status">Status</th>
                        <th class="col-sort">Sort</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentMethods as $method)
                    <tr>
                        <td class="col-id">
                            <span class="payments-id">{{ $paymentMethods->firstItem() + $loop->index }}</span>
                        </td>
                        <td class="col-name">
                            <div class="payments-name-cell">
                                <span class="payments-name">{{ $method->name }}</span>
                            </div>
                        </td>
                        <td class="col-qr">
                            @if($method->qr_code)
                                <button type="button" class="payments-qr-btn"
                                        @click="qrModal = '{{ addslashes($method->qr_code_url) }}'; $el.closest('.payments-table-container').querySelector('#qrModalName').textContent = '{{ addslashes($method->name) }}'"
                                        title="Click to enlarge QR code">
                                    <img src="{{ $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) }}"
                                         alt="{{ $method->name }} QR"
                                         class="payments-qr-thumb"
                                         loading="lazy">
                                </button>
                            @else
                                <span class="payments-no-qr">—</span>
                            @endif
                        </td>
                        <td class="col-status">
                            @if($method->is_active)
                                <span class="payments-status active">
                                    <span class="status-dot"></span>
                                    Active
                                </span>
                            @else
                                <span class="payments-status inactive">
                                    <span class="status-dot"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="col-sort">
                            <span class="payments-sort">{{ $method->sort_order }}</span>
                        </td>
                        <td class="col-actions">
                            <div class="payments-actions">
                                @if($method->qr_code)
                                <button type="button" class="payments-action-btn view"
                                        @click="qrModal = '{{ addslashes($method->qr_code_url) }}'; document.getElementById('qrModalName').textContent = '{{ addslashes($method->name) }}'"
                                        title="View QR code">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span class="tooltip-text">View QR</span>
                                </button>
                                @endif
                                <a href="{{ route('admin.payments.edit', ['payment' => $method->id]) }}" class="payments-action-btn edit" title="Edit payment method">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <span class="tooltip-text">Edit</span>
                                </a>
                                <button type="button" class="payments-action-btn delete"
                                        @click="deleteModal = true; deleteForm = $el.closest('tr').querySelector('.delete-form')"
                                        title="Delete payment method">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="tooltip-text">Delete</span>
                                </button>
                                <form action="{{ route('admin.payments.destroy', ['payment' => $method->id]) }}" method="POST" class="delete-form hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($paymentMethods->hasPages())
        <div class="payments-pagination">
            <div class="payments-pagination-info">
                Showing <strong>{{ $paymentMethods->firstItem() }}</strong> to <strong>{{ $paymentMethods->lastItem() }}</strong>
                of <strong>{{ $paymentMethods->total() }}</strong> methods
            </div>
            <div class="payments-pagination-links">
                @if($paymentMethods->onFirstPage())
                    <span class="pag-link disabled">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </span>
                @else
                    <a href="{{ $paymentMethods->previousPageUrl() }}" class="pag-link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                @endif

                @foreach($paymentMethods->getUrlRange(max(1, $paymentMethods->currentPage() - 2), min($paymentMethods->lastPage(), $paymentMethods->currentPage() + 2)) as $page => $url)
                    <a href="{{ $url }}" class="pag-link {{ $page === $paymentMethods->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                @endforeach

                @if($paymentMethods->hasMorePages())
                    <a href="{{ $paymentMethods->nextPageUrl() }}" class="pag-link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @else
                    <span class="pag-link disabled">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                @endif
            </div>
        </div>
        @elseif($paymentMethods->total() > 0)
        <div class="payments-pagination">
            <div class="payments-pagination-info">
                Showing <strong>{{ $paymentMethods->total() }}</strong> method{{ $paymentMethods->total() !== 1 ? 's' : '' }}
            </div>
        </div>
        @endif
    @endif

    {{-- QR Preview Modal --}}
    <div x-show="qrModal" x-cloak
         @keydown.escape.window="qrModal = null"
         @click.self="qrModal = null"
         class="payments-modal-overlay">
        <div class="payments-modal-content">
            <div class="payments-modal-header">
                <h3>QR Code Preview</h3>
                <button type="button" class="payments-modal-close" @click="qrModal = null">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="payments-modal-body">
                <img :src="qrModal" alt="QR Code Preview">
                <p class="payments-modal-label" id="qrModalName"></p>
            </div>
            <div class="payments-modal-footer">
                <a :href="qrModal" download class="payments-modal-download">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download QR Code
                </a>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-show="deleteModal" x-cloak
         @keydown.escape.window="deleteModal = false"
         @click.self="deleteModal = false"
         class="payments-modal-overlay">
        <div class="payments-modal-content" style="max-width:400px;">
            <div class="payments-delete-body">
                <div class="payments-delete-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="payments-delete-title">Delete Payment Method?</h3>
                <p class="payments-delete-desc">This action cannot be undone. The method will be removed from the Donate page and all associated data.</p>
                <div class="payments-delete-actions">
                    <button type="button" @click="deleteModal = false" class="payments-btn-cancel">Cancel</button>
                    <button type="button" @click="deleteForm ? deleteForm.submit() : null" class="payments-btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
