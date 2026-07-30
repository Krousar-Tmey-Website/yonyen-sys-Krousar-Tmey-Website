@php
    $campaign = $campaign ?? null;
    $isEdit   = (bool) $campaign;

    $vTitle         = old('title', $campaign->title ?? '');
    $vTitleFr       = old('title_fr', $campaign->title_fr ?? '');
    $vYear          = old('year', $campaign->year ?? date('Y'));
    $vDescription   = old('description', $campaign->description ?? '');
    $vDescriptionFr = old('description_fr', $campaign->description_fr ?? '');
    $vSortOrder     = old('sort_order', $campaign->sort_order ?? 0);
    // An unchecked box posts nothing, so after a failed submit trust old() alone
    // rather than falling back to the stored/default "on".
    $vActive        = $errors->any() ? (bool) old('is_active') : ($campaign->is_active ?? true);
    $vVideoUrl      = old('video_url', $campaign && $campaign->is_external_video ? $campaign->video : '');
    $vVideoTab      = $vVideoUrl !== '' ? 'link' : 'upload';
@endphp

{{-- ── Language switch ──────────────────────────────────────
     Year, media and visibility are shared between languages —
     only the title and the rich-text description are per-locale. --}}
<div class="flex items-center justify-between gap-4 mb-5">
    <p class="text-xs text-gray-400 leading-relaxed">
        Editing the <span class="font-semibold text-gray-600" x-text="lang === 'fr' ? 'French' : 'English'"></span> content.
        Visitors see the French version when the site language is set to FR.
    </p>
    <div class="lang-tabs flex-shrink-0" title="Toggle editing language (English / French)">
        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
    </div>
</div>

{{-- ── Title ───────────────────────────────────────────────── --}}
<div class="form-group" x-show="lang === 'en'">
    <label class="form-label">Title <span class="required">*</span></label>
    <input type="text" name="title" value="{{ $vTitle }}"
           class="form-control @error('title') error @enderror"
           placeholder="e.g. Back to School for 500 Children">
    @error('title')<div class="form-error">{{ $message }}</div>@enderror
</div>

<div class="form-group" x-show="lang === 'fr'" x-cloak>
    <label class="form-label">Title (French) <span class="optional">(optional)</span></label>
    <input type="text" name="title_fr" value="{{ $vTitleFr }}"
           class="form-control @error('title_fr') error @enderror"
           placeholder="ex. La rentrée scolaire pour 500 enfants">
    @error('title_fr')<div class="form-error">{{ $message }}</div>@enderror
    <div class="form-helper">Leave blank to reuse the English title.</div>
</div>

{{-- ── Year & sort order ───────────────────────────────────── --}}
<div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="form-group">
        <label class="form-label">Year <span class="required">*</span></label>
        <input type="text" name="year" value="{{ $vYear }}" maxlength="20"
               class="form-control @error('year') error @enderror"
               placeholder="e.g. {{ date('Y') }}">
        @error('year')<div class="form-error">{{ $message }}</div>@enderror
        <div class="form-helper">Shown on the campaign card and detail page.</div>
    </div>

    <div class="form-group">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" value="{{ $vSortOrder }}" min="0"
               class="form-control @error('sort_order') error @enderror" placeholder="0">
        @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
        <div class="form-helper">Lower numbers appear first. Ties fall back to the newest year.</div>
    </div>
</div>

{{-- ── Description (CKEditor) ──────────────────────────────── --}}
<div class="form-group" x-show="lang === 'en'">
    <label class="form-label">Description</label>
    <x-admin.rich-text name="description" :value="$vDescription" lang="en" :rows="14"
                       placeholder="Describe the campaign: who it helps, what it funds, why it matters…"
                       :upload-url="route('admin.campaigns.upload-image')" />
    @error('description')<div class="form-error">{{ $message }}</div>@enderror
</div>

<div class="form-group" x-show="lang === 'fr'" x-cloak>
    <label class="form-label">Description (French) <span class="optional">(optional)</span></label>
    <x-admin.rich-text name="description_fr" :value="$vDescriptionFr" lang="fr" :rows="14"
                       placeholder="Décrivez la campagne en français…"
                       :upload-url="route('admin.campaigns.upload-image')" />
    @error('description_fr')<div class="form-error">{{ $message }}</div>@enderror
    <div class="form-helper">Leave blank to reuse the English description.</div>
</div>

