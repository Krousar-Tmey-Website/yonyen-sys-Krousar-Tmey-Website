@extends('admin.layouts.app')

@section('title', 'News Articles')
@section('page-title', 'News Articles')
@section('breadcrumb', 'Manage all news and updates')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">{{ $articles->total() }} article(s) total</p>
    <a href="{{ route('admin.news.create') }}" class="btn-primary text-sm">+ New Article</a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    @if($articles->isEmpty())
    <div class="px-6 py-16 text-center text-gray-400">
        <svg class="w-10 h-10 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
        <p class="text-sm">No articles yet.</p>
        <a href="{{ route('admin.news.create') }}" class="text-[#2d6fa3] text-sm underline mt-1 inline-block">Create your first article</a>
    </div>
    @else
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Title</th>
                <th class="px-6 py-3 text-left">Category</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Published</th>
                <th class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($articles as $article)
            <tr class="hover:bg-gray-50/50">
                <td class="px-6 py-4">
                    <div class="font-medium text-gray-700 max-w-xs">{{ $article->title }}</div>
                    @if($article->excerpt)
                    <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $article->excerpt }}</div>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-400 capitalize">{{ $article->category }}</td>
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-50 text-green-600' : 'bg-amber-50 text-amber-600' }}">
                        {{ $article->is_published ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-400 text-xs">
                    {{ $article->published_at?->format('d M Y') ?? '—' }}
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.news.edit', $article) }}"
                           class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium">Edit</a>
                        <form action="{{ route('admin.news.destroy', $article) }}" method="POST"
                              onsubmit="return confirm('Delete this article?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 text-xs">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-50">
        {{ $articles->links() }}
    </div>
    @endif
</div>

@endsection
