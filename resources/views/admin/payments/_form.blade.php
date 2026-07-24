@php
    $isEdit = isset($paymentMethod);
    $method          = $paymentMethod ?? null;
    $val             = fn($field, $default = '') => old($field, $method?->{$field} ?? $default);

    $brandPresets = [
        'ABA'    => ['label' => 'ABA Blue',    'color' => '#003087'],
        'ACLEDA' => ['label' => 'ACLEDA Red',  'color' => '#e31e2d'],
        'WING'   => ['label' => 'Wing Pink',   'color' => '#e6007e'],
        'Bakong' => ['label' => 'Bakong Gold', 'color' => '#f7941d'],
        'CAB'    => ['label' => 'CAB Purple',  'color' => '#5b2d8e'],
        'SATHAPANA' => ['label' => 'Sathapana Green', 'color' => '#00843d'],
    ];
@endphp

<div x-data="{ 
    residency: '{{ $val('tag', 'cambodia') }}',
    methodType: '{{ $val('redirect_url') ? 'online' : (($val('account_no') || $val('account_name')) ? 'offline' : 'online') }}'
}">

    {{-- ===== SECTION 1: Basic Information ===== --}}
    <div class="payment-form-section-header">
        <div class="section-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <span>Basic Information</span>
    </div>

    <div class="payment-form-section-body">

        {{-- Residency Tag --}}
        <div class="payment-form-group">
            <label class="payment-form-label">Residency Tag <span class="required">*</span></label>
            <select name="tag" required class="payment-form-input @error('tag') error @enderror" x-model="residency">
                <option value="cambodia" {{ $val('tag', 'cambodia') === 'cambodia' ? 'selected' : '' }}>Cambodia 🇰🇭</option>
                <option value="france" {{ $val('tag') === 'france' ? 'selected' : '' }}>France 🇫🇷</option>
                <option value="switzerland" {{ $val('tag') === 'switzerland' ? 'selected' : '' }}>Switzerland 🇨🇭</option>
                <option value="elsewhere" {{ $val('tag') === 'elsewhere' ? 'selected' : '' }}>Elsewhere 🌐</option>
            </select>
            @error('tag')<div class="payment-form-error">{{ $message }}</div>@enderror
        </div>

        {{-- Method Type Selector (Only for non-Cambodia tags) --}}
        <div class="payment-form-group" x-show="residency !== 'cambodia'" x-cloak>
            <label class="payment-form-label">Payment Method Type <span class="required">*</span></label>
            <div class="payment-form-grid" style="grid-template-columns: repeat(2, minmax(0, 1fr));">
                <label class="payment-form-radio-card" :class="methodType === 'online' ? 'selected' : ''">
                    <input type="radio" x-model="methodType" value="online" class="payment-form-radio-hidden">
                    <div class="radio-card-content">
                        <span class="radio-card-icon" style="font-size: 18px;">🌐</span>
                        <span class="radio-card-label" style="font-size: 13px; font-weight: 700;">Online Redirect Link</span>
                        <span style="font-size: 11px; color: #64748b; text-align: center; margin-top: 4px;">For HelloAsso (FR) or PayPal (SW) donation pages.</span>
                    </div>
                </label>
                <label class="payment-form-radio-card" :class="methodType === 'offline' ? 'selected' : ''">
                    <input type="radio" x-model="methodType" value="offline" class="payment-form-radio-hidden">
                    <div class="radio-card-content">
                        <span class="radio-card-icon" style="font-size: 18px;">✉️</span>
                        <span class="radio-card-label" style="font-size: 13px; font-weight: 700;">Check / Bank Transfer Details</span>
                        <span style="font-size: 11px; color: #64748b; text-align: center; margin-top: 4px;">For check addresses (FR) or Banque Cler bank info (SW).</span>
                    </div>
                </label>
            </div>
        </div>

        {{-- Bank Type (Only for Cambodia) --}}
        <div class="payment-form-group" x-show="residency === 'cambodia'">
            <label class="payment-form-label">Bank Type <span class="required">*</span></label>
            <div class="payment-form-grid">
                @foreach(['ABA Bank','ACLEDA Bank','Wing Bank','Other'] as $bt)
                <label class="payment-form-radio-card {{ $val('bank_type') === $bt ? 'selected' : '' }}">
                    <input type="radio" name="bank_type" value="{{ $bt }}"
                           {{ $val('bank_type') === $bt ? 'checked' : '' }}
                           class="payment-form-radio-hidden"
                           onchange="this.closest('.payment-form-grid').querySelectorAll('.payment-form-radio-card').forEach(c => c.classList.remove('selected')); this.closest('.payment-form-radio-card').classList.add('selected');">
                    <div class="radio-card-content">
                        @php $btIcon = match($bt) {
                            'ABA Bank' => 'A',
                            'ACLEDA Bank' => 'AC',
                            'Wing Bank' => 'W',
                            default => '?',
                        }; @endphp
                        <span class="radio-card-icon">{{ $btIcon }}</span>
                        <span class="radio-card-label">{{ $bt }}</span>
                    </div>
                </label>
                @endforeach
            </div>
            @error('bank_type')<div class="payment-form-error">{{ $message }}</div>@enderror
        </div>

        {{-- Name --}}
        <div class="payment-form-group">
            <label class="payment-form-label">
                <span x-text="residency === 'cambodia' ? 'Bank Name' : (methodType === 'online' ? 'Platform Name (e.g. HelloAsso, PayPal)' : 'Method / Recipient Name (e.g. Banque Cler, Check Payment)')">Bank Name</span>
                <span class="required">*</span>
            </label>
            <input type="text" name="name" value="{{ $val('name') }}" required
                   class="payment-form-input @error('name') error @enderror"
                   :placeholder="residency === 'cambodia' ? 'e.g. ABA Bank' : (methodType === 'online' ? 'e.g. HelloAsso, PayPal' : 'e.g. Banque Cler, Check')">
            @error('name')<div class="payment-form-error">{{ $message }}</div>@enderror
        </div>

    </div>

    {{-- ===== SECTION 2: Account Details (For Cambodia or Offline Methods) ===== --}}
    <div x-show="residency === 'cambodia' || methodType === 'offline'" x-cloak>
        <div class="payment-form-section-header">
            <div class="section-icon" style="background:#e3f5e3;color:#16a34a;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                </svg>
            </div>
            <span x-text="residency === 'cambodia' ? 'Account Details' : (residency === 'france' ? 'Check Payment Recipient & Mailing Address' : 'Bank Transfer Info / IBAN')">Account Details</span>
        </div>

        <div class="payment-form-section-body">

            {{-- Account Holder --}}
            <div class="payment-form-group">
                <label class="payment-form-label">
                    <span x-text="residency === 'cambodia' ? 'Account Holder' : (residency === 'france' ? 'Payable To (Check Recipient Name)' : 'Account Holder / Bank Name')">Account Holder</span>
                    <span class="required" x-show="residency !== 'france'">*</span>
                    <span class="optional" x-show="residency === 'france'">(optional)</span>
                </label>
                <input type="text" name="account_name" value="{{ $val('account_name') }}"
                       :required="residency === 'cambodia' || (residency !== 'france' && methodType === 'offline')"
                       :disabled="residency !== 'cambodia' && methodType !== 'offline'"
                       class="payment-form-input @error('account_name') error @enderror"
                       placeholder="e.g. Krousar Thmey France">
                @error('account_name')<div class="payment-form-error">{{ $message }}</div>@enderror
            </div>

            {{-- Account Number & Currency --}}
            <div class="payment-form-grid">
                <div class="payment-form-group" style="flex: 2;">
                    <label class="payment-form-label">
                        <span x-text="residency === 'cambodia' ? 'Account Number' : (residency === 'france' ? 'Mailing Address (e.g. 62 rue Greneta...)' : 'IBAN / Account Number')">Account Number</span>
                        <span class="required" x-show="residency !== 'france'">*</span>
                        <span class="optional" x-show="residency === 'france'">(optional)</span>
                    </label>
                    <textarea name="account_no" rows="3"
                           :required="residency === 'cambodia' || (residency !== 'france' && methodType === 'offline')"
                           :disabled="residency !== 'cambodia' && methodType !== 'offline'"
                           class="payment-form-input @error('account_no') error @enderror"
                           style="min-height: 80px;"
                           :placeholder="residency === 'france' ? 'e.g. 62 rue Greneta\n75002 Paris' : 'e.g. 123 456 789'">{{ $val('account_no') }}</textarea>
                    @error('account_no')<div class="payment-form-error">{{ $message }}</div>@enderror
                </div>
                <div class="payment-form-group" x-show="residency === 'cambodia'">
                    <label class="payment-form-label">Currency</label>
                    <div class="payment-form-currency-group">
                        @foreach(['USD' => '$ USD', 'KHR' => '៛ KHR', 'Both' => 'USD / KHR'] as $cv => $cl)
                        <label class="payment-form-chip {{ $val('currency') === $cv ? 'selected' : '' }}"
                               onclick="this.closest('.payment-form-currency-group').querySelectorAll('.payment-form-chip').forEach(c => c.classList.remove('selected')); this.classList.add('selected'); document.querySelector('input[name=currency][value=\'{{ $cv }}\']')?.click();">
                            <input type="radio" name="currency" value="{{ $cv }}"
                                   {{ $val('currency') === $cv ? 'checked' : '' }}
                                   class="hidden">
                            <span>{{ $cl }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('currency')<div class="payment-form-error">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Brand Color (Only for Cambodia) --}}
            <div class="payment-form-group" x-show="residency === 'cambodia'">
                <label class="payment-form-label">Bank Brand Color</label>
                <div x-data="colorManager('{{ $val('brand_color') }}')">
                    {{-- Preset swatches --}}
                    <div class="payment-form-color-presets">
                        @foreach($brandPresets as $key => $preset)
                        <button type="button"
                                class="payment-form-color-swatch"
                                style="background:{{ $preset['color'] }};"
                                title="{{ $preset['label'] }}"
                                data-color="{{ $preset['color'] }}"
                                :class="{ 'active': selectedColor === '{{ $preset['color'] }}' }"
                                @click="setColor('{{ $preset['color'] }}')">
                            <span class="swatch-inner" x-show="selectedColor === '{{ $preset['color'] }}'">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                        </button>
                        @endforeach
                        {{-- Custom color picker --}}
                        <div class="payment-form-color-custom" :class="{ 'active': isCustom }">
                            <input type="color" name="brand_color" :value="selectedColor"
                                   @input="setColor($event.target.value)"
                                   class="payment-form-color-picker">
                            <span class="custom-label" x-text="selectedColor || 'Custom'"></span>
                        </div>
                    </div>
                    <div class="payment-form-color-preview" x-show="selectedColor" x-cloak>
                        <span class="preview-dot" :style="'background:' + selectedColor"></span>
                        <span class="preview-text" x-text="selectedColor"></span>
                        <button type="button" class="preview-clear" @click="clearColor()" x-show="selectedColor">× Clear</button>
                    </div>
                </div>
                @error('brand_color')<div class="payment-form-error">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- ===== SECTION 3: Settings & Online Platforms ===== --}}
    <div class="payment-form-section-header">
        <div class="section-icon" style="background:#ede9fe;color:#7c3aed;">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <span x-text="residency === 'cambodia' ? 'Settings' : 'Settings & Online Platforms (HelloAsso, PayPal)'">Settings</span>
    </div>

    <div class="payment-form-section-body">

        {{-- Sort Order & Status --}}
        <div class="payment-form-grid">
            <div class="payment-form-group">
                <label class="payment-form-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ $val('sort_order', 0) }}" min="0"
                       class="payment-form-input @error('sort_order') error @enderror"
                       placeholder="0">
                @error('sort_order')<div class="payment-form-error">{{ $message }}</div>@enderror
            </div>
            <div class="payment-form-group">
                <label class="payment-form-label">Status</label>
                <div class="payment-form-toggle">
                    <label class="toggle-track">
                        <input type="checkbox" name="is_active" value="1"
                               {{ $val('is_active', true) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                    <div>
                        <div class="toggle-label">Active</div>
                        <div class="toggle-desc">Available for donors on the Donate page</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Redirect URL --}}
        <div class="payment-form-group" style="margin-top:16px; border-top:1px solid #f1f5f9; padding-top:20px;"
             x-show="residency === 'cambodia' || methodType === 'online'">
            <label class="payment-form-label">
                <span x-text="residency === 'cambodia' ? 'Redirect URL' : (residency === 'france' ? 'Redirect URL (e.g. HelloAsso Link)' : 'Redirect URL (e.g. PayPal Link)')">Redirect URL</span>
                <span class="required" x-show="residency !== 'cambodia'">*</span>
                <span class="optional" x-show="residency === 'cambodia'">(optional)</span>
            </label>
            <input type="url" name="redirect_url" value="{{ $val('redirect_url') }}"
                   :required="residency !== 'cambodia' && methodType === 'online'"
                   :disabled="residency !== 'cambodia' && methodType !== 'online'"
                   class="payment-form-input @error('redirect_url') error @enderror"
                   :placeholder="residency === 'france' ? 'e.g. https://www.helloasso.com/...' : 'e.g. https://www.paypal.com/...'">
            <span style="font-size: 11px; color: #64748b; margin-top: 4px; display: block;" x-text="residency === 'cambodia' ? 'For external links like ABA Pay. Overrides QR code action.' : 'For direct redirect links to the donation platform.'">For external links like HelloAsso/PayPal. Overrides QR code action.</span>
            @error('redirect_url')<div class="payment-form-error">{{ $message }}</div>@enderror
        </div>

        {{-- Description --}}
        <div class="payment-form-group" style="margin-top: 16px;" x-show="residency !== 'cambodia'">
            <label class="payment-form-label">Description / Note <span class="optional">(optional)</span></label>
            <textarea name="description" rows="3" class="payment-form-input @error('description') error @enderror"
                      :placeholder="methodType === 'online' ? 'e.g. You can make a one-time or regular donation on our dedicated website, you will be redirected to our HelloAsso page:' : 'e.g. You can also send a check payable to Krousar Thmey France at the following address:'">{{ $val('description') }}</textarea>
            <span style="font-size: 11px; color: #64748b; margin-top: 4px; display: block;">Custom description text to show on the donation page.</span>
            @error('description')<div class="payment-form-error">{{ $message }}</div>@enderror
        </div>

        {{-- Upload Image (QR or Logo) --}}
        <div class="payment-form-group" style="margin-top:16px; border-top:1px solid #f1f5f9; padding-top:20px;">
            <label class="payment-form-label">
                <span x-text="residency === 'cambodia' ? ({{ $isEdit && $method?->qr_code ? 'true' : 'false' }} ? 'Replace QR Code' : 'Upload QR Code') : (residency === 'france' ? ({{ $isEdit && $method?->qr_code ? 'true' : 'false' }} ? 'Replace HelloAsso Logo' : 'Upload HelloAsso Logo') : ({{ $isEdit && $method?->qr_code ? 'true' : 'false' }} ? 'Replace Platform Logo' : 'Upload Platform Logo'))">Upload QR Code</span>
                <span class="optional">(optional)</span>
            </label>

            {{-- Current file display (edit mode) --}}
            @if($isEdit && $method?->qr_code)
            <div class="payment-form-current-file">
                <img src="{{ $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) }}"
                     alt="Current image" class="current-file-thumb">
                <div class="current-file-info">
                    <strong>Current Logo/QR code</strong>
                    <span>{{ $method->qr_code }}</span>
                </div>
                <label class="current-file-remove">
                    <input type="checkbox" name="remove_qr" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                    <span>Remove</span>
                </label>
            </div>
            @endif

            {{-- Upload dropzone --}}
            <div class="payment-form-upload" id="uploadZone"
                 onclick="document.getElementById('qrInput').click()">
                <input type="file" name="qr_code" id="qrInput" accept="image/*" class="hidden">
                <div id="qrPlaceholder" class="upload-placeholder">
                    <div class="upload-icon-box">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <div class="upload-label" x-text="residency === 'cambodia' ? 'Click to upload QR Code' : 'Click to upload Logo / Image'">Click to upload QR Code</div>
                    <div class="upload-hint">JPG, PNG, GIF or WebP · Max 2MB</div>
                </div>
                <div id="qrPreview" class="hidden"></div>
            </div>

            @error('qr_code')<div class="payment-form-error">{{ $message }}</div>@enderror
        </div>
    </div>

