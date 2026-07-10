@extends('admin.layouts.app')

@section('title', 'Offices')
@section('page-title', 'Office Locations')
@section('breadcrumb', 'Manage office locations displayed on the Contact page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Add form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Office</h3>
        <form action="{{ route('admin.offices.store') }}" method="POST" class="space-y-3">
            @csrf
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Country <span class="text-red-400">*</span></label>
                    <input type="text" name="country" value="{{ old('country') }}" required
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Cambodia">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">City <span class="text-red-400">*</span></label>
                    <input type="text" name="city" value="{{ old('city') }}" required
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Phnom Penh">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Flag (emoji)</label>
                    <input type="text" name="flag" value="{{ old('flag', '🌍') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] text-center text-lg">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Badge Label</label>
                    <input type="text" name="badge" value="{{ old('badge') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Headquarters">
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Address <span class="text-red-400">*</span></label>
                <input type="text" name="address" value="{{ old('address') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="#58, Street 478, Phnom Penh">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="+855 (0)23 211 955">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="info@krousar-thmey.org">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Accent Color (Tailwind)</label>
                    <input type="text" name="accent_color" value="{{ old('accent_color', 'border-[#2d6fa3]') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
            <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Office</button>
        </form>
    </div>

    {{-- List --}}
    <div class="lg:col-span-2 space-y-4">
        @if($offices->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
            No offices yet. Add your first one.
        </div>
        @else
        @foreach($offices as $office)
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden" x-data="{ editing: false }">
            {{-- View row --}}
            <div class="flex items-start justify-between px-5 py-4" x-show="!editing">
                <div class="flex items-start gap-3 min-w-0">
                    <span class="text-2xl flex-shrink-0 mt-0.5">{{ $office->flag }}</span>
                    <div class="min-w-0">
                        <p class="font-semibold text-gray-700 text-sm">{{ $office->country }} — {{ $office->city }}</p>
                        @if($office->badge)<span class="text-xs bg-[#2d6fa3]/10 text-[#2d6fa3] px-2 py-0.5 rounded-full">{{ $office->badge }}</span>@endif
                        <p class="text-gray-400 text-xs mt-1">{{ $office->address }}</p>
                        @if($office->phone)<p class="text-gray-400 text-xs">{{ $office->phone }}</p>@endif
                        @if($office->email)<p class="text-gray-400 text-xs">{{ $office->email }}</p>@endif
                        @if(!$office->is_active)<span class="text-xs text-orange-400">hidden</span>@endif
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                    <button @click="editing = true" class="text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors p-1 text-xs font-medium">Edit</button>
                    <form action="{{ route('admin.offices.destroy', $office) }}" method="POST"
                          onsubmit="return confirm('Remove {{ addslashes($office->country) }} office?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-300 hover:text-red-500 transition-colors p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Edit form --}}
            <div class="px-5 py-4 bg-gray-50 border-t border-gray-100" x-show="editing" x-cloak>
                <form action="{{ route('admin.offices.update', $office) }}" method="POST" class="space-y-3">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Country</label>
                            <input type="text" name="country" value="{{ $office->country }}" required
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">City</label>
                            <input type="text" name="city" value="{{ $office->city }}" required
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Flag</label>
                            <input type="text" name="flag" value="{{ $office->flag }}"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] text-center text-lg">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Badge</label>
                            <input type="text" name="badge" value="{{ $office->badge }}"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Address</label>
                        <input type="text" name="address" value="{{ $office->address }}" required
                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Phone</label>
                            <input type="text" name="phone" value="{{ $office->phone }}"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Email</label>
                            <input type="email" name="email" value="{{ $office->email }}"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Accent Color</label>
                            <input type="text" name="accent_color" value="{{ $office->accent_color }}"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                            <input type="number" name="sort_order" value="{{ $office->sort_order }}"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                        </div>
                        <div class="flex items-end pb-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ $office->is_active ? 'checked' : '' }}
                                       class="rounded accent-[#2d6fa3] w-4 h-4">
                                <span class="text-xs text-gray-600">Active</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="btn-primary text-xs px-4 py-2">Save</button>
                        <button type="button" @click="editing = false" class="text-gray-400 hover:text-gray-600 text-xs px-4 py-2">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@endsection
