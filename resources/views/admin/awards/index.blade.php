@extends('admin.layouts.app')

@section('title', 'Awards')
@section('page-title', 'Awards')
@section('breadcrumb', 'Manage awards displayed on the About page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Add award form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Award</h3>
        <form action="{{ route('admin.awards.store') }}" method="POST" class="space-y-3">
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
                        <span class="text-2xl flex-shrink-0 mt-0.5">{{ $award->icon }}</span>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-700 text-sm">{{ $award->title }}</p>
                            <p class="text-[#2d6fa3] text-xs">{{ $award->organization }}</p>
                            @if($award->recipient)
                            <p class="text-gray-400 text-xs">{{ $award->recipient }}</p>
                            @endif
                            @if($award->description)
                            <p class="text-gray-400 text-xs mt-1 line-clamp-2">{{ $award->description }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-1 flex-shrink-0 ml-3">
                        <button type="button" onclick="openEditModal({{ $award->id }}, '{{ addslashes($award->title) }}', '{{ addslashes($award->organization) }}', '{{ addslashes($award->recipient ?? '') }}', '{{ addslashes($award->description ?? '') }}', '{{ $award->icon }}', {{ $award->sort_order ?? 0 }})"
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
        <form id="editForm" method="POST">
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
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="flex-1 btn-primary text-sm py-2.5">Save Changes</button>
                <button type="button" onclick="closeEditModal()" class="btn-cancel text-sm py-2.5">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, title, organization, recipient, description, icon, sort_order) {
    document.getElementById('editId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editOrganization').value = organization;
    document.getElementById('editRecipient').value = recipient;
    document.getElementById('editDescription').value = description;
    document.getElementById('editIcon').value = icon;
    document.getElementById('editSortOrder').value = sort_order;
    document.getElementById('editForm').action = '/admin/awards/' + id;
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}
</script>

