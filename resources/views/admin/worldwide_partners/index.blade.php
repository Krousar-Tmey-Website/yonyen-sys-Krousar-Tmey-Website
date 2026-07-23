@extends('admin.layouts.app')

@section('title', 'Worldwide Partners')
@section('page-title', 'Krousar Thmey Worldwide')
@section('breadcrumb', 'Manage international partner organizations')

@section('content')

<div class="space-y-8" x-data="worldwidePartners()">
    {{-- Page Header --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">🌍 Krousar Thmey Worldwide</h1>
                <p class="text-gray-500 text-sm mt-1">Manage international partner organizations displayed on the website.</p>
            </div>
            <a href="{{ route('admin.worldwide-partners.create') }}" class="btn-primary">
                + Add New Country
            </a>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-blue-50 rounded-xl p-4 text-center">
                <p class="text-2xl font-bold text-[#2d6fa3]">{{ $partners->count() }}</p>
                <p class="text-xs text-gray-500">Total Countries</p>
            </div>
            <div class="bg-green-50 rounded-xl p-4 text-center">
                <p class="text-2xl font-bold text-green-600">{{ $partners->where('is_active', true)->count() }}</p>
                <p class="text-xs text-gray-500">Active Countries</p>
            </div>did
            <div class="bg-gray-50 rounded-xl p-4 text-center">
                <p class="text-2xl font-bold text-gray-400">{{ $partners->where('is_active', false)->count() }}</p>
                <p class="text-xs text-gray-500">Inactive Countries</p>
            </div>
            <div class="bg-purple-50 rounded-xl p-4 text-center">
                <p class="text-2xl font-bold text-purple-600">{{ $partners->max('updated_at')?->format('M d') ?? '—' }}</p>
                <p class="text-xs text-gray-500">Last Updated</p>
            </div>
        </div>
    </div>

    {{-- Worldwide Content Settings --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Worldwide Content Settings</h3>
        <form action="{{ route('admin.website.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="section" value="worldwide">
            
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Small Label</label>
                <input type="text" name="settings[worldwide_label]" value="{{ old('settings.worldwide_label', \App\Models\HomeSetting::getValue('worldwide_label', 'GLOBAL NETWORK')) }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Main Title</label>
                <input type="text" name="settings[worldwide_title]" value="{{ old('settings.worldwide_title', \App\Models\HomeSetting::getValue('worldwide_title', 'Krousar Thmey Worldwide')) }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                <textarea name="settings[worldwide_description]" data-ckeditor rows="3"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('settings.worldwide_description', \App\Models\HomeSetting::getValue('worldwide_description', 'Krousar Thmey benefits from the support of partner organizations around the world. Their fundraising, advocacy, communication, and volunteer networks greatly contribute to the success of our education, child protection, and disability inclusion programs.')) }}</textarea>
            </div>
            
            <button type="submit" class="btn-primary text-sm py-2.5">Save Changes</button>
        </form>
    </div>

    {{-- Social Sharing Settings --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Social Sharing Settings</h3>
        <form action="{{ route('admin.website.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="section" value="social">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                    <input type="checkbox" name="settings[sharing_facebook_enabled]" value="1" {{ \App\Models\HomeSetting::getValue('sharing_facebook_enabled', '1') == '1' ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                    <span class="text-sm font-medium text-gray-700">Facebook</span>
                </label>
                
                <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                    <input type="checkbox" name="settings[sharing_twitter_enabled]" value="1" {{ \App\Models\HomeSetting::getValue('sharing_twitter_enabled', '1') == '1' ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                    <span class="text-sm font-medium text-gray-700">Twitter (X)</span>
                </label>
                
                <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                    <input type="checkbox" name="settings[sharing_linkedin_enabled]" value="1" {{ \App\Models\HomeSetting::getValue('sharing_linkedin_enabled', '1') == '1' ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                    <span class="text-sm font-medium text-gray-700">LinkedIn</span>
                </label>
                
                <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                    <input type="checkbox" name="settings[sharing_share_enabled]" value="1" {{ \App\Models\HomeSetting::getValue('sharing_share_enabled', '1') == '1' ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                    <span class="text-sm font-medium text-gray-700">Share Button</span>
                </label>
            </div>
            
            <button type="submit" class="btn-primary text-sm py-2.5">Save Settings</button>
        </form>
    </div>

    {{-- Country Management --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-700 text-sm">Country Management</h3>
            <div class="flex items-center gap-2">
                <input type="text" placeholder="Search countries..." 
                       class="px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20"
                       x-model="search" @input="filterCountries()">
            </div>
        </div>

        @if($partners->isEmpty())
        <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
            <p class="text-sm font-medium mb-2">No country partners yet.</p>
            <a href="{{ route('admin.worldwide-partners.create') }}" class="text-[#2d6fa3] text-sm underline">Add your first country</a>
        </div>
        @else
        <div class="space-y-3">
            @foreach($partners as $partner)
            <div class="bg-gray-50 rounded-xl border border-gray-100 overflow-hidden flex">
                {{-- Image --}}
                <div class="relative w-32 flex-shrink-0 hidden sm:block">
                    <div class="aspect-video rounded-l-xl overflow-hidden">
                        <img src="{{ $partner->image_url }}" alt="{{ $partner->country_name }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>
                </div>

                {{-- Info --}}
                <div class="flex-1 p-4 flex items-center justify-between gap-3">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full
                                  {{ $partner->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $partner->is_active ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                                {{ $partner->is_active ? 'Active' : 'Hidden' }}
                            </span>
                            @if($partner->is_featured)
                            <span class="text-xs bg-[#e8a020]/10 text-[#e8a020] px-2 py-0.5 rounded-full">Featured</span>
                            @endif
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm mb-1 truncate max-w-sm">{{ $partner->country_name }}</h4>
                        @if($partner->description)
                        <p class="text-gray-400 text-xs line-clamp-2 max-w-sm">{{ Str::limit($partner->description, 80) }}</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('admin.worldwide-partners.edit', $partner) }}"
                           class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium px-3 py-1.5 border border-[#2d6fa3]/30 rounded-lg hover:bg-[#2d6fa3]/5 transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('admin.worldwide-partners.destroy', $partner) }}" method="POST"
                              onsubmit="return confirm('Delete this country partner?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-300 hover:text-red-500 text-xs font-medium px-3 py-1.5 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
function worldwidePartners() {
    return {
        search: '',
        filterCountries() {
            // Search functionality
        }
    }
}
</script>
@endpush