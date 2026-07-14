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
            <button @click="tab = 'values'"
                    :class="tab === 'values' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Our Values
            </button>
            <button @click="tab = 'portfolio'"
                    :class="tab === 'portfolio' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Our Portfolio
            </button>
            <button @click="tab = 'programs'"
                    :class="tab === 'programs' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Programs
            </button>
            <button @click="tab = 'impact'"
                    :class="tab === 'impact' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Key Figures
            </button>
            <button @click="tab = 'worldwide'"
                    :class="tab === 'worldwide' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Krousar Thmey Worldwide
            </button>
            <button @click="tab = 'sharing'"
                    :class="tab === 'sharing' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Share our impact
            </button>
        </nav>
    </div>

    {{-- INTRO / MISSION / VISION SECTION --}}
    <div x-show="tab === 'intro'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-1 text-sm">Intro Heading</h3>
            <p class="text-gray-400 text-xs mb-4">The headline shown at the very top of the page.</p>
            <form action="{{ route('admin.presentation.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <textarea name="intro_heading" rows="2"
                              class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $settings['intro_heading'] ?? 'Krousar Thmey, the first Cambodian organization helping disadvantaged children, born in 1991 in the Site II refugee camp in Thailand.' }}</textarea>
                </div>
                <button type="submit" class="btn-primary text-sm py-2.5">Save Intro Heading</button>
            </form>
        </div>

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
                            <div class="flex items-center gap-2">
                                <div class="flex-1 h-px bg-gray-200"></div>
                                <span class="text-xs text-gray-400">OR</span>
                                <div class="flex-1 h-px bg-gray-200"></div>
                            </div>
                            <input type="url" name="mission_image" value="{{ $settings['mission_image'] ?? '' }}"
                                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                   placeholder="https://example.com/image.jpg">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Upload an image (max 4MB) or paste an external URL. Upload takes priority.</p>
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
                            <div class="flex items-center gap-2">
                                <div class="flex-1 h-px bg-gray-200"></div>
                                <span class="text-xs text-gray-400">OR</span>
                                <div class="flex-1 h-px bg-gray-200"></div>
                            </div>
                            <input type="url" name="vision_image" value="{{ $settings['vision_image'] ?? '' }}"
                                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                   placeholder="https://example.com/image.jpg">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Upload an image (max 4MB) or paste an external URL. Upload takes priority.</p>
                    </div>
                    <button type="submit" class="btn-primary text-sm py-2.5">Save Our Vision</button>
                </form>
            </div>
        </div>
    </div>

    {{-- OUR VALUES SECTION --}}
    <div x-show="tab === 'values'" class="space-y-6">
        <p class="text-gray-400 text-xs">These values also appear on the About page. Need to set a photo per value? Use the full <a href="{{ route('admin.core-values.index') }}" class="text-[#2d6fa3] hover:underline">Our Values</a> manager.</p>
        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Add value form --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Value</h3>
                <form action="{{ route('admin.core-values.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Title <span class="text-red-400">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="e.g. Identity">
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
                            <input type="text" name="icon" value="{{ old('icon', '⭐') }}"
                                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] text-center text-lg">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                    </div>
                    <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Value</button>
                </form>
            </div>

            {{-- Values list --}}
            <div class="lg:col-span-2">
                @if($coreValues->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
                    No values yet. Add your first one.
                </div>
                @else
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100">
                        <h4 class="font-semibold text-gray-700 text-sm">{{ $coreValues->count() }} Value(s)</h4>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @foreach($coreValues as $value)
                        <div x-data="{ editing: false }">
                            {{-- View row --}}
                            <div class="flex items-start justify-between px-5 py-4 hover:bg-gray-50/50" x-show="!editing">
                                <div class="flex items-start gap-3 min-w-0">
                                    <span class="text-2xl flex-shrink-0 mt-0.5">{{ $value->icon }}</span>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-700 text-sm">{{ $value->title }}</p>
                                        @if($value->description)
                                        <p class="text-gray-400 text-xs mt-1 line-clamp-2">{{ $value->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                                    <button @click="editing = true" class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium p-1">Edit</button>
                                    <form action="{{ route('admin.core-values.destroy', $value) }}" method="POST"
                                          onsubmit="return confirm('Remove this value?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-300 hover:text-red-500 transition-colors p-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- Edit form --}}
                            <div class="px-5 py-4 bg-gray-50 border-t border-gray-100" x-show="editing" x-cloak>
                                <form action="{{ route('admin.core-values.update', $value) }}" method="POST" class="space-y-3">
                                    @csrf @method('PUT')
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                                        <input type="text" name="title" value="{{ $value->title }}" required
                                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                                        <textarea name="description" rows="2"
                                                  class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] resize-none">{{ $value->description }}</textarea>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Icon</label>
                                            <input type="text" name="icon" value="{{ $value->icon }}"
                                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] text-center text-lg">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                                            <input type="number" name="sort_order" value="{{ $value->sort_order }}"
                                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="submit" class="btn-primary text-xs px-4 py-2">Save</button>
                                        <button type="button" @click="editing = false" class="text-gray-400 hover:text-gray-600 text-xs px-4 py-2">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
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

    {{-- PROGRAMS SECTION --}}
    <div x-show="tab === 'programs'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-4 text-sm">Manage Programs</h3>
            <p class="text-gray-500 text-xs mb-4">Programs are managed in the Programs section. <a href="{{ route('admin.programs.index') }}" class="text-[#2d6fa3] hover:underline">Go to Programs Management</a></p>

            @php
            $adminPrograms = \App\Models\Program::active()->get();
            @endphp

            @if($adminPrograms->isEmpty())
            <p class="text-gray-400 text-sm">No programs configured yet. <a href="{{ route('admin.programs.index') }}" class="text-[#2d6fa3] hover:underline">Add programs</a></p>
            @else
            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($adminPrograms as $program)
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <div class="w-12 h-12 rounded-full bg-[#2d6fa3] flex items-center justify-center mx-auto mb-2 overflow-hidden">
                        @if($program->image_url)
                        <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                        @else
                        <span class="text-xl">⭐</span>
                        @endif
                    </div>
                    <p class="text-xs font-medium text-gray-700">{{ $program->title }}</p>
                </div>
                @endforeach
            </div>
            @endif

            <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-xl text-xs text-blue-600">
                <strong>Note:</strong> The Programs strip heading also shows the number of Cambodian provinces — set that under the Key Figures tab.
            </div>
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
                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center mx-auto mb-2">
                        <img src="{{ $stat->image_url }}" alt="{{ $stat->label }}" class="w-full h-full object-cover">
                    </div>
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

    {{-- KROUSAR THMEY WORLDWIDE SECTION --}}
    <div x-show="tab === 'worldwide'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-1 text-sm">Krousar Thmey Worldwide</h3>
            <p class="text-gray-400 text-xs mb-4">Intro text shown above the country office cards.</p>
            <form action="{{ route('admin.presentation.update') }}" method="POST" class="space-y-4">
                @csrf
                <textarea name="worldwide_text" rows="3"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $settings['worldwide_text'] ?? 'Krousar Thmey benefits from the support of various entities around the world. Their fundraising and communication networks greatly contribute to the success of all programs and projects.' }}</textarea>
                <button type="submit" class="btn-primary text-sm py-2.5">Save Worldwide Text</button>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Country Offices</h3>
                <a href="{{ route('admin.offices.index') }}" class="text-xs text-[#2d6fa3] hover:underline">Manage All Offices</a>
            </div>
            <p class="text-gray-400 text-xs mb-4">The country cards (flag, address, phone, email) shown here are the same offices used on the Contact page.</p>

            @if($offices->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No international offices yet.</p>
                <a href="{{ route('admin.offices.index') }}" class="text-[#2d6fa3] text-sm underline">Add your first office</a>
            </div>
            @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($offices as $office)
                <div class="bg-gray-50 rounded-xl border border-gray-100 p-4 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xl">{{ $office->flag }}</span>
                            <h4 class="font-bold text-gray-800 text-sm truncate">{{ $office->country }}</h4>
                        </div>
                        <p class="text-gray-400 text-xs truncate">{{ $office->email }}</p>
                    </div>
                    <a href="{{ route('admin.offices.index') }}"
                       class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium p-1 flex-shrink-0">Edit</a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    {{-- SHARE OUR IMPACT SECTION --}}
    <div x-show="tab === 'sharing'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Share our impact - Social Media Links</h3>
            </div>

            <form action="{{ route('admin.presentation.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Enable Share Section</label>
                        <label class="flex items-center gap-2 text-xs text-gray-600">
                            <input type="checkbox" name="sharing_enabled" value="1" {{ (old('sharing_enabled', \App\Models\HomeSetting::getValue('sharing_enabled', '1')) == '1') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                            Show share buttons on presentation page
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Section Title</label>
                        <input type="text" name="sharing_title"
                               value="{{ old('sharing_title', \App\Models\HomeSetting::getValue('sharing_title', 'Share our impact')) }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <p class="text-xs font-medium text-gray-700 mb-3">Social Media Links & Icons</p>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-[#1877F2] flex items-center justify-center">
                                <img src="{{ asset(\App\Models\HomeSetting::getValue('sharing_facebook_icon', 'images/social/facebook.svg')) }}" alt="Facebook" class="w-6 h-6 filter brightness-0 invert">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Facebook Icon & Link</label>
                                <input type="url" name="sharing_facebook_link" value="{{ old('sharing_facebook_link', \App\Models\HomeSetting::getValue('sharing_facebook_link', '')) }}"
                                       class="w-full mb-2 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="https://facebook.com/yourpage">
                                <input type="file" name="sharing_facebook_icon" accept="image/svg+xml,image/png,image/jpeg,image/webp"
                                       class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-[#2d6fa3]">
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-[#1DA1F2] flex items-center justify-center">
                                <img src="{{ asset(\App\Models\HomeSetting::getValue('sharing_twitter_icon', 'images/social/twitter.svg')) }}" alt="Twitter" class="w-6 h-6 filter brightness-0 invert">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Twitter Icon & Link</label>
                                <input type="url" name="sharing_twitter_link" value="{{ old('sharing_twitter_link', \App\Models\HomeSetting::getValue('sharing_twitter_link', '')) }}"
                                       class="w-full mb-2 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="https://twitter.com/yourpage">
                                <input type="file" name="sharing_twitter_icon" accept="image/svg+xml,image/png,image/jpeg,image/webp"
                                       class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-[#2d6fa3]">
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-[#0A66C2] flex items-center justify-center">
                                <img src="{{ asset(\App\Models\HomeSetting::getValue('sharing_linkedin_icon', 'images/social/linkedin.svg')) }}" alt="LinkedIn" class="w-6 h-6 filter brightness-0 invert">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">LinkedIn Icon & Link</label>
                                <input type="url" name="sharing_linkedin_link" value="{{ old('sharing_linkedin_link', \App\Models\HomeSetting::getValue('sharing_linkedin_link', '')) }}"
                                       class="w-full mb-2 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="https://linkedin.com/yourpage">
                                <input type="file" name="sharing_linkedin_icon" accept="image/svg+xml,image/png,image/jpeg,image/webp"
                                       class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-[#2d6fa3]">
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gray-600 flex items-center justify-center">
                                <img src="{{ asset(\App\Models\HomeSetting::getValue('sharing_share_icon', 'images/social/share.svg')) }}" alt="Share" class="w-6 h-6 filter brightness-0 invert">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Share Icon</label>
                                <input type="file" name="sharing_share_icon" accept="image/svg+xml,image/png,image/jpeg,image/webp"
                                       class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-[#2d6fa3]">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary text-sm py-2.5">Save Sharing Settings</button>
            </form>
        </div>
    </div>

@endsection
