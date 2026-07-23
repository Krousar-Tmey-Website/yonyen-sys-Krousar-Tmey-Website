@extends('admin.layouts.app')

@section('title', 'Edit Presentation Slide')
@section('page-title', 'Edit Presentation Slide')
@section('breadcrumb', 'Presentation Slides → Edit')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Form --}}
    <div>
        <form action="{{ route('admin.presentation-slides.update', $slide) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            {{-- Slide Text --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4" x-data="{ lang: 'en' }">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-gray-700 text-sm">Slide Content</h3>
                    <div class="lang-tabs">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'">FR</button>
                    </div>
                </div>

                <div x-show="lang === 'en'" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Badge Label</label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', $slide->badge_text) }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="Our Mission">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                        <textarea name="title" rows="2"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('title', $slide->title) }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Line breaks split the title on the slide.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle</label>
                        <textarea name="subtitle" rows="3"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('subtitle', $slide->subtitle) }}</textarea>
                    </div>
                </div>

                <div x-show="lang === 'fr'" x-cloak class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Badge Label (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="badge_text_fr" value="{{ old('badge_text_fr', $slide->badge_text_fr) }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="Notre Mission">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="title_fr" rows="2"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('title_fr', $slide->title_fr) }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English title.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="subtitle_fr" rows="3"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('subtitle_fr', $slide->subtitle_fr) }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English subtitle.</p>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 text-sm">Background Image</h3>

                {{-- Current preview --}}
                <div class="relative h-40 rounded-xl overflow-hidden border border-gray-200">
                    <div class="w-full h-full bg-cover bg-center"
                         style="background-image: url('{{ $slide->image_url }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0f2448]/60 to-transparent flex items-end p-4">
                        <p class="text-white text-xs font-semibold">Current image</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Replace with Upload</label>
                    <input type="file" name="image" accept="image/*" id="imageInput"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400">OR</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Replace with External URL</label>
                    <input type="url" name="image_url"
                           value="{{ old('image_url', str_starts_with((string)$slide->image, 'http') ? $slide->image : '') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="https://...">
                </div>
            </div>

            {{-- CTAs --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4" x-data="{ lang: 'en' }">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-gray-700 text-sm">Call-to-Action Buttons</h3>
                    <div class="lang-tabs">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'">FR</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div x-show="lang === 'en'">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Primary Button Text</label>
                        <input type="text" name="cta_primary_text" value="{{ old('cta_primary_text', $slide->cta_primary_text) }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Primary Button Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="cta_primary_text_fr" value="{{ old('cta_primary_text_fr', $slide->cta_primary_text_fr) }}"
                               placeholder="En savoir plus"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Primary Button URL</label>
                        <input type="text" name="cta_primary_url" value="{{ old('cta_primary_url', $slide->cta_primary_url) }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-show="lang === 'en'">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Secondary Button Text</label>
                        <input type="text" name="cta_secondary_text" value="{{ old('cta_secondary_text', $slide->cta_secondary_text) }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Secondary Button Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="cta_secondary_text_fr" value="{{ old('cta_secondary_text_fr', $slide->cta_secondary_text_fr) }}"
                               placeholder="Faire un don"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Secondary Button URL</label>
                        <input type="text" name="cta_secondary_url" value="{{ old('cta_secondary_url', $slide->cta_secondary_url) }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
                <p class="text-xs text-gray-400">French text is shown to French-language visitors. Leave blank to reuse the English button text.</p>
            </div>

            {{-- Settings --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-700 text-sm mb-4">Settings</h3>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <label class="text-sm font-medium text-gray-700">Sort Order:</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $slide->sort_order) }}"
                               class="w-20 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $slide->is_active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">Save Changes</button>
                <a href="{{ route('admin.presentation-slides.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
                <button type="submit" form="delete-slide-form" class="text-red-400 hover:text-red-600 text-sm ml-auto">Delete Slide</button>
            </div>
        </form>

        <form id="delete-slide-form" action="{{ route('admin.presentation-slides.destroy', $slide) }}" method="POST" class="hidden"
              onsubmit="return confirm('Delete this slide permanently?')">
            @csrf @method('DELETE')
        </form>
    </div>

</div>

@endsection