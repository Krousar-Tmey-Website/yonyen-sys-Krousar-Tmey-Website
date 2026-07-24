@extends('admin.layouts.app')

@section('title', 'Analytics')
@section('page-title', 'Analytics')
@section('breadcrumb', 'View website traffic and statistics')

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 p-8">
    <div class="text-center py-12">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        <h3 class="text-lg font-medium text-gray-700 mb-2">Analytics Dashboard</h3>
        <p class="text-gray-400">Connect your analytics service (Google Analytics, etc.) to view website statistics here.</p>
    </div>
</div>
@endsection