@extends('admin.layouts.app')

@section('title', 'SEO Settings')
@section('page-title', 'SEO Settings')
@section('breadcrumb', 'Manage search engine optimization settings')

@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ route('admin.seo.update') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Site Name</label>
                <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'Krousar Thmey') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">The name of your website, used in page titles and meta tags.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Site Tagline</label>
                <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? 'គ្រួសារថ្មី · New Family') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">A short description shown in meta tags.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Meta Description</label>
                <textarea name="site_description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                <p class="mt-1.5 text-xs text-gray-400">The default meta description for your website. This appears in search results.</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">Save SEO Settings</button>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection