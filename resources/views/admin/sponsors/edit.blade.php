@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css'])
@endpush

@section('title', 'Edit Sponsor')
@section('page-title', 'Edit Sponsor')
@section('breadcrumb', 'Sponsors → Edit')

@section('content')

<div class="form-container" x-data="{ logoMethod: '{{ str_starts_with($sponsor->logo ?? '', 'http') ? 'url' : 'file' }}', fileName: '', lang: 'en' }">
    <form action="{{ route('admin.sponsors.update', $sponsor) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3>Sponsor Details</h3>
                <div class="header-actions">
                    <span class="badge">Required *</span>
                    <div class="lang-tabs">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'">FR</button>
                    </div>
                </div>
            </div>

            <div class="card-body space-y-6">
                <!-- Sponsor Name -->
                <div class="form-group" x-show="lang === 'en'">
                    <label class="form-label">Sponsor Name <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $sponsor->name) }}"
                           class="form-control @error('name') error @enderror"
                           placeholder="e.g. Ministry of Education, Youth and Sport">
                    @error('name')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">The official display name of the sponsor.</div>
                </div>
                <div class="form-group" x-show="lang === 'fr'" x-cloak>
                    <label class="form-label">Sponsor Name (French) <span class="optional">(optional)</span></label>
                    <input type="text" name="name_fr" value="{{ old('name_fr', $sponsor->name_fr) }}"
                           class="form-control @error('name_fr') error @enderror"
                           placeholder="ex. Ministère de l'Éducation, de la Jeunesse et des Sports">
                    @error('name_fr')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English name.</div>
                </div>

                <!-- Website URL -->
                <div class="form-group">
                    <label class="form-label">Website URL <span class="optional">(optional)</span></label>
                    <input type="url" name="url" value="{{ old('url', $sponsor->url) }}"
                           class="form-control @error('url') error @enderror"
                           placeholder="https://example.com">
                    @error('url')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">The destination URL when someone clicks this sponsor's logo.</div>
                </div>

                <!-- Logo Selection -->
                <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-200/50">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                        <label class="form-label font-bold text-gray-800 mb-0">Sponsor Logo <span class="optional">(Choose one method)</span></label>
                        
                        <!-- Toggle Tab buttons -->
                        <div class="flex items-center gap-1 p-1 bg-gray-200/60 border border-gray-200 rounded-lg self-start sm:self-auto">
                            <button type="button" 
                                    @click="logoMethod = 'file'" 
                                    :class="logoMethod === 'file' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-800'" 
                                    class="px-3 py-1 text-[11px] font-bold rounded-md transition-all">
                                Upload File
                            </button>
                            <button type="button" 
                                    @click="logoMethod = 'url'" 
                                    :class="logoMethod === 'url' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-800'" 
                                    class="px-3 py-1 text-[11px] font-bold rounded-md transition-all">
                                External URL
                            </button>
                        </div>
                    </div>

                    @if($sponsor->logo)
                        <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-gray-200 shadow-sm mb-4 self-start max-w-xs">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Current Logo:</span>
                            <div class="h-10 w-16 flex items-center justify-center p-1 bg-gray-50 rounded-lg border border-gray-100">
                                <img src="{{ str_starts_with($sponsor->logo, 'http') ? $sponsor->logo : asset('storage/' . $sponsor->logo) }}" alt="Current Logo" class="max-h-full max-w-full object-contain">
                            </div>
                        </div>
                    @endif

                    <!-- Upload File Box -->
                    <div x-show="logoMethod === 'file'" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-1"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="relative">
                        <div class="border-2 border-dashed border-gray-200 hover:border-indigo-400 rounded-xl p-6 bg-white hover:bg-gray-50/50 text-center transition-all cursor-pointer relative"
                             @click="$refs.fileInput.click()">
                            <input type="file" x-ref="fileInput" name="logo_file" accept="image/*" class="hidden" 
                                   @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                            
                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-xs font-semibold text-gray-700">Click to upload new logo file</p>
                            <p class="text-[10px] text-gray-400 mt-1">PNG, JPG, SVG or WEBP up to 2MB (Leave empty to keep current)</p>
                            
                            <!-- Display file name if chosen -->
                            <div x-show="fileName" class="mt-3 p-2 bg-indigo-50 border border-indigo-100 rounded-lg inline-flex items-center gap-2 max-w-full" @click.stop>
                                <svg class="w-3.5 h-3.5 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-xs text-indigo-700 font-semibold truncate max-w-[200px]" x-text="fileName"></span>
                                <button type="button" @click="fileName = ''; $refs.fileInput.value = ''" class="text-indigo-400 hover:text-indigo-600 focus:outline-none">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                        @error('logo_file')<div class="form-error mt-2">{{ $message }}</div>@enderror
                    </div>

                    <!-- External URL Input -->
                    <div x-show="logoMethod === 'url'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-1"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="space-y-2">
                        <input type="url" name="logo_url" value="{{ old('logo_url', str_starts_with($sponsor->logo ?? '', 'http') ? $sponsor->logo : '') }}" class="form-control" placeholder="https://example.com/logo.png">
                        @error('logo_url')<div class="form-error mt-2">{{ $message }}</div>@enderror
                        <div class="text-[11px] text-gray-400">Direct link to the image hosted on another server. Leave empty to keep current logo.</div>
                    </div>
                </div>

                <!-- Settings Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group form-group--no-margin">
                          <label class="form-label">Sort Order</label>
                          <input type="number" name="sort_order" value="{{ old('sort_order', $sponsor->sort_order) }}" class="form-control w-full md:w-32">
                          @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                          <div class="form-helper">Lower numbers appear first.</div>
                    </div>
                    
                    <div class="flex items-center pt-6">
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $sponsor->is_active ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#1a3c6e]/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#1a3c6e]"></div>
                            <span class="ml-3 text-sm font-semibold text-gray-700">Sponsor is Active</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Update Sponsor
            </button>
            <a href="{{ route('admin.sponsors.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

@endsection
