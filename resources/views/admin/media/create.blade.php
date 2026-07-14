@extends('admin.layouts.app')

@push('styles')
<style>
    .dropzone {
        border: 2px dashed #d1d5db;
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        background: #f9fafb;
        position: relative;
        min-height: 220px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .dropzone:hover {
        border-color: #2d6fa3;
        background: #eff6ff;
    }
    .dropzone.dragover {
        border-color: #2d6fa3;
        background: #dbeafe;
        transform: scale(1.01);
    }
    .dropzone.has-file {
        border-color: #22c55e;
        background: #f0fdf4;
        padding: 1.5rem;
    }
    .dropzone .preview-wrap {
        display: flex;
        align-items: center;
        gap: 1rem;
        width: 100%;
    }
    .dropzone .preview-wrap img,
    .dropzone .preview-wrap video {
        max-height: 140px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }
    .file-details {
        text-align: left;
        flex: 1;
    }
    .file-details .file-name {
        font-weight: 600;
        font-size: 14px;
        color: #1f2937;
        word-break: break-all;
    }
    .file-details .file-size {
        font-size: 12px;
        color: #6b7280;
        margin-top: 2px;
    }
    .file-details .file-type-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 10px;
        border-radius: 20px;
        margin-top: 6px;
    }
    .progress-wrap {
        width: 100%;
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
        margin-top: 12px;
    }
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #2d6fa3, #1d4e7a);
        border-radius: 3px;
        transition: width 0.3s ease;
        width: 0%;
    }
    .category-checkbox-group {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 8px;
        max-height: 240px;
        overflow-y: auto;
        padding: 4px;
    }
    .category-checkbox-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13px;
        color: #374151;
        cursor: pointer;
        transition: all 0.15s;
    }
    .category-checkbox-group label:hover {
        border-color: #2d6fa3;
        background: #eff6ff;
    }
    .category-checkbox-group label:has(input:checked) {
        border-color: #2d6fa3;
        background: #eff6ff;
        color: #1e40af;
        font-weight: 500;
    }
    .category-checkbox-group input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #2d6fa3;
        flex-shrink: 0;
    }
</style>
@endpush

@section('title', 'Upload Media')
@section('page-title', 'Upload Media')
@section('breadcrumb', 'Add photos &amp; videos to the media gallery')

@section('content')

