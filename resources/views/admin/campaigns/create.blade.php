@extends('admin.layouts.app')

@section('title', 'Create Campaign')
@section('page-title', 'Create Campaign')
@section('breadcrumb', 'Donation Campaigns → Create Campaign')

@section('content')

<div class="form-container">
    <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                        <input type="text" name="title" id="campaignTitle" value="{{ old('title') }}" required
                               class="form-control @error('title') error @enderror"
                               placeholder="e.g. Education for All 2026"
                               oninput="updateSlugPreview(this.value)">
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Goal Amount <span class="required">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">$</span>
                            <input type="number" name="goal_amount" value="{{ old('goal_amount', '0.00') }}" required step="0.01" min="0"
                                   class="form-control pl-8 @error('goal_amount') error @enderror"
                                   placeholder="e.g. 50000.00">
                        </div>
                        @error('goal_amount')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="hidden mt-2 mb-4 text-xs text-gray-400" id="slugPreview">
                    URL: <span class="text-gray-600 font-mono" id="slugText"></span>
                </div>

                <div class="form-grid grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-group">
                        <label class="form-label">Collected So Far <span class="optional">(optional)</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">$</span>
                            <input type="number" name="collected_amount" value="{{ old('collected_amount', '0.00') }}" step="0.01" min="0"
                                   class="form-control pl-8 @error('collected_amount') error @enderror"
                                   placeholder="e.g. 15000.00">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sort Order <span class="optional">(optional)</span></label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', '0') }}" min="0"
                               class="form-control @error('sort_order') error @enderror"
                               placeholder="Lower numbers appear first">
                        @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                        <div class="form-helper">Lower numbers appear first in listings.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="publish-option">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', false) ? 'checked' : '' }}>
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
                    <span id="charCount">0</span>/5000
                </span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <textarea name="description" id="campaignDescription" rows="6" maxlength="5000"
                              class="form-control textarea @error('description') error @enderror"
                              placeholder="Describe the campaign goal, who it helps, and why donations are needed. You can include multiple paragraphs and important details here."
                              oninput="updateCharCount()">{{ old('description') }}</textarea>
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
                        <input type="date" name="start_date" id="startDate" value="{{ old('start_date') }}"
                               class="form-control @error('start_date') error @enderror"
                               onchange="validateDates()">
                        @error('start_date')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">End Date <span class="optional">(optional)</span></label>
                        <input type="date" name="end_date" id="endDate" value="{{ old('end_date') }}"
                               class="form-control @error('end_date') error @enderror"
                               onchange="validateDates()">
                        @error('end_date')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div id="dateWarning" class="hidden mt-2 text-xs text-amber-600 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2">
                    End date must be after start date.
                </div>
                <div class="form-helper mt-2">Leave both empty for ongoing campaigns with no specific end date.</div>
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
                <div class="form-group">
                    <div class="upload-area-modern" id="imageDropZone" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <div class="upload-icon-box">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="upload-label">Click or drag to upload campaign image</div>
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
                <p class="text-sm text-gray-500 mb-4">Choose one: upload a video file <strong>or</strong> paste a YouTube link.</p>

                {{-- YouTube URL --}}
                <div class="form-group">
                    <label class="form-label">YouTube Link <span class="optional">(or upload below)</span></label>
                    <div class="relative">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <input type="url" name="youtube_url" id="youtubeUrlInput" value="{{ old('youtube_url') }}"
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
                        <div id="videoPlaceholder">
                            <div class="upload-icon-box" style="background:#fef2f2;">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#dc2626;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="upload-label">Click or drag to upload campaign video</div>
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
                <div class="form-group">
                    <label class="form-label">Upload PDF Brochure <span class="optional">(optional)</span></label>
                    <div class="upload-area-modern" onclick="document.getElementById('pdfInput').click()">
                        <input type="file" name="pdf" id="pdfInput" accept=".pdf" class="hidden">
                        <div id="pdfPlaceholder">
                            <div class="upload-icon-box" style="background:#f0fdf4;">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#16a34a;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="upload-label">Click or drag to upload campaign PDF</div>
                            <div class="upload-hint">PDF only — Max 50MB</div>
                        </div>
                        <div id="pdfPreview" class="hidden mt-3"></div>
                    </div>
                    @error('pdf')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Campaign
            </button>
            <a href="{{ route('admin.campaigns.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Setup file inputs with modern preview
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

    // Video source toggling
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

    // Slug preview
    window.updateSlugPreview = function(value) {
        const preview = document.getElementById('slugPreview');
        const slugText = document.getElementById('slugText');
        if (!preview || !slugText) return;
        if (value.trim()) {
            const slug = value.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-|-$/g, '');
            slugText.textContent = slug;
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    };

    // Character count
    window.updateCharCount = function() {
        const textarea = document.getElementById('campaignDescription');
        const count = document.getElementById('charCount');
        if (textarea && count) {
            count.textContent = textarea.value.length;
        }
    };

    // Date validation
    window.validateDates = function() {
        const start = document.getElementById('startDate');
        const end = document.getElementById('endDate');
        const warning = document.getElementById('dateWarning');
        if (start.value && end.value && start.value > end.value) {
            warning.classList.remove('hidden');
        } else {
            warning.classList.add('hidden');
        }
    };

    // Initial character count
    updateCharCount();

    // Initialize video toggle from old values
    if (window.toggleVideoSource) toggleVideoSource();
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

@endsection
