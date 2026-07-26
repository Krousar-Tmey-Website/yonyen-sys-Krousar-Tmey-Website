@extends('admin.layouts.app')
@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Testimonial')

@section('content')
<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.testimonials.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-5" x-data="bilingualForm()">
        @csrf @method('PUT')

        {{-- Testimonial --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    Testimonial
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Name</label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Role / Affiliation</label>
                <div x-show="lang === 'en'">
                    <input type="text" name="role" value="{{ old('role', $item->role) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <input type="text" name="role_fr" value="{{ old('role_fr', $item->role_fr) }}" placeholder="Rôle (français)..." class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English value.</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Content</label>
                <div x-show="lang === 'en'">
                    <x-admin.rich-text name="content" :value="old('content', $item->content)" lang="en" />
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <x-admin.rich-text name="content_fr" :value="old('content_fr', $item->content_fr)" lang="fr" placeholder="Contenu (français)..." />
                    <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English value.</p>
                </div>
            </div>

            <div class="flex items-end pb-1">
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                    <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                </div>
            </div>
        </div>

        {{-- Photo --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                Photo
            </h3>

            @if($item->image)
            <div>
                <p class="text-xs text-gray-500 mb-2">Current image:</p>
                <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" class="h-28 w-auto rounded-xl object-cover border border-gray-200">
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Replace Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Save Changes</button>
            <a href="{{ route('admin.testimonials.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
