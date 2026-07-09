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
                <div x-data="{ editing: false }">
                    <div class="flex items-center justify-between px-5 py-3 hover:bg-gray-50/50" x-show="!editing">
                        <div>
                            <span class="text-sm text-gray-700">{{ $partner->name }}</span>
                            @if($partner->country)
                            <span class="text-xs text-gray-400 ml-2">· {{ $partner->country }}</span>
                            @endif
                            @if(!$partner->is_active)
                            <span class="ml-2 px-1.5 py-0.5 bg-gray-100 text-gray-400 text-xs rounded">hidden</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="editing = true" class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium p-1">Edit</button>
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                  onsubmit="return confirm('Remove {{ addslashes($partner->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-300 hover:text-red-500 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="px-5 py-3 bg-gray-50 border-t border-gray-100" x-show="editing" x-cloak>
                        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" class="flex flex-wrap items-end gap-3">
                            @csrf @method('PUT')
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Name</label>
                                <input type="text" name="name" value="{{ $partner->name }}" required
                                       class="px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] w-48">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Category</label>
                                <select name="category" class="px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] bg-white">
                                    @foreach(['authorities'=>'Authorities','organizations'=>'Organizations','companies'=>'Companies','towns'=>'Towns'] as $v=>$l)
                                    <option value="{{ $v }}" {{ $partner->category === $v ? 'selected' : '' }}>{{ $l }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Country</label>
                                <input type="text" name="country" value="{{ $partner->country }}"
                                       class="px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] w-28">
                            </div>
                            <div class="flex items-center gap-2 pb-1">
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" {{ $partner->is_active ? 'checked' : '' }}
                                           class="rounded accent-[#2d6fa3] w-4 h-4">
                                    <span class="text-xs text-gray-600">Active</span>
                                </label>
                            </div>
                            <div class="flex gap-2 pb-0.5">
                                <button type="submit" class="btn-primary text-xs px-3 py-2">Save</button>
                                <button type="button" @click="editing = false" class="text-gray-400 hover:text-gray-600 text-xs px-3 py-2">Cancel</button>
                            </div>
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

@endsection
