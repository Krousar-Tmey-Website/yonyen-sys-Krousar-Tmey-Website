@extends('admin.layouts.app')

@section('title', $partner->name)
@section('page-title', $partner->name)
@section('breadcrumb', 'Partners → ' . $partner->name)

@section('content')

<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Header with logo --}}
        <div class="px-6 py-5 bg-gray-50 border-b border-gray-100 flex items-center gap-4">
            @if ($partner->logo)
                <img src="{{ asset('storage/' . $partner->logo) }}"
                     alt="{{ $partner->name }}"
                     class="w-16 h-16 rounded-xl object-cover border border-gray-100 bg-white">
            @else
                <div class="w-16 h-16 rounded-xl bg-blue-50 flex items-center justify-center text-blue-400 text-xl font-bold">
                    {{ Str::substr($partner->name, 0, 1) }}
                </div>
            @endif
            <div>
                <h2 class="text-xl font-bold text-gray-800">{{ $partner->name }}</h2>
                @if ($partner->partnerCategory)
                    <p class="text-sm text-gray-400 flex items-center gap-1.5 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        {{ $partner->partnerCategory->name }}
                    </p>
                @endif
            </div>
        </div>

        {{-- Details --}}
        <div class="p-6 space-y-5">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Status</p>
                    @if ($partner->is_active)
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">
                            Active
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">
                            Hidden
                        </span>
                    @endif
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Created</p>
                    <p class="text-sm font-medium text-gray-800">{{ $partner->created_at->format('d M Y, h:i A') }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Updated</p>
                    <p class="text-sm font-medium text-gray-800">{{ $partner->updated_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-3">
            <a href="{{ route('admin.partners.edit', $partner) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Partner
            </a>
            <a href="{{ route('admin.partners.index') }}"
               class="px-4 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl text-sm font-medium transition">
                Back to List
            </a>
        </div>
    </div>
</div>

@endsection
