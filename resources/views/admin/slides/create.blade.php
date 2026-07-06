@extends('admin.layouts.app')

@section('title', 'New Slide')
@section('page-title', 'Add New Slide')
@section('breadcrumb', 'Slideshow → Create')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">

    {{-- Form --}}
    <div class="lg:col-span-2">
        <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Slide Text --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 text-sm">Slide Content</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Badge Label <span class="text-gray-400 font-normal">(optional — e.g. "Cultural Arts")</span>
                    </label>
                    <input type="text" name="badge_text" value="{{ old('badge_text') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Cultural Arts">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                    <textarea name="title" rows="2" required
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                              placeholder="Cultural Performance&#10;for Charity">{{ old('title') }}</textarea>
                    <p class="text-xs text-gray-400 mt-1">Use line breaks to split the title onto two lines on the slide.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle</label>
                    <textarea name="subtitle" rows="3"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                              placeholder="Our students showcase the beauty of Khmer arts and culture...">{{ old('subtitle') }}</textarea>
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
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 text-sm">Call-to-Action Buttons</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Primary Button Text</label>
                        <input type="text" name="cta_primary_text" value="{{ old('cta_primary_text', 'Learn More') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Primary Button URL</label>
                        <input type="text" name="cta_primary_url" value="{{ old('cta_primary_url', '/our-programs') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Secondary Button Text</label>
                        <input type="text" name="cta_secondary_text" value="{{ old('cta_secondary_text', 'Donate Now') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Secondary Button URL</label>
                        <input type="text" name="cta_secondary_url" value="{{ old('cta_secondary_url', '/donate') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
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
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active (show on homepage)</label>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">Save Slide</button>
                <a href="{{ route('admin.slides.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            </div>
        </form>
    </div>

    {{-- Tips --}}
    <div class="space-y-4">
        <div class="bg-[#2d6fa3]/5 rounded-2xl p-5 border border-[#2d6fa3]/10">
            <h4 class="font-bold text-[#2d6fa3] text-sm mb-3">📐 Image Tips</h4>
            <ul class="space-y-2 text-xs text-gray-600">
                <li>• Recommended size: <strong>1400 × 800px</strong> or larger</li>
                <li>• Landscape (wide) orientation works best</li>
                <li>• High contrast subjects — the left side gets text overlay</li>
                <li>• JPG or PNG, max 4 MB</li>
            </ul>
        </div>
        <div class="bg-[#8da83a]/5 rounded-2xl p-5 border border-[#8da83a]/10">
            <h4 class="font-bold text-[#8da83a] text-sm mb-3">✏️ Content Tips</h4>
            <ul class="space-y-2 text-xs text-gray-600">
                <li>• Keep title short — 3–6 words per line</li>
                <li>• Badge adds a coloured pill above the title</li>
                <li>• Leave CTA fields blank to hide that button</li>
                <li>• Lower sort order = appears earlier in rotation</li>
            </ul>
        </div>
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
