@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Welcome back, ' . auth()->user()->name)

@section('content')

{{-- Stat cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['label' => 'Total Articles',   'value' => $stats['news_total'],     'color' => 'bg-[#2d6fa3]', 'route' => 'admin.news.index'],
        ['label' => 'Published',        'value' => $stats['news_published'], 'color' => 'bg-[#8da83a]', 'route' => 'admin.news.index'],
        ['label' => 'Programs',         'value' => $stats['programs'],       'color' => 'bg-[#1d4e7a]', 'route' => 'admin.programs.index'],
        ['label' => 'Projects',         'value' => $stats['projects'],       'color' => 'bg-[#2d6fa3]', 'route' => 'admin.projects.index'],
        ['label' => 'Additional Pages', 'value' => $stats['page_items'],     'color' => 'bg-[#e8a020]', 'route' => 'admin.program-pages.index'],
        ['label' => 'Partners',         'value' => $stats['partners'],       'color' => 'bg-[#2d6fa3]', 'route' => 'admin.partners.index'],
        ['label' => 'Awards',           'value' => $stats['awards'],         'color' => 'bg-[#8da83a]', 'route' => 'admin.awards.index'],
    ] as $card)
    <a href="{{ route($card['route']) }}"
       class="bg-white rounded-2xl p-5 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="text-3xl font-black text-gray-800 mb-1">{{ $card['value'] }}</div>
        <div class="text-gray-400 text-xs">{{ $card['label'] }}</div>
        <div class="h-1 {{ $card['color'] }} rounded-full mt-3 w-8"></div>
    </a>
    @endforeach
</div>

{{-- Recent news --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
        <h2 class="font-bold text-gray-800">Recent Articles</h2>
        <a href="{{ route('admin.news.create') }}" class="btn-primary text-xs px-4 py-2">+ New Article</a>
    </div>
    @if($recentNews->isEmpty())
    <div class="px-6 py-12 text-center text-gray-400 text-sm">
        No articles yet. <a href="{{ route('admin.news.create') }}" class="text-[#2d6fa3] underline">Create your first article.</a>
    </div>
    @else
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Title</th>
                <th class="px-6 py-3 text-left">Category</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($recentNews as $article)
            <tr class="hover:bg-gray-50/50">
                <td class="px-6 py-3 font-medium text-gray-700 max-w-xs truncate">{{ $article->title }}</td>
                <td class="px-6 py-3 text-gray-400 capitalize">{{ $article->category }}</td>
                <td class="px-6 py-3">
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                        {{ $article->is_published ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-6 py-3 text-gray-400 text-xs">{{ $article->created_at->format('d M Y') }}</td>
                <td class="px-6 py-3 text-right">
                    <a href="{{ route('admin.news.edit', $article) }}" class="text-[#2d6fa3] hover:underline text-xs">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection
