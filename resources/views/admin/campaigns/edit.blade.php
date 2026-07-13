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
                        <input type="number" name="goal_amount" value="{{ old('goal_amount', $campaign->goal_amount) }}" required step="0.01" min="0"
                               class="form-control @error('goal_amount') error @enderror"
                               placeholder="e.g. 50000.00">
                        @error('goal_amount')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Collected So Far <span class="optional">(optional)</span></label>
                        <input type="number" name="collected_amount" value="{{ old('collected_amount', $campaign->collected_amount) }}" step="0.01" min="0"
                               class="form-control @error('collected_amount') error @enderror"
                               placeholder="e.g. 15000.00">
                        @error('collected_amount')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="publish-option">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $campaign->is_active) ? 'checked' : '' }}>
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
                    <textarea name="description" rows="4" class="form-control textarea @error('description') error @enderror"
                              placeholder="Describe the campaign goal, who it helps, and why donations are needed...">{{ old('description', $campaign->description) }}</textarea>
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
                @if($campaign->image_url)
                <div class="form-group">
                    <label class="form-label">Current Image</label>
                    <div class="current-image">
                        <img src="{{ $campaign->image_url }}" alt="Current campaign image">
                        <div class="image-info">
                            <strong>Current campaign image</strong>
                            <div class="text-small-info">Replace below if needed</div>
                        </div>
                        <label class="ml-auto flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                            <input type="checkbox" name="remove_image" value="1" class="accent-red-500">
                            Remove image
                        </label>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Replace Image <span class="optional">(optional)</span></label>
                    <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder" class="{{ $campaign->image_url ? 'hidden' : '' }}">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div class="upload-title">Click to upload new image</div>
                            <div class="upload-subtitle">JPG, PNG or WebP (Max 2MB)</div>
                        </div>
                        <div id="imagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('image')<div class="form-error">{{ $message }}</div>@enderror
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
            </div>
            <div class="card-body">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500"
                                 style="width: {{ $campaign->progress_percentage }}%; background: {{ $campaign->progress_percentage >= 100 ? '#16a34a' : '#2d6fa3' }};">
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-bold text-gray-800">{{ $campaign->progress_percentage }}%</div>
                        <div class="text-xs text-gray-400">of {{ $campaign->formatted_goal }}</div>
                    </div>
                </div>
                <div class="mt-2 text-xs text-gray-400">
                    <span class="font-medium text-gray-600">{{ $campaign->formatted_collected }}</span> raised so far
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Update Campaign
            </button>
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
                    <p class="desc">Once deleted, this campaign and all its data will be permanently removed. This action cannot be undone.</p>
                </div>
                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST"
                      onsubmit="return confirm('Delete &quot;{{ addslashes($campaign->title) }}&quot; permanently? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
