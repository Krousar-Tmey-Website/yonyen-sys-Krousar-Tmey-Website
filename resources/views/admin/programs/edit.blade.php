@extends('admin.layouts.app')

@section('title', 'Edit Program')
@section('page-title', 'Edit Program: ' . $program->title)
@section('breadcrumb', 'Programs → ' . $program->title)

@section('content')

<div class="max-w-4xl">
    <form action="{{ route('admin.programs.update', $program) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Left: Image Upload --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 sticky top-6 space-y-4">
                    <h3 class="font-semibold text-gray-800 text-sm">Program Image</h3>
                    
                    {{-- Current Image Preview --}}
                    @if($program->image)
                    <div class="relative group rounded-xl overflow-hidden border-2 border-gray-200">
                        <img src="{{ $program->image_url }}" alt="{{ $program->title }}"
                             class="w-full aspect-square object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-xs font-medium">Replace Image</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500">Current image is displayed above</p>
                    @endif
                    
                    {{-- Drag & Drop File Input --}}
                    <div class="relative">
                        <input type="file" name="image" accept="image/*" id="imageInput"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-[#2d6fa3] hover:bg-blue-50/50 transition-colors">
                            <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <p class="text-xs font-medium text-gray-700">Drag image here</p>
                            <p class="text-xs text-gray-400 mt-1">or click to browse</p>
                            <p class="text-xs text-gray-300 mt-2">JPG, PNG (Max 2MB)</p>
                        </div>
                    </div>
                    
                    {{-- File Name Display --}}
                    <div id="fileNameDisplay" class="hidden bg-green-50 border border-green-200 rounded-lg p-3">
                        <p class="text-xs text-green-700 font-medium" id="fileName"></p>
                    </div>
                </div>
            </div>

            {{-- Right: Text Fields --}}
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
                    {{-- Title --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="inline-block w-1 h-1 bg-red-500 rounded-full mr-1"></span>
                            Program Title
                        </label>
                        <input type="text" name="title" value="{{ old('title', $program->title) }}" required
                               placeholder="e.g., Child Welfare"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-all">
                        <p class="text-xs text-gray-500 mt-1.5">This is the main title shown on the homepage</p>
                    </div>

                    {{-- Short Description (Hover Text) --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="inline-block w-1 h-1 bg-red-500 rounded-full mr-1"></span>
                            Hover Description
                        </label>
                        <textarea name="description" rows="3" placeholder="This text appears when hovering over the card..."
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none transition-all">{{ old('description', $program->description) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1.5">This shows on hover effect (200 characters recommended)</p>
                        <div class="flex justify-between mt-1">
                            <span id="charCount" class="text-xs text-gray-400">0 / 200</span>
                        </div>
                    </div>

                    {{-- Full Description --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">Full Description (Optional)</label>
                        <textarea name="full_description" rows="4" placeholder="Additional detailed information..."
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-y transition-all">{{ old('full_description', $program->full_description) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1.5">Used on the full programs page</p>
                    </div>

                    {{-- Sort Order & Status --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Display Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $program->sort_order ?? 0) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-all">
                            <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Status</label>
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl h-12">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $program->is_active) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-[#2d6fa3] w-5 h-5 cursor-pointer">
                                <label for="is_active" class="text-sm font-medium text-gray-700 cursor-pointer">Show on website</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Preview --}}
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 text-sm mb-4">📱 Homepage Preview</h3>
                    <div class="rounded-xl overflow-hidden border border-gray-200 bg-white shadow-sm">
                        <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800 text-base mb-2">{{ old('title', $program->title) }}</h4>
                            <p class="text-gray-600 text-xs leading-relaxed">{{ old('description', $program->description) ?? 'Description will appear here...' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] text-white rounded-lg hover:bg-[#1d4e7a] font-medium text-sm transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Changes
            </button>
            <a href="{{ route('admin.programs.index') }}" class="px-4 py-2.5 text-gray-600 hover:text-gray-800 font-medium text-sm transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileName = document.getElementById('fileName');
    const descriptionInput = document.querySelector('textarea[name="description"]');
    const charCount = document.getElementById('charCount');

    // Image upload handling
    imageInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            fileName.textContent = '✓ ' + this.files[0].name;
            fileNameDisplay.classList.remove('hidden');
        }
    });

    // Drag & drop
    const dropZone = imageInput.parentElement;
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('border-[#2d6fa3]', 'bg-blue-50/50');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('border-[#2d6fa3]', 'bg-blue-50/50');
        });
    });

    dropZone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        imageInput.files = files;
        imageInput.dispatchEvent(new Event('change'));
    });

    // Character counter
    if (descriptionInput) {
        descriptionInput.addEventListener('input', function() {
            charCount.textContent = this.value.length + ' / 200';
        });
        // Initialize
        charCount.textContent = descriptionInput.value.length + ' / 200';
    }
});
</script>

@endsection
