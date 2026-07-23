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
                        <input type="text" name="title" value="{{ old('title') }}" required
                               class="form-control @error('title') error @enderror"
                               placeholder="e.g. Education for All 2026">
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Goal Amount <span class="required">*</span></label>
                        <input type="number" name="goal_amount" value="{{ old('goal_amount', '0.00') }}" required step="0.01" min="0"
                               class="form-control @error('goal_amount') error @enderror"
                               placeholder="e.g. 50000.00">
                        @error('goal_amount')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Collected So Far <span class="optional">(optional)</span></label>
                        <input type="number" name="collected_amount" value="{{ old('collected_amount', '0.00') }}" step="0.01" min="0"
                               class="form-control @error('collected_amount') error @enderror"
                               placeholder="e.g. 15000.00">
                        @error('collected_amount')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="publish-option">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <div>
                                <div class="label">Active</div>
                                <div class="description">Show this campaign on the public donation page</div>
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
            </div>
            <div class="card-body">
                <div class="form-group">
                    <textarea name="description" data-ckeditor rows="4" class="form-control textarea @error('description') error @enderror"
                              placeholder="Describe the campaign goal, who it helps, and why donations are needed...">{{ old('description') }}</textarea>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
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
                        <input type="date" name="start_date" value="{{ old('start_date') }}"
                               class="form-control @error('start_date') error @enderror">
                        @error('start_date')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">End Date <span class="optional">(optional)</span></label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}"
                               class="form-control @error('end_date') error @enderror">
                        @error('end_date')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-helper">Leave empty for ongoing campaigns with no specific end date.</div>
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
                    <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div class="upload-title">Click to upload campaign image</div>
                            <div class="upload-subtitle">JPG, PNG or WebP (Max 2MB)</div>
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
    const input = document.getElementById('imageInput');
    if (input) {
        input.addEventListener('change', function(e) {
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
                            <img src="${e.target.result}" alt="Preview" class="h-[180px]">
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
