<div class="table-container" x-data="{ qrModal: null, deleteModal: null, deleteForm: null }">
    <div class="table-header-modern">
        <h3>
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;color:#2d6fa3;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
            Payment Methods
        </h3>
        <span class="count-badge">{{ $totalMethods }} method{{ $totalMethods !== 1 ? 's' : '' }}</span>
    </div>

    @if($paymentMethods->isEmpty())
        <div class="empty-state-modern">
            <div class="empty-icon-box">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:32px;height:32px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <div class="empty-title">No payment methods yet</div>
            <div class="empty-desc">Add your first payment method using the form. Active methods will appear on the Donate page.</div>
        </div>
    @else
        <div class="table-responsive-wrap">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width:44px;">#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>QR Code</th>
                        <th>Status</th>
                        <th style="width:70px;">Sort</th>
                        <th style="width:110px;text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentMethods as $method)
                    <tr>
                        <td>
                            <span class="id-cell">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <span class="font-medium text-gray-800">{{ $method->name }}</span>
                        </td>
                        <td>
                            <span class="code-badge">{{ $method->code }}</span>
                        </td>
                        <td>
                            @if($method->qr_code)
                                <div class="qr-thumb-wrapper">
                                    <img src="{{ $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) }}"
                                         alt="{{ $method->name }} QR"
                                         class="qr-thumb"
                                         loading="lazy"
                                         @click="qrModal = '{{ addslashes($method->qr_code_url) }}'; $el.closest('.table-container').querySelector('#qrModalName').textContent = '{{ addslashes($method->name) }}'"
                                         title="Click to enlarge">
                                </div>
                            @else
                                <span class="text-gray-300 text-xs">—</span>
                            @endif
                        </td>
                        <td>
                            @if($method->is_active)
                                <span class="status-badge-modern active">Active</span>
                            @else
                                <span class="status-badge-modern inactive">Disabled</span>
                            @endif
                        </td>
                        <td>
                            <span class="sort-badge">{{ $method->sort_order }}</span>
                        </td>
                        <td style="text-align:right;">
                            <div class="action-btn-group" style="justify-content:flex-end;">
                                @if($method->qr_code)
                                <button type="button" class="icon-btn view"
                                        @click="qrModal = '{{ addslashes($method->qr_code_url) }}'; document.getElementById('qrModalName').textContent = '{{ addslashes($method->name) }}'"
                                        title="Preview QR">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span class="tooltip-text">View QR</span>
                                </button>
                                @endif
                                <a href="{{ route('admin.payments.edit', ['payment' => $method->id]) }}" class="icon-btn edit" title="Edit">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <span class="tooltip-text">Edit</span>
                                </a>
                                <button type="button" class="icon-btn delete"
                                        @click="deleteModal = true; deleteForm = $event.currentTarget.nextElementSibling"
                                        title="Delete">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="tooltip-text">Delete</span>
                                </button>
                                <form action="{{ route('admin.payments.destroy', ['payment' => $method->id]) }}" method="POST" class="hidden">
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
    @endif

    {{-- QR Preview Modal --}}
    <div x-show="qrModal" x-cloak
         @keydown.escape.window="qrModal = null"
         @click.self="qrModal = null"
         class="qr-modal-overlay">
        <div class="qr-modal-content">
            <button type="button" class="qr-modal-close" @click="qrModal = null">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <img :src="qrModal" alt="QR Code Preview">
            <p class="qr-modal-label" id="qrModalName"></p>
            <div style="text-align:center;margin-top:14px;">
                <a :href="qrModal" download
                   style="display:inline-flex;align-items:center;gap:6px;padding:8px 20px;background:#2d6fa3;color:#fff;border-radius:8px;font-size:13px;font-weight:500;text-decoration:none;transition:all 0.2s;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download QR
                </a>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-show="deleteModal" x-cloak
         @keydown.escape.window="deleteModal = false"
         @click.self="deleteModal = false"
         class="qr-modal-overlay">
        <div class="qr-modal-content" style="max-width:400px;padding:1.5rem;text-align:center;">
            <div style="width:56px;height:56px;border-radius:16px;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg fill="none" stroke="#ef4444" viewBox="0 0 24 24" style="width:28px;height:28px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 style="font-size:17px;font-weight:600;color:#0f172a;margin:0 0 4px;">Delete Payment Method?</h3>
            <p style="font-size:13px;color:#64748b;margin:0 0 20px;">This action cannot be undone. The method will be removed from the Donate page.</p>
            <div style="display:flex;gap:10px;justify-content:center;">
                <button type="button" @click="deleteModal = false"
                        style="padding:10px 24px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;color:#475569;font-size:14px;font-weight:500;cursor:pointer;">
                    Cancel
                </button>
                <button type="button" @click="deleteForm ? (deleteForm.submit()) : null"
                        style="padding:10px 24px;border:none;border-radius:8px;background:#ef4444;color:#fff;font-size:14px;font-weight:500;cursor:pointer;">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