@if($errors->any())
<div class="max-w-3xl mx-auto mb-5 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data"
          id="uploadForm" class="space-y-6">
        @csrf

        {{-- File upload zone --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Media File
                </h3>
            </div>
            <div class="p-6">
                <div id="dropzone" class="dropzone" onclick="document.getElementById('fileInput').click()">
                    <input type="file" name="file" id="fileInput" accept=".jpg,.jpeg,.png,.webp,.gif,.svg,.mp4,.mov,.avi,.webm,.ogg" class="hidden">
                    <div id="dropzonePlaceholder">
                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="text-sm font-medium text-gray-600">Drag &amp; drop or click to browse</p>
                        <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP, GIF, SVG (images) &middot; MP4, MOV, AVI, WebM, OGG (videos)</p>
                        <p class="text-xs text-gray-400">Max file size: 100MB</p>
                    </div>
                    <div id="filePreview" class="hidden w-full">
                        <div class="preview-wrap">
                            <div id="previewMedia"></div>
                            <div class="file-details">
                                <div class="file-name" id="fileName"></div>
                                <div class="file-size" id="fileSize"></div>
                                <div class="file-type-badge" id="fileTypeBadge"></div>
                                <div class="progress-wrap" id="progressWrap">
                                    <div class="progress-fill" id="progressFill"></div>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="resetFileInput()"
                                class="mt-3 text-xs text-red-500 hover:text-red-700 font-medium">
                            Remove file
                        </button>
                    </div>
                </div>
                @error('file')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Title & Description --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Media Information</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="e.g. School opening ceremony 2026">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Optional description or caption...">{{ old('description') }}</textarea>
            </div>
        </div>

        {{-- Thumbnail (for videos) --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Thumbnail <span class="font-normal text-gray-400 normal-case">(optional &mdash; for videos, or custom image thumbnail)</span>
            </h3>
            <div>
                <input type="file" name="thumbnail" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-1.5 text-xs text-gray-400">Recommended: 16:9 aspect ratio, max 4MB. For images, the uploaded image is used automatically.</p>
            </div>
        </div>

        {{-- Categories (multi-select) --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Categories
                <span class="font-normal text-gray-400 normal-case">(select multiple)</span>
            </h3>
            @if($categories->isEmpty())
            <p class="text-sm text-gray-400">No categories available. <a href="{{ route('admin.categories.index') }}" class="text-[#2d6fa3] underline">Create categories</a> first.</p>
            @else
            <div class="category-checkbox-group">
                @foreach($categories as $cat)
                <label>
                    <input type="checkbox" name="category_ids[]" value="{{ $cat->CategoryID }}"
                           {{ in_array($cat->CategoryID, old('category_ids', [])) ? 'checked' : '' }}>
                    {{ $cat->CategoryName }}
                </label>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Active toggle --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                       class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                <label for="is_active" class="text-sm font-medium text-gray-700">Active (visible on the website)</label>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 pb-4">
            <button type="submit" id="submitBtn"
                    class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Upload Media
            </button>
            <a href="{{ route('admin.media.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const placeholder = document.getElementById('dropzonePlaceholder');
    const preview = document.getElementById('filePreview');
    const previewMedia = document.getElementById('previewMedia');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const fileTypeBadge = document.getElementById('fileTypeBadge');
    const progressFill = document.getElementById('progressFill');
    const progressWrap = document.getElementById('progressWrap');
    const uploadForm = document.getElementById('uploadForm');

    // Drag and drop events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
            dropzone.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
            dropzone.classList.remove('dragover');
        });
    });

    dropzone.addEventListener('drop', function(e) {
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    });

    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    function handleFileSelect(file) {
        const maxSize = 100 * 1024 * 1024; // 100MB
        const allowedImageTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/svg+xml'];
        const allowedVideoTypes = ['video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/webm', 'video/ogg'];

        // Check file size
        if (file.size > maxSize) {
            alert('File is too large. Maximum size is 100MB.');
            resetFileInput();
            return;
        }

        // Check file type
        const isImage = allowedImageTypes.includes(file.type);
        const isVideo = allowedVideoTypes.includes(file.type);

        if (!isImage && !isVideo) {
            alert('Invalid file type. Allowed: JPG, PNG, WebP, GIF, SVG (images) or MP4, MOV, AVI, WebM, OGG (videos).');
            resetFileInput();
            return;
        }

        // Show preview
        placeholder.classList.add('hidden');
        preview.classList.remove('hidden');

        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);

        if (isImage) {
            fileTypeBadge.className = 'file-type-badge bg-blue-50 text-blue-600';
            fileTypeBadge.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Image';
            const reader = new FileReader();
            reader.onload = function(e) {
                previewMedia.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        } else {
            fileTypeBadge.className = 'file-type-badge bg-purple-50 text-purple-600';
            fileTypeBadge.innerHTML = '<svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg> Video';
            const url = URL.createObjectURL(file);
            previewMedia.innerHTML = `<video src="${url}" controls class="max-h-[140px] rounded-lg"></video>`;
        }

        dropzone.classList.add('has-file');
        progressWrap.style.display = 'block';
        progressFill.style.width = '0%';
    }

    // Upload progress
    uploadForm.addEventListener('submit', function(e) {
        const file = fileInput.files[0];
        if (!file) {
            alert('Please select a file to upload.');
            e.preventDefault();
            return;
        }

        // Show progress with AJAX upload
        if (window.XMLHttpRequest) {
            e.preventDefault();

            const formData = new FormData(uploadForm);
            const xhr = new XMLHttpRequest();

            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    progressFill.style.width = percent + '%';

                    if (percent < 100) {
                        // Update button text
                        document.getElementById('submitBtn').innerHTML = `
                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            Uploading ${percent}%`;
                        document.getElementById('submitBtn').disabled = true;
                    }
                }
            });

            xhr.addEventListener('load', function() {
                if (xhr.status === 200 || xhr.status === 201) {
                    // Redirect on success
                    window.location.href = '{{ route('admin.media.index') }}';
                } else {
                    // Reload to show errors
                    window.location.reload();
                }
            });

            xhr.addEventListener('error', function() {
                window.location.reload();
            });

            xhr.open('POST', uploadForm.action);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.send(formData);
        }
    });

    function formatFileSize(bytes) {
        if (bytes >= 1073741824) return (bytes / 1073741824).toFixed(2) + ' GB';
        if (bytes >= 1048576) return (bytes / 1048576).toFixed(1) + ' MB';
        if (bytes >= 1024) return Math.round(bytes / 1024) + ' KB';
        return bytes + ' B';
    }
});

function resetFileInput() {
    const fileInput = document.getElementById('fileInput');
    const placeholder = document.getElementById('dropzonePlaceholder');
    const preview = document.getElementById('filePreview');
    const dropzone = document.getElementById('dropzone');
    const progressFill = document.getElementById('progressFill');
    const progressWrap = document.getElementById('progressWrap');
    const previewMedia = document.getElementById('previewMedia');

    fileInput.value = '';
    placeholder.classList.remove('hidden');
    preview.classList.add('hidden');
    dropzone.classList.remove('has-file');
    previewMedia.innerHTML = '';
    progressFill.style.width = '0%';
    progressWrap.style.display = 'none';
}
</script>

@endsection
