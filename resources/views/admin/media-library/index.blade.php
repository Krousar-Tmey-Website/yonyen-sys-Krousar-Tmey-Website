@extends('admin.layouts.app')

@section('title', 'Media Library')
@section('page-title', 'Media Library')
@section('breadcrumb', 'Browse all uploaded media files')

@section('content')
<div class="space-y-6">
    @if($files->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center">
        <p class="text-gray-400">No media files found. Files will appear here after you upload them in other sections.</p>
    </div>
    @else
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($files as $file)
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="h-32 bg-gray-50 flex items-center justify-center">
                @if(str_starts_with($file['type'], 'image/'))
                <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" class="max-w-full max-h-full object-contain">
                @else
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                @endif
            </div>
            <div class="p-4">
                <p class="text-xs font-medium text-gray-700 truncate" title="{{ $file['name'] }}">{{ $file['name'] }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $file['directory'] }}</p>
                <p class="text-xs text-gray-400">{{ number_format($file['size'] / 1024, 1) }} KB</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection