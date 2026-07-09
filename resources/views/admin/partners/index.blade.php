@extends('admin.layouts.app')

@section('title', 'Partners')
@section('page-title', 'Partners')
@section('breadcrumb', 'Manage partner organisations displayed on the About page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6 mb-6">
    {{-- Add partner form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Partner</h3>
        <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Name <span class="text-red-400">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Partner name...">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Category <span class="text-red-400">*</span></label>
                <select name="category" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] bg-white">
                    <option value="authorities">Cambodian Authorities</option>
                    <option value="organizations">Organizations / Foundations</option>
                    <option value="companies">Companies</option>
                    <option value="towns">Towns & Municipalities</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Country (optional)</label>
                <input type="text" name="country" value="{{ old('country') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="e.g. Switzerland">
            </div>
            <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Partner</button>
        </form>
    </div>

    {{-- Partner lists --}}
    <div class="lg:col-span-2 space-y-5">
        @foreach(['authorities' => '🇰🇭 Cambodian Authorities', 'organizations' => '🏛️ Organizations & Foundations', 'companies' => '🏢 Companies', 'towns' => '🏙️ Towns & Municipalities'] as $cat => $catLabel)
        @if(isset($partners[$cat]) && $partners[$cat]->count())
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
                <h4 class="font-semibold text-gray-700 text-sm">{{ $catLabel }}</h4>
                <span class="text-xs text-gray-400">{{ $partners[$cat]->count() }} entries</span>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($partners[$cat] as $partner)
                <div class="flex items-center justify-between px-5 py-3 hover:bg-gray-50/50">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-700">{{ $partner->name }}</span>
                        @if($partner->country)
                        <span class="text-xs text-gray-400 ml-2">· {{ $partner->country }}</span>
                        @endif
                        @if(!$partner->is_active)
                        <span class="ml-2 px-1.5 py-0.5 bg-gray-100 text-gray-400 text-xs rounded">hidden</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-1">
                        <button type="button" onclick="openEditModal({{ $partner->id }}, '{{ addslashes($partner->name) }}', '{{ $partner->category }}', '{{ addslashes($partner->country ?? '') }}', {{ $partner->is_active ? 'true' : 'false' }})"
                                class="text-gray-400 hover:text-[#2d6fa3] transition-colors p-1" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                              onsubmit="return confirm('Remove {{ addslashes($partner->name) }}?')">
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
        @endforeach

        @if($partners->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
            No partners yet. Add your first one using the form.
        </div>
        @endif
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Edit Partner</h3>
        <form id="editForm" method="POST">
            @csrf @method('PUT')
            <input type="hidden" id="editId" name="id">
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Name <span class="text-red-400">*</span></label>
                    <input type="text" name="name" id="editName" required
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Category <span class="text-red-400">*</span></label>
                    <select name="category" id="editCategory"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] bg-white">
                        <option value="authorities">Cambodian Authorities</option>
                        <option value="organizations">Organizations / Foundations</option>
                        <option value="companies">Companies</option>
                        <option value="towns">Towns & Municipalities</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Country (optional)</label>
                    <input type="text" name="country" id="editCountry"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="flex items-center gap-2 text-xs font-medium text-gray-600">
                        <input type="checkbox" name="is_active" id="editActive" value="1" checked
                               class="w-4 h-4 text-[#2d6fa3] border-gray-300 rounded focus:ring-[#2d6fa3]">
                        Active (visible on website)
                    </label>
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
function openEditModal(id, name, category, country, is_active) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editCategory').value = category;
    document.getElementById('editCountry').value = country;
    document.getElementById('editActive').checked = is_active;
    document.getElementById('editForm').action = '/admin/partners/' + id;
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}
</script>

@endsection