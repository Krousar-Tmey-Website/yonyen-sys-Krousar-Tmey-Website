@extends('admin.layouts.app')

@section('title', 'Create Program')
@section('page-title', 'Create Program')
@section('breadcrumb', 'Programs → Create')

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                    <input type="text" name="Status" value="{{ old('Status') }}" placeholder="e.g. Active, Ongoing, Planning..."
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Description</label>
                <textarea name="full_description" rows="6"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-y">{{ old('full_description') }}</textarea>
            </div>

            {{-- Stats Editor --}}
            <div x-data="{
                stats: {{ json_encode(old('stats', [['value'=>'','label'=>'']])) }},
                addStat() { this.stats.push({value:'',label:''}); },
                removeStat(i) { this.stats.splice(i,1); }
            }">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-medium text-gray-700">Statistics (shown as badges & bullet points)</label>
                    <button type="button" @click="addStat()" class="text-xs text-[#2d6fa3] hover:underline">+ Add Stat</button>
                </div>
                <div class="space-y-2">
                    <template x-for="(stat, i) in stats" :key="i">
                        <div class="flex items-center gap-2">
                            <input type="text" :name="'stats['+i+'][value]'" x-model="stat.value" placeholder="Value (e.g. 240)"
                                   class="w-28 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            <input type="text" :name="'stats['+i+'][label]'" x-model="stat.label" placeholder="Label (e.g. Children)"
                                   class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            <button type="button" @click="removeStat(i)" class="text-red-400 hover:text-red-600 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div class="flex items-end pb-1">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
            </div>

            <div x-data="{ imageType: 'upload' }">
                <div class="flex items-center gap-4 mb-3">
                    <label class="block text-sm font-medium text-gray-700">Program Image</label>
                    <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg">
                        <button type="button" @click="imageType = 'upload'" :class="imageType === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                        <button type="button" @click="imageType = 'url'" :class="imageType === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
                    </div>
                </div>

                <div x-show="imageType === 'upload'">
                    <input type="file" name="image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                    <p class="mt-2 text-xs text-gray-400">Max 2MB. Recommended: 800×600px or wider.</p>
                </div>

                <div x-show="imageType === 'url'" style="display: none;">
                    <input type="url" name="image_url" placeholder="https://example.com/image.jpg"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="mt-2 text-xs text-gray-400">Enter a direct link to the image.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Create Program</button>
            <a href="{{ route('admin.programs.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

@endsection
