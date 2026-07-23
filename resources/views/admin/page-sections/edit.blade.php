@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Section')
@section('page-title', 'Edit Section')
@section('breadcrumb', 'Homepage Sections → ' . Str::limit($page_section->title, 40))

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Form --}}
    <div>
        <form action="{{ route('admin.page-sections.update', $page_section) }}" method="POST" enctype="multipart/form-data" class="space-y-5" x-data="bilingualForm()">
            @csrf @method('PUT')

            {{-- Section Info --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                        Section Information
                    </h3>
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Section Name <span class="text-red-400">*</span>
                            <span class="text-gray-400 font-normal">(identifier)</span>
                        </label>
                        <input type="text" name="section_name" value="{{ old('section_name', $page_section->section_name) }}" required
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="e.g. focus, mission, support">
                        @error('section_name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Order</label>
                        <input type="number" name="order" value="{{ old('order', $page_section->order) }}" min="0"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Title <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $page_section->title) }}" required
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @error('title')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Title (French) <span class="text-gray-400 font-normal">(optional)</span>
                    </label>
                    <input type="text" name="title_fr" value="{{ old('title_fr', $page_section->title_fr) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @error('title_fr')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English title.</p>
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                    <textarea name="description" rows="6"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description', $page_section->description) }}</textarea>
                    @error('description')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Description (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <textarea name="description_fr" rows="6"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description_fr', $page_section->description_fr) }}</textarea>
                    @error('description_fr')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English description.</p>
                </div>
            </div>

            {{-- Image --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    Section Image
                </h3>

                @php $existingImage = $page_section->images->first(); @endphp

                @if($existingImage)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Current Image</label>
                    <div class="relative h-44 rounded-xl overflow-hidden border border-gray-200 bg-gray-50 mb-3">
                        <img src="{{ str_starts_with($existingImage->path, 'http') ? $existingImage->path : asset('storage/' . $existingImage->path) }}"
                             alt="{{ $existingImage->alt ?? $page_section->title }}"
                             class="w-full h-full object-cover">
                        <div class="absolute bottom-3 left-3 bg-black/60 text-white text-xs px-3 py-1 rounded-lg">
                            Current image
                        </div>
                    </div>
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        {{ $existingImage ? 'Replace Image' : 'Upload Image' }}
                        <span class="text-gray-400 font-normal">(recommended: 800×500px)</span>
                    </label>
                    <input type="file" name="image" accept="image/*" id="imageInput"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                    @error('image')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Image Alt Text</label>
                    <input type="text" name="image_alt" value="{{ old('image_alt', $existingImage->alt ?? '') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Describe the image for accessibility">
                </div>

                {{-- Preview for new upload --}}
                <div id="imagePreview" class="hidden">
                    <p class="text-xs text-gray-500 mb-2">New image preview:</p>
                    <div class="relative h-44 rounded-xl overflow-hidden border border-gray-200 bg-gray-50">
                        <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4" x-data="linkManager({{ $page_section->links->toJson() }})">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </span>
                        CTA Buttons / Links
                    </h3>
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: $root.lang === 'en' }" @click="$root.lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: $root.lang === 'fr' }" @click="$root.lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Add a Link</label>
                    <div class="flex gap-2">
                        <input type="text" x-show="$root.lang === 'en'" x-model="newLink.text" @keydown.enter.prevent="addLink()"
                               class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="Button text (e.g. Support Us)">
                        <input type="text" x-show="$root.lang === 'fr'" x-cloak x-model="newLink.text_fr" @keydown.enter.prevent="addLink()"
                               class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="Texte du bouton en français (optionnel)">
                        <input type="url" x-model="newLink.url" @keydown.enter.prevent="addLink()"
                               class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="https://example.com">
                        <button type="button" @click="addLink()"
                                class="px-4 py-2.5 bg-[#2d6fa3] text-white rounded-xl text-sm font-medium hover:bg-[#1d4e7a] transition-colors whitespace-nowrap">
                            Add
                        </button>
                    </div>
                </div>

                {{-- Link list --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Added Links</label>
                    <div class="space-y-2">
                        <template x-for="(link, index) in links" :key="index">
                            <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-xl border border-gray-100">
                                <span class="w-2 h-2 rounded-full bg-[#2d6fa3] flex-shrink-0"></span>
                                <span class="text-sm font-medium text-gray-700 min-w-[100px]" x-text="$root.lang === 'fr' && link.text_fr ? link.text_fr : link.text"></span>
                                <span class="text-xs text-blue-500 truncate flex-1" x-text="link.url"></span>
                                <button type="button" @click="removeLink(index)"
                                        class="text-red-400 hover:text-red-600 text-lg leading-none">&times;</button>
                            </div>
                        </template>
                        <div x-show="links.length === 0" class="text-center py-6 text-gray-400 text-sm border-2 border-dashed border-gray-100 rounded-xl">
                            No links added yet.
                        </div>
                    </div>
                    <input type="hidden" name="links" x-model="linksJson">
                </div>
            </div>

            {{-- Settings --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-700 text-sm mb-4 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    Settings
                </h3>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="active" id="active" value="1" {{ old('active', $page_section->active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                        <label for="active" class="text-sm font-medium text-gray-700">Active (show on homepage)</label>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">Save Changes</button>
                <a href="{{ route('admin.page-sections.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
                <button type="submit" form="delete-section-form" class="text-red-400 hover:text-red-600 text-sm ml-auto">Delete Section</button>
            </div>
        </form>

        <form id="delete-section-form" action="{{ route('admin.page-sections.destroy', $page_section) }}" method="POST" class="hidden"
              onsubmit="return confirm('⚠️ Delete this section permanently? All images and links will also be removed.')">
            @csrf @method('DELETE')
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

function linkManager(initialLinks = []) {
    return {
        links: initialLinks.map(l => ({ text: l.text, text_fr: l.text_fr ?? '', url: l.url })),
        newLink: { text: '', text_fr: '', url: '' },
        get linksJson() {
            return JSON.stringify(this.links);
        },
        addLink() {
            const text = this.newLink.text.trim();
            const textFr = this.newLink.text_fr.trim();
            const url = this.newLink.url.trim();
            if (!text || !url) return;
            try { new URL(url); } catch(e) { alert('Please enter a valid URL.'); return; }
            this.links.push({ text, text_fr: textFr, url });
            this.newLink = { text: '', text_fr: '', url: '' };
        },
        removeLink(index) {
            this.links.splice(index, 1);
        }
    };
}
</script>

@endsection