</div>

{{-- Styles for new form elements --}}
<style>
    /* Radio card */
    .payment-form-radio-card {
        position: relative;
        cursor: pointer;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px;
        transition: all 0.2s ease;
        background: #fafbfc;
        text-align: center;
    }
    .payment-form-radio-card:hover {
        border-color: #93c5fd;
        background: #f0f7ff;
    }
    .payment-form-radio-card.selected {
        border-color: #2d6fa3;
        background: #e3f0ff;
        box-shadow: 0 0 0 3px rgba(45,111,163,0.1);
    }
    .payment-form-radio-hidden {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    .radio-card-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }
    .radio-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        color: #475569;
    }
    .payment-form-radio-card.selected .radio-card-icon {
        background: #2d6fa3;
        border-color: #2d6fa3;
        color: #ffffff;
    }
    .radio-card-label {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
    }
    .payment-form-radio-card.selected .radio-card-label {
        color: #1e40af;
    }



    /* Hint text */
    .payment-form-hint-input {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .payment-form-hint {
        font-size: 12px;
        color: #94a3b8;
        font-style: italic;
    }

    /* Currency chips */
    .payment-form-currency-group {
        display: flex;
        gap: 8px;
    }
    .payment-form-chip {
        flex: 1;
        cursor: pointer;
        padding: 10px 12px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        background: #fafbfc;
        transition: all 0.2s ease;
    }
    .payment-form-chip:hover {
        border-color: #93c5fd;
        background: #f0f7ff;
    }
    .payment-form-chip.selected {
        border-color: #2d6fa3;
        background: #e3f0ff;
        color: #1e40af;
        box-shadow: 0 0 0 3px rgba(45,111,163,0.1);
    }
    .payment-form-chip .hidden { display: none; }

    /* Color presets */
    .payment-form-color-presets {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }
    .payment-form-color-swatch {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .payment-form-color-swatch:hover {
        transform: scale(1.15);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .payment-form-color-swatch.active {
        border-color: #1e293b;
        box-shadow: 0 0 0 3px rgba(30,41,59,0.15);
        transform: scale(1.1);
    }
    .swatch-inner {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .payment-form-color-custom {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px 4px 4px;
        border: 2px dashed #e2e8f0;
        border-radius: 20px;
        background: #fafbfc;
        transition: all 0.2s;
        cursor: pointer;
    }
    .payment-form-color-custom.active {
        border-color: #2d6fa3;
        background: #f0f7ff;
        border-style: solid;
    }
    .payment-form-color-picker {
        width: 28px;
        height: 28px;
        border: none;
        border-radius: 50%;
        padding: 0;
        cursor: pointer;
        background: none;
    }
    .payment-form-color-picker::-webkit-color-swatch-wrapper {
        padding: 0;
    }
    .payment-form-color-picker::-webkit-color-swatch {
        border: 1px solid #e2e8f0;
        border-radius: 50%;
    }
    .custom-label {
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
    }

    /* Color preview */
    .payment-form-color-preview {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
        padding: 8px 14px;
        background: #f8fafc;
        border: 1px solid #eef2f6;
        border-radius: 8px;
    }
    .preview-dot {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        flex-shrink: 0;
        border: 1px solid #e2e8f0;
    }
    .preview-text {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        font-family: 'SF Mono', 'Consolas', monospace;
    }
    .preview-clear {
        margin-left: auto;
        font-size: 12px;
        color: #94a3b8;
        background: none;
        border: none;
        cursor: pointer;
        padding: 2px 8px;
        border-radius: 4px;
        transition: all 0.2s;
    }
    .preview-clear:hover {
        color: #ef4444;
        background: #fef2f2;
    }
</style>

{{-- Alpine.js component for color manager --}}
<script>
function colorManager(initialColor) {
    return {
        selectedColor: initialColor || '',
        isCustom: false,
        setColor(color) {
            this.selectedColor = color;
            this.isCustom = !document.querySelector(`.payment-form-color-swatch[data-color="${color}"]`);
        },
        clearColor() {
            this.selectedColor = '';
            this.isCustom = false;
            document.querySelector('input[name="brand_color"]').value = '';
        }
    };
}
</script>

{{-- QR upload preview --}}
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
                        '<div style="display:flex;flex-direction:column;align-items:center;gap:10px;">',
                        '<img src="' + e.target.result + '" alt="Preview"',
                        '     style="height:120px;width:auto;object-fit:contain;border-radius:8px;border:1px solid #e2e8f0;">',
                        '<div style="display:flex;align-items:center;gap:8px;">',
                        '    <span style="font-size:11px;color:#94a3b8;">' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)</span>',
                        '    <button type="button"',
                        '            style="background:#f1f5f9;border:none;border-radius:6px;padding:4px 12px;cursor:pointer;font-size:12px;color:#64748b;font-weight:500;"',
                        '            onclick="document.getElementById(\\'qrInput\\').value=\\'\\'; document.getElementById(\\'qrPreview\\').innerHTML=\\'\\'; document.getElementById(\\'qrPreview\\').classList.add(\\'hidden\\'); document.getElementById(\\'qrPlaceholder\\').classList.remove(\\'hidden\\'); document.getElementById(\\'uploadZone\\').classList.remove(\\'has-file\\');">',
                        '        × Remove',
                        '    </button>',
                        '</div>',
                        '</div>'
                    ].join('\\n');
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
