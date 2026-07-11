@extends('admin.layouts.app')

@section('title', 'Add Office')
@section('page-title', 'Add Office')
@section('breadcrumb', 'Create a new office location')

@section('content')

<form action="{{ route('admin.offices.store') }}" method="POST" class="max-w-2xl mx-auto space-y-6">
    @csrf

    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <h3 class="font-bold text-gray-800 text-base mb-5 flex items-center gap-2">
            <span>🏢</span> Office Details
        </h3>

        <div class="space-y-5">
            {{-- Name & Flag --}}
            <div class="grid md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Office Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="e.g. Cambodia Office">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Flag Emoji</label>
                    <input type="text" name="flag" value="{{ old('flag') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="🇰🇭">
                    @error('flag') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Country --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Country</label>
                <input type="text" name="country" value="{{ old('country') }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="e.g. Cambodia">
                @error('country') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Address --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Address <span class="text-gray-400 font-normal">(for display)</span></label>
                <textarea name="address" rows="3"
                          class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('address') }}</textarea>
                @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Google Maps Link --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Google Maps Link
                    <span class="text-gray-400 font-normal">(website will use this to show the location)</span>
                </label>
                <input type="url" name="google_maps_link" value="{{ old('google_maps_link') }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="https://maps.google.com/?q=... or embed link">
                <p class="text-xs text-gray-400 mt-1.5">Paste a Google Maps share link or embed URL. The frontend will display a map with this location.</p>
                @error('google_maps_link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Phone & Email --}}
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="+855 (0)23 880 502">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="office@example.org">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Office Hours --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Office Hours</label>
                <textarea name="office_hours" rows="2"
                          class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Mon–Fri: 8:00 AM – 5:00 PM">{{ old('office_hours') }}</textarea>
                @error('office_hours') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Sort Order & Active --}}
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @error('sort_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                    <div class="flex items-center gap-3 h-[42px]">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked
                                   class="rounded accent-[#2d6fa3] w-4 h-4">
                            <span class="text-sm text-gray-600">Active</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary">Create Office</button>
        <a href="{{ route('admin.offices.index') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
    </div>
</form>

@endsection
