@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Campaign')
@section('page-title', 'Edit Campaign')
@section('breadcrumb', 'Donation Campaigns → ' . Str::limit($campaign->title, 40))

@section('content')

<div class="form-container">
    <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Campaign Header --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Editing: <span class="text-[#2d6fa3]">{{ Str::limit($campaign->title, 50) }}</span></h1>
                        <p class="text-sm text-gray-400 mt-0.5">Update campaign details and manage attachments</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold
                        {{ $campaign->status === 'active' ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200' : '' }}
                        {{ $campaign->status === 'upcoming' ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-200' : '' }}
                        {{ $campaign->status === 'ended' ? 'bg-gray-100 text-gray-500 ring-1 ring-gray-200' : '' }}
                        {{ $campaign->status === 'inactive' ? 'bg-gray-50 text-gray-400 ring-1 ring-gray-200' : '' }}">
                        <span class="w-1.5 h-1.5 rounded-full
                            {{ $campaign->status === 'active' ? 'bg-emerald-500 animate-pulse' : '' }}
                            {{ $campaign->status === 'upcoming' ? 'bg-blue-500' : '' }}
                            {{ $campaign->status === 'ended' ? 'bg-gray-400' : '' }}
                            {{ $campaign->status === 'inactive' ? 'bg-gray-400' : '' }}"></span>
                        {{ $campaign->status_label }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Basic Details --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <h3>Campaign Details</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Campaign Title <span class="required">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $campaign->title) }}" required
                               class="form-control @error('title') error @enderror"
                               placeholder="e.g. Education for All 2026">
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Goal Amount <span class="required">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">$</span>
                            <input type="number" name="goal_amount" value="{{ old('goal_amount', $campaign->goal_amount) }}" required step="0.01" min="0"
                                   class="form-control pl-8 @error('goal_amount') error @enderror"
                                   placeholder="e.g. 50000.00">
                        </div>
                        @error('goal_amount')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-grid grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-group">
                        <label class="form-label">Collected So Far <span class="optional">(optional)</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">$</span>
                            <input type="number" name="collected_amount" value="{{ old('collected_amount', $campaign->collected_amount) }}" step="0.01" min="0"
                                   class="form-control pl-8 @error('collected_amount') error @enderror"
                                   placeholder="e.g. 15000.00">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sort Order <span class="optional">(optional)</span></label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $campaign->sort_order ?? 0) }}" min="0"
                               class="form-control @error('sort_order') error @enderror"
                               placeholder="Lower numbers appear first">
                        @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                        <div class="form-helper">Lower numbers appear first in listings.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="publish-option">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $campaign->is_active) ? 'checked' : '' }}>
                            <div>
                                <div class="label">Active</div>
                                <div class="description">Show on public donation page</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <h3>Description</h3>
                <span class="flex items-center gap-1 ml-auto text-xs text-gray-400">
                    <span id="charCount">{{ strlen($campaign->description ?? '') }}</span>/5000
                </span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <textarea name="description" id="campaignDescription" rows="6" maxlength="5000"
                              class="form-control textarea @error('description') error @enderror"
                              placeholder="Describe the campaign goal, who it helps, and why donations are needed..."
                              oninput="document.getElementById('charCount').textContent = this.value.length">{{ old('description', $campaign->description) }}</textarea>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">This will be shown on the public campaign page.</div>
                </div>
            </div>
        </div>

        {{-- Date Range --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3>Date Range <span class="badge">Optional</span></h3>
            </div>
            <div class="card-body">
                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Start Date <span class="optional">(optional)</span></label>
                        <input type="date" name="start_date" value="{{ old('start_date', $campaign->start_date?->format('Y-m-d')) }}"
                               class="form-control @error('start_date') error @enderror">
                        @error('start_date')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">End Date <span class="optional">(optional)</span></label>
                        <input type="date" name="end_date" value="{{ old('end_date', $campaign->end_date?->format('Y-m-d')) }}"
                               class="form-control @error('end_date') error @enderror">
                        @error('end_date')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-helper">Leave both empty for ongoing campaigns with no specific end date.</div>
            </div>
        </div>

        {{-- Image --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3>Campaign Image</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                @if($campaign->image_url)
                <div class="form-group">
                    <label class="form-label">Current Image</label>
                    <div class="current-image">
                        <img src="{{ $campaign->image_url }}" alt="Current campaign image">
                        <div class="image-info">
                            <strong>Current image</strong>
                            <div class="text-small-info">Replace below if needed</div>
                        </div>
                        <label class="ml-auto flex items-center gap-2 text-xs text-gray-500 cursor-pointer bg-white px-3 py-1.5 rounded-lg border border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all">
                            <input type="checkbox" name="remove_image" value="1" class="accent-red-500"> Remove
                        </label>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">{{ $campaign->image_url ? 'Replace' : 'Upload' }} Image <span class="optional">(optional)</span></label>
                    <div class="upload-area-modern" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder" class="{{ $campaign->image_url ? 'hidden' : '' }}">
                            <div class="upload-icon-box">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="upload-label">Click or drag to upload {{ $campaign->image_url ? 'new' : 'campaign' }} image</div>
                            <div class="upload-hint">JPG, PNG or WebP — Max 10MB</div>
                        </div>
                        <div id="imagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('image')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Video --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon" style="background:#fef2f2;color:#dc2626;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3>Campaign Video</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                <p class="text-sm text-gray-500 mb-4">Choose one: a YouTube link <strong>or</strong> an uploaded video file.</p>

                {{-- Current video indicator --}}
                @if($campaign->has_youtube)
                <div class="form-group">
                    <label class="form-label">Current Video</label>
                    <div class="current-image">
                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-xl flex-shrink-0">▶️</div>
                        <div class="image-info">
                            <strong>YouTube video linked</strong>
                            <div class="text-small-info truncate max-w-[300px]">
                                <a href="{{ $campaign->youtube_url }}" target="_blank" class="text-blue-500 hover:underline">{{ $campaign->youtube_url }}</a>
                            </div>
                        </div>
                        <label class="ml-auto flex items-center gap-2 text-xs text-gray-500 cursor-pointer bg-white px-3 py-1.5 rounded-lg border border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all">
                            <input type="checkbox" name="remove_youtube" value="1" class="accent-red-500"> Remove
                        </label>
                    </div>
                </div>
                @elseif($campaign->has_uploaded_video)
                <div class="form-group">
                    <label class="form-label">Current Video</label>
                    <div class="current-image">
                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-xl flex-shrink-0">🎬</div>
                        <div class="image-info">
                            <strong>Video file uploaded</strong>
                            <div class="text-small-info">Replace below if needed</div>
                        </div>
                        <label class="ml-auto flex items-center gap-2 text-xs text-gray-500 cursor-pointer bg-white px-3 py-1.5 rounded-lg border border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all">
                            <input type="checkbox" name="remove_video" value="1" class="accent-red-500"> Remove
                        </label>
                    </div>
                </div>
                @endif

                {{-- YouTube URL --}}
                <div class="form-group">
                    <label class="form-label">YouTube Link <span class="optional">(or upload below)</span></label>
                    <div class="relative">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <input type="url" name="youtube_url" id="youtubeUrlInput" value="{{ old('youtube_url', $campaign->youtube_url) }}"
                               class="form-control pl-10 @error('youtube_url') error @enderror"
                               placeholder="https://www.youtube.com/watch?v=..."
                               oninput="toggleVideoSource()">
                    </div>
                    @error('youtube_url')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Paste a YouTube video URL to embed it on the campaign page.</div>
                </div>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-4 text-xs font-medium text-gray-400 uppercase tracking-wider">Or</span>
                    </div>
                </div>

                {{-- File upload --}}
                <div class="form-group">
                    <label class="form-label">Upload Video File <span class="optional">(or use YouTube above)</span></label>
                    <div class="upload-area-modern" id="videoUploadArea" onclick="document.getElementById('videoInput').click()">
                        <input type="file" name="video" id="videoInput" accept="video/*" class="hidden" onchange="toggleVideoSource()">
                        <div id="videoPlaceholder" class="{{ $campaign->video_url && !$campaign->has_youtube ? 'hidden' : '' }}">
                            <div class="upload-icon-box" style="background:#fef2f2;">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#dc2626;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="upload-label">Click or drag to upload {{ $campaign->video_url ? 'new' : 'campaign' }} video</div>
                            <div class="upload-hint">MP4, AVI, MOV, MKV or WebM — Max 300MB</div>
                        </div>
                        <div id="videoPreview" class="hidden mt-3"></div>
                    </div>
                    @error('video')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- PDF --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon" style="background:#f0fdf4;color:#16a34a;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3>Campaign PDF</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                @if($campaign->pdf_url)
                <div class="form-group">
                    <label class="form-label">Current PDF</label>
                    <div class="current-image">
                        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center text-xl flex-shrink-0">📄</div>
                        <div class="image-info min-w-0">
                            <strong class="truncate block max-w-[200px]">{{ $campaign->pdf_filename }}</strong>
                            <div class="text-small-info">Replace below if needed</div>
                        </div>
                        <label class="ml-auto flex items-center gap-2 text-xs text-gray-500 cursor-pointer bg-white px-3 py-1.5 rounded-lg border border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all">
                            <input type="checkbox" name="remove_pdf" value="1" class="accent-red-500"> Remove
                        </label>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">{{ $campaign->pdf_url ? 'Replace' : 'Upload' }} PDF <span class="optional">(optional)</span></label>
                    <div class="upload-area-modern" onclick="document.getElementById('pdfInput').click()">
                        <input type="file" name="pdf" id="pdfInput" accept=".pdf" class="hidden">
                        <div id="pdfPlaceholder" class="{{ $campaign->pdf_url ? 'hidden' : '' }}">
                            <div class="upload-icon-box" style="background:#f0fdf4;">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#16a34a;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="upload-label">Click or drag to upload {{ $campaign->pdf_url ? 'new' : 'campaign' }} PDF</div>
                            <div class="upload-hint">PDF only — Max 50MB</div>
                        </div>
                        <div id="pdfPreview" class="hidden mt-3"></div>
                    </div>
                    @error('pdf')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Progress Summary --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3>Campaign Progress</h3>
                <span class="ml-auto text-xs text-gray-400">Live preview</span>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <div class="text-lg font-bold text-gray-800">{{ $campaign->formatted_goal }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">Goal</div>
                    </div>
                    <div class="text-center p-3 bg-emerald-50 rounded-xl">
                        <div class="text-lg font-bold text-emerald-700">{{ $campaign->formatted_collected }}</div>
                        <div class="text-xs text-emerald-500 mt-0.5">Raised</div>
                    </div>
                    <div class="text-center p-3 {{ $campaign->days_remaining !== null && $campaign->days_remaining > 0 ? 'bg-blue-50' : 'bg-gray-50' }} rounded-xl">
                        <div class="text-lg font-bold {{ $campaign->days_remaining !== null && $campaign->days_remaining > 0 ? 'text-blue-700' : 'text-gray-500' }}">
                            {{ $campaign->days_remaining !== null ? $campaign->days_remaining : '∞' }}
                        </div>
                        <div class="text-xs {{ $campaign->days_remaining !== null && $campaign->days_remaining > 0 ? 'text-blue-500' : 'text-gray-400' }} mt-0.5">
                            {{ $campaign->days_remaining !== null ? 'Days Left' : 'Ongoing' }}
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-700 ease-out"
                                 style="width: {{ $campaign->progress_percentage }}%; background: {{ $campaign->progress_percentage >= 100 ? '#16a34a' : '#2d6fa3' }};">
                            </div>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <div class="text-lg font-bold text-gray-800">{{ $campaign->progress_percentage }}%</div>
                        <div class="text-xs text-gray-400">of {{ $campaign->formatted_goal }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Update Campaign
            </button>
            <a href="{{ route('admin.campaigns.preview', $campaign) }}" target="_blank" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                Preview
            </a>
            <a href="{{ route('admin.campaigns.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>

    {{-- Delete Section --}}
    <div class="form-card danger-zone">
        <div class="card-header danger">
            <div class="icon red">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <h3>Danger Zone</h3>
            <span class="badge">Irreversible</span>
        </div>
        <div class="card-body">
            <div class="danger-content">
                <div class="danger-text">
                    <p class="title">Delete this campaign</p>
                    <p class="desc">Once deleted, this campaign and all its associated files (image, video, PDF) will be permanently removed. This action cannot be undone.</p>
                </div>
                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST"
                      onsubmit="return confirm('Delete &quot;{{ addslashes($campaign->title) }}&quot; permanently? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Campaign
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function setupFileInput(inputId, placeholderId, previewId, isImage) {
        const input = document.getElementById(inputId);
        if (!input) return;
        const dropZone = input.closest('.upload-area-modern');

        input.addEventListener('change', function(e) {
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);
            const file = e.target.files[0];
            if (file) {
                placeholder.classList.add('hidden');
                preview.classList.remove('hidden');
                dropZone && dropZone.classList.add('has-file');
                
                if (isImage) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `
                            <div class="image-preview-wrapper">
                                <img src="${e.target.result}" alt="Preview">
                                <button type="button" class="remove-btn"
                                        onclick="clearFileInput('${inputId}', '${placeholderId}', '${previewId}')">×</button>
                                <div class="file-info">${file.name} (${(file.size / 1024).toFixed(1)} KB)</div>
                            </div>`;
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.innerHTML = `
                        <div class="image-preview-wrapper">
                            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg">
                                <span class="text-2xl">${inputId.includes('video') ? '🎬' : '📄'}</span>
                                <div class="text-left">
                                    <div class="text-sm font-semibold text-gray-700">${file.name}</div>
                                    <div class="text-xs text-gray-400">${(file.size / 1024 / 1024).toFixed(2)} MB</div>
                                </div>
                            </div>
                            <button type="button" class="remove-btn"
                                    onclick="clearFileInput('${inputId}', '${placeholderId}', '${previewId}')">×</button>
                        </div>`;
                }
            }
        });

        if (dropZone) {
            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('border-[#2d6fa3]', 'bg-blue-50/30');
            });
            dropZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('border-[#2d6fa3]', 'bg-blue-50/30');
            });
            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('border-[#2d6fa3]', 'bg-blue-50/30');
                const files = e.dataTransfer.files;
                if (files.length) {
                    input.files = files;
                    input.dispatchEvent(new Event('change'));
                }
            });
        }
    }

    setupFileInput('imageInput', 'imagePlaceholder', 'imagePreview', true);
    setupFileInput('videoInput', 'videoPlaceholder', 'videoPreview', false);
    setupFileInput('pdfInput', 'pdfPlaceholder', 'pdfPreview', false);

    window.toggleVideoSource = function() {
        const youtubeInput = document.getElementById('youtubeUrlInput');
        const videoInput = document.getElementById('videoInput');
        const uploadArea = document.getElementById('videoUploadArea');

        if (youtubeInput.value.trim() !== '') {
            videoInput.disabled = true;
            uploadArea.classList.add('opacity-40', 'cursor-not-allowed');
            uploadArea.style.pointerEvents = 'none';
        } else {
            videoInput.disabled = false;
            uploadArea.classList.remove('opacity-40', 'cursor-not-allowed');
            uploadArea.style.pointerEvents = 'auto';
        }

        if (videoInput.files.length > 0) {
            youtubeInput.disabled = true;
            youtubeInput.classList.add('opacity-40');
        } else {
            youtubeInput.disabled = false;
            youtubeInput.classList.remove('opacity-40');
        }
    };
});

window.clearFileInput = function(inputId, placeholderId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const placeholder = document.getElementById(placeholderId);
    const dropZone = input.closest('.upload-area-modern');

    input.value = '';
    preview.innerHTML = '';
    preview.classList.add('hidden');
    placeholder.classList.remove('hidden');
    dropZone && dropZone.classList.remove('has-file');
    if (window.toggleVideoSource) toggleVideoSource();
};
</script>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

@endsection
