@extends('admin.layouts.app')

@section('title', 'Presentation')
@section('page-title', 'Presentation Management')
@section('breadcrumb', 'Manage all content for the Presentation page')

@section('content')

<div class="space-y-8" x-data="{ tab: 'hero' }">
    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200">
        <nav class="flex space-x-8 overflow-x-auto">
            <button @click="tab = 'hero'" 
                    :class="tab === 'hero' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Hero Section
            </button>
            <button @click="tab = 'slideshow'" 
                    :class="tab === 'slideshow' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Hero Slideshow
            </button>
            <button @click="tab = 'about'" 
                    :class="tab === 'about' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                About Section
            </button>
            <button @click="tab = 'values'" 
                    :class="tab === 'values' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Our Values
            </button>
            <button @click="tab = 'programs'" 
                    :class="tab === 'programs' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Programs
            </button>
            <button @click="tab = 'impact'" 
                    :class="tab === 'impact' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Impact Statistics
            </button>
            <button @click="tab = 'principle'" 
                    :class="tab === 'principle' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Our Principle
            </button>
            <button @click="tab = 'worldwide'" 
                    :class="tab === 'worldwide' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Worldwide Partners
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
                        <div class="h-full min-h-[90px] bg-cover bg-center"
                             style="background-image: url('{{ $slide->image_url }}')">
                            <div class="absolute inset-0 bg-[#1d4e7a]/60"></div>
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-3">
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
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('admin.presentation-slides.edit', $slide) }}"
                               class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium px-3 py-1.5 border border-[#2d6fa3]/30 rounded-lg hover:bg-[#2d6fa3]/5 transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.presentation-slides.destroy', $slide) }}" method="POST"
                                  onsubmit="return confirm('Delete this slide?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-300 hover:text-red-500 text-xs font-medium px-3 py-1.5 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                                    Delete
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
                        <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                        <textarea name="description" rows="2"
                                  class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="Short description...">{{ old('description') }}</textarea>
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
                                        @if($value->description)
                                        <p class="text-gray-400 text-xs mt-1 line-clamp-2">{{ $value->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                                    <button @click="editing = true" class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium p-1">Edit</button>
                                    <form action="{{ route('admin.core-values.destroy', $value) }}" method="POST"
                                          onsubmit="return confirm('Remove this value?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-300 hover:text-red-500 transition-colors p-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
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
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                                        <textarea name="description" rows="2"
                                                  class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] resize-none">{{ $value->description }}</textarea>
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
            
            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-4">
                @php
                $programs = [
                    ['title' => 'Child Welfare', 'icon' => '👶', 'color' => 'bg-[#2d6fa3]'],
                    ['title' => 'Education for Deaf or Blind Children', 'icon' => '🦻', 'color' => 'bg-[#1d4e7a]'],
                    ['title' => 'Cultural and Artistic Development', 'icon' => '🎨', 'color' => 'bg-[#8da83a]'],
                    ['title' => 'Academic and Career Counseling', 'icon' => '📚', 'color' => 'bg-[#d4af37]'],
                    ['title' => 'Health and Hygiene', 'icon' => '🏥', 'color' => 'bg-[#2d6fa3]'],
                ];
                @endphp
                
                @foreach($programs as $program)
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <div class="w-12 h-12 rounded-full {{ $program['color'] }} flex items-center justify-center mx-auto mb-2 text-xl">
                        {{ $program['icon'] }}
                    </div>
                    <p class="text-xs font-medium text-gray-700">{{ $program['title'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- IMPACT STATISTICS SECTION --}}
    <div x-show="tab === 'impact'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-4 text-sm">Key Figures / Impact Statistics</h3>
            <form action="{{ route('admin.presentation.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="section" value="impact">
                
                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Children Supported</label>
                        <input type="text" name="stat_children" value="{{ $settings['stat_children'] ?? '4,079' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Child Welfare Program</label>
                        <input type="text" name="stat_welfare" value="{{ $settings['stat_welfare'] ?? '240' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Special Education Students</label>
                        <input type="text" name="stat_special_ed" value="{{ $settings['stat_special_ed'] ?? '768' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Children in 2025</label>
                        <input type="text" name="stat_2025" value="{{ $settings['stat_2025'] ?? '3,526' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Arts & Culture Students</label>
                        <input type="text" name="stat_arts" value="{{ $settings['stat_arts'] ?? '1,088' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Career Counseling</label>
                        <input type="text" name="stat_counseling" value="{{ $settings['stat_counseling'] ?? '357' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Employees</label>
                        <input type="text" name="stat_employees" value="{{ $settings['stat_employees'] ?? '68' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Annual Budget (USD)</label>
                        <input type="text" name="stat_budget" value="{{ $settings['stat_budget'] ?? '950K' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Administrative Costs</label>
                        <input type="text" name="stat_admin" value="{{ $settings['stat_admin'] ?? '< 4%' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
                <button type="submit" class="btn-primary text-sm py-2.5">Save Impact Statistics</button>
            </form>
        </div>
    </div>

    {{-- OUR PRINCIPLE SECTION --}}
    <div x-show="tab === 'principle'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-4 text-sm">Our Principle</h3>
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
                    <label class="block text-xs font-medium text-gray-600 mb-1">Background Image</label>
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
                    <p class="text-xs text-gray-400 mt-1">Upload an image (max 4MB) or paste an external URL. Upload takes priority.</p>
                </div>
                
                <button type="submit" class="btn-primary text-sm py-2.5">Save Principle Section</button>
            </form>
        </div>
    </div>

    {{-- WORLDWIDE PARTNERS SECTION --}}
    <div x-show="tab === 'worldwide'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-4 text-sm">Krousar Thmey Worldwide</h3>
            <p class="text-gray-500 text-xs mb-4">International offices are managed in the Offices section. <a href="{{ route('admin.offices.index') }}" class="text-[#2d6fa3] hover:underline">Go to Offices Management</a></p>
            
            @php
            $offices = \App\Models\Office::active()->where('country', '!=', 'Cambodia')->get();
            @endphp
            
            @if($offices->isNotEmpty())
            <div class="grid md:grid-cols-3 gap-4">
                @foreach($offices as $office)
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center mx-auto mb-2">
                        <span class="text-xl">{{ $office->flag }}</span>
                    </div>
                    <p class="text-xs font-medium text-gray-700">Krousar Thmey {{ $office->country }}</p>
                    <p class="text-xs text-gray-500">{{ $office->city }}</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-400 text-sm">No international offices configured yet.</p>
            @endif
        </div>
    </div>
</div>

@endsection