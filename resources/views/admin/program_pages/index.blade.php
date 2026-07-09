@extends('admin.layouts.app')

@section('title', 'Additional Pages')
@section('page-title', 'Additional Pages')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <p class="text-gray-500 text-sm">Manage page items that appear under the Our Programs section.</p>
        <p class="text-gray-400 text-xs mt-1">Each item has a title, short preview, and full detail content shown on "Read More".</p>
    </div>
    <a href="{{ route('admin.program-pages.create') }}"
       class="flex-shrink-0 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add New Item
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Item</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Images</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($items as $item)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-gray-100 flex-shrink-0 overflow-hidden">
                                @if($item->image)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                @endif
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">{{ $item->title }}</div>
                                @if($item->short_content)
                                <div class="text-xs text-gray-400 mt-0.5 max-w-xs truncate">{{ $item->short_content }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-1.5">
                            @php $imgCount = collect([$item->image, $item->image_2, $item->image_3])->filter()->count(); @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold {{ $imgCount > 0 ? 'bg-blue-50 text-blue-700' : 'bg-gray-100 text-gray-400' }}">
                                {{ $imgCount }} {{ Str::plural('image', $imgCount) }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($item->is_active)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Hidden</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('program-page-items.show', $item->id) }}" target="_blank"
                               class="text-gray-400 hover:text-[#2d6fa3] p-1.5 rounded-lg hover:bg-gray-100 transition-colors" title="View Public Page">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="{{ route('admin.program-pages.edit', $item) }}"
                               class="text-gray-400 hover:text-[#2d6fa3] p-1.5 rounded-lg hover:bg-gray-100 transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.program-pages.destroy', $item) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Delete this item?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition-colors" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 text-sm">
                        No items found. <a href="{{ route('admin.program-pages.create') }}" class="text-[#2d6fa3] hover:underline">Create one</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
