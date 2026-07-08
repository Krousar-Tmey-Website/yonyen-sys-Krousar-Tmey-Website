@extends('admin.layouts.app')

@section('title', 'Awards')
@section('page-title', 'Awards')
@section('breadcrumb', 'Manage awards displayed on the Awards page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Add award form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Award</h3>
        <form action="{{ route('admin.awards.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Award title...">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Organization <span class="text-red-400">*</span></label>
                <input type="text" name="organization" value="{{ old('organization') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Awarding organization...">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Recipient (optional)</label>
                <input type="text" name="recipient" value="{{ old('recipient') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Person name if applicable...">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="2"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Short description...">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Image <span class="optional">(optional)</span></label>
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
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', '🏆') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] text-center text-lg">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
            <div class="border-t border-gray-100 pt-3 mt-3">
                <p class="text-xs font-medium text-gray-600 mb-2">External Link (optional)</p>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Link Type</label>
                    <select name="link_type"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] bg-white">
                        <option value="">None</option>
                        <option value="website">Visit Website</option>
                        <option value="article">Read Article</option>
                        <option value="video">Watch Video</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Link Text (button label)</label>
                    <input type="text" name="link_text" value="{{ old('link_text') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Visit Website, Read Article, or Watch Video...">
                </div>
                <div class="mt-2">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Link URL</label>
                    <input type="url" name="link_url" value="{{ old('link_url') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="https://...">
                </div>
            </div>
            <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Award</button>
        </form>
    </div>

    {{-- Awards list --}}
    <div class="lg:col-span-2">
        @if($awards->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
            No awards yet. Add your first one.
        </div>
        @else
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100">
                <h4 class="font-semibold text-gray-700 text-sm">{{ $awards->count() }} Award(s)</h4>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($awards as $award)
                <div class="flex items-start justify-between px-5 py-4 hover:bg-gray-50/50">
                    <div class="flex items-start gap-3 min-w-0">
                        @if($award->image)
                        <img src="{{ $award->image_url }}" alt="{{ $award->title }}" class="w-12 h-12 rounded-xl object-cover flex-shrink-0 mt-0.5">
                        @else
                        <span class="text-2xl flex-shrink-0 mt-0.5">{{ $award->icon }}</span>
                        @endif
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-700 text-sm">{{ $award->title }}</p>
                            <p class="text-[#2d6fa3] text-xs">{{ $award->organization }}</p>
                            @if($award->recipient)
                            <p class="text-gray-400 text-xs">{{ $award->recipient }}</p>
                            @endif
                            @if($award->description)
                            <p class="text-gray-400 text-xs mt-1 line-clamp-2">{{ $award->description }}</p>
                            @endif
                            @if($award->link_url)
                            <a href="{{ $award->link_url }}" target="_blank" rel="noopener" class="text-xs text-[#2d6fa3] hover:underline mt-1 inline-block">
                                {{ $award->link_text ?? ucfirst($award->link_type) }} →
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-1 flex-shrink-0 ml-3">
                        <button type="button" onclick="openEditModal({{ $award->id }}, '{{ addslashes($award->title) }}', '{{ addslashes($award->organization) }}', '{{ addslashes($award->recipient ?? '') }}', '{{ addslashes($award->description ?? '') }}', '{{ $award->icon }}', {{ $award->sort_order ?? 0 }}, '{{ $award->link_url ?? '' }}', '{{ $award->link_type ?? '' }}', '{{ $award->link_text ?? '' }}')"
                                class="text-gray-400 hover:text-[#2d6fa3] transition-colors p-1" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form action="{{ route('admin.awards.destroy', $award) }}" method="POST"
                              onsubmit="return confirm('Remove this award?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-300 hover:text-red-500 transition-colors p-1" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Edit Award</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="hidden" id="editId" name="id">
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Title <span class="text-red-400">*</span></label>
                    <input type="text" name="title" id="editTitle" required
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Organization <span class="text-red-400">*</span></label>
                    <input type="text" name="organization" id="editOrganization" required
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Recipient (optional)</label>
                    <input type="text" name="recipient" id="editRecipient"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                    <textarea name="description" id="editDescription" rows="2"
                              class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Image <span class="optional">(optional)</span></label>
                    <div class="upload-area" onclick="document.getElementById('editImageInput').click()">
                        <input type="file" name="image" id="editImageInput" accept="image/*" class="hidden">
                        <div id="editImagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">Click to upload</div>
                            <div class="upload-subtitle">Max 2MB. JPG, PNG, or WebP</div>
                        </div>
                        <div id="editImagePreview" class="hidden mt-3"></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Icon (emoji)</label>
                        <input type="text" name="icon" id="editIcon"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] text-center text-lg">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                        <input type="number" name="sort_order" id="editSortOrder"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-3 mt-3">
                    <p class="text-xs font-medium text-gray-600 mb-2">External Link (optional)</p>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Link Type</label>
                        <select name="link_type" id="editLinkType"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] bg-white">
                            <option value="">None</option>
                            <option value="website">Visit Website</option>
                            <option value="article">Read Article</option>
                            <option value="video">Watch Video</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Link Text (button label)</label>
                        <input type="text" name="link_text" id="editLinkText"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="Visit Website, Read Article, or Watch Video...">
                    </div>
                    <div class="mt-2">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Link URL</label>
                        <input type="url" name="link_url" id="editLinkUrl"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="https://...">
                    </div>
                </div>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="flex-1 btn-primary text-sm py-2.5">Save Changes</button>
                <button type="button" onclick="closeEditModal()" class="btn-cancel text-sm py-2.5">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, title, organization, recipient, description, icon, sort_order, link_url, link_type, link_text) {
    document.getElementById('editId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editOrganization').value = organization;
    document.getElementById('editRecipient').value = recipient;
    document.getElementById('editDescription').value = description;
    document.getElementById('editIcon').value = icon;
    document.getElementById('editSortOrder').value = sort_order;
    document.getElementById('editLinkUrl').value = link_url;
    document.getElementById('editLinkType').value = link_type;
    document.getElementById('editLinkText').value = link_text || '';
    document.getElementById('editForm').action = '/admin/awards/' + id;
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

// Image preview for add form
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
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="max-h-32 rounded-lg">';
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    const editImageInput = document.getElementById('editImageInput');
    if (editImageInput) {
        editImageInput.addEventListener('change', function(e) {
            const preview = document.getElementById('editImagePreview');
            const placeholder = document.getElementById('editImagePlaceholder');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    placeholder.classList.add('hidden');
                    preview.classList.remove('hidden');
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="max-h-32 rounded-lg">';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>

@endsection