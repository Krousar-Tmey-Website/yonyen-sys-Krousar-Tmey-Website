@extends('admin.layouts.app')

@section('title', 'Edit Award')
@section('page-title', 'Edit Award')
@section('breadcrumb', 'Awards → Edit')

@section('content')

<div class="form-container">
    <form action="{{ route('admin.awards.update', $award) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        {{-- Award Details --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3>Award Details</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Title <span class="required">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $award->title) }}" required
                               class="form-control @error('title') error @enderror"
                               placeholder="Award title...">
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Organization <span class="required">*</span></label>
                        <input type="text" name="organization" value="{{ old('organization', $award->organization) }}" required
                               class="form-control @error('organization') error @enderror"
                               placeholder="Awarding organization...">
                        @error('organization')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Recipient <span class="optional">(optional)</span></label>
                    <input type="text" name="recipient" value="{{ old('recipient', $award->recipient) }}"
                           class="form-control @error('recipient') error @enderror"
                           placeholder="Person name if applicable...">
                    <div class="form-helper">Leave empty if the award is for the organization</div>
                    @error('recipient')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description <span class="optional">(optional)</span></label>
                    <textarea name="description" rows="3"
                              class="form-control textarea @error('description') error @enderror"
                              placeholder="Short description...">{{ old('description', $award->description) }}</textarea>
                    <div class="form-helper">Brief description of the award (max 500 characters)</div>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Sort Order <span class="optional">(optional)</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $award->sort_order) }}"
                           class="form-control @error('sort_order') error @enderror"
                           placeholder="0">
                    <div class="form-helper">Lower numbers appear first (default: 0)</div>
                    @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Award Image --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3>Award Image</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                @if($award->image)
                <div class="mb-4">
                    <p class="text-xs font-medium text-gray-600 mb-2">Current Image:</p>
                    <div class="flex items-center gap-3">
                        <img src="{{ $award->image_url }}" alt="{{ $award->title }}" class="w-16 h-16 rounded-lg object-cover">
                        <div>
                            <p class="text-sm text-gray-500">{{ $award->image }}</p>
                            <label class="flex items-center gap-2 mt-1 text-xs">
                                <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300">
                                Remove image
                            </label>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="form-group">
                    <label class="form-label">Upload New Image <span class="optional">(optional)</span></label>
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

                <div class="form-group">
                    <label class="form-label">Icon (emoji) <span class="optional">(optional)</span></label>
                    <input type="text" name="icon" value="{{ old('icon', $award->icon) }}"
                           class="form-control @error('icon') error @enderror text-center text-lg"
                           placeholder="🏆">
                    <div class="form-helper">Used when no image is uploaded. Default: 🏆</div>
                    @error('icon')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- External Link --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-8m0-6V6a2 2 0 112 2h-6m-6 0l6 6m-6-6l6-6"/>
                    </svg>
                </div>
                <h3>External Link</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Link Type <span class="optional">(optional)</span></label>
                    <select name="link_type"
                            class="form-control @error('link_type') error @enderror">
                        <option value="">None</option>
                        <option value="website" {{ old('link_type', $award->link_type) == 'website' ? 'selected' : '' }}>Visit Website</option>
                        <option value="article" {{ old('link_type', $award->link_type) == 'article' ? 'selected' : '' }}>Read Article</option>
                        <option value="video" {{ old('link_type', $award->link_type) == 'video' ? 'selected' : '' }}>Watch Video</option>
                    </select>
                    <div class="form-helper">Choose the type of link for the button</div>
                    @error('link_type')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Link Text <span class="optional">(optional)</span></label>
                    <input type="text" name="link_text" value="{{ old('link_text', $award->link_text) }}"
                           class="form-control @error('link_text') error @enderror"
                           placeholder="Visit Website, Read Article, or Watch Video...">
                    <div class="form-helper">Button label text. If empty, will use the link type as default</div>
                    @error('link_text')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Link URL <span class="optional">(optional)</span></label>
                    <input type="url" name="link_url" value="{{ old('link_url', $award->link_url) }}"
                           class="form-control @error('link_url') error @enderror"
                           placeholder="https://...">
                    <div class="form-helper">Full URL to the external resource</div>
                    @error('link_url')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Changes
            </button>
            <a href="{{ route('admin.awards.index') }}" class="btn-cancel">Cancel</a>
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