@extends('admin.layouts.app')

@section('title', 'Our Values')
@section('page-title', 'Our Values')
@section('breadcrumb', 'Manage the value cards displayed on the About page')

@section('content')

<div class="space-y-6">
    {{-- Supporting Description (Global) --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Our Values Supporting Description</h3>
        <form action="{{ route('admin.presentation.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="section" value="values_supporting">
            
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Supporting Description</label>
                <textarea name="values_supporting_description" rows="3"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Krousar Thmey offers a portfolio of cross-cutting programs...">{{ old('values_supporting_description', \App\Models\HomeSetting::getValue('values_supporting_description', '')) }}</textarea>
                <p class="text-xs text-gray-400 mt-1">This text appears under the Our Values header on the presentation page.</p>
            </div>
            
            <button type="submit" class="btn-primary text-sm py-2.5">Save Supporting Description</button>
        </form>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6 mt-6">
    {{-- Add value form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Value</h3>
        <form action="{{ route('admin.core-values.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="e.g. Integration">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Headline (e.g. "Every child belongs.")</label>
                <input type="text" name="headline" value="{{ old('headline') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Every child belongs.">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="2"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Full description...">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Supporting Description</label>
                <textarea name="supporting_description" rows="2"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Supporting description...">{{ old('supporting_description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', '⭐') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] text-center text-lg">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Image (optional, overrides icon)</label>
                <input type="file" name="image" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <input type="url" name="image_url" value="{{ old('image_url') }}"
                       class="w-full mt-2 px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="...or paste an image URL">
                @error('image')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                @error('image_url')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Value</button>
        </form>
    </div>

    {{-- Values list --}}
    <div class="lg:col-span-2">
        @if($coreValues->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
            No values yet. Add your first one.
        </div>
        @else
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100">
                <h4 class="font-semibold text-gray-700 text-sm">{{ $coreValues->count() }} Value(s)</h4>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($coreValues as $value)
                <div x-data="{ editing: false }">
                    {{-- View row --}}
                    <div class="flex items-start justify-between px-5 py-4 hover:bg-gray-50/50" x-show="!editing">
                        <div class="flex items-start gap-3 min-w-0">
                            @if($value->image_url)
                            <img src="{{ $value->image_url }}" alt="" class="w-8 h-8 object-cover flex-shrink-0 mt-0.5 rounded-lg">
                            @else
                            <span class="text-2xl flex-shrink-0 mt-0.5">{{ $value->icon }}</span>
                            @endif
                            <div class="min-w-0">
                                <p class="font-semibold text-gray-700 text-sm">{{ $value->title }}</p>
                                @if($value->headline)
                                <p class="text-gray-500 text-xs font-medium mt-0.5">{{ $value->headline }}</p>
                                @endif
                                @if($value->description)
                                <p class="text-gray-400 text-xs mt-1 line-clamp-2">{{ $value->description }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-2">
                            <button @click="editing = true" title="Edit"
                                    class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <form action="{{ route('admin.core-values.destroy', $value) }}" method="POST"
                                  onsubmit="return confirm('Remove this value?')">
                                @csrf @method('DELETE')
                                <button type="submit" title="Delete"
                                        class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- Edit form --}}
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100" x-show="editing" x-cloak>
                        <form action="{{ route('admin.core-values.update', $value) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf @method('PUT')
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                                <input type="text" name="title" value="{{ $value->title }}" required
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Headline (e.g. "Every child belongs.")</label>
                                <input type="text" name="headline" value="{{ $value->headline }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]"
                                       placeholder="Every child belongs.">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                                <textarea name="description" rows="2"
                                          class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] resize-none">{{ $value->description }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Supporting Description</label>
                                <textarea name="supporting_description" rows="2"
                                          class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] resize-none">{{ $value->supporting_description }}</textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Icon</label>
                                    <input type="text" name="icon" value="{{ $value->icon }}"
                                           class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] text-center text-lg">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                                    <input type="number" name="sort_order" value="{{ $value->sort_order }}"
                                           class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Image (optional, overrides icon)</label>
                                @if($value->image_url)
                                <div class="flex items-center gap-2 mb-2">
                                    <img src="{{ $value->image_url }}" alt="" class="w-10 h-10 object-cover rounded-lg border border-gray-200">
                                    <label class="flex items-center gap-1.5 text-xs text-gray-500">
                                        <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300">
                                        Remove current image
                                    </label>
                                </div>
                                @endif
                                <input type="file" name="image" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#2d6fa3]">
                                <input type="url" name="image_url" value="{{ $value->image_url ?? '' }}"
                                       class="w-full mt-2 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]"
                                       placeholder="...or paste an image URL">
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="btn-primary text-xs px-4 py-2">Save</button>
                                <button type="button" @click="editing = false" class="text-gray-400 hover:text-gray-600 text-xs px-4 py-2">Cancel</button>
                            </div>
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