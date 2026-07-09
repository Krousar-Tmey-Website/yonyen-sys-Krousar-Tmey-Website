@extends('admin.layouts.app')

@section('title', 'View Award')
@section('page-title', 'View Award')
@section('breadcrumb', 'Awards → View')

@section('content')

<div class="form-container">
    {{-- Award Details --}}
    <div class="form-card">
        <div class="card-header">
            <div class="icon green">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <h3>Award Details</h3>
        </div>
        <div class="card-body">
            <div class="grid md:grid-cols-2 gap-6">
                {{-- Image/Icon --}}
                <div class="text-center">
                    @if($award->image)
                    <img src="{{ $award->image_url }}" alt="{{ $award->title }}" class="w-32 h-32 rounded-2xl object-cover mx-auto shadow-lg">
                    @else
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#2d6fa3] to-[#1a3c6e] flex items-center justify-center mx-auto shadow-lg">
                        <span class="text-6xl">{{ $award->icon }}</span>
                    </div>
                    @endif
                </div>

                {{-- Details --}}
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-bold text-[#8da83a] uppercase tracking-wider mb-1">Title</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $award->title }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#8da83a] uppercase tracking-wider mb-1">Organization</p>
                        <p class="text-gray-600">{{ $award->organization }}</p>
                    </div>
                    @if($award->recipient)
                    <div>
                        <p class="text-xs font-bold text-[#8da83a] uppercase tracking-wider mb-1">Recipient</p>
                        <p class="text-gray-600">{{ $award->recipient }}</p>
                    </div>
                    @endif
                    @if($award->description)
                    <div>
                        <p class="text-xs font-bold text-[#8da83a] uppercase tracking-wider mb-1">Description</p>
                        <p class="text-gray-600 text-sm">{{ $award->description }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-xs font-bold text-[#8da83a] uppercase tracking-wider mb-1">Sort Order</p>
                        <p class="text-gray-600">{{ $award->sort_order ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- External Link --}}
    @if($award->link_url)
    <div class="form-card">
        <div class="card-header">
            <div class="icon blue">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-8m0-6V6a2 2 0 112 2h-6m-6 0l6 6m-6-6l6-6"/>
                </svg>
            </div>
            <h3>External Link</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <p class="text-xs font-bold text-[#8da83a] uppercase tracking-wider mb-1">Link Type</p>
                <p class="text-gray-600">{{ ucfirst($award->link_type) }}</p>
            </div>
            <div class="form-group">
                <p class="text-xs font-bold text-[#8da83a] uppercase tracking-wider mb-1">Link Text</p>
                <p class="text-gray-600">{{ $award->link_text ?? ucfirst($award->link_type) }}</p>
            </div>
            <div class="form-group">
                <p class="text-xs font-bold text-[#8da83a] uppercase tracking-wider mb-1">Link URL</p>
                <a href="{{ $award->link_url }}" target="_blank" rel="noopener" class="text-[#2d6fa3] hover:underline break-all">
                    {{ $award->link_url }}
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- Actions --}}
    <div class="form-actions">
        <a href="{{ route('admin.awards.edit', $award) }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Award
        </a>
        <a href="{{ route('admin.awards.index') }}" class="btn-cancel">Back to List</a>
    </div>
</div>

@endsection