@extends('admin.layouts.app')

@section('title', 'Awards')
@section('page-title', 'Awards')
@section('breadcrumb', 'Manage awards displayed on the About page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Add award form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Award</h3>
        <form action="{{ route('admin.awards.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Award title...">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Organization <span class="text-red-400">*</span></label>
                <input type="text" name="organization" value="{{ old('organization') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Awarding organization...">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Recipient (optional)</label>
                <input type="text" name="recipient" value="{{ old('recipient') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Person name if applicable...">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="2"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Short description...">{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', '🏆') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] text-center text-lg">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
            <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Award</button>
        </form>
    </div>

    {{-- Awards list --}}
    <div class="lg:col-span-2">
        @if($awards->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
            No awards yet. Add your first one.
        </div>
        @else
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100">
                <h4 class="font-semibold text-gray-700 text-sm">{{ $awards->count() }} Award(s)</h4>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($awards as $award)
                <div class="flex items-start justify-between px-5 py-4 hover:bg-gray-50/50">
                    <div class="flex items-start gap-3 min-w-0">
                        <span class="text-2xl flex-shrink-0 mt-0.5">{{ $award->icon }}</span>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-700 text-sm">{{ $award->title }}</p>
                            <p class="text-[#2d6fa3] text-xs">{{ $award->organization }}</p>
                            @if($award->recipient)
                            <p class="text-gray-400 text-xs">{{ $award->recipient }}</p>
                            @endif
                            @if($award->description)
                            <p class="text-gray-400 text-xs mt-1 line-clamp-2">{{ $award->description }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                        <a href="{{ route('admin.awards.show', $award) }}" title="View"
                           class="text-emerald-400 hover:text-emerald-600 transition-colors p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                        <form action="{{ route('admin.awards.destroy', $award) }}" method="POST"
                              onsubmit="return confirm('Remove this award?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-300 hover:text-red-500 transition-colors p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
