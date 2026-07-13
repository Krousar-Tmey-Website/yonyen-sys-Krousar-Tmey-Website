@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Payment Method')
@section('page-title', 'Edit Payment Method')
@section('breadcrumb', 'Payment Methods → ' . Str::limit($paymentMethod->name, 40))

@section('content')

<div class="max-w-3xl mx-auto" x-data="{ qrModal: false }">

    <form action="{{ route('admin.payments.update', ['payment' => $paymentMethod->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Details Card --}}
        <div class="form-card" style="border-radius:16px;border:1px solid #eef2f6;box-shadow:0 1px 3px rgba(0,0,0,0.02);margin-bottom:20px;">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3>Payment Method Details</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                <div class="form-grid-compact">
                    <div class="form-group">
                        <label class="form-label">Name <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $paymentMethod->name) }}" required
                               class="form-control @error('name') error @enderror"
                               placeholder="e.g. ABA Bank">
                        @error('name')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Code <span class="required">*</span></label>
                        <input type="text" name="code" value="{{ old('code', $paymentMethod->code) }}" required
                               class="form-control @error('code') error @enderror"
                               placeholder="e.g. ABA">
                        @error('code')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="2" class="form-control textarea @error('description') error @enderror"
                              placeholder="Instructions for donors using this payment method...">{{ old('description', $paymentMethod->description) }}</textarea>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-grid-compact">
                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $paymentMethod->sort_order) }}" min="0"
                               class="form-control @error('sort_order') error @enderror"
                               placeholder="0">
                        @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group" style="padding-top:22px;">
                        <div class="toggle-wrapper">
                            <label class="toggle-track">
                                <input type="checkbox" name="is_active" id="is_active" value="1"
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

        {{-- QR Code Card --}}
        <div class="form-card" style="border-radius:16px;border:1px solid #eef2f6;box-shadow:0 1px 3px rgba(0,0,0,0.02);margin-bottom:20px;">
            <div class="card-header">
                <div class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                </div>
                <h3>QR Code</h3>
                @if($paymentMethod->qr_code)
                    <span class="badge">
                        <a href="#" @click.prevent="qrModal = true" class="text-[#2d6fa3] hover:underline">Preview</a>
                    </span>
                @endif
            </div>
            <div class="card-body">
                @if($paymentMethod->qr_code)
                <div class="flex items-center gap-4 p-4 bg-[#f8fafc] rounded-xl border border-[#eef2f6] mb-4">
                    <img src="{{ $paymentMethod->qr_code_url . '?v=' . ($paymentMethod->updated_at?->timestamp ?? time()) }}"
                         alt="Current QR"
                         class="w-20 h-20 object-cover rounded-lg border border-gray-200 cursor-pointer"
                         @click="qrModal = true">
                    <div class="flex-1 min-w-0">
                        <strong class="block text-sm text-gray-800">Current QR code</strong>
                        <span class="text-xs text-gray-400 block truncate">{{ $paymentMethod->qr_code }}</span>
                    </div>
                    <label class="flex items-center gap-2 text-xs text-gray-400 hover:text-red-500 cursor-pointer transition-colors flex-shrink-0">
                        <input type="checkbox" name="remove_qr" value="1"
                               class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                        Remove
                    </label>
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">
                        {{ $paymentMethod->qr_code ? 'Replace QR Code' : 'Upload QR Code' }}
                        <span class="optional">(optional)</span>
                    </label>
                    <div class="upload-area-modern" id="uploadZone"
                         onclick="document.getElementById('qrInput').click()">
                        <input type="file" name="qr_code" id="qrInput" accept="image/*" class="hidden">
                        <div id="qrPlaceholder">
                            <div class="upload-icon-box">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:24px;height:24px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                            </div>
                            <div class="upload-label">Click to upload QR code</div>
                            <div class="upload-hint">JPG, PNG, GIF or WebP · Max 2MB</div>
                        </div>
                        <div id="qrPreview" class="hidden"></div>
                    </div>
                    @error('qr_code')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 flex-wrap" style="padding:16px 0;">
            <button type="submit" class="btn-primary">                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Update Payment Method
            </button>
            <a href="{{ route('admin.payments.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>

    {{-- Danger Zone --}}
    <div class="form-card" style="border-radius:16px;border:1px solid #fecaca;box-shadow:0 1px 3px rgba(0,0,0,0.02);margin-top:24px;">
        <div class="card-header danger">
            <div class="icon red">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3>Danger Zone</h3>
            <span class="badge" style="background:#fee2e2;color:#991b1b;">Irreversible</span>
        </div>
        <div class="card-body danger">
            <div class="danger-content">
                <div class="danger-text">
                    <p class="title">Delete this payment method</p>
                    <p class="desc">Once deleted, this method cannot be restored. Donors will no longer see it.</p>
                </div>
                <form action="{{ route('admin.payments.destroy', ['payment' => $paymentMethod->id]) }}" method="POST"
                      onsubmit="return confirm('Delete {{ addslashes($paymentMethod->name) }}? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" style="margin-left:0;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- QR Preview Modal --}}
<div x-show="qrModal" x-cloak
     @keydown.escape.window="qrModal = false"
     @click.self="qrModal = false"
     class="qr-modal-overlay">
    <div class="qr-modal-content">
            <button type="button" class="qr-modal-close" @click="qrModal = false">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        <img src="{{ $paymentMethod->qr_code_url . '?v=' . ($paymentMethod->updated_at?->timestamp ?? time()) }}" alt="{{ $paymentMethod->name }} QR">
        <p class="qr-modal-label">{{ $paymentMethod->name }} — Scan to donate</p>
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
                                    onclick="document.getElementById('qrInput').value=''; preview.innerHTML=''; preview.classList.add('hidden'); placeholder.classList.remove('hidden'); uploadZone.classList.remove('has-file');">
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
