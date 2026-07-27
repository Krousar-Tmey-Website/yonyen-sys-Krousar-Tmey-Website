@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])

@endpush

@section('title', 'Payment Methods')
@section('page-title', 'Payment Methods')
@section('breadcrumb', 'Manage payment methods available for donors')

@section('content')

<div class="payments-page" x-data="paymentManager()" x-init="init()">
    {{-- Residency Selector Tabs (styled like public donate page) --}}
    <div style="margin-bottom: 24px;">
        <div class="bg-white rounded-xl border border-slate-200/80 p-1 shadow-2xs flex flex-wrap lg:flex-nowrap justify-between gap-1 w-full">
            
            {{-- Tab: Cambodia --}}
            <button type="button"
                    @click="switchTag('cambodia')"
                    :class="tag === 'cambodia' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                <span>Payment in Cambodia</span>
                <img src="{{ asset('images/Flag_of_Cambodia.svg.webp') }}" class="h-3.5 w-auto rounded-xs object-contain shrink-0 border border-slate-200/60 shadow-3xs" alt="KH">
            </button>

            {{-- Tab: France --}}
            <button type="button"
                    @click="switchTag('france')"
                    :class="tag === 'france' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                <span>Fiscal residency in France</span>
                <img src="{{ asset('images/Flag_of_France.svg.webp') }}" class="h-3.5 w-auto rounded-xs object-contain shrink-0 border border-slate-200/60 shadow-3xs" alt="FR">
            </button>

            {{-- Tab: Switzerland --}}
            <button type="button"
                    @click="switchTag('switzerland')"
                    :class="tag === 'switzerland' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                <span>Fiscal residency in Switzerland</span>
                <img src="{{ asset('images/Flag_of_Switzerland_(Pantone).svg.webp') }}" class="h-3.5 w-auto rounded-xs object-contain shrink-0 border border-slate-200/60 shadow-3xs" alt="CH">
            </button>

            {{-- Tab: Elsewhere --}}
            <button type="button"
                    @click="switchTag('elsewhere')"
                    :class="tag === 'elsewhere' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                <span>Fiscal residency elsewhere</span>
                <span class="text-sm leading-none">🌐</span>
            </button>

        </div>
    </div>

    {{-- Page Header --}}
    <div class="payments-header" :class="(tag === 'france' || tag === 'switzerland' || tag === 'elsewhere') ? 'max-w-3xl mx-auto' : ''">
        <div class="payments-header-left">
        </div>
        <div class="payments-header-right" style="display: flex; gap: 12px; align-items: center;">
            <a href="{{ route('admin.payments.create') }}" class="payments-btn-add" x-show="tag !== 'france' && tag !== 'elsewhere' && tag !== 'switzerland'">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Payment Method
            </a>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════
         FRANCE TAB: Donation Settings
         ════════════════════════════════════════════════ --}}
    <div x-show="tag === 'france'" x-cloak class="france-settings-panel">
        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @php
            $fr = fn($key, $default = '') => old($key, $settings['france_' . $key] ?? $default);
        @endphp

        <div class="max-w-3xl mx-auto space-y-6">
            <form action="{{ route('admin.donate-content.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="redirect_tag" value="france">

                {{-- ── Online Donation (HelloAsso) Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                            <span class="text-base">🔗</span> Online Donation (HelloAsso)
                        </h3>
                        @php
                            $hasHelloAsso = filled($settings['france_helloasso_url'] ?? '');
                        @endphp
                        <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $hasHelloAsso ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400 border border-slate-200' }}">
                            {{ $hasHelloAsso ? '✓ Configured' : 'Not set' }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Redirect URL <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="url" name="helloasso_url"
                               value="{{ old('helloasso_url', $settings['france_helloasso_url'] ?? '') }}"
                               placeholder="https://www.helloasso.com/associations/..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <p class="mt-1.5 text-xs text-gray-400">Donors will be redirected here to make an online donation via HelloAsso.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Description <span class="text-gray-400 font-normal">(optional)</span></label>
                        <x-admin.rich-text name="helloasso_description" :value="$fr('helloasso_description', 'You can make a one-time or regular donation on our dedicated website, you will be redirected to our HelloAsso page:')" rows="3" />
                        <p class="mt-1.5 text-xs text-gray-400">Shown above the HelloAsso button.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Logo / Brand Image <span class="text-gray-400 font-normal">(optional)</span></label>
                        @php $logo = $settings['france_helloasso_logo'] ?? ''; @endphp
                        @if($logo)
                        <div class="flex items-center gap-4 p-3 bg-blue-50/60 rounded-xl border border-blue-100 mb-3">
                            <div class="relative">
                                <img src="{{ str_starts_with($logo, 'http') ? $logo : asset('storage/' . $logo) . '?v=' . time() }}" alt="HelloAsso logo" class="h-16 w-auto rounded-xl border-2 border-white shadow-sm bg-white object-contain p-1.5">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-700 mb-0.5">Current logo</p>
                                <p class="text-xs text-gray-400 truncate">{{ basename($logo) }}</p>
                            </div>
                            <label class="flex items-center gap-1.5 text-xs font-semibold text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0 bg-white px-3 py-1.5 rounded-lg border border-red-200 hover:bg-red-50 transition-colors">
                                <input type="checkbox" name="remove_helloasso_logo" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                                Remove
                            </label>
                        </div>
                        @endif
                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#2d6fa3] hover:bg-blue-50/30 transition-all duration-200 cursor-pointer group"
                             id="helloassoUploadZone"
                             onclick="document.getElementById('helloassoLogoInput').click()">
                            <input type="file" name="helloasso_logo" id="helloassoLogoInput" accept="image/*" class="hidden">
                            <div id="helloassoPlaceholder" class="flex flex-col items-center gap-2 pointer-events-none">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 group-hover:bg-[#2d6fa3]/10 flex items-center justify-center transition-colors">
                                    <svg class="w-6 h-6 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600 group-hover:text-[#2d6fa3] transition-colors">Click to upload logo</p>
                                    <p class="text-xs text-gray-400 mt-0.5">JPG, PNG, GIF or WebP &bull; Max 2MB</p>
                                </div>
                            </div>
                            <div id="helloassoPreview" class="hidden"></div>
                        </div>
                    </div>
                </div>

                {{-- ── Check / Bank Transfer Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                            <span class="text-base">📬</span> Check / Bank Transfer Details
                        </h3>
                        @php
                            $hasCheck = filled($settings['france_check_address'] ?? '');
                        @endphp
                        <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $hasCheck ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400 border border-slate-200' }}">
                            {{ $hasCheck ? '✓ Configured' : 'Not set' }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Check Recipient <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="check_recipient"
                               value="{{ $fr('check_recipient', 'Krousar Thmey France') }}"
                               placeholder="e.g. Krousar Thmey France"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <p class="mt-1.5 text-xs text-gray-400">The name the check should be payable to.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Description <span class="text-gray-400 font-normal">(optional)</span></label>
                        <x-admin.rich-text name="check_description" :value="$fr('check_description', 'You can also send a check payable to Krousar Thmey France at the following address:')" rows="2" />
                        <p class="mt-1.5 text-xs text-gray-400">Shown above the mailing address.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Mailing Address <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="check_address" rows="3"
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="62 rue Greneta&#10;75002 Paris">{{ $fr('check_address', "62 rue Greneta\n75002 Paris") }}</textarea>
                        <p class="mt-1.5 text-xs text-gray-400">The address where donors can mail a physical check.</p>
                    </div>
                </div>

                {{-- ── Tax Deductions Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                        <span class="text-base">🧾</span> Tax Deductions Content
                    </h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Intro text</label>
                        <x-admin.rich-text name="tax_intro" :value="$fr('tax_intro', 'The Krousar Thmey entities in France and Switzerland are recognized as being of public interest, so you can get tax deductions based on your donation.')" rows="2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">"Association of 1901 general interest" text</label>
                        <x-admin.rich-text name="tax_association_text" :value="$fr('tax_association_text', 'Deduction of <strong>66% of income tax (IR)</strong> and up to 20% of taxable income. If the limit is exceeded, the excess entitles you to a tax reduction for the next five years.')" rows="3" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">"Loi Coluche" text</label>
                        <x-admin.rich-text name="tax_coluche_text" :value="$fr('tax_coluche_text', 'Deduction of <strong>75% of income tax</strong> capped at <strong>€530</strong>. Beyond that, donations are deductible up to 66% of income tax and up to 20% of taxable income. If the limit is exceeded, the surplus entitles the holder to a tax reduction for the next five years.')" rows="3" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tax receipt note</label>
                        <input type="text" name="tax_receipt_note"
                               value="{{ $fr('tax_receipt_note', 'A tax receipt will be sent to you in March of the year following your donation.') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>

                {{-- ── Legacy Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                        <span class="text-base">🕊️</span> Legacy Content
                    </h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Intro text</label>
                        <x-admin.rich-text name="legacy_intro" :value="$fr('legacy_intro', 'As a recognized association of public utility, Krousar Thmey is entitled to receive bequests and donations.')" rows="2" />
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-4">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Bequest (Wills)</p>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">"What is a bequest?" text</label>
                            <x-admin.rich-text name="legacy_bequest_what_text" :value="$fr('legacy_bequest_what_text', 'A bequest is a testamentary disposition whereby a person transfers all or part of his or her property to the designated person. You can bequeath your property to an association recognized of public interest such as Krousar Thmey; Whatever the amount, the gift is exempt from all inheritance taxes.')" rows="3" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Legacy types note</label>
                            <x-admin.rich-text name="legacy_bequest_types_note" :value="$fr('legacy_bequest_types_note', 'There are several types of legacies: The universal legacy (all property), the legacy of a part of patrimony, or the particular legacy (bequest of one or more properties identified).')" rows="2" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">"How to make a legacy" intro</label>
                            <input type="text" name="legacy_bequest_how_intro"
                                   value="{{ $fr('legacy_bequest_how_intro', 'You have to write a will. The most common forms are:') }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">"How to make a legacy" list (holograph / authentic will)</label>
                            <x-admin.rich-text name="legacy_bequest_how_list" :value="$fr('legacy_bequest_how_list', '<ul><li><strong>The holograph will:</strong> document written, dated and signed by the hand of the testator, it is easy and inexpensive. However, it can sometimes be challenged when it is not drafted with the help of a specialized lawyer.</li><li><strong>The authentic testament:</strong> drawn up by a notary in the presence of two witnesses or a second notary, the authentic will must be signed by the testator. The notary writes it himself under the dictation of his client.</li></ul>')" rows="5" />
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-4">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Donation (Lifetime)</p>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">"What is a donation?" text</label>
                            <x-admin.rich-text name="legacy_donation_what_text" :value="$fr('legacy_donation_what_text', 'A donation is a contract by which you, as a donor, transfer ownership of a property to a beneficiary. You can give to a recognized public interest association, whatever the amount, this donation is exempt from all rights of succession.')" rows="3" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Capped share note</label>
                            <x-admin.rich-text name="legacy_donation_capped_note" :value="$fr('legacy_donation_capped_note', '<strong>Capped Share:</strong> The share you can transmit is called the amount available and corresponds to 1/2 of your assets if you have only one child, 1/3 if you have two children, and 1/4 if you have three or more children. It can be all or part of the estate if you have no other heirs.')" rows="3" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">"How to make a donation" text</label>
                            <x-admin.rich-text name="legacy_donation_how_text" :value="$fr('legacy_donation_how_text', 'Contrary to the will, which takes effect only at the death of the testator, this transmission takes place during the lifetime of its author. In principle, recourse to the notary is compulsory at the time of a donation. Nevertheless, the donor can hand over goods or money directly (manual donation).')" rows="3" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Contract conditions note</label>
                            <x-admin.rich-text name="legacy_donation_conditions_note" :value="$fr('legacy_donation_conditions_note', 'Three conditions of any contract must be met for a donation to be valid: the donor must have the capacity to give, the donee must have the capacity to receive, and donor and recipient must agree to the donation.')" rows="3" />
                        </div>
                    </div>
                </div>

                {{-- ── Save Button ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <h3 class="text-sm font-bold text-gray-700">Save Settings</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Changes are saved to the database when you click Save.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('donate') }}?residency=france" target="_blank"
                               class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors px-4 py-2 rounded-lg border border-gray-200 hover:border-[#2d6fa3]/30">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Preview
                            </a>
                            <button type="submit"
                                    class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Save France Settings
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════
         SWITZERLAND TAB: Donation Settings (same pattern as France)
         ════════════════════════════════════════════════ --}}
    <div x-show="tag === 'switzerland'" x-cloak class="france-settings-panel">
        @php
            $ch = fn($key, $default = '') => old($key, $settings['switzerland_' . $key] ?? $default);
        @endphp
        <div class="max-w-3xl mx-auto space-y-6">
            <form action="{{ route('admin.donate-content.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="redirect_tag" value="switzerland">

                {{-- ── Bank Transfer Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                            <span class="text-base">🏦</span> Bank Transfer Details
                        </h3>
                        @php $hasBank = filled($settings['switzerland_bank_account'] ?? ''); @endphp
                        <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $hasBank ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400 border border-slate-200' }}">
                            {{ $hasBank ? '✓ Configured' : 'Not set' }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Bank / Account Holder Name <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="bank_name"
                               value="{{ $ch('bank_name', 'Banque Cler') }}"
                               placeholder="e.g. Banque Cler"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Description <span class="text-gray-400 font-normal">(optional)</span></label>
                        <x-admin.rich-text name="bank_description" :value="$ch('bank_description', 'To make a donation to our entity in Switzerland, you can make a money transfer to our bank account:')" rows="2" />
                        <p class="mt-1.5 text-xs text-gray-400">Shown above the IBAN / account number.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">IBAN / Account Number <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="bank_account" rows="2"
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="IBAN CH87&#10;0844 0459 1242 9009 0">{{ $ch('bank_account', "IBAN CH87\n0844 0459 1242 9009 0") }}</textarea>
                    </div>
                </div>

                {{-- ── Online Donation (PayPal) Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                            <span class="text-base">🔗</span> Online Donation (PayPal)
                        </h3>
                        @php $hasPaypal = filled($settings['switzerland_paypal_url'] ?? ''); @endphp
                        <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $hasPaypal ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400 border border-slate-200' }}">
                            {{ $hasPaypal ? '✓ Configured' : 'Not set' }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Redirect URL <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="url" name="paypal_url"
                               value="{{ $ch('paypal_url') }}"
                               placeholder="https://www.paypal.com/..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <p class="mt-1.5 text-xs text-gray-400">Donors will be redirected here to donate via PayPal.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Description <span class="text-gray-400 font-normal">(optional)</span></label>
                        <x-admin.rich-text name="paypal_description" :value="$ch('paypal_description', 'You can make a online donation via our PayPal account')" rows="2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Logo / Brand Image <span class="text-gray-400 font-normal">(optional)</span></label>
                        @php $paypalLogo = $settings['switzerland_paypal_logo'] ?? ''; @endphp
                        @if($paypalLogo)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 mb-3">
                            <img src="{{ str_starts_with($paypalLogo, 'http') ? $paypalLogo : asset('storage/' . $paypalLogo) . '?v=' . time() }}"
                                 alt="PayPal logo" class="h-14 w-auto object-contain rounded-lg border border-gray-200 bg-white p-1">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-gray-600 mb-0.5">Current Logo</p>
                                <p class="text-xs text-gray-400 truncate">{{ basename($paypalLogo) }}</p>
                            </div>
                            <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                                <input type="checkbox" name="remove_paypal_logo" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                                Remove
                            </label>
                        </div>
                        @endif
                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#2d6fa3] hover:bg-blue-50/30 transition-all duration-200 cursor-pointer group"
                             id="paypalLogoUploadZone"
                             onclick="document.getElementById('paypalLogoInput').click()">
                            <input type="file" name="paypal_logo" id="paypalLogoInput" accept="image/*" class="hidden">
                            <div id="paypalLogoPlaceholder" class="flex flex-col items-center gap-2 pointer-events-none">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 group-hover:bg-[#2d6fa3]/10 flex items-center justify-center transition-colors">
                                    <svg class="w-6 h-6 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600 group-hover:text-[#2d6fa3] transition-colors">Click to upload logo</p>
                                    <p class="text-xs text-gray-400 mt-0.5">JPG, PNG, GIF or WebP &bull; Max 2MB</p>
                                </div>
                            </div>
                            <div id="paypalLogoPreview" class="hidden"></div>
                        </div>
                    </div>
                </div>

                {{-- ── Tax Notes Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                        <span class="text-base">🧾</span> Tax Note
                    </h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tax deductible note</label>
                        <input type="text" name="tax_note"
                               value="{{ $ch('tax_note', 'Donations are tax deductible in Switzerland.') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Receipt note</label>
                        <input type="text" name="tax_receipt_note"
                               value="{{ $ch('tax_receipt_note', 'A donation receipt will be sent in February of the year following your transfer') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>

                {{-- ── Save Button ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <h3 class="text-sm font-bold text-gray-700">Save Settings</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Changes are saved to the database when you click Save.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('donate') }}?residency=switzerland" target="_blank"
                               class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors px-4 py-2 rounded-lg border border-gray-200 hover:border-[#2d6fa3]/30">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Preview
                            </a>
                            <button type="submit"
                                    class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Save Switzerland Settings
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════
         ELSEWHERE TAB: Page Content
         ════════════════════════════════════════════════ --}}
    <div x-show="tag === 'elsewhere'" x-cloak class="france-settings-panel">
        @php
            $el = fn($key, $default = '') => old($key, $settings[$key] ?? $default);
        @endphp
        <form action="{{ route('admin.donate-content.update') }}" method="POST" class="max-w-3xl mx-auto space-y-6">
            @csrf
            <input type="hidden" name="redirect_tag" value="elsewhere">

            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-base">🌐</span> Impact Description
                </h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                    <x-admin.rich-text name="elsewhere_description" :value="$el('elsewhere_description', 'For donors residing elsewhere in the world, your international donation goes directly to support Krousar Thmey\'s child welfare, special education, and cultural development programs in Cambodia.')" rows="3" />
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-base">✨</span> Highlighted Bullet Points
                </h3>

                @foreach([1 => ['Special Education', 'Funding specialized schools and materials for deaf or blind children to learn and communicate.'], 2 => ['Child Welfare', 'Providing protection, safe housing, and family integration for street-involved and vulnerable kids.'], 3 => ['Cultural & Artistic Development', 'Supporting visual arts, traditional Khmer music, dance, and creative expression classes.']] as $i => $defaults)
                <div class="grid sm:grid-cols-[1fr_2fr] gap-3 {{ $i > 1 ? 'pt-4 border-t border-gray-100' : '' }}">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Bullet {{ $i }} title</label>
                        <input type="text" name="elsewhere_bullet_{{ $i }}_title"
                               value="{{ $el('elsewhere_bullet_' . $i . '_title', $defaults[0]) }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Bullet {{ $i }} description</label>
                        <input type="text" name="elsewhere_bullet_{{ $i }}_desc"
                               value="{{ $el('elsewhere_bullet_' . $i . '_desc', $defaults[1]) }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
                @endforeach
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-base">✅</span> Guarantee Note
                </h3>
                <input type="text" name="elsewhere_guarantee_note"
                       value="{{ $el('elsewhere_guarantee_note', '100% of your funds go directly to supporting the children in Cambodia.') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('donate') }}?residency=elsewhere" target="_blank"
                   class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors px-4 py-2 rounded-lg border border-gray-200 hover:border-[#2d6fa3]/30">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Preview
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    Save Elsewhere Settings
                </button>
            </div>
        </form>
    </div>

    {{-- ════════════════════════════════════════════════
         OTHER TABS: Payment Methods Table
         (Cambodia and "All Methods" use the payment methods table)
         ════════════════════════════════════════════════ --}}
    <div x-show="tag !== 'france' && tag !== 'elsewhere' && tag !== 'switzerland'" class="payments-content">

        {{-- Filter Bar --}}
        <div class="payments-filter-bar" style="border-top: none;">
            <div class="payments-search-input">
                <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" x-model="search" @input.debounce="applyFilters()"
                       placeholder="Search by name...">
                <button x-show="search.length > 0" @click="search = ''; applyFilters()" class="search-clear-btn" type="button">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="payments-filter-select-wrap">
                <svg class="filter-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <select x-model="status" @change="applyFilters()" class="payments-filter-select">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

        </div>

        {{-- Results Table --}}
        <div class="payments-table-wrapper">
            <div x-ref="results">
                @include('admin.payments._results')
            </div>

            {{-- Loading Overlay --}}
            <div x-show="loading" x-cloak class="payments-loading-overlay">
                <div class="payments-loading-spinner">
                    <svg class="animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    <span>Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Alpine.js Component --}}
<script>
function paymentManager() {
    return {
        search: '{{ $filters['search'] ?? '' }}',
        status: '{{ $filters['status'] ?? '' }}',
        tag: '{{ $filters['tag'] ?? '' }}',
        total: {{ $totalMethods ?? 0 }},
        activeFilters: {{ $activeCount ?? 0 }},
        loading: false,

        init() {},

        switchTag(t) {
            this.tag = t;
            this.applyFilters();
            this.$nextTick(() => requestAnimationFrame(() => window.initCKEditors && window.initCKEditors()));
        },

        applyFilters() {
            const params = new URLSearchParams();
            if (this.search) params.set('search', this.search);
            if (this.status) params.set('status', this.status);
            if (this.tag) params.set('tag', this.tag);

            this.loading = true;

            fetch(`{{ route('admin.payments.index') }}?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                this.$refs.results.innerHTML = data.html;
                this.total = data.total;
                this.activeFilters = data.activeFilters;
                history.replaceState(null, '', `?${params.toString()}`);
            })
            .catch(() => location.reload())
            .finally(() => this.loading = false);
        }
    };
}
</script>

{{-- HelloAsso logo upload preview --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoInput = document.getElementById('helloassoLogoInput');
    if (logoInput) {
        logoInput.addEventListener('change', function(e) {
            const preview = document.getElementById('helloassoPreview');
            const placeholder = document.getElementById('helloassoPlaceholder');
            const uploadZone = document.getElementById('helloassoUploadZone');
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
                        '     style="height:80px;width:auto;object-fit:contain;border-radius:8px;border:1px solid #e2e8f0;background:#fff;padding:6px;">',
                        '<div style="display:flex;align-items:center;gap:8px;">',
                        '    <span style="font-size:11px;color:#94a3b8;">' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)</span>',
                        '    <button type="button"',
                        '            style="background:#f1f5f9;border:none;border-radius:6px;padding:4px 12px;cursor:pointer;font-size:12px;color:#64748b;font-weight:500;"',
                        '            onclick="event.stopPropagation(); document.getElementById(\'helloassoLogoInput\').value=\'\'; document.getElementById(\'helloassoPreview\').innerHTML=\'\'; document.getElementById(\'helloassoPreview\').classList.add(\'hidden\'); document.getElementById(\'helloassoPlaceholder\').classList.remove(\'hidden\'); document.getElementById(\'helloassoUploadZone\').classList.remove(\'has-file\');">',
                        '        × Remove',
                        '    </button>',
                        '</div>',
                        '</div>'
                    ].join('');
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>

{{-- PayPal logo upload preview --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoInput = document.getElementById('paypalLogoInput');
    if (logoInput) {
        logoInput.addEventListener('change', function(e) {
            const preview = document.getElementById('paypalLogoPreview');
            const placeholder = document.getElementById('paypalLogoPlaceholder');
            const uploadZone = document.getElementById('paypalLogoUploadZone');
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
                        '     style="height:80px;width:auto;object-fit:contain;border-radius:8px;border:1px solid #e2e8f0;background:#fff;padding:6px;">',
                        '<div style="display:flex;align-items:center;gap:8px;">',
                        '    <span style="font-size:11px;color:#94a3b8;">' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)</span>',
                        '    <button type="button"',
                        '            style="background:#f1f5f9;border:none;border-radius:6px;padding:4px 12px;cursor:pointer;font-size:12px;color:#64748b;font-weight:500;"',
                        '            onclick="event.stopPropagation(); document.getElementById(\'paypalLogoInput\').value=\'\'; document.getElementById(\'paypalLogoPreview\').innerHTML=\'\'; document.getElementById(\'paypalLogoPreview\').classList.add(\'hidden\'); document.getElementById(\'paypalLogoPlaceholder\').classList.remove(\'hidden\'); document.getElementById(\'paypalLogoUploadZone\').classList.remove(\'has-file\');">',
                        '        × Remove',
                        '    </button>',
                        '</div>',
                        '</div>'
                    ].join('');
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>

@endsection
