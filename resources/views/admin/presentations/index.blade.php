@extends('admin.layouts.app')

@section('title', 'Presentation')
@section('page-title', 'Presentation Management')
@section('breadcrumb', 'Manage all content for the Presentation page')

@section('content')

<div class="space-y-8" x-data="{ tab: 'slideshow' }">
    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200">
        <nav class="flex space-x-8 overflow-x-auto">
            <button @click="tab = 'slideshow'" 
                    :class="tab === 'slideshow' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Intro / Mission / Vision
            </button>
            <button @click="tab = 'about'" 
                    :class="tab === 'about' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Our Values
            </button>
            <button @click="tab = 'values'" 
                    :class="tab === 'values' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Our Portfolio
            </button>
            <button @click="tab = 'programs'" 
                    :class="tab === 'programs' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Programs
            </button>
            <button @click="tab = 'impact'" 
                    :class="tab === 'impact' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Key Figures
            </button>
            <button @click="tab = 'principle'" 
                    :class="tab === 'principle' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Krousar Thmey Worldwide
            </button>
            <button @click="tab = 'worldwide'" 
                    :class="tab === 'worldwide' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Share our impact
            </button>
        </nav>
    </div>

    {{-- HERO SECTION --}}
    <div x-show="tab === 'hero'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-4 text-sm">Hero Section</h3>
            <form action="{{ route('admin.presentation.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="section" value="hero">
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Hero Title</label>
                    <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? 'KROUSAR THMEY' }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Hero Subtitle</label>
                    <input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] ?? 'The First Cambodian Organization Helping Disadvantaged Children' }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Hero Description</label>
                    <input type="text" name="hero_description" value="{{ $settings['hero_description'] ?? 'Born in 1991 in the Site II Refugee Camp in Thailand.' }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Background Image</label>
                    <div class="space-y-3">
                        {{-- Current image preview --}}
                        @if(!empty($settings['hero_image']))
                        <div class="flex items-center gap-3">
                            <img src="{{ str_starts_with($settings['hero_image'], 'http') ? $settings['hero_image'] : asset('storage/' . $settings['hero_image']) }}" 
                                 alt="Current hero image" class="w-20 h-14 object-cover rounded-lg border border-gray-200">
                            <label class="flex items-center gap-1.5 text-xs text-gray-500">
                                <input type="checkbox" name="remove_hero_image" value="1" class="rounded border-gray-300">
                                Remove current image
                            </label>
                        </div>
                        @endif
                        
                        {{-- File upload --}}
                        <input type="file" name="hero_image_file" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        
                        {{-- OR URL --}}
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-px bg-gray-200"></div>
                            <span class="text-xs text-gray-400">OR</span>
                            <div class="flex-1 h-px bg-gray-200"></div>
                        </div>
                        
                        <input type="url" name="hero_image" value="{{ $settings['hero_image'] ?? '' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="https://example.com/image.jpg">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Upload an image (max 4MB) or paste an external URL. Upload takes priority.</p>
                </div>
                
                <button type="submit" class="btn-primary text-sm py-2.5">Save Hero Section</button>
            </form>
        </div>
    </div>

    {{-- HERO SLIDESHOW SECTION --}}
    <div x-show="tab === 'slideshow'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Hero Slideshow</h3>
                <a href="{{ route('admin.presentation-slides.create') }}" class="btn-primary text-sm">+ Add Slide</a>
            </div>
            
            @php
            $presentationSlides = \App\Models\PresentationSlide::orderBy('sort_order')->orderBy('id')->get();
            @endphp
            
            @if($presentationSlides->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm font-medium">No slides yet.</p>
                <a href="{{ route('admin.presentation-slides.create') }}" class="text-[#2d6fa3] text-sm underline mt-1 inline-block">Add your first slide</a>
            </div>
            @else
            <div class="space-y-3">
                @foreach($presentationSlides as $slide)
                <div class="bg-gray-50 rounded-xl border border-gray-100 overflow-hidden flex">
                    {{-- Preview --}}
                    <div class="relative w-40 flex-shrink-0 hidden sm:block">
                        <div class="h-24 rounded-l-xl overflow-hidden">
                            <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-[#1d4e7a]/60"></div>
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-3 pointer-events-none">
                            @if($slide->badge_text)
                            <span class="text-xs bg-[#e8a020] text-white px-2 py-0.5 rounded-full w-fit mb-1">{{ $slide->badge_text }}</span>
                            @endif
                            <p class="text-white text-xs font-bold leading-snug line-clamp-2">{{ $slide->title }}</p>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 p-4 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full
                                          {{ $slide->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $slide->is_active ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                                    {{ $slide->is_active ? 'Active' : 'Hidden' }}
                                </span>
                                <span class="text-gray-300 text-xs">Order: {{ $slide->sort_order }}</span>
                            </div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1 truncate max-w-sm">{{ $slide->title }}</h4>
                            @if($slide->subtitle)
                            <p class="text-gray-400 text-xs line-clamp-1 max-w-sm">{{ $slide->subtitle }}</p>
                            @endif
                        </div>
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.presentation-slides.edit', $slide) }}" title="Edit"
                               class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.presentation-slides.destroy', $slide) }}" method="POST"
                                  onsubmit="return confirm('Delete this slide?')">
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
                </div>
                @endforeach
            </div>

            <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-xl text-xs text-blue-600">
                <strong>Tip:</strong> Change the <em>Sort Order</em> on each slide to control which appears first. Lower numbers appear first.
                The carousel auto-advances every 5.5 seconds.
            </div>
            @endif
        </div>
    </div>

    {{-- ABOUT SECTION --}}
    <div x-show="tab === 'about'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-4 text-sm">About Section</h3>
            <form action="{{ route('admin.presentation.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="section" value="about">
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                    <input type="text" name="about_title" value="{{ $settings['about_title'] ?? 'Who We Are' }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                    <textarea name="about_description" rows="4"
                              class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $settings['about_description'] ?? 'Krousar Thmey supports disadvantaged children through sustainable projects focused on child welfare, education, culture, inclusion, and health. The organization develops projects led by Cambodians for Cambodians.' }}</textarea>
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Image</label>
                    <div class="space-y-3">
                        @if(!empty($settings['about_image']))
                        <div class="flex items-center gap-3">
                            <img src="{{ str_starts_with($settings['about_image'], 'http') ? $settings['about_image'] : asset('storage/' . $settings['about_image']) }}" 
                                 alt="Current about image" class="w-20 h-14 object-cover rounded-lg border border-gray-200">
                            <label class="flex items-center gap-1.5 text-xs text-gray-500">
                                <input type="checkbox" name="remove_about_image" value="1" class="rounded border-gray-300">
                                Remove current image
                            </label>
                        </div>
                        @endif
                        
                        <input type="file" name="about_image_file" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-px bg-gray-200"></div>
                            <span class="text-xs text-gray-400">OR</span>
                            <div class="flex-1 h-px bg-gray-200"></div>
                        </div>
                        
                        <input type="url" name="about_image" value="{{ $settings['about_image'] ?? '' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="https://example.com/image.jpg">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Upload an image (max 4MB) or paste an external URL. Upload takes priority.</p>
                </div>
                
                <button type="submit" class="btn-primary text-sm py-2.5">Save About Section</button>
            </form>
        </div>
    </div>

    {{-- OUR VALUES SECTION --}}
    <div x-show="tab === 'values'" class="space-y-6">
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
                              placeholder="Krousar Thmey offers a portfolio of cross-cutting programs...">{{ old('values_supporting_description', $settings['values_supporting_description'] ?? '') }}</textarea>
                    <p class="text-xs text-gray-400 mt-1">This text appears under the Our Values header on the presentation page.</p>
                </div>
                
                <button type="submit" class="btn-primary text-sm py-2.5">Save Supporting Description</button>
            </form>
        </div>
        
        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Add value form --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Value</h3>
                <form action="{{ route('admin.core-values.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Title <span class="text-red-400">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="e.g. Identity">
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
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>                            <label class="block text-xs font-medium text-gray-600 mb-1">Image</label>
                        <input type="file" name="image" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <input type="url" name="image_url" value="{{ old('image_url') }}"
                               class="w-full mt-2 px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="...or paste an image URL">
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
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                                        <input type="number" name="sort_order" value="{{ $value->sort_order }}"
                                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Image</label>
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
                                        <input type="url" name="image_url"
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
    </div>

    {{-- PROGRAMS SECTION --}}
    <div x-show="tab === 'programs'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-4 text-sm">Manage Programs</h3>
            <p class="text-gray-500 text-xs mb-4">Programs are managed in the Programs section. <a href="{{ route('admin.programs.index') }}" class="text-[#2d6fa3] hover:underline">Go to Programs Management</a></p>
            
            @php
            $adminPrograms = \App\Models\Program::active()->get();
            @endphp
            
            @if($adminPrograms->isEmpty())
            <p class="text-gray-400 text-sm">No programs configured yet. <a href="{{ route('admin.programs.index') }}" class="text-[#2d6fa3] hover:underline">Add programs</a></p>
            @else
            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($adminPrograms as $program)
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <div class="w-12 h-12 rounded-full bg-[#2d6fa3] flex items-center justify-center mx-auto mb-2 overflow-hidden">
                        @if($program->image_url)
                        <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                        @else
                        <span class="text-xl">⭐</span>
                        @endif
                    </div>
                    <p class="text-xs font-medium text-gray-700">{{ $program->title }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    {{-- IMPACT STATISTICS SECTION --}}
    <div x-show="tab === 'impact'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Key Figures / Impact Statistics</h3>
                <a href="{{ route('admin.impact-statistics.index') }}" class="text-xs text-[#2d6fa3] hover:underline">Manage All Statistics</a>
            </div>
            
            @php
            $impactStats = \App\Models\ImpactStatistic::active()->orderBy('sort_order')->get();
            @endphp
            
            @if($impactStats->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No impact statistics configured yet.</p>
                <a href="{{ route('admin.impact-statistics.index') }}" class="text-[#2d6fa3] text-sm underline">Add your first statistic</a>
            </div>
            @else
            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($impactStats as $stat)
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center mx-auto mb-2">
                        <img src="{{ $stat->image_url }}" alt="{{ $stat->label }}" class="w-full h-full object-cover">
                    </div>
                    <p class="text-xs font-bold text-gray-700">{{ $stat->value }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $stat->label }}</p>
                </div>
                @endforeach
            </div>
            
            <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-xl text-xs text-blue-600">
                <strong>Tip:</strong> Click "Manage All Statistics" to edit values, images, and reorder statistics.
            </div>
            @endif
        </div>
    </div>

{{-- OUR PRINCIPLE SECTION --}}
    <div x-show="tab === 'principle'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Our Principle</h3>
                <a href="{{ route('admin.principle-slides.index') }}" class="text-xs text-[#2d6fa3] hover:underline">Manage Background Slides</a>
            </div>
            <form action="{{ route('admin.presentation.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="section" value="principle">
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                    <input type="text" name="principle_title" value="{{ $settings['principle_title'] ?? 'Our Principle' }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Quote</label>
                    <textarea name="principle_quote" rows="3"
                              class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $settings['principle_quote'] ?? "Krousar Thmey's main principle is the development of projects led by Cambodians for Cambodians." }}</textarea>
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Background Image (Fallback)</label>
                    <p class="text-xs text-gray-400 mb-2">This image is used when no slides are configured. <a href="{{ route('admin.principle-slides.index') }}" class="text-[#2d6fa3] hover:underline">Manage slides for slideshow</a></p>
                    <div class="space-y-3">
                        @if(!empty($settings['principle_image']))
                        <div class="flex items-center gap-3">
                            <img src="{{ str_starts_with($settings['principle_image'], 'http') ? $settings['principle_image'] : asset('storage/' . $settings['principle_image']) }}" 
                                 alt="Current principle image" class="w-20 h-14 object-cover rounded-lg border border-gray-200">
                            <label class="flex items-center gap-1.5 text-xs text-gray-500">
                                <input type="checkbox" name="remove_principle_image" value="1" class="rounded border-gray-300">
                                Remove current image
                            </label>
                        </div>
                        @endif
                        
                        <input type="file" name="principle_image_file" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-px bg-gray-200"></div>
                            <span class="text-xs text-gray-400">OR</span>
                            <div class="flex-1 h-px bg-gray-200"></div>
                        </div>
                        
                        <input type="url" name="principle_image" value="{{ $settings['principle_image'] ?? '' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="https://example.com/image.jpg">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Upload an image (max 4MB) or paste an external URL. Used as fallback when no slides exist.</p>
                </div>
                
                <button type="submit" class="btn-primary text-sm py-2.5">Save Principle Section</button>
            </form>
        </div>
    </div>

    {{-- WORLDWIDE PARTNERS SECTION --}}
    <div x-show="tab === 'worldwide'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Krousar Thmey Worldwide</h3>
                <a href="{{ route('admin.worldwide-partners.index') }}" class="text-xs text-[#2d6fa3] hover:underline">Manage All Countries</a>
            </div>
            
            @php
            $worldwidePartners = \App\Models\WorldwidePartner::active()->get();
            @endphp
            
            @if($worldwidePartners->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No country partners yet.</p>
                <a href="{{ route('admin.worldwide-partners.create') }}" class="text-[#2d6fa3] text-sm underline">Add your first country</a>
            </div>
            @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($worldwidePartners as $partner)
                <div class="bg-gray-50 rounded-xl border border-gray-100 overflow-hidden flex">
                    {{-- Image --}}
                    <div class="relative w-24 flex-shrink-0 hidden sm:block">
                        <div class="aspect-video rounded-l-xl overflow-hidden">
                            <img src="{{ $partner->image_url }}" alt="{{ $partner->country_name }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 p-4 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <h4 class="font-bold text-gray-800 text-sm mb-1 truncate">{{ $partner->country_name }}</h4>
                            @if($partner->description)
                            <p class="text-gray-400 text-xs line-clamp-2">{{ Str::limit($partner->description, 60) }}</p>
                            @endif
                        </div>
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.worldwide-partners.edit', $partner) }}" title="Edit"
                               class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    {{-- SHARE OUR IMPACT SECTION --}}
    <div x-show="tab === 'sharing'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Share our impact - Social Media Links</h3>
            </div>
            
            <form action="{{ route('admin.presentation.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="section" value="sharing">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Enable Share Section</label>
                        <label class="flex items-center gap-2 text-xs text-gray-600">
                            <input type="checkbox" name="sharing_enabled" value="1" {{ (old('sharing_enabled', \App\Models\HomeSetting::getValue('sharing_enabled', '1')) == '1') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                            Show share buttons on presentation page
                        </label>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Section Title</label>
                        <input type="text" name="sharing_title" 
                               value="{{ old('sharing_title', \App\Models\HomeSetting::getValue('sharing_title', 'Share our impact')) }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
                
                <div class="pt-3 border-t border-gray-100">
                    <p class="text-xs font-medium text-gray-700 mb-3">Social Media Links & Icons</p>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-[#1877F2] flex items-center justify-center">
                                <img src="{{ asset(\App\Models\HomeSetting::getValue('sharing_facebook_icon', 'images/social/facebook.svg')) }}" alt="Facebook" class="w-6 h-6 filter brightness-0 invert">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Facebook Icon & Link</label>
                                <input type="url" name="sharing_facebook_link" value="{{ old('sharing_facebook_link', \App\Models\HomeSetting::getValue('sharing_facebook_link', '')) }}"
                                       class="w-full mb-2 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="https://facebook.com/yourpage">
                                <input type="file" name="sharing_facebook_icon" accept="image/svg+xml,image/png,image/jpeg,image/webp"
                                       class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-[#2d6fa3]">
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-[#1DA1F2] flex items-center justify-center">
                                <img src="{{ asset(\App\Models\HomeSetting::getValue('sharing_twitter_icon', 'images/social/twitter.svg')) }}" alt="Twitter" class="w-6 h-6 filter brightness-0 invert">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Twitter Icon & Link</label>
                                <input type="url" name="sharing_twitter_link" value="{{ old('sharing_twitter_link', \App\Models\HomeSetting::getValue('sharing_twitter_link', '')) }}"
                                       class="w-full mb-2 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="https://twitter.com/yourpage">
                                <input type="file" name="sharing_twitter_icon" accept="image/svg+xml,image/png,image/jpeg,image/webp"
                                       class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-[#2d6fa3]">
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-[#0A66C2] flex items-center justify-center">
                                <img src="{{ asset(\App\Models\HomeSetting::getValue('sharing_linkedin_icon', 'images/social/linkedin.svg')) }}" alt="LinkedIn" class="w-6 h-6 filter brightness-0 invert">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">LinkedIn Icon & Link</label>
                                <input type="url" name="sharing_linkedin_link" value="{{ old('sharing_linkedin_link', \App\Models\HomeSetting::getValue('sharing_linkedin_link', '')) }}"
                                       class="w-full mb-2 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="https://linkedin.com/yourpage">
                                <input type="file" name="sharing_linkedin_icon" accept="image/svg+xml,image/png,image/jpeg,image/webp"
                                       class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-[#2d6fa3]">
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gray-600 flex items-center justify-center">
                                <img src="{{ asset(\App\Models\HomeSetting::getValue('sharing_share_icon', 'images/social/share.svg')) }}" alt="Share" class="w-6 h-6 filter brightness-0 invert">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Share Icon</label>
                                <input type="file" name="sharing_share_icon" accept="image/svg+xml,image/png,image/jpeg,image/webp"
                                       class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-[#2d6fa3]">
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn-primary text-sm py-2.5">Save Sharing Settings</button>
            </form>
        </div>
    </div>

@endsection