@extends('admin.layouts.app')

@section('title', 'Presentation')
@section('page-title', 'Presentation Management')
@section('breadcrumb', 'Manage all content for the Presentation page')

@section('content')

<div class="space-y-8" x-data="{ tab: 'intro' }">
    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200">
        <nav class="flex space-x-8 overflow-x-auto">
            <button @click="tab = 'intro'"
                    :class="tab === 'intro' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Intro / Mission / Vision
            </button>
            <button @click="tab = 'portfolio'"
                    :class="tab === 'portfolio' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Our Portfolio
            </button>
            <button @click="tab = 'impact'"
                    :class="tab === 'impact' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Key Figures
            </button>
        </nav>
    </div>

    {{-- INTRO / MISSION / VISION SECTION --}}
    <div x-show="tab === 'intro'" class="space-y-6">
        <div class="grid lg:grid-cols-2 gap-6">
            {{-- Our Mission --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-gray-700 mb-4 text-sm">Our Mission</h3>
                <form action="{{ route('admin.presentation.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                        <input type="text" name="mission_title" value="{{ $settings['mission_title'] ?? 'Our Mission' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Text (shown on hover)</label>
                        <textarea name="mission_text" rows="4"
                                  class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $settings['mission_text'] ?? 'Enable the integration of underprivileged children into Cambodian society through education and support adapted to their needs, with respect to their traditions and beliefs.' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Photo</label>
                        <div class="space-y-3">
                            @if(!empty($settings['mission_image']))
                            <div class="flex items-center gap-3">
                                <img src="{{ str_starts_with($settings['mission_image'], 'http') ? $settings['mission_image'] : asset('storage/' . $settings['mission_image']) }}"
                                     alt="Current mission image" class="w-20 h-14 object-cover rounded-lg border border-gray-200">
                                <label class="flex items-center gap-1.5 text-xs text-gray-500">
                                    <input type="checkbox" name="remove_mission_image" value="1" class="rounded border-gray-300">
                                    Remove current image
                                </label>
                            </div>
                            @endif
                            <input type="file" name="mission_image_file" accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Upload an image (max 4MB).</p>
                    </div>
                    <button type="submit" class="btn-primary text-sm py-2.5">Save Our Mission</button>
                </form>
            </div>

            {{-- Our Vision --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-gray-700 mb-4 text-sm">Our Vision</h3>
                <form action="{{ route('admin.presentation.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                        <input type="text" name="vision_title" value="{{ $settings['vision_title'] ?? 'Our Vision' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Text (shown on hover)</label>
                        <textarea name="vision_text" rows="4"
                                  class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $settings['vision_text'] ?? 'A world in which all children are empowered to grow into independent and responsible adults.' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Photo</label>
                        <div class="space-y-3">
                            @if(!empty($settings['vision_image']))
                            <div class="flex items-center gap-3">
                                <img src="{{ str_starts_with($settings['vision_image'], 'http') ? $settings['vision_image'] : asset('storage/' . $settings['vision_image']) }}"
                                     alt="Current vision image" class="w-20 h-14 object-cover rounded-lg border border-gray-200">
                                <label class="flex items-center gap-1.5 text-xs text-gray-500">
                                    <input type="checkbox" name="remove_vision_image" value="1" class="rounded border-gray-300">
                                    Remove current image
                                </label>
                            </div>
                            @endif
                            <input type="file" name="vision_image_file" accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Upload an image (max 4MB).</p>
                    </div>
                    <button type="submit" class="btn-primary text-sm py-2.5">Save Our Vision</button>
                </form>
            </div>
        </div>
    </div>

    {{-- OUR PORTFOLIO SECTION --}}
    <div x-show="tab === 'portfolio'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-1 text-sm">Our Portfolio</h3>
            <p class="text-gray-400 text-xs mb-4">The paragraph, pull-quote, and closing note shown between Our Values and the Programs strip.</p>
            <form action="{{ route('admin.presentation.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Portfolio Paragraph</label>
                    <textarea name="portfolio_text" rows="4"
                              class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $settings['portfolio_text'] ?? 'Krousar Thmey offers a portfolio of cross-cutting programs and projects supporting 4,079 children in their development: Child Welfare, special and inclusive Education for Deaf or Blind Children, Cultural and Artistic Development, Academic and Career Counseling, as well as Health and Hygiene. In the spirit of sustainable action, Krousar Thmey ensures that its support does not lead to any privilege, dependence or disparity in the community.' }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Pull-Quote</label>
                    <textarea name="principle_quote" rows="2"
                              class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $settings['principle_quote'] ?? "Krousar Thmey's main principle is the development of projects led by Cambodians for Cambodians." }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Closing Note</label>
                    <textarea name="portfolio_volunteers_text" rows="3"
                              class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $settings['portfolio_volunteers_text'] ?? 'Only two foreign volunteers provide the organization with support in communication, donor relations and project coordination. Apolitical and secular, the action of Krousar Thmey has been acknowledged internationally for its impact, capacity for innovation and sustainability.' }}</textarea>
                </div>
                <button type="submit" class="btn-primary text-sm py-2.5">Save Our Portfolio</button>
            </form>
        </div>
    </div>

    {{-- KEY FIGURES SECTION --}}
    <div x-show="tab === 'impact'" class="space-y-6" x-data="{ showStatsModal: false }">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Key Figures / Impact Statistics</h3>
                <button @click="showStatsModal = true"
                        class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-[#2d6fa3] hover:bg-[#1d4e7a] px-3 py-1.5 rounded-lg transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 active:scale-95">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Manage Key Figures
                </button>
            </div>

            @php
            $impactStats = \App\Models\ImpactStatistic::active()->orderBy('sort_order')->get();
            @endphp

            @if($impactStats->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No impact statistics configured yet.</p>
                <button @click="showStatsModal = true" class="text-[#2d6fa3] text-sm underline hover:text-[#1d4e7a] transition-colors">Add your first statistic</button>
            </div>
            @else
            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($impactStats as $stat)
                <div class="bg-gray-50 rounded-xl p-4 text-center border border-transparent hover:border-[#2d6fa3]/20 hover:bg-white hover:shadow-sm transition-all duration-200 cursor-pointer group relative"
                     @click="showStatsModal = true">
                    {{-- Delete button --}}
                    <form action="{{ route('admin.impact-statistics.destroy', $stat) }}" method="POST"
                          @click.stop>
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="absolute top-1.5 right-1.5 w-6 h-6 rounded-full flex items-center justify-center bg-white/0 hover:bg-red-50 opacity-0 group-hover:opacity-100 transition-all duration-200"
                                title="Delete statistic">
                            <svg class="w-3.5 h-3.5 text-red-400 hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                    <p class="text-xs font-bold text-gray-700 group-hover:text-[#2d6fa3] transition-colors">{{ $stat->value }}</p>
                    <p class="text-xs text-gray-500 mt-1 group-hover:text-gray-700 transition-colors">{{ $stat->label }}</p>
                    @if($stat->is_featured)
                    <span class="inline-block mt-1 text-[10px] font-semibold text-[#e8a020] uppercase tracking-wide">Featured</span>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-xl text-xs text-blue-600">
                <strong>Tip:</strong> Click "Manage Key Figures" to add, edit values, and reorder statistics.
            </div>
            @endif
        </div>

        {{-- ===== ANIMATED STATS MODAL ===== --}}
        <template x-teleport="body">
            <div x-show="showStatsModal"
                 x-cloak
                 @keydown.escape.window="showStatsModal = false"
                 class="fixed inset-0 z-[9999] flex items-start justify-center p-4 pt-10 sm:pt-16 sm:p-6 overflow-y-auto"
                 style="background: rgba(0,0,0,0.5); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);">

                {{-- Overlay click to close --}}
                <div x-show="showStatsModal"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="showStatsModal = false"
                     class="absolute inset-0 z-0"></div>

                {{-- Modal Panel --}}
                <div x-show="showStatsModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-8"
                     class="relative z-10 w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden max-h-[90vh] overflow-y-auto">

                    {{-- Top accent bar --}}
                    <div class="h-1.5 w-full bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3]"></div>

                    {{-- Modal Header --}}
                    <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm">Add New Statistic</h3>
                                <p class="text-xs text-gray-400">Create a new key figure for the presentation page</p>
                            </div>
                        </div>
                        <button @click="showStatsModal = false"
                                class="w-7 h-7 rounded-full flex items-center justify-center bg-gray-100 hover:bg-gray-200 hover:rotate-90 transition-all duration-200 group">
                            <svg class="w-3.5 h-3.5 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Modal Body: Add Statistic Form --}}
                    <div class="p-6">
                        <form action="{{ route('admin.impact-statistics.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            {{-- Value --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                    Value <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="value" value="{{ old('value') }}" required
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow"
                                       placeholder="e.g. 3526 or 950K or < 4%">
                            </div>

                            {{-- Label --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                    Label <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="label" value="{{ old('label') }}" required
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow"
                                       placeholder="e.g. Children Supported in 2025">
                            </div>

                            {{-- Sort order + Active --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow">
                                </div>
                                <div class="flex items-end pb-1">
                                    <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer select-none">
                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20 cursor-pointer">
                                        Active
                                    </label>
                                </div>
                            </div>

                            {{-- Featured --}}
                            <div class="flex items-end">
                                <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer select-none">
                                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-[#e8a020] focus:ring-[#e8a020]/20 cursor-pointer">
                                    <span>Featured <span class="text-gray-400">(Main Highlight)</span></span>
                                </label>
                            </div>

                            {{-- Submit --}}
                            <div class="flex gap-3 pt-2">
                                <button type="submit"
                                        class="flex-1 btn-primary text-sm py-2.5 inline-flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Add Statistic
                                </button>
                                <button type="button" @click="showStatsModal = false"
                                        class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl transition-all duration-200">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Bottom accent bar --}}
                    <div class="h-1 w-full bg-gradient-to-r from-[#2d6fa3] to-[#8da83a]"></div>
                </div>
            </div>
        </template>

        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-1 text-sm">Organisation-wide Figures</h3>
            <p class="text-gray-400 text-xs mb-4">Provinces, staff, budget, and administrative cost figures shown across the page.</p>
            <form action="{{ route('admin.presentation.update') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Provinces</label>
                        <input type="text" name="stat_provinces" value="{{ $settings['stat_provinces'] ?? '15' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Cambodian Staff</label>
                        <input type="text" name="stat_employees" value="{{ $settings['stat_employees'] ?? '68' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Expat Staff</label>
                        <input type="text" name="stat_expats" value="{{ $settings['stat_expats'] ?? '2' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Budget (K USD)</label>
                        <input type="text" name="stat_budget" value="{{ $settings['stat_budget'] ?? '950' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Admin Costs (%)</label>
                        <input type="text" name="stat_admin_costs" value="{{ $settings['stat_admin_costs'] ?? '4' }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
                <button type="submit" class="btn-primary text-sm py-2.5">Save Organisation Figures</button>
            </form>
        </div>
    </div>

@endsection
