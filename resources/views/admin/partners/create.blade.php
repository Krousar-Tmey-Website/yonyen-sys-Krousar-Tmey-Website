@extends('admin.layouts.app')

@section('title', 'Add Partner')
@section('page-title', 'Add Partner')
@section('breadcrumb', 'Partners → Add Partner')

@section('content')

<div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8" x-data="bilingualForm()">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-1">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
                New Partner
            </h3>
            <div class="lang-tabs" title="Toggle editing language (English / French)">
                <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
            </div>
        </div>
        <p class="text-sm text-gray-400 mb-6 ml-9">Add a new partner organisation to the website.</p>

        <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @include('admin.partners._form', ['partner' => null])

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">Add Partner</button>
                <a href="{{ route('admin.partners.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
