@extends('admin.layouts.app')

@section('title', 'New Presentation Slide')
@section('page-title', 'Add New Presentation Slide')
@section('breadcrumb', 'Presentation Slides → Create')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Form --}}
    <div>
        <form action="{{ route('admin.presentation-slides.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

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
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Badge Label <span class="text-gray-400 font-normal">(optional — e.g. "Our Mission")</span>
                        </label>
                        <input type="text" name="badge_text" value="{{ old('badge_text') }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="Our Mission">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                        <textarea name="title" rows="2"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="Empowering&#10;Cambodia's Children">{{ old('title') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Use line breaks to split the title onto two lines on the slide.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle</label>
                        <textarea name="subtitle" rows="3"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="Supporting disadvantaged children through education, culture, and welfare programs...">{{ old('subtitle') }}</textarea>
                    </div>
                </div>

                <div x-show="lang === 'fr'" x-cloak class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Badge Label (French) <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <input type="text" name="badge_text_fr" value="{{ old('badge_text_fr') }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="Notre Mission">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="title_fr" rows="2"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="Titre en français...">{{ old('title_fr') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English title.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="subtitle_fr" rows="3"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="Sous-titre en français...">{{ old('subtitle_fr') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English subtitle.</p>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 text-sm">Background Image</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Upload Image <span class="text-gray-400 font-normal">(recommended: 1400×800px or wider)</span></label>
                    <input type="file" name="image" accept="image/*" id="imageInput"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                    <p class="text-xs text-gray-400 mt-1">Max 4 MB.</p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400">OR</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">External Image URL</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="https://...">
                    <p class="text-xs text-gray-400 mt-1">Upload takes priority over URL if both are provided.</p>
                </div>

                {{-- Preview --}}
                <div id="imagePreview" class="hidden">
                    <p class="text-xs text-gray-500 mb-2">Preview:</p>
                    <div class="relative h-40 rounded-xl overflow-hidden border border-gray-200">
                        <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#0f2448]/60 to-transparent"></div>
                    </div>
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
                        <input type="text" name="cta_primary_text" value="{{ old('cta_primary_text', 'Learn More') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Primary Button Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="cta_primary_text_fr" value="{{ old('cta_primary_text_fr') }}"
                               placeholder="En savoir plus"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Primary Button URL</label>
                        <input type="text" name="cta_primary_url" value="{{ old('cta_primary_url', '/our-programs') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-show="lang === 'en'">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Secondary Button Text</label>
                        <input type="text" name="cta_secondary_text" value="{{ old('cta_secondary_text', 'Donate Now') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Secondary Button Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="cta_secondary_text_fr" value="{{ old('cta_secondary_text_fr') }}"
                               placeholder="Faire un don"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Secondary Button URL</label>
                        <input type="text" name="cta_secondary_url" value="{{ old('cta_secondary_url', '/donate') }}"
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
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                               class="w-20 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active (show on presentation page)</label>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">Save Slide</button>
                <a href="{{ route('admin.presentation-slides.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            </div>
        </form>
    </div>

</div>

<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('imagePreview').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});
</script>

@endsection