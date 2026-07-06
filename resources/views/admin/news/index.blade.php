@extends('admin.layouts.app')

@section('title', 'News Articles')
@section('page-title', 'News Articles')
@section('breadcrumb', 'Manage all news and updates')

@section('content')

{{-- Stats Overview Cards --}}
@php
    $total = $articles->total();
    $published = $articles->where('is_published', true)->count();
    $drafts = $articles->where('is_published', false)->count();
    $categories = $articles->pluck('category')->unique()->count();
    $recentCount = $articles->where('is_published', true)
        ->where('published_at', '>=', now()->subDays(7))
        ->count();
@endphp

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total }}</p>
            </div>
            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 pt-2 border-t border-gray-50">
            <span class="text-xs text-gray-400">All articles</span>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Published</p>
                <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $published }}</p>
            </div>
            <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 pt-2 border-t border-gray-50">
            <span class="text-xs text-emerald-600">● Live on site</span>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Drafts</p>
                <p class="text-2xl font-bold text-amber-600 mt-1">{{ $drafts }}</p>
            </div>
            <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 pt-2 border-t border-gray-50">
            <span class="text-xs text-amber-600">● In progress</span>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Categories</p>
                <p class="text-2xl font-bold text-purple-600 mt-1">{{ $categories }}</p>
            </div>
            <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 pt-2 border-t border-gray-50">
            <span class="text-xs text-purple-600">● {{ $categories }} types</span>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Recent</p>
                <p class="text-2xl font-bold text-rose-600 mt-1">{{ $recentCount }}</p>
            </div>
            <div class="w-10 h-10 bg-rose-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 pt-2 border-t border-gray-50">
            <span class="text-xs text-rose-600">● Last 7 days</span>
        </div>
    </div>
</div>

{{-- Toolbar --}}
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
    <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
        <div class="relative flex-1 sm:flex-initial min-w-[200px]">
            <input type="text" 
                   placeholder="Search articles..." 
                   class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-all bg-gray-50/50 hover:bg-white focus:bg-white">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <select class="px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] bg-gray-50/50 hover:bg-white transition-all text-gray-600 cursor-pointer">
            <option value="">All Categories</option>
            @foreach($articles->pluck('category')->unique()->sort()->values() as $cat)
            <option value="{{ $cat }}" class="capitalize">{{ str_replace('-', ' ', $cat) }}</option>
            @endforeach
        </select>
        <select class="px-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] bg-gray-50/50 hover:bg-white transition-all text-gray-600 cursor-pointer">
            <option value="">All Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <a href="{{ route('admin.news.create') }}" 
       class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] text-white rounded-lg text-sm font-medium hover:bg-[#1d4e7a] transition-all shadow-sm hover:shadow-md whitespace-nowrap">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Article
    </a>
</div>

{{-- Table --}}
<div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
    @if($articles->isEmpty())
    <div class="px-6 py-20 text-center">
        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-600 mb-1">No articles yet</h3>
        <p class="text-sm text-gray-400 mb-4">Get started by creating your first news article.</p>
        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-2 text-[#2d6fa3] text-sm font-medium hover:text-[#1d4e7a] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create your first article
        </a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50/80 border-b border-gray-100">
                    <th class="px-6 py-3.5 text-left">
                        <div class="flex items-center gap-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            <span>Article</span>
                        </div>
                    </th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Published</th>
                    <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($articles as $article)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            {{-- Thumbnail --}}
                            <div class="w-12 h-12 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                                @if($article->image)
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#2d6fa3]/10 to-[#2d6fa3]/20">
                                    <svg class="w-5 h-5 text-[#2d6fa3]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <div class="font-medium text-gray-800 hover:text-[#2d6fa3] transition-colors truncate max-w-xs">
                                    {{ $article->title }}
                                </div>
                                @if($article->excerpt)
                                <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $article->excerpt }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 capitalize">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                            {{ str_replace('-', ' ', $article->category) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($article->is_published)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Published
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Draft
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($article->published_at)
                        <div class="text-xs">
                            <div class="text-gray-700 font-medium">{{ $article->published_at->format('d M Y') }}</div>
                            <div class="text-gray-400 text-[10px]">{{ $article->published_at->format('h:i A') }}</div>
                        </div>
                        @else
                        <span class="text-gray-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-1">
                            {{-- Edit Button --}}
                            <a href="{{ route('admin.news.edit', $article) }}" 
                               class="p-2 text-gray-400 hover:text-[#2d6fa3] hover:bg-[#2d6fa3]/10 rounded-lg transition-all duration-200"
                               title="Edit article">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            {{-- View Button - Only show if route exists --}}
                            @if(Route::has('news.show'))
                            <a href="{{ route('news.show', $article->slug) }}" target="_blank"
                               class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all duration-200"
                               title="View on site">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            @endif

                            {{-- Delete Button --}}
                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST"
                                  onsubmit="return confirm('⚠️ Permanently delete this article?\n\nThis action cannot be undone.')"
                                  class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200"
                                        title="Delete article">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{-- Table Footer with Pagination --}}
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-sm text-gray-500">
            Showing <span class="font-medium text-gray-700">{{ $articles->firstItem() ?? 0 }}</span> to 
            <span class="font-medium text-gray-700">{{ $articles->lastItem() ?? 0 }}</span> of 
            <span class="font-medium text-gray-700">{{ $articles->total() }}</span> articles
        </div>
        <div class="flex items-center gap-2">
            {{ $articles->links() }}
        </div>
    </div>
    @endif
</div>

{{-- Quick Tips --}}
<div class="mt-6 bg-blue-50/60 rounded-xl border border-blue-100/50 p-4 flex items-start gap-3">
    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <div>
        <p class="text-sm font-medium text-blue-800">Quick Tips</p>
        <ul class="text-xs text-blue-700 mt-1 space-y-0.5">
            <li>• <strong>Published</strong> articles are visible on the public news page.</li>
            <li>• <strong>Drafts</strong> are only visible to admins and editors.</li>
            @if(Route::has('news.show'))
            <li>• Click the <strong>View</strong> icon <span class="inline-flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></span> to preview the article on the live site.</li>
            @endif
        </ul>
    </div>
</div>

@endsection