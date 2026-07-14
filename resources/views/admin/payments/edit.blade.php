@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Payment Method')
@section('page-title', 'Edit Payment Method')
@section('breadcrumb', 'Payment Methods → ' . Str::limit($paymentMethod->name, 40))

@section('content')

<div class="payment-form-page">
    {{-- Page Header --}}
    <div class="payment-form-header">
        <a href="{{ route('admin.payments.index') }}" class="payment-form-back">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
            </svg>
            Back to Payment Methods
        </a>
        <div class="payment-form-title-group">
            <div class="payment-form-icon edit-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <h1>Edit Payment Method</h1>
                <p>Update details for <strong>{{ $paymentMethod->name }}</strong></p>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.payments.update', ['payment' => $paymentMethod->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Details Card --}}
        <div class="payment-form-card">
            <div class="payment-form-section">
                <div class="payment-form-section-header">
                    <div class="section-icon blue">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3>Basic Information</h3>
                        <p>General details about this payment method</p>
                    </div>
                </div>
                <div class="payment-form-section-body">
                    <div class="payment-form-grid">
                        <div class="payment-form-group">
                            <label class="payment-form-label">Name <span class="required">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $paymentMethod->name) }}" required
                                   class="payment-form-input @error('name') error @enderror"
                                   placeholder="e.g. ABA Bank">
                            @error('name')<div class="payment-form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="payment-form-group">
                            <label class="payment-form-label">Code <span class="required">*</span></label>
                            <input type="text" name="code" value="{{ old('code', $paymentMethod->code) }}" required
                                   class="payment-form-input @error('code') error @enderror"
                                   placeholder="e.g. ABA">
                            @error('code')<div class="payment-form-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="payment-form-group">
                        <label class="payment-form-label">Description</label>
                        <textarea name="description" rows="2" class="payment-form-input payment-form-textarea @error('description') error @enderror"
                                  placeholder="Instructions for donors using this payment method...">{{ old('description', $paymentMethod->description) }}</textarea>
                        @error('description')<div class="payment-form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="payment-form-grid">
                        <div class="payment-form-group">
                            <label class="payment-form-label">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $paymentMethod->sort_order) }}" min="0"
                                   class="payment-form-input @error('sort_order') error @enderror"
                                   placeholder="0">
                            @error('sort_order')<div class="payment-form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="payment-form-group">
                            <label class="payment-form-label">Status</label>
                            <div class="payment-form-toggle">
                                <label class="toggle-track">
                                    <input type="checkbox" name="is_active" value="1"
                                           {{ old('is_active', $paymentMethod->is_active) ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                                <div>
                                    <div class="toggle-label">Active</div>
                                    <div class="toggle-desc">Available for donors on the Donate page</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- QR Code Section --}}
            <div class="payment-form-section">
                <div class="payment-form-section-header">
                    <div class="section-icon green">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <div>
                        <h3>QR Code</h3>
                        <p>Upload a QR code image for donors to scan</p>
                    </div>
                    @if($paymentMethod->qr_code)
                        <button type="button" class="payments-badge-link"
                                onclick="document.getElementById('qrPreviewModal').classList.remove('hidden')">
                            Preview Current
                        </button>
                    @endif
                </div>
                <div class="payment-form-section-body">
                    @if($paymentMethod->qr_code)
                    <div class="payment-form-current-file">
                        <img src="{{ $paymentMethod->qr_code_url . '?v=' . ($paymentMethod->updated_at?->timestamp ?? time()) }}"
                             alt="Current QR" class="current-file-thumb">
                        <div class="current-file-info">
                            <strong>Current QR code</strong>
                            <span>{{ $paymentMethod->qr_code }}</span>
                        </div>
                        <label class="current-file-remove">
                            <input type="checkbox" name="remove_qr" value="1"
                                   class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                            <span>Remove</span>
                        </label>
                    </div>
                    @endif

                    <div class="payment-form-group">
                        <label class="payment-form-label">
                            {{ $paymentMethod->qr_code ? 'Replace QR Code' : 'Upload QR Code' }}
                            <span class="optional">(optional)</span>
                        </label>
                        <div class="payment-form-upload" id="uploadZone"
                             onclick="document.getElementById('qrInput').click()">
                            <input type="file" name="qr_code" id="qrInput" accept="image/*" class="hidden">
                            <div id="qrPlaceholder" class="upload-placeholder">
                                <div class="upload-icon-box">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                    </svg>
                                </div>
                                <div class="upload-label">Click to upload QR code</div>
                                <div class="upload-hint">JPG, PNG, GIF or WebP · Max 2MB</div>
                            </div>
                            <div id="qrPreview" class="hidden"></div>
                        </div>
                        @error('qr_code')<div class="payment-form-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="payment-form-actions">
                <a href="{{ route('admin.payments.index') }}" class="payments-btn-secondary">
                    Cancel
                </a>
                <div class="payment-form-actions-right">
                    <button type="submit" class="payments-btn-primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Update Payment Method
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- Danger Zone --}}
    <div class="payment-form-card payment-form-card-danger">
        <div class="payment-form-section">
            <div class="payment-form-section-header danger">
                <div class="section-icon red">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3>Danger Zone</h3>
                    <p>Irreversible actions for this payment method</p>
                </div>
            </div>
            <div class="payment-form-section-body danger">
                <div class="payment-form-danger-content">
                    <div class="danger-text">
                        <strong>Delete this payment method</strong>
                        <p>Once deleted, this method cannot be restored. Donors will no longer see it on the Donate page.</p>
                    </div>
                    <form action="{{ route('admin.payments.destroy', ['payment' => $paymentMethod->id]) }}" method="POST"
                          onsubmit="return confirm('Delete {{ addslashes($paymentMethod->name) }}? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="payments-btn-danger">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- QR Preview Modal --}}
<div id="qrPreviewModal" class="payments-modal-overlay hidden"
     onclick="this.classList.add('hidden')">
    <div class="payments-modal-content" onclick="event.stopPropagation()">
        <div class="payments-modal-header">
            <h3>QR Code Preview</h3>
            <button type="button" class="payments-modal-close"
                    onclick="document.getElementById('qrPreviewModal').classList.add('hidden')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="payments-modal-body">
            <img src="{{ $paymentMethod->qr_code_url . '?v=' . ($paymentMethod->updated_at?->timestamp ?? time()) }}"
                 alt="{{ $paymentMethod->name }} QR">
            <p class="payments-modal-label">{{ $paymentMethod->name }} — Scan to donate</p>
        </div>
        <div class="payments-modal-footer">
            <a href="{{ $paymentMethod->qr_code_url . '?v=' . ($paymentMethod->updated_at?->timestamp ?? time()) }}" download
               class="payments-modal-download">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Download QR Code
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrInput = document.getElementById('qrInput');
    if (qrInput) {
        qrInput.addEventListener('change', function(e) {
            const preview = document.getElementById('qrPreview');
            const placeholder = document.getElementById('qrPlaceholder');
            const uploadZone = document.getElementById('uploadZone');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    placeholder.classList.add('hidden');
                    preview.classList.remove('hidden');
                    uploadZone.classList.add('has-file');
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview"
                             style="height:120px;width:auto;object-fit:contain;border-radius:8px;border:1px solid #e2e8f0;margin:0 auto;">
                        <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:8px;">
                            <span style="font-size:11px;color:#94a3b8;">${file.name} (${(file.size / 1024).toFixed(1)} KB)</span>
                            <button type="button"
                                    style="background:#f1f5f9;border:none;border-radius:4px;padding:2px 8px;cursor:pointer;font-size:12px;color:#64748b;"
                                    onclick="document.getElementById('qrInput').value=''; document.getElementById('qrPreview').innerHTML=''; document.getElementById('qrPreview').classList.add('hidden'); document.getElementById('qrPlaceholder').classList.remove('hidden'); document.getElementById('uploadZone').classList.remove('has-file');">
                                × Clear
                            </button>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>

@endsection
