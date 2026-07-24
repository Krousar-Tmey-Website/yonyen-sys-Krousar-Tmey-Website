@php
    $isEdit = isset($item) && $item?->exists;
    $fieldValue = fn (string $field, mixed $default = '') => old($field, $isEdit ? ($item->{$field} ?? $default) : $default);

    $inputClass = 'w-full rounded-xl border border-slate-200 bg-slate-50/70 px-4 py-3 text-sm text-slate-800 shadow-inner shadow-slate-100/60 transition focus:border-[#2d6fa3] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#2d6fa3]/10';
    $textareaClass = $inputClass . ' resize-y leading-relaxed';
    $imageRows = [
        ['label' => 'Primary Image', 'field' => 'image', 'url_field' => 'image_url', 'current_url' => $isEdit ? $item->image_url : null, 'has' => $isEdit && (bool) $item->image],
        ['label' => 'Supporting Image 2', 'field' => 'image_2', 'url_field' => 'image_2_url', 'current_url' => $isEdit ? $item->image_2_url : null, 'has' => $isEdit && (bool) $item->image_2],
        ['label' => 'Supporting Image 3', 'field' => 'image_3', 'url_field' => 'image_3_url', 'current_url' => $isEdit ? $item->image_3_url : null, 'has' => $isEdit && (bool) $item->image_3],
    ];
@endphp

