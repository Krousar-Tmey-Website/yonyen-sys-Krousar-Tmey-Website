@php
    $isEdit = isset($paymentMethod);
    $methodName        = old('name', $paymentMethod->name ?? '');
    $methodCode        = old('code', $paymentMethod->code ?? '');
    $methodDescription = old('description', $paymentMethod->description ?? '');
    $methodAccountName = old('account_name', $paymentMethod->account_name ?? '');
    $methodAccountNo   = old('account_no', $paymentMethod->account_no ?? '');
    $methodCurrency    = old('currency', $paymentMethod->currency ?? '');
    $methodSortOrder   = old('sort_order', $paymentMethod->sort_order ?? 0);
    $methodActive      = old('is_active', $paymentMethod->is_active ?? true);
@endphp

<div class="payment-form-grid">
    <div class="payment-form-group">
        <label class="payment-form-label">Name <span class="required">*</span></label>
        <input type="text" name="name" value="{{ $methodName }}" required
               class="payment-form-input @error('name') error @enderror"
               placeholder="e.g. ABA Bank">
        @error('name')<div class="payment-form-error">{{ $message }}</div>@enderror
    </div>

    <div class="payment-form-group">
        <label class="payment-form-label">Code <span class="required">*</span></label>
        <input type="text" name="code" value="{{ $methodCode }}" required
               class="payment-form-input @error('code') error @enderror"
               placeholder="e.g. ABA">
        @error('code')<div class="payment-form-error">{{ $message }}</div>@enderror
    </div>
</div>

<div class="payment-form-group">
    <label class="payment-form-label">Description</label>
    <textarea name="description" rows="2" class="payment-form-input payment-form-textarea @error('description') error @enderror"
              placeholder="Instructions for donors using this payment method...">{{ $methodDescription }}</textarea>
    @error('description')<div class="payment-form-error">{{ $message }}</div>@enderror
</div>

<div class="payment-form-section-header" style="margin-top:24px;">
    <div class="section-header-icon">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
        </svg>
    </div>
    <span>Account Details</span>
</div>

<div class="payment-form-grid">
    <div class="payment-form-group">
        <label class="payment-form-label">Account Name</label>
        <input type="text" name="account_name" value="{{ $methodAccountName }}"
               class="payment-form-input @error('account_name') error @enderror"
               placeholder="e.g. Krousar Thmey Cambodia">
        @error('account_name')<div class="payment-form-error">{{ $message }}</div>@enderror
    </div>

    <div class="payment-form-group">
        <label class="payment-form-label">Account No.</label>
        <input type="text" name="account_no" value="{{ $methodAccountNo }}"
               class="payment-form-input @error('account_no') error @enderror"
               placeholder="e.g. 123 456 789">
        @error('account_no')<div class="payment-form-error">{{ $message }}</div>@enderror
    </div>
</div>

<div class="payment-form-grid">
    <div class="payment-form-group">
        <label class="payment-form-label">Currency</label>
        <select name="currency" class="payment-form-input @error('currency') error @enderror">
            <option value="">Select currency...</option>
            @foreach(['KHR' => '៛ KHR — Khmer Riel', 'USD' => '$ USD — US Dollar', 'EUR' => '€ EUR — Euro', 'THB' => '฿ THB — Thai Baht'] as $val => $label)
                <option value="{{ $val }}" {{ $methodCurrency === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @error('currency')<div class="payment-form-error">{{ $message }}</div>@enderror
    </div>

    <div class="payment-form-group">
        <label class="payment-form-label">Sort Order</label>
        <input type="number" name="sort_order" value="{{ $methodSortOrder }}" min="0"
               class="payment-form-input @error('sort_order') error @enderror"
               placeholder="0">
        @error('sort_order')<div class="payment-form-error">{{ $message }}</div>@enderror
    </div>
</div>

<div class="payment-form-group">
    <label class="payment-form-label">Status</label>
    <div class="payment-form-toggle">
        <label class="toggle-track">
            <input type="checkbox" name="is_active" value="1"
                   {{ $methodActive ? 'checked' : '' }}>
            <span class="slider"></span>
        </label>
        <div>
            <div class="toggle-label">Active</div>
            <div class="toggle-desc">Available for donors on the Donate page</div>
        </div>
    </div>
</div>

{{-- QR Code Upload --}}
<div class="payment-form-group" style="margin-top:24px;">
    <label class="payment-form-label">
        Upload QR Code
        @if(!$isEdit)
            <span class="optional">(optional)</span>
        @endif
    </label>

    <div class="payment-form-upload" id="uploadZone"
         onclick="document.getElementById('qrInput').click()">
        <input type="file" name="qr_code" id="qrInput" accept="image/*" class="hidden">
        <div id="qrPlaceholder" class="upload-placeholder">
            <div class="upload-icon-box">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:24px;height:24px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                </svg>
            </div>
            <div class="upload-label">Click to upload QR code</div>
            <div class="upload-hint">JPG, PNG, GIF or WebP · Max 2MB</div>
        </div>
        <div id="qrPreview" class="hidden"></div>
    </div>

    @if($isEdit && $paymentMethod->qr_code)
    <div class="payment-form-current-file" style="margin-top:12px;">
        <img src="{{ $paymentMethod->qr_code_url }}" alt="QR Code" class="current-file-thumb">
        <div class="current-file-info">
            <strong>Current QR code</strong>
            <span>{{ $paymentMethod->qr_code }}</span>
        </div>
        <label class="current-file-remove" title="Remove current QR code">
            <input type="checkbox" name="remove_qr" value="1"
                   class="rounded border-gray-300 text-red-500 focus:ring-red-400">
            <span>Remove</span>
        </label>
    </div>
    @endif

    @error('qr_code')<div class="payment-form-error">{{ $message }}</div>@enderror
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
                    preview.innerHTML = [
                        '<img src="' + e.target.result + '" alt="Preview"',
                        '     style="height:120px;width:auto;object-fit:contain;border-radius:8px;border:1px solid #e2e8f0;margin:0 auto;">',
                        '<div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:8px;">',
                        '    <span style="font-size:11px;color:#94a3b8;">' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)</span>',
                        '    <button type="button"',
                        '            style="background:#f1f5f9;border:none;border-radius:4px;padding:2px 8px;cursor:pointer;font-size:12px;color:#64748b;"',
                        '            onclick="document.getElementById(\'qrInput\').value=\'\'; this.closest(\'#uploadZone\').querySelector(\'#qrPreview\').innerHTML=\'\'; this.closest(\'#uploadZone\').querySelector(\'#qrPreview\').classList.add(\'hidden\'); this.closest(\'#uploadZone\').querySelector(\'#qrPlaceholder\').classList.remove(\'hidden\'); this.closest(\'#uploadZone\').classList.remove(\'has-file\');">',
                        '        × Clear',
                        '    </button>',
                        '</div>'
                    ].join('\\n');
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
