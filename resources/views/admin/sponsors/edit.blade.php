@extends('admin.layouts.app')

@section('title', 'Edit Sponsor')
@section('page-title', 'Edit Sponsor')
@section('breadcrumb', 'Update sponsor details')

@section('content')

<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Sponsor</h2>
        <p class="mt-1 text-sm text-gray-500">Update sponsor details and configuration.</p>
    </div>
    <a href="{{ route('admin.sponsors.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium rounded-md text-gray-700 shadow-sm hover:bg-gray-50 transition-colors">
        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to List
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-8">
        <form action="{{ route('admin.sponsors.update', $sponsor) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="space-y-8 tracking-tight">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-800 mb-2">Sponsor Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $sponsor->name) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1a3c6e] focus:ring-[#1a3c6e] px-4 py-2.5 transition-colors">
                    @error('name')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
                </div>

                {{-- Logo Selection --}}
                <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                    <div class="flex items-start justify-between mb-6">
                        <label class="block text-sm font-semibold text-gray-800">Sponsor Logo <span class="text-gray-400 font-normal ml-1">(Choose one method)</span></label>
                        @if($sponsor->logo)
                            <div class="text-right">
                                <p class="text-xs text-gray-500 mb-2 font-medium uppercase tracking-wide">Current Logo</p>
                                <div class="bg-white border border-gray-200 rounded-lg p-2 inline-block shadow-sm">
                                    <img src="{{ str_starts_with($sponsor->logo, 'http') ? $sponsor->logo : asset('storage/' . $sponsor->logo) }}" alt="Current Logo" class="h-14 w-auto object-contain">
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative">
                        {{-- Divider for Desktop --}}
                        <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-px bg-gray-200 transform -translate-x-1/2">
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-50 px-2 text-xs font-bold text-gray-400">OR</div>
                        </div>

                        {{-- Upload File --}}
                        <div class="flex flex-col justify-center">
                            <label for="logo_file" class="block text-sm font-medium text-gray-700 mb-2">Upload New File</label>
                            <input type="file" name="logo_file" id="logo_file" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#1a3c6e]/10 file:text-[#1a3c6e] hover:file:bg-[#1a3c6e]/20 transition-all cursor-pointer">
                            @error('logo_file')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
                        </div>

                        {{-- Divider for Mobile --}}
                        <div class="md:hidden relative flex py-2 items-center">
                            <div class="flex-grow border-t border-gray-200"></div>
                            <span class="flex-shrink-0 mx-4 text-gray-400 text-xs font-bold">OR</span>
                            <div class="flex-grow border-t border-gray-200"></div>
                        </div>

                        {{-- URL --}}
                        <div class="flex flex-col justify-center">
                            <label for="logo_url" class="block text-sm font-medium text-gray-700 mb-2">External URL</label>
                            <input type="url" name="logo_url" id="logo_url" value="{{ old('logo_url', str_starts_with($sponsor->logo ?? '', 'http') ? $sponsor->logo : '') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1a3c6e] focus:ring-[#1a3c6e] px-4 py-2.5 transition-colors" placeholder="https://example.com/logo.png">
                            @error('logo_url')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <p class="text-gray-500 text-xs mt-6 flex items-center"><svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Leave both empty to keep the current logo. Max 2MB.</p>
                </div>

                {{-- Settings Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-gray-800 mb-2">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $sponsor->sort_order) }}" class="w-full md:w-32 rounded-lg border-gray-300 shadow-sm focus:border-[#1a3c6e] focus:ring-[#1a3c6e] px-4 py-2.5 transition-colors">
                        <p class="text-gray-500 text-xs mt-2">Lower numbers appear first.</p>
                    </div>
                    
                    <div class="flex items-center pt-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $sponsor->is_active ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#1a3c6e]/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#1a3c6e]"></div>
                            <span class="ml-3 text-sm font-semibold text-gray-800">Sponsor is Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.sponsors.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">Cancel</a>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-[#1a3c6e] text-white text-sm font-medium rounded-lg shadow-sm hover:bg-[#153059] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1a3c6e]">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Update Sponsor
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
