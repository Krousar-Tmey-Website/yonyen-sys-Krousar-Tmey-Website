@extends('admin.layouts.app')

@section('title', 'Edit Partner')
@section('page-title', $partner->name)
@section('breadcrumb', 'Partners → ' . $partner->name)

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" x-data="bilingualForm()">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-1">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                Edit Partner
            </h3>
            <div class="flex items-center gap-3">
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
                @if ($partner->logo)
                    <img src="{{ asset('storage/' . $partner->logo) }}"
                         alt="{{ $partner->name }}"
                         class="w-10 h-10 rounded-xl object-cover border border-gray-100 bg-white">
                @else
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500 text-sm font-bold">
                        {{ Str::substr($partner->name, 0, 1) }}
                    </div>
                @endif
            </div>
        </div>
        <p class="text-sm text-gray-400 mb-6 ml-9">Update partner information and website display settings.</p>

        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.partners._form', ['partner' => $partner])

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">Update Partner</button>
                <a href="{{ route('admin.partners.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
