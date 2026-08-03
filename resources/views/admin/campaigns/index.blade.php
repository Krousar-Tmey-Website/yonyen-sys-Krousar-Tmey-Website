@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Campaigns')
@section('page-title', 'Campaigns')
@section('breadcrumb', 'Manage the campaigns shown on the public Campaigns page')

@section('content')

<div class="form-container">

    {{-- ── Page banner ─────────────────────────────────────── --}}
    <div class="form-card" x-data="{ open: {{ $errors->hasAny(['campaigns_banner_title', 'campaigns_banner_subtitle', 'campaigns_banner_subtitle_fr', 'campaigns_banner_image', 'campaigns_banner_image_url']) ? 'true' : 'false' }}, preview: '' }">
        <button type="button" @click="open = !open" class="card-header w-full text-left">
            <span class="icon blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </span>
            <h3>Page Banner</h3>
            <div class="header-actions">
                <span class="badge">Hero of /campaigns</span>
                <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </button>

        <div class="card-body" x-show="open" x-collapse.duration.300ms x-cloak>
            <form action="{{ route('admin.campaigns.banner') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Banner Title <span class="required">*</span></label>
                    <input type="text" name="campaigns_banner_title" value="{{ old('campaigns_banner_title', $banner['title']) }}"
                           class="form-control @error('campaigns_banner_title') error @enderror" placeholder="Our Campaigns">
                    @error('campaigns_banner_title')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group" x-data="bilingualForm()">
                    <div class="flex items-center justify-between gap-3 mb-1.5">
                        <label class="form-label mb-0">Banner Subtitle</label>
                        <div class="lang-tabs" title="Toggle editing language (English / French)">
                            <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                            <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                        </div>
                    </div>

                    <div x-show="lang === 'en'">
                        <x-admin.rich-text name="campaigns_banner_subtitle" :value="old('campaigns_banner_subtitle', $banner['subtitle'])" lang="en" :rows="3"
                                           placeholder="One or two sentences that make visitors want to read on…" />
                        @error('campaigns_banner_subtitle')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <x-admin.rich-text name="campaigns_banner_subtitle_fr" :value="old('campaigns_banner_subtitle_fr', $banner['subtitle_fr'] ?? '')" lang="fr" :rows="3"
                                           placeholder="Une ou deux phrases qui donnent envie d'en savoir plus…" />
                        @error('campaigns_banner_subtitle_fr')<div class="form-error">{{ $message }}</div>@enderror
                        <div class="form-helper">Leave blank to reuse the English subtitle.</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Banner Image</label>
                    <div class="upload-area" @click="$refs.bannerInput.click()">
                        <input type="file" name="campaigns_banner_image" x-ref="bannerInput" accept="image/*" class="hidden"
                               @change="const f = $event.target.files[0]; preview = f ? URL.createObjectURL(f) : '';">
                        <template x-if="!preview">
                            <div>
                                <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div class="upload-title">Click to upload a banner image</div>
                                <div class="upload-subtitle">Wide landscape works best — max 6 MB. Leave empty to keep the default site photo.</div>
                            </div>
                        </template>
                        <template x-if="preview">
                            <div class="image-preview-wrapper mt-3" @click.stop>
                                <img :src="preview" alt="Preview" class="h-[180px]">
                                <button type="button" class="remove-btn" @click="$refs.bannerInput.value = ''; preview = '';">×</button>
                            </div>
                        </template>
                    </div>

                    @if($banner['image'])
                    <div class="current-image" x-show="!preview">
                        <img src="{{ str_starts_with($banner['image'], 'http') ? $banner['image'] : asset('storage/' . $banner['image']) }}" alt="Current banner">
                        <div class="image-info">
                            <strong>Current banner</strong>
                            <div class="text-small-info break-all">{{ $banner['image'] }}</div>
                            <label class="inline-flex items-center gap-1.5 mt-1.5 text-xs text-red-500 cursor-pointer hover:text-red-600">
                                <input type="checkbox" name="campaigns_banner_image_clear" value="1">
                                Remove this banner image
                            </label>
                        </div>
                    </div>
                    @endif
                    @error('campaigns_banner_image')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">…or use an image URL</label>
                    <input type="url" name="campaigns_banner_image_url" value="{{ old('campaigns_banner_image_url') }}"
                           class="form-control @error('campaigns_banner_image_url') error @enderror" placeholder="https://…">
                    @error('campaigns_banner_image_url')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Banner
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── Campaign list ───────────────────────────────────── --}}
    <div class="table-container">
        <div class="table-header table-header--blue">
            <h3>All Campaigns</h3>
            <span class="count-badge">{{ $campaigns->total() }}</span>
            <div class="ml-auto">
                <a href="{{ route('admin.campaigns.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Campaign
                </a>
            </div>
        </div>

        @if($campaigns->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
            </div>
            <div class="empty-title">No campaigns yet</div>
            <div class="empty-desc">Create your first campaign to show it on the public Campaigns page.</div>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th class="th-width-50">Campaign</th>
                        <th class="th-width-13">Year</th>
                        <th class="th-width-17">Media</th>
                        <th class="th-width-13">Status</th>
                        <th class="th-text-right th-width-15">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns as $campaign)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3 min-w-0">
                                <img src="{{ $campaign->image_url }}" alt=""
                                     class="w-14 h-14 rounded-xl object-cover bg-gray-100 flex-shrink-0">
                                <div class="min-w-0">
                                    <a href="{{ route('admin.campaigns.edit', $campaign) }}"
                                       class="font-semibold text-gray-800 hover:text-[#2d6fa3] transition-colors block truncate">
                                        {{ $campaign->title }}
                                    </a>
                                    @if($campaign->title_fr)
                                    <div class="text-small-info truncate">🇫🇷 {{ $campaign->title_fr }}</div>
                                    @else
                                    <div class="text-small-info text-amber-500">No French title</div>
                                    @endif
                                    <div class="text-small-info truncate">{{ Str::limit($campaign->excerpt(70), 70) ?: '—' }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="sort-badge">{{ $campaign->year ?: '—' }}</span></td>
                        <td>
                            <div class="flex items-center gap-1.5 text-gray-400">
                                <span title="{{ $campaign->has_image ? 'Has image' : 'No image' }}"
                                      class="{{ $campaign->has_image ? 'text-[#2d6fa3]' : 'text-gray-200' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </span>
                                <span title="{{ $campaign->has_video ? 'Has video' : 'No video' }}"
                                      class="{{ $campaign->has_video ? 'text-[#2d6fa3]' : 'text-gray-200' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </span>
                                <span title="{{ $campaign->has_file ? $campaign->file_name : 'No document' }}"
                                      class="{{ $campaign->has_file ? 'text-[#2d6fa3]' : 'text-gray-200' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </span>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge-modern {{ $campaign->is_active ? 'active' : 'inactive' }}">
                                {{ $campaign->is_active ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="th-text-right">
                            <div class="action-btn-group justify-end">
                                @if($campaign->is_active)
                                <a href="{{ route('campaigns.show', $campaign) }}" target="_blank" class="icon-btn view" title="View on site">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                                @endif
                                <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="icon-btn edit" title="Edit">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="delete-form"
                                      onsubmit="return confirm('Delete “{{ addslashes($campaign->title) }}”? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn delete" title="Delete">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($campaigns->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Showing <strong>{{ $campaigns->firstItem() }}–{{ $campaigns->lastItem() }}</strong> of <strong>{{ $campaigns->total() }}</strong>
            </div>
            <div class="pagination-links">{{ $campaigns->onEachSide(1)->links() }}</div>
        </div>
        @endif
        @endif
    </div>
</div>

@endsection