@if($errors->any())
    <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
        <div class="font-semibold">Please review the highlighted fields.</div>
        <ul class="mt-2 list-inside list-disc space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_330px]">
    <div class="space-y-6">
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 bg-gradient-to-r from-[#f7fbfd] to-white px-6 py-5">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-[#2d6fa3]">Translatable Fields</p>
                        <h2 class="mt-1 text-lg font-bold text-slate-900">Page content</h2>
                        <p class="mt-1 text-sm text-slate-500">Edit the English and French content used on the public additional pages section.</p>
                    </div>
                    <div class="lang-tabs self-start" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" data-lang="en" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" data-lang="fr" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>
            </div>

            <div class="space-y-6 p-6">
                <div class="grid gap-5 md:grid-cols-2">
                    <div x-show="lang === 'en'">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ $fieldValue('title') }}" class="{{ $inputClass }}" placeholder="e.g. Child Protection Services" required>
                        @error('title')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Title (French) <span class="font-normal text-slate-400">(optional)</span></label>
                        <input type="text" name="title_fr" value="{{ $fieldValue('title_fr') }}" class="{{ $inputClass }}" placeholder="Titre en francais">
                        <p class="mt-1.5 text-xs text-slate-400">Leave blank to reuse the English title.</p>
                        @error('title_fr')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div x-show="lang === 'en'">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Objective</label>
                        <textarea name="objective" rows="4" class="{{ $textareaClass }}" placeholder="e.g. To protect the health of Cambodian children...">{{ $fieldValue('objective') }}</textarea>
                        @error('objective')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Objective (French) <span class="font-normal text-slate-400">(optional)</span></label>
                        <textarea name="objective_fr" rows="4" class="{{ $textareaClass }}" placeholder="Objectif en francais">{{ $fieldValue('objective_fr') }}</textarea>
                        <p class="mt-1.5 text-xs text-slate-400">Shown to French-language visitors.</p>
                        @error('objective_fr')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div x-show="lang === 'en'">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Short Content <span class="font-normal text-slate-400">(card preview)</span></label>
                    <textarea name="short_content" rows="4" class="{{ $textareaClass }}" placeholder="Brief description that appears on the card listing...">{{ $fieldValue('short_content') }}</textarea>
                    @error('short_content')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Short Content (French) <span class="font-normal text-slate-400">(optional)</span></label>
                    <textarea name="short_content_fr" rows="4" class="{{ $textareaClass }}" placeholder="Breve description en francais">{{ $fieldValue('short_content_fr') }}</textarea>
                    <p class="mt-1.5 text-xs text-slate-400">Leave blank to reuse the English card text.</p>
                    @error('short_content_fr')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div x-show="lang === 'en'">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">The Project <span class="font-normal text-slate-400">(detail content)</span></label>
                    <textarea name="detail_content" rows="11" class="{{ $textareaClass }} font-mono" placeholder="Full content. HTML is supported.">{{ $fieldValue('detail_content') }}</textarea>
                    @error('detail_content')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">The Project (French) <span class="font-normal text-slate-400">(optional)</span></label>
                    <textarea name="detail_content_fr" rows="11" class="{{ $textareaClass }} font-mono" placeholder="Contenu complet en francais. HTML pris en charge.">{{ $fieldValue('detail_content_fr') }}</textarea>
                    <p class="mt-1.5 text-xs text-slate-400">Leave blank to reuse the English detail content.</p>
                    @error('detail_content_fr')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div x-show="lang === 'en'">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Activities</label>
                    <textarea name="activities" rows="5" class="{{ $textareaClass }}" placeholder="Activity 1&#10;Activity 2">{{ $fieldValue('activities') }}</textarea>
                    <p class="mt-1.5 text-xs text-slate-400">Each new line becomes a bullet point on the public page.</p>
                    @error('activities')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Activities (French) <span class="font-normal text-slate-400">(optional)</span></label>
                    <textarea name="activities_fr" rows="5" class="{{ $textareaClass }}" placeholder="Activite 1&#10;Activite 2">{{ $fieldValue('activities_fr') }}</textarea>
                    <p class="mt-1.5 text-xs text-slate-400">Leave blank to reuse the English activities.</p>
                    @error('activities_fr')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-[#8da83a]">Media</p>
                <h2 class="mt-1 text-lg font-bold text-slate-900">Images</h2>
                <p class="mt-1 text-sm text-slate-500">Upload files or paste image URLs. Up to three images can appear on the detail page.</p>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach($imageRows as $img)
                    <div class="p-6">
                        <div class="mb-4 flex items-center justify-between gap-4">
                            <h3 class="text-sm font-bold text-slate-800">{{ $img['label'] }}</h3>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold text-slate-500">Optional</span>
                        </div>

                        @if($img['has'])
                            <div class="mb-4 flex gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-3">
                                <img src="{{ $img['current_url'] }}" class="h-24 w-36 rounded-xl border border-white object-cover shadow-sm" alt="Current {{ $img['label'] }}">
                                <div class="min-w-0 flex-1 pt-1">
                                    <p class="text-xs font-semibold text-slate-500">Current image</p>
                                    <label class="mt-3 inline-flex cursor-pointer items-center gap-2 rounded-xl border border-red-100 bg-white px-3 py-2 text-xs font-semibold text-red-500 transition hover:bg-red-50">
                                        <input type="checkbox" name="remove_{{ $img['field'] }}" value="1" class="rounded border-red-200 text-red-500 focus:ring-red-500">
                                        Remove image
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Upload</label>
                                <input type="file" name="{{ $img['field'] }}" accept="image/*" class="w-full rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-[#2d6fa3]/10 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                                @error($img['field'])<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Image URL</label>
                                <input type="url" name="{{ $img['url_field'] }}" value="{{ old($img['url_field']) }}" class="{{ $inputClass }}" placeholder="https://example.com/image.jpg">
                                @error($img['url_field'])<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <aside class="space-y-6 xl:sticky xl:top-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-[11px] font-black uppercase tracking-[0.2em] text-[#2d6fa3]">Publishing</p>
            <h2 class="mt-1 text-lg font-bold text-slate-900">Visibility</h2>

            <div class="mt-5 space-y-5">
                <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-[#2d6fa3]/15 bg-[#2d6fa3]/5 p-4">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $isEdit ? ($item->is_active ? '1' : '0') : '1') == '1' ? 'checked' : '' }} class="mt-1 rounded border-slate-300 text-[#2d6fa3] focus:ring-[#2d6fa3]">
                    <span>
                        <span class="block text-sm font-bold text-slate-800">Publish this item</span>
                        <span class="mt-1 block text-xs leading-relaxed text-slate-500">Visible on the public programs page when enabled.</span>
                    </span>
                </label>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $isEdit ? $item->sort_order : 0) }}" min="0" class="{{ $inputClass }}">
                    <p class="mt-1.5 text-xs text-slate-400">Lower numbers appear first.</p>
                    @error('sort_order')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>


        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-3">
                <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#2d6fa3] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#1d4e7a] hover:shadow-md">
                    @if($isEdit)
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Update Item
                    @else
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Create Item
                    @endif
                </button>
                <a href="{{ route('admin.program-pages.index') }}" class="inline-flex w-full items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-500 transition hover:bg-slate-50 hover:text-slate-800">Cancel</a>
                @if($isEdit)
                    <button type="button" onclick="if(confirm('Delete this item permanently?')) document.getElementById('delete-item-form').submit();" class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-100 px-5 py-3 text-sm font-semibold text-red-500 transition hover:bg-red-50">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete Item
                    </button>
                @endif
            </div>
        </section>
    </aside>
</div>
