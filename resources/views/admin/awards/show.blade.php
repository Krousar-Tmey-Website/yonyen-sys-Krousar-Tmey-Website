@extends('admin.layouts.app')

@section('title', $award->title)
@section('page-title', 'Award Details')
@section('breadcrumb', 'Awards → ' . $award->title)

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Header --}}
        <div class="px-6 py-5 bg-gray-50 border-b border-gray-100 flex items-center gap-4">
            <span class="text-5xl">{{ $award->icon }}</span>
            <div>
                <h2 class="text-xl font-bold text-gray-800">{{ $award->title }}</h2>
                <p class="text-sm text-[#2d6fa3] font-medium">{{ $award->organization }}</p>
            </div>
        </div>

        {{-- Details --}}
        <div class="p-6 space-y-5">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Title</p>
                    <p class="text-sm font-medium text-gray-800">{{ $award->title }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Organization</p>
                    <p class="text-sm font-medium text-gray-800">{{ $award->organization }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Recipient</p>
                    <p class="text-sm font-medium text-gray-800">{{ $award->recipient ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Sort Order</p>
                    <p class="text-sm font-medium text-gray-800">{{ $award->sort_order ?? 0 }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Created</p>
                    <p class="text-sm font-medium text-gray-800">{{ $award->created_at->format('d M Y, h:i A') }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Updated</p>
                    <p class="text-sm font-medium text-gray-800">{{ $award->updated_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>

            @if($award->description)
            <div class="border-t border-gray-100 pt-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Description</p>
                <p class="text-sm text-gray-600 leading-relaxed">{{ $award->description }}</p>
            </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-3">
            <a href="{{ route('admin.awards.index') }}"
               class="px-4 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl text-sm font-medium transition">
                Back to Awards
            </a>
        </div>
    </div>
</div>

@endsection
