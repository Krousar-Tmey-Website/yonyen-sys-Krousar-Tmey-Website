@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit History Event')
@section('page-title', 'Edit History Event')
@section('breadcrumb', 'History → Edit')

@section('content')

<div class="form-container">
    <form action="{{ route('admin.history.update', $history) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

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
                        <input type="text" name="year" value="{{ old('year', $history->year) }}" required
                               class="form-control @error('year') error @enderror"
                               placeholder="e.g., 1991">
                        @error('year')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Side <span class="required">*</span></label>
                        <select name="side" required
                                class="form-control @error('side') error @enderror">
                            <option value="left" {{ old('side', $history->side) == 'left' ? 'selected' : '' }}>Left Side</option>
                            <option value="right" {{ old('side', $history->side) == 'right' ? 'selected' : '' }}>Right Side</option>
                        </select>
                        <div class="form-helper">Choose which side to display the event on the timeline</div>
                        @error('side')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Event Description <span class="required">*</span></label>
                    <textarea name="event" rows="4"
                              class="form-control textarea @error('event') error @enderror"
                              placeholder="Describe the event...">{{ old('event', $history->event) }}</textarea>
                    @error('event')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Sort Order <span class="optional">(optional)</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $history->sort_order) }}"
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
                {{-- Current Image --}}
                @if($history->image)
                <div class="form-group">
                    <label class="form-label">Current Image</label>
                    <div class="current-image">
                        <img src="{{ $history->image_url }}" alt="Current image">
                        <div class="image-info">
                            <strong>Current image</strong>
                            <div class="text-small-info">Replace below if needed</div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Image Upload --}}
                <div class="form-group">
                    <label class="form-label">Upload New Image <span class="optional">(optional)</span></label>
                    <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">{{ $history->image ? 'Replace image' : 'Click to upload' }}</div>
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
                Update Event
            </button>
            <a href="{{ route('admin.history.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>

    {{-- Delete Form --}}
    <div class="form-actions form-actions--delete">
        <form action="{{ route('admin.history.destroy', $history) }}" method="POST"
              onsubmit="return confirm('⚠️ Permanently delete this history event?\n\nThis action cannot be undone.')"
              class="inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn-danger">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete Event
            </button>
        </form>
    </div>
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