{{-- ── Cover image ─────────────────────────────────────────── --}}
<div class="form-group" x-data="{ preview: '', name: '', removed: false }">
    <label class="form-label">Cover Image</label>

    <div class="upload-area" @click="$refs.imageInput.click()">
        <input type="file" name="image" x-ref="imageInput" accept="image/*" class="hidden"
               @change="const f = $event.target.files[0];
                        name = f ? `${f.name} (${(f.size/1024).toFixed(1)} KB)` : '';
                        preview = f ? URL.createObjectURL(f) : '';
                        if (f) removed = false;">
        <template x-if="!preview">
            <div>
                <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <div class="upload-title">Click to upload a cover image</div>
                <div class="upload-subtitle">JPG, PNG or WebP — max 4 MB. Used on the card and page header.</div>
            </div>
        </template>
        <template x-if="preview">
            <div class="image-preview-wrapper mt-3" @click.stop>
                <img :src="preview" alt="Preview" class="h-[180px]">
                <button type="button" class="remove-btn"
                        @click="$refs.imageInput.value = ''; preview = ''; name = '';">×</button>
                <div class="file-info" x-text="name"></div>
            </div>
        </template>
    </div>

    @if($isEdit && $campaign->has_image)
    <div class="current-image" x-show="!preview && !removed">
        <img src="{{ $campaign->image_url }}" alt="Current cover">
        <div class="image-info">
            <strong>Current image</strong>
            <div class="text-small-info">{{ $campaign->image }}</div>
            <label class="inline-flex items-center gap-1.5 mt-1.5 text-xs text-red-500 cursor-pointer hover:text-red-600">
                <input type="checkbox" name="remove_image" value="1" @change="removed = $event.target.checked">
                Remove this image
            </label>
        </div>
    </div>
    @endif
    @error('image')<div class="form-error">{{ $message }}</div>@enderror
</div>

{{-- ── Video ───────────────────────────────────────────────── --}}
<div class="form-group" x-data="{
        name: '', preview: '', removed: false, error: '',
        videoUrl: @js($vVideoUrl),
        tab: @js($vVideoTab),
        maxSize: 500 * 1024 * 1024,
        get embedUrl() {
            const url = this.videoUrl.trim();
            if (!url) return '';
            let m = url.match(/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/i);
            if (m) return 'https://www.youtube.com/embed/' + m[1];
            m = url.match(/vimeo\.com\/(?:video\/)?(\d+)/i);
            if (m) return 'https://player.vimeo.com/video/' + m[1];
            return '';
        }
     }">
    <label class="form-label">Video <span class="optional">(optional)</span></label>

    <div class="lang-tabs mb-3">
        <button type="button" class="lang-tab" :class="{ active: tab === 'upload' }" @click="tab = 'upload'">Upload video</button>
        <button type="button" class="lang-tab" :class="{ active: tab === 'link' }" @click="tab = 'link'">Paste a link</button>
    </div>

    {{-- Upload --}}
    <div x-show="tab === 'upload'" x-cloak>
        <div class="upload-area" @click="$refs.videoInput.click()">
            <input type="file" name="video" x-ref="videoInput" accept="video/mp4,video/quicktime,video/webm" class="hidden"
                   @change="const f = $event.target.files[0];
                            error = ''; preview = '';
                            if (f && f.size > maxSize) {
                                error = `“${f.name}” is ${(f.size/1048576).toFixed(1)} MB — the max video size is 500 MB.`;
                                $event.target.value = ''; name = '';
                                return;
                            }
                            name = f ? `${f.name} (${(f.size/1048576).toFixed(1)} MB)` : '';
                            preview = f ? URL.createObjectURL(f) : '';
                            if (f) removed = false;">
            <template x-if="!name">
                <div>
                    <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <div class="upload-title">Click to upload a video</div>
                    <div class="upload-subtitle">MP4, MOV or WebM — max 500 MB</div>
                </div>
            </template>
            <template x-if="name">
                <div class="flex items-center justify-center gap-2 text-sm text-gray-600 py-2" @click.stop>
                    <svg class="w-4 h-4 text-[#2d6fa3]" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <span x-text="name"></span>
                    <button type="button" class="text-red-500 hover:text-red-600 font-bold px-1"
                            @click="$refs.videoInput.value = ''; name = ''; preview = '';">×</button>
                </div>
            </template>
        </div>
        <template x-if="error">
            <div class="form-error mt-1" x-text="error"></div>
        </template>
        <template x-if="preview">
            <video :src="preview" controls class="mt-2 rounded-lg w-full" style="max-height:220px" @click.stop></video>
        </template>

        @if($isEdit && $campaign->has_video && !$campaign->is_external_video)
        <div x-show="!name && !removed">
            <div class="current-image mt-3">
                <div class="image-info">
                    <strong>Current video</strong>
                    <div class="text-small-info break-all">{{ $campaign->video }}</div>
                    <label class="inline-flex items-center gap-1.5 mt-1.5 text-xs text-red-500 cursor-pointer hover:text-red-600">
                        <input type="checkbox" name="remove_video" value="1" @change="removed = $event.target.checked">
                        Remove this video
                    </label>
                </div>
            </div>
            <video src="{{ $campaign->video_url }}" controls class="mt-2 rounded-lg w-full" style="max-height:220px"></video>
        </div>
        @endif
    </div>

    {{-- Link --}}
    <div x-show="tab === 'link'" x-cloak>
        <input type="url" name="video_url" x-model="videoUrl"
               class="form-control @error('video_url') error @enderror"
               placeholder="https://www.youtube.com/watch?v=…">
        @error('video_url')<div class="form-error">{{ $message }}</div>@enderror
        <div class="form-helper">YouTube and Vimeo links play inline.</div>
        <template x-if="embedUrl">
            <div class="mt-2 rounded-lg overflow-hidden border border-gray-200" style="aspect-ratio:16/9;max-width:400px">
                <iframe :src="embedUrl" class="w-full h-full" frameborder="0" allowfullscreen referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
        </template>
        <template x-if="videoUrl.trim() && !embedUrl">
            <div class="form-helper text-amber-600 mt-1">This doesn't look like a YouTube or Vimeo link — it will be saved, but won't preview here or on the site.</div>
        </template>

        @if($isEdit && $campaign->has_video && $campaign->is_external_video)
        <div class="current-image mt-3" x-show="!removed">
            <div class="image-info">
                <strong>Current video link</strong>
                <div class="text-small-info break-all">{{ $campaign->video }}</div>
                <label class="inline-flex items-center gap-1.5 mt-1.5 text-xs text-red-500 cursor-pointer hover:text-red-600">
                    <input type="checkbox" name="remove_video" value="1" @change="removed = $event.target.checked">
                    Remove this video
                </label>
            </div>
        </div>
        @endif
    </div>

    <div class="form-helper mt-2">An uploaded file takes priority over a link if both are provided.</div>
    @error('video')<div class="form-error">{{ $message }}</div>@enderror
