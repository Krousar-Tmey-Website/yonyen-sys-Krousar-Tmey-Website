@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Add History Event')
@section('page-title', 'Add History Event')
@section('breadcrumb', 'History → Create')

@section('content')

<style>
    .form-container {
        max-width: 100%;
        padding: 0;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .form-card {
        background: #ffffff;
        border: none;
        border-bottom: 1px solid #e9ecef;
        overflow: hidden;
    }
    .form-card:last-child {
        border-bottom: none;
    }

    .card-header {
        padding: 14px 24px;
        background: #fafbfc;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .card-header .icon {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .card-header .icon.blue { background: #e3f0ff; color: #1a73e8; }

    .card-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    .card-header .badge {
        font-size: 11px;
        color: #94a3b8;
        margin-left: auto;
        background: #f1f4f9;
        padding: 2px 12px;
        border-radius: 12px;
    }

    .card-body {
        padding: 20px 24px;
    }

    .form-group {
        margin-bottom: 16px;
    }
    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #334155;
        margin-bottom: 5px;
    }
    .form-label .required {
        color: #ef4444;
    }
    .form-label .optional {
        font-weight: 400;
        color: #94a3b8;
        font-size: 12px;
    }

    .form-control {
        width: 100%;
        padding: 9px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
        background: #fafbfc;
        color: #0f172a;
    }
    .form-control:focus {
        outline: none;
        border-color: #2d6fa3;
        box-shadow: 0 0 0 3px rgba(45, 111, 163, 0.08);
        background: #ffffff;
    }
    .form-control:hover {
        background: #ffffff;
    }
    .form-control::placeholder {
        color: #a0aec0;
    }
    .form-control.error {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .form-control.textarea {
        min-height: 80px;
        resize: vertical;
        line-height: 1.6;
    }

    .form-helper {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 5px;
    }

    .form-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 4px;
    }

    .form-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        padding: 16px 24px;
        background: #fafbfc;
        border-top: 1px solid #e9ecef;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 28px;
        background: #2d6fa3;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background: #1a4a7a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(45,111,163,0.25);
    }
    .btn-primary svg {
        width: 18px;
        height: 18px;
    }

    .btn-cancel {
        padding: 10px 20px;
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        background: none;
        border: none;
        cursor: pointer;
        border-radius: 6px;
    }
    .btn-cancel:hover {
        color: #0f172a;
        background: #f1f5f9;
    }

    .upload-area {
        border: 2px dashed #e2e8f0;
        border-radius: 8px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafbfc;
    }
    .upload-area:hover {
        border-color: #2d6fa3;
        background: #f1f5f9;
    }
    .upload-area .upload-icon {
        width: 40px;
        height: 40px;
        color: #cbd5e1;
        margin: 0 auto 10px;
        transition: color 0.3s;
    }
    .upload-area:hover .upload-icon {
        color: #2d6fa3;
    }
    .upload-area .upload-title {
        font-size: 14px;
        color: #64748b;
    }
    .upload-area .upload-subtitle {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }

    .image-preview-wrapper {
        position: relative;
        display: inline-block;
    }
    .image-preview-wrapper img {
        height: 140px;
        width: auto;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        object-fit: cover;
    }
    .image-preview-wrapper .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 26px;
        height: 26px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .image-preview-wrapper .remove-btn:hover {
        background: #dc2626;
        transform: scale(1.1);
    }
    .image-preview-wrapper .file-info {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 6px;
        text-align: center;
    }
</style>

<div class="form-container">
    <form action="{{ route('admin.history.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Event Details --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3>Event Details</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Year <span class="required">*</span></label>
                        <input type="text" name="year" value="{{ old('year') }}" required
                               class="form-control @error('year') error @enderror"
                               placeholder="e.g., 1991">
                        @error('year')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Side <span class="required">*</span></label>
                        <select name="side" required
                                class="form-control @error('side') error @enderror">
                            <option value="left" {{ old('side', 'left') == 'left' ? 'selected' : '' }}>Left Side</option>
                            <option value="right" {{ old('side') == 'right' ? 'selected' : '' }}>Right Side</option>
                        </select>
                        <div class="form-helper">Choose which side to display the event on the timeline</div>
                        @error('side')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Event Description <span class="required">*</span></label>
                    <textarea name="event" rows="4"
                              class="form-control textarea @error('event') error @enderror"
                              placeholder="Describe the event...">{{ old('event') }}</textarea>
                    @error('event')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Sort Order <span class="optional">(optional)</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="form-control @error('sort_order') error @enderror"
                           placeholder="0">
                    <div class="form-helper">Lower numbers appear first (default: 0)</div>
                    @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Image --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3>Event Image</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Upload Image <span class="optional">(optional)</span></label>
                    <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">Click to upload</div>
                            <div class="upload-subtitle">Max 2MB. JPG, PNG, or WebP</div>
                        </div>
                        <div id="imagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('image')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Event
            </button>
            <a href="{{ route('admin.history.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('imagePlaceholder');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    placeholder.classList.add('hidden');
                    preview.classList.remove('hidden');
                    preview.innerHTML = `
                        <div class="image-preview-wrapper">
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-btn" 
                                    onclick="document.getElementById('imageInput').value=''; preview.innerHTML=''; preview.classList.add('hidden'); placeholder.classList.remove('hidden');">
                                ×
                            </button>
                            <div class="file-info">${file.name} (${(file.size / 1024).toFixed(1)} KB)</div>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>

@endsection