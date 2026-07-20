@extends('admin.layouts.app')

@push('styles')
<style>
    .editor-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 2px;
        padding: 6px 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-bottom: none;
        border-radius: 10px 10px 0 0;
    }
    .editor-toolbar button {
        width: 34px;
        height: 34px;
        border: none;
        background: transparent;
        border-radius: 6px;
        cursor: pointer;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
        position: relative;
    }
    .editor-toolbar button:hover {
        background: #e2e8f0;
        color: #0f172a;
    }
    .editor-toolbar button:active {
        background: #cbd5e1;
        transform: scale(0.95);
    }
    .editor-toolbar button svg { width: 16px; height: 16px; }
    .editor-toolbar .separator {
        width: 1px;
        height: 22px;
        background: #e2e8f0;
        margin: 6px 5px;
    }
    .content-editor {
        min-height: 320px;
        max-height: 520px;
        padding: 16px 20px;
        border: 1px solid #e2e8f0;
        border-radius: 0 0 10px 10px;
        font-size: 14px;
        line-height: 1.8;
        background: #fff;
        color: #0f172a;
        resize: vertical;
        overflow-y: auto;
    }
    .content-editor:focus {
        outline: none;
        border-color: #2d6fa3;
        box-shadow: 0 0 0 3px rgba(45,111,163,0.08);
    }
    .content-editor:empty:before {
        content: attr(data-placeholder);
        color: #94a3b8;
        pointer-events: none;
    }

    /* ── Live Preview ── */
    .live-preview-wrap {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        max-height: 600px;
        overflow-y: auto;
    }
    .live-preview-wrap .lp-header {
        background: linear-gradient(135deg, #2d6fa3 0%, #1d4e7a 100%);
        padding: 28px 32px 22px;
        text-align: center;
    }
    .live-preview-wrap .lp-header h2 {
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        margin: 0;
        line-height: 1.3;
    }
    .live-preview-wrap .lp-body {
        padding: 24px 32px;
        font-size: 14px;
        line-height: 1.8;
        color: #333;
    }
    .live-preview-wrap .lp-body h2 { color: #2d6fa3; font-size: 18px; margin: 20px 0 10px; }
    .live-preview-wrap .lp-body h3 { color: #1e293b; font-size: 15px; margin: 16px 0 8px; }
    .live-preview-wrap .lp-body p { margin-bottom: 12px; }
    .live-preview-wrap .lp-body ul, .live-preview-wrap .lp-body ol { margin: 8px 0 14px 22px; }
    .live-preview-wrap .lp-body li { margin-bottom: 5px; }
    .live-preview-wrap .lp-body a { color: #2d6fa3; }
    .live-preview-wrap .lp-body img { max-width: 100%; border-radius: 6px; margin: 12px 0; }
    .live-preview-wrap .lp-footer {
        background: #f8f9fc;
        padding: 16px 32px;
        text-align: center;
        font-size: 11px;
        color: #aaa;
        border-top: 1px solid #eee;
    }

    /* ── Image Upload ── */
    .image-upload-zone {
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 24px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #fafbfc;
        position: relative;
    }
    .image-upload-zone:hover,
    .image-upload-zone.dragover {
        border-color: #2d6fa3;
        background: #eff6ff;
    }
    .image-upload-zone .iu-icon {
        width: 40px;
        height: 40px;
        color: #cbd5e1;
        margin: 0 auto 10px;
        transition: color 0.2s;
    }
    .image-upload-zone:hover .iu-icon,
    .image-upload-zone.dragover .iu-icon {
        color: #2d6fa3;
    }
    .image-upload-zone .iu-label {
        font-size: 14px;
        font-weight: 500;
        color: #475569;
    }
    .image-upload-zone .iu-hint {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 4px;
    }
    .image-preview-card {
        display: none;
        margin-top: 12px;
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }
    .image-preview-card.show { display: block; }
    .image-preview-card img {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        display: block;
    }
    .image-preview-card .ip-actions {
        position: absolute;
        top: 8px;
        right: 8px;
        display: flex;
        gap: 4px;
    }
    .image-preview-card .ip-actions button {
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        background: rgba(0,0,0,0.5);
        color: #fff;
    }
    .image-preview-card .ip-actions button:hover {
        background: rgba(0,0,0,0.7);
        transform: scale(1.08);
    }
    .image-preview-card .ip-filename {
        padding: 6px 12px;
        font-size: 11px;
        color: #64748b;
        background: #fff;
        border-top: 1px solid #e2e8f0;
    }

    /* ── Subject char count ── */
    .char-count {
        font-size: 11px;
        color: #94a3b8;
        transition: color 0.2s;
    }
    .char-count.warning { color: #f59e0b; }
    .char-count.danger { color: #ef4444; }

    /* ── Tooltip ── */
    .toolbar-btn-tip {
        display: none;
        position: absolute;
        bottom: calc(100% + 4px);
        left: 50%;
        transform: translateX(-50%);
        background: #1e293b;
        color: #fff;
        font-size: 10px;
        padding: 3px 7px;
        border-radius: 4px;
        white-space: nowrap;
        pointer-events: none;
        z-index: 10;
    }
    .editor-toolbar button:hover .toolbar-btn-tip { display: block; }
</style>
@endpush

@section('title', 'New Newsletter Campaign')
@section('page-title', 'Create Newsletter')
@section('breadcrumb', 'Campaigns → Create')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- ═══ Left: Form ═══ --}}
    <div>
        <form action="{{ route('admin.newsletter.campaigns.store') }}" method="POST" enctype="multipart/form-data" id="campaignForm">
            @csrf

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                {{-- Section header --}}
                <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-800">Campaign Details</h3>
                        <p class="text-[11px] text-gray-400">Fill in the details for your newsletter</p>
                    </div>
                </div>

                <div class="p-6 space-y-6">

                    {{-- ── Subject ── --}}
                    <div>
                        <label for="subjectInput" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Subject <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="subject" id="subjectInput"
                                   value="{{ old('subject') }}" required maxlength="200"
                                   class="w-full px-4 py-3 pr-20 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] @error('subject') border-red-300 @enderror"
                                   placeholder="Enter your newsletter subject line..."
                                   autocomplete="off">
                            <span class="char-count absolute right-3 top-1/2 -translate-y-1/2" id="charCount">{{ strlen(old('subject', '')) }} / 200</span>
                        </div>
                        @error('subject')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>

                    {{-- ── Content / Editor ── --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Content <span class="text-red-400">*</span>
                        </label>

                        {{-- Toolbar --}}
                        <div class="editor-toolbar" id="editorToolbar">
                            <button type="button" onclick="execCmd('bold')" title="Bold (Ctrl+B)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"/><path d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"/></svg>
                                <span class="toolbar-btn-tip">Bold</span>
                            </button>
                            <button type="button" onclick="execCmd('italic')" title="Italic (Ctrl+I)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 4h-9M14 20H5M15 4L9 20"/></svg>
                                <span class="toolbar-btn-tip">Italic</span>
                            </button>
                            <button type="button" onclick="execCmd('underline')" title="Underline (Ctrl+U)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 3v7a6 6 0 006 6 6 6 0 006-6V3"/><path d="M4 21h16"/></svg>
                                <span class="toolbar-btn-tip">Underline</span>
                            </button>
                            <div class="separator"></div>
                            <button type="button" onclick="execCmd('insertUnorderedList')" title="Bullet List">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                                <span class="toolbar-btn-tip">Bullet List</span>
                            </button>
                            <button type="button" onclick="execCmd('insertOrderedList')" title="Numbered List">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 6h11M10 12h11M10 18h11M4 6h1v4M4 10h2M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"/></svg>
                                <span class="toolbar-btn-tip">Numbered List</span>
                            </button>
                            <div class="separator"></div>
                            <button type="button" onclick="execCmd('formatBlock', '<h2>')" title="Heading">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4v16M20 4v16M4 12h16"/></svg>
                                <span class="toolbar-btn-tip">Heading</span>
                            </button>
                            <button type="button" onclick="execCmd('formatBlock', '<h3>')" title="Subheading">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 4v16M18 4v16M6 12h12"/></svg>
                                <span class="toolbar-btn-tip">Subheading</span>
                            </button>
                            <div class="separator"></div>
                            <button type="button" onclick="insertLink()" title="Insert Link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
                                <span class="toolbar-btn-tip">Insert Link</span>
                            </button>
                            <button type="button" onclick="removeFormat()" title="Remove formatting">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 4V8M15 8H9M15 8L9 20M9 16H5M13 20L9 8"/></svg>
                                <span class="toolbar-btn-tip">Clear Format</span>
                            </button>
                        </div>

                        {{-- Editor --}}
                        <div id="contentEditor"
                             class="content-editor"
                             contenteditable="true"
                             data-placeholder="Write your newsletter content here..."></div>
                        <textarea name="content" id="contentInput" class="hidden">{{ old('content') }}</textarea>
                        @error('content')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                        <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Use the toolbar to format. Images added here will not appear in the email — use the header image field below.
                        </p>
                    </div>

                    {{-- ── Header Image Upload ── --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Header Image
                            <span class="text-gray-400 font-normal">(optional)</span>
                        </label>

                        <div class="image-upload-zone" id="imageUploadZone">
                            <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                            <svg class="iu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="iu-label">Drop an image here or click to browse</div>
                            <div class="iu-hint">PNG, JPG, GIF · Max 5MB · Recommended 1200×400px</div>
                        </div>

                        {{-- Image preview --}}
                        <div class="image-preview-card" id="imagePreviewCard">
                            <img id="imagePreview" src="" alt="Preview">
                            <div class="ip-actions">
                                <button type="button" id="removeImageBtn" title="Remove image">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="ip-filename" id="imageFileName">No file selected</div>
                        </div>
                        @error('image')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- ── Form Actions ── --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('admin.newsletter.campaigns.index') }}"
                       class="text-sm text-gray-400 hover:text-gray-600 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Create Campaign
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- ═══ Right: Live Preview ═══ --}}
    <div class="lg:sticky lg:top-6 self-start">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            {{-- Preview header --}}
            <div class="px-5 py-3.5 border-b border-gray-50 bg-gray-50/80 flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <span class="text-sm font-semibold text-gray-700">Live Preview</span>
                <span class="ml-auto text-[10px] text-gray-400">Updates as you type</span>
            </div>

            {{-- Preview content --}}
            <div class="live-preview-wrap" id="livePreview">
                {{-- Email header --}}
                <div class="lp-header" id="previewHeader">
                    <h2 id="previewSubject">Your Newsletter Subject</h2>
                </div>
                {{-- Email image area --}}
                <div id="previewImageArea" class="hidden" style="line-height:0;">
                    <img id="previewImage" src="" alt="Header Image" style="width:100%;max-height:240px;object-fit:cover;display:block;">
                </div>
                {{-- Email body --}}
                <div class="lp-body" id="previewBody">
                    <p style="color:#94a3b8; text-align:center; padding:24px 0;">
                        Your newsletter content will appear here as you type...
                    </p>
                </div>
                {{-- Email footer --}}
                <div class="lp-footer">
                    <strong style="color:#2d6fa3">Krousar Thmey</strong> · Cambodia since 1991
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // ── DOM refs ──
    const editor = document.getElementById('contentEditor');
    const contentInput = document.getElementById('contentInput');
    const subjectInput = document.getElementById('subjectInput');
    const charCount = document.getElementById('charCount');
    const previewSubject = document.getElementById('previewSubject');
    const previewBody = document.getElementById('previewBody');
    const imageInput = document.getElementById('imageInput');
    const imageUploadZone = document.getElementById('imageUploadZone');
    const imagePreviewCard = document.getElementById('imagePreviewCard');
    const imagePreview = document.getElementById('imagePreview');
    const imageFileName = document.getElementById('imageFileName');
    const removeImageBtn = document.getElementById('removeImageBtn');
    const previewImageArea = document.getElementById('previewImageArea');
    const previewImage = document.getElementById('previewImage');

    // ── Editor commands ──
    function execCmd(command, value = null) {
        document.execCommand(command, false, value);
        editor.focus();
        updatePreview();
    }

    function insertLink() {
        const url = prompt('Enter the URL:');
        if (url && url.trim()) {
            execCmd('createLink', url.trim());
        }
    }

    function removeFormat() {
        document.execCommand('removeFormat', false, null);
        editor.focus();
        updatePreview();
    }

    // ── Update preview ──
    function updatePreview() {
        const html = editor.innerHTML;
        contentInput.value = html;
        previewBody.innerHTML = html || '<p style="color:#94a3b8;text-align:center;padding:24px 0;">Your newsletter content will appear here as you type...</p>';
    }

    // ── Subject live update + char count ──
    function updateSubject() {
        const val = subjectInput.value;
        const len = val.length;
        previewSubject.textContent = val || 'Your Newsletter Subject';

        charCount.textContent = `${len} / 200`;
        charCount.classList.remove('warning', 'danger');
        if (len > 175) charCount.classList.add('warning');
        if (len > 195) charCount.classList.add('danger');
    }

    subjectInput.addEventListener('input', updateSubject);
    updateSubject();

    // ── Editor events ──
    editor.addEventListener('input', updatePreview);
    editor.addEventListener('keyup', updatePreview);
    updatePreview();

    // ── Restore old content on validation error ──
    @if(old('content'))
        editor.innerHTML = @json(old('content'));
        updatePreview();
    @endif

    // ── Keyboard shortcuts ──
    editor.addEventListener('keydown', function(e) {
        if (!e.ctrlKey && !e.metaKey) return;
        switch (e.key.toLowerCase()) {
            case 'b': e.preventDefault(); execCmd('bold'); break;
            case 'i': e.preventDefault(); execCmd('italic'); break;
            case 'u': e.preventDefault(); execCmd('underline'); break;
        }
    });

    // ── Image upload ──
    imageUploadZone.addEventListener('click', function() { imageInput.click(); });

    // ── Drag & drop support ──
    imageUploadZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });
    imageUploadZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });
    imageUploadZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        if (e.dataTransfer.files.length) {
            imageInput.files = e.dataTransfer.files;
            handleImageFile(e.dataTransfer.files[0]);
        }
    });

    imageInput.addEventListener('change', function() {
        if (this.files[0]) handleImageFile(this.files[0]);
    });

    function handleImageFile(file) {
        if (!file.type.startsWith('image/')) {
            alert('Please select an image file.');
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreviewCard.classList.add('show');
            imageUploadZone.style.display = 'none';
            imageFileName.textContent = file.name;

            previewImage.src = e.target.result;
            previewImageArea.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    removeImageBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        imagePreviewCard.classList.remove('show');
        imageUploadZone.style.display = 'block';
        imageInput.value = '';
        previewImageArea.classList.add('hidden');
    });

    // ── Form submit: sync editor content ──
    document.getElementById('campaignForm').addEventListener('submit', function() {
        updatePreview();
    });
</script>
@endpush