</div>

{{-- ── Document ────────────────────────────────────────────── --}}
<div class="form-group" x-data="{ name: '', removed: false }">
    <label class="form-label">Document <span class="optional">(optional)</span></label>

    <div class="upload-area" @click="$refs.fileInput.click()">
        <input type="file" name="file" x-ref="fileInput" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="hidden"
               @change="const f = $event.target.files[0];
                        name = f ? `${f.name} (${(f.size/1024).toFixed(0)} KB)` : '';
                        if (f) removed = false;">
        <template x-if="!name">
            <div>
                <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <div class="upload-title">Click to upload a document</div>
                <div class="upload-subtitle">PDF, Word, Excel or PowerPoint — max 500 MB. PDFs preview on the public page.</div>
            </div>
        </template>
        <template x-if="name">
            <div class="flex items-center justify-center gap-2 text-sm text-gray-600 py-2" @click.stop>
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span x-text="name"></span>
                <button type="button" class="text-red-500 hover:text-red-600 font-bold px-1"
                        @click="$refs.fileInput.value = ''; name = '';">×</button>
            </div>
        </template>
    </div>

    @if($isEdit && $campaign->has_file)
    <div class="current-image mt-3" x-show="!name && !removed">
        <div class="image-info">
            <strong>Current document</strong>
            <div class="text-small-info break-all">{{ $campaign->file_name }} — {{ $campaign->file_size_for_humans }}</div>
            <div class="flex items-center gap-3 mt-1.5">
                <a href="{{ $campaign->file_url }}" target="_blank" rel="noopener" class="text-xs text-[#2d6fa3] hover:underline">Open</a>
                <label class="inline-flex items-center gap-1.5 text-xs text-red-500 cursor-pointer hover:text-red-600">
                    <input type="checkbox" name="remove_file" value="1" @change="removed = $event.target.checked">
                    Remove this document
                </label>
            </div>
        </div>
    </div>
    @endif
    @error('file')<div class="form-error">{{ $message }}</div>@enderror
</div>

{{-- ── Visibility ──────────────────────────────────────────── --}}
<div class="form-group form-group--no-margin">
    <div class="publish-option">
        <input type="checkbox" name="is_active" id="is_active" value="1" {{ $vActive ? 'checked' : '' }}>
        <div>
            <div class="label">Publish this campaign</div>
            <div class="description">Show it on the public Campaigns page</div>
        </div>
    </div>
</div>
