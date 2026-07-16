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
    <div x-show="tab === 'impact'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Key Figures / Impact Statistics</h3>
                <a href="{{ route('admin.impact-statistics.index') }}" class="text-xs text-[#2d6fa3] hover:underline">Manage All Statistics</a>
            </div>

            @php
            $impactStats = \App\Models\ImpactStatistic::active()->orderBy('sort_order')->get();
            @endphp

            @if($impactStats->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No impact statistics configured yet.</p>
                <a href="{{ route('admin.impact-statistics.index') }}" class="text-[#2d6fa3] text-sm underline">Add your first statistic</a>
            </div>
            @else
            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($impactStats as $stat)
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <p class="text-xs font-bold text-gray-700">{{ $stat->value }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $stat->label }}</p>
                    @if($stat->is_featured)
                    <span class="inline-block mt-1 text-[10px] font-semibold text-[#e8a020] uppercase tracking-wide">Featured</span>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-xl text-xs text-blue-600">
                <strong>Tip:</strong> Click "Manage All Statistics" to edit values, images, and reorder statistics.
            </div>
            @endif
        </div>

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
