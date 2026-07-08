@extends('admin.layouts.app')

@section('title', 'Social Links')
@section('page-title', 'Social Media Links')
@section('breadcrumb', 'Manage social media links displayed on the website')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Manage the social media links shown in the top bar and footer.</p>
    <a href="{{ route('admin.social-links.create') }}" class="btn-primary text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Social Link
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-100 bg-gray-50/50">
                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Platform</th>
                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">URL</th>
                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Active</th>
                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Order</th>
                <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($socialLinks as $link)
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-base">
                            @switch($link->icon)
                                @case('facebook')  📘 @break
                                @case('instagram') 📸 @break
                                @case('linkedin')  💼 @break
                                @case('youtube')   ▶️ @break
                                @case('telegram')  ✈️ @break
                                @default           🔗
                            @endswitch
                        </div>
                        <span class="font-medium text-gray-800 text-sm">{{ $link->platform_name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ $link->url }}" target="_blank" rel="noopener"
                       class="text-sm text-[#2d6fa3] hover:underline truncate max-w-xs block">
                        {{ $link->url }}
                    </a>
                </td>
                <td class="px-6 py-4 text-center">
                    @if($link->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-50 text-gray-400">
                            Inactive
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $link->sort_order }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.social-links.edit', $link) }}"
                           class="text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors p-2 rounded-lg hover:bg-blue-50 border border-blue-200"
                           title="Edit {{ $link->platform_name }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST"
                              onsubmit="return confirm('Delete {{ $link->platform_name }}? This cannot be undone.');">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="text-red-400 hover:text-red-600 transition-colors p-2 rounded-lg hover:bg-red-50 border border-red-200"
                                    title="Delete {{ $link->platform_name }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center">
                    <p class="text-gray-400 text-sm">No social links yet.</p>
                    <a href="{{ route('admin.social-links.create') }}" class="text-[#2d6fa3] text-sm hover:underline mt-1 inline-block">
                        Add your first social link
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
