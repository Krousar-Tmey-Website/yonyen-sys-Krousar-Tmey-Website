@extends('admin.layouts.app')

@section('title', $news->title)
@section('page-title', 'Article Details')
@section('breadcrumb', 'News → ' . Str::limit($news->title, 40))

@section('content')

<div class="max-w-4xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Image --}}
        @if($news->image)
        <div class="relative h-64 overflow-hidden">
            <img src="{{ $news->image_url }}" alt="{{ $news->title }}"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        </div>
        @endif

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center gap-2 mb-3">
                <span class="px-3 py-1 bg-gray-100 rounded-full text-xs font-medium text-gray-600">
                    {{ $news->category_name }}
                </span>
                @if($news->is_published)
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs font-semibold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Published
                    </span>
                @else
                    <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-xs font-semibold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        Draft
                    </span>
                @endif
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $news->title }}</h2>
            @if($news->published_at)
            <p class="text-sm text-gray-400 mt-2">
                Published {{ $news->published_at->format('d M Y, h:i A') }}
            </p>
            @endif
        </div>

        {{-- Content --}}
        <div class="px-6 py-5 space-y-6">
            @if($news->excerpt)
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Excerpt</p>
                <p class="text-sm text-gray-600 italic">{{ $news->excerpt }}</p>
            </div>
            @endif

            @if($news->content)
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Content</p>
                <div class="text-sm text-gray-600 leading-relaxed whitespace-pre-wrap">{{ $news->content }}</div>
            </div>
            @endif

            {{-- Details grid --}}
            <div class="border-t border-gray-100 pt-5">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Slug</p>
                        <p class="text-sm font-medium text-gray-800">{{ $news->slug }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Category</p>
                        <p class="text-sm font-medium text-gray-800">{{ $news->category_name }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tags</p>
                        <p class="text-sm font-medium text-gray-800">{{ $news->tags ?? '—' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Created</p>
                        <p class="text-sm font-medium text-gray-800">{{ $news->created_at->format('d M Y, h:i A') }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Updated</p>
                        <p class="text-sm font-medium text-gray-800">{{ $news->updated_at->format('d M Y, h:i A') }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Public URL</p>
                        @if($news->is_published)
                        <a href="{{ route('news.show', $news->slug) }}" target="_blank"
                           class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                            View on site
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                        @else
                        <p class="text-sm text-gray-400">Not published</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Links --}}
            @if(!empty($news->links))
            <div class="border-t border-gray-100 pt-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Related Links</p>
                <div class="space-y-2">
                    @foreach($news->links as $link)
                    <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
                       class="flex items-center gap-2 p-3 bg-gray-50 rounded-xl hover:bg-blue-50 transition group">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600">{{ $link['title'] }}</span>
                        <span class="text-xs text-gray-400 ml-auto">{{ $link['url'] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-3 flex-wrap">
            <a href="{{ route('admin.news.edit', $news) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Article
            </a>
            @if($news->is_published)
            <a href="{{ route('news.show', $news->slug) }}" target="_blank"
               class="px-4 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl text-sm font-medium transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                View on Site
            </a>
            @endif
            <a href="{{ route('admin.news.index') }}"
               class="px-4 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl text-sm font-medium transition">
                Back to Articles
            </a>
        </div>
    </div>
</div>

@endsection
