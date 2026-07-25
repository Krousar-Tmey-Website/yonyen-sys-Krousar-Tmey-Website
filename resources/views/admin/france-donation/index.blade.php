@extends('admin.layouts.app')

@section('title', 'France Donation Settings')
@section('page-title', 'France Donation Settings')
@section('breadcrumb', 'Manage content and links for the France fiscal residency donation page')

@section('content')

@if($errors->any())
<div class="max-w-3xl mx-auto mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="max-w-3xl mx-auto space-y-6">
    <form action="{{ route('admin.france-donation.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

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

            {{-- URL --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Redirect URL <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <input type="url" name="helloasso_url"
                       value="{{ old('helloasso_url', $settings['france_helloasso_url'] ?? '') }}"
                       placeholder="https://www.helloasso.com/associations/..."
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Donors will be redirected here to make an online donation via HelloAsso.
                </p>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Description <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <textarea name="helloasso_description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="You can make a one-time or regular donation on our dedicated website, you will be redirected to our HelloAsso page:">{{ old('helloasso_description', $settings['france_helloasso_description'] ?? '') }}</textarea>
                <p class="mt-1.5 text-xs text-gray-400">Shown above the HelloAsso button. Leave blank to use the default text.</p>
            </div>

            {{-- Logo Upload --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Logo / Brand Image <span class="text-gray-400 font-normal">(optional)</span>
                </label>

                @php $logo = $settings['france_helloasso_logo'] ?? ''; @endphp
                @if($logo)
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 mb-3">
                    <img src="{{ str_starts_with($logo, 'http') ? $logo : asset('storage/' . $logo) . '?v=' . time() }}"
                         alt="HelloAsso logo" class="h-14 w-auto object-contain rounded-lg border border-gray-200 bg-white p-1">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-gray-600 mb-0.5">Current Logo</p>
                        <p class="text-xs text-gray-400 truncate">{{ $logo }}</p>
                    </div>
                    <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                        <input type="checkbox" name="remove_helloasso_logo" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                        Remove
                    </label>
                </div>
                @else
                <div class="flex items-center gap-3 p-3 bg-[#2d6fa3]/5 rounded-xl border border-[#2d6fa3]/10 mb-3">
                    <div class="h-14 w-14 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-[#2d6fa3]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-xs text-gray-500">No logo uploaded — falls back to the default HelloAsso logo on the public page.</p>
                </div>
                @endif
                <input type="file" name="helloasso_logo" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-1.5 text-xs text-gray-400">JPG, PNG, GIF or WebP · Max 2MB</p>
            </div>
        </div>

        {{-- ── Check / Bank Transfer Card ── --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-base">📬</span> Check / Bank Transfer Details
                </h3>
                @php
                    $hasCheck = filled($settings['france_check_recipient'] ?? '') || filled($settings['france_check_address'] ?? '');
                @endphp
                <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $hasCheck ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400 border border-slate-200' }}">
                    {{ $hasCheck ? '✓ Configured' : 'Not set' }}
                </span>
            </div>

            {{-- Recipient --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Check Recipient <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <input type="text" name="check_recipient"
                       value="{{ old('check_recipient', $settings['france_check_recipient'] ?? '') }}"
                       placeholder="e.g. Krousar Thmey France"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">The name the check should be payable to.</p>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Description <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <textarea name="check_description" rows="2"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="You can also send a check payable to Krousar Thmey France at the following address:">{{ old('check_description', $settings['france_check_description'] ?? '') }}</textarea>
                <p class="mt-1.5 text-xs text-gray-400">Shown above the mailing address. Leave blank to use the default text.</p>
            </div>

            {{-- Address --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Mailing Address <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <textarea name="check_address" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="62 rue Greneta&#10;75002 Paris">{{ old('check_address', $settings['france_check_address'] ?? '') }}</textarea>
                <p class="mt-1.5 text-xs text-gray-400 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    The address where donors can mail a physical check.
                </p>
            </div>
        </div>

        {{-- ── Preview & Actions ── --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-sm font-bold text-gray-700">Preview &amp; Save</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Changes are saved to the database when you click Save.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('donate') }}?residency=france" target="_blank"
                       class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors px-4 py-2 rounded-lg border border-gray-200 hover:border-[#2d6fa3]/30">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Preview donate page
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save France Settings
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
