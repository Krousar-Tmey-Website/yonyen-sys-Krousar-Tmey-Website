@extends('admin.layouts.app')

@section('title', 'Presentation')
@section('page-title', 'Presentation Management')
@section('breadcrumb', 'Manage all content for the Presentation page')

@section('content')

<div class="space-y-8" x-data="{ tab: '{{ request('tab', 'intro') }}' }">
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
    <div x-show="tab === 'impact'" class="space-y-6"
         x-data="{
             showStatsModal: false,
             editMode: false,
             lang: 'en',
             actionUrl: '{{ route('admin.impact-statistics.store') }}',
             statId: '',
             statValue: '',
             statLabel: '',
             statLabelFr: '',
             statDescription: '',
             statDescriptionFr: '',
             statSortOrder: 0,
             statIsActive: true,
             statIsFeatured: false,
             openAddModal() {
                 this.editMode = false;
                 this.lang = 'en';
                 this.actionUrl = '{{ route('admin.impact-statistics.store') }}';
                 this.statId = '';
                 this.statValue = '';
                 this.statLabel = '';
                 this.statLabelFr = '';
                 this.statDescription = '';
                 this.statDescriptionFr = '';
                 this.statSortOrder = 0;
                 this.statIsActive = true;
                 this.statIsFeatured = false;
                 this.showStatsModal = true;
             },
             openEditModal(stat) {
                 this.editMode = true;
                 this.lang = 'en';
                 this.actionUrl = `/admin/impact-statistics/${stat.id}`;
                 this.statId = stat.id;
                 this.statValue = stat.value;
                 this.statLabel = stat.label;
                 this.statLabelFr = stat.label_fr || '';
                 this.statDescription = stat.description || '';
                 this.statDescriptionFr = stat.description_fr || '';
                 this.statSortOrder = stat.sort_order;
                 this.statIsActive = !!stat.is_active;
                 this.statIsFeatured = !!stat.is_featured;
                 this.showStatsModal = true;
             }
         }">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-gray-700 text-sm">Key Figures / Impact Statistics</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Click any card to edit its content or change its sort order.</p>
                </div>
                <button @click="openAddModal()"
                        class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-[#2d6fa3] hover:bg-[#1d4e7a] px-3.5 py-2 rounded-lg transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 active:scale-95">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Statistic
                </button>
            </div>

            @php
            $accentColors = [
                ['name' => 'blue', 'bg' => '#2d6fa3', 'light' => '#e3f2fd', 'lighter' => '#bbdefb'],
                ['name' => 'green', 'bg' => '#8da83a', 'light' => '#f1f8e9', 'lighter' => '#dcedc8'],
                ['name' => 'orange', 'bg' => '#e8a020', 'light' => '#fff3e0', 'lighter' => '#ffe0b2'],
                ['name' => 'red', 'bg' => '#d32f2f', 'light' => '#ffebee', 'lighter' => '#ffcdd2'],
                ['name' => 'purple', 'bg' => '#7c4dff', 'light' => '#f3e5f5', 'lighter' => '#e1bee7'],
            ];

            $statIcons = [
                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>',
            ];
            $impactStats = \App\Models\ImpactStatistic::orderBy('sort_order')->get();
            @endphp

            @if($impactStats->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No impact statistics configured yet.</p>
                <button @click="openAddModal()" class="text-[#2d6fa3] text-sm underline hover:text-[#1d4e7a] transition-colors">Add your first statistic</button>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
                @foreach($impactStats as $index => $stat)
                @php
                    $colorScheme = $accentColors[$index % count($accentColors)];
                    $icon = $statIcons[$index % count($statIcons)];
                @endphp
                <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 cursor-pointer group flex flex-col justify-between"
                     @click="openEditModal({{ json_encode($stat) }})">
                    
                    {{-- Top colored accent border --}}
                    <div class="h-1 w-full" style="background-color: {{ $colorScheme['bg'] }}"></div>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        {{-- Action buttons --}}
                        <div class="absolute top-3 right-3 z-10 flex gap-1 items-center">
                            {{-- Edit button --}}
                            <button type="button"
                                    class="w-7 h-7 rounded-full flex items-center justify-center bg-gray-50 hover:bg-blue-50 hover:text-blue-600 text-gray-400 opacity-0 group-hover:opacity-100 transition-all duration-200"
                                    title="Edit statistic"
                                    @click.stop="openEditModal({{ json_encode($stat) }})">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>

                            {{-- Delete button --}}
                            <form action="{{ route('admin.impact-statistics.destroy', $stat) }}" method="POST"
                                  @click.stop class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-7 h-7 rounded-full flex items-center justify-center bg-gray-50 hover:bg-red-50 hover:text-red-600 text-gray-400 opacity-0 group-hover:opacity-100 transition-all duration-200"
                                        title="Delete statistic">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        {{-- Value & Icon Row --}}
                        <div class="flex items-center gap-3 mb-3.5 mt-1">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                                 style="background-color: {{ $colorScheme['light'] }}">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="{{ $colorScheme['bg'] }}" stroke-width="2" viewBox="0 0 24 24">
                                    {!! $icon !!}
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-lg font-extrabold leading-none" style="color: {{ $colorScheme['bg'] }}">{{ $stat->value }}</p>
                            </div>
                        </div>

                        {{-- Label --}}
                        <p class="text-xs font-semibold text-gray-700 leading-snug flex-1 mb-4">{{ $stat->label }}</p>

                        {{-- Card footer --}}
                        <div class="flex items-center justify-between pt-3 border-t border-gray-50 mt-auto">
                            <div class="flex gap-1">
                                @if($stat->is_featured)
                                <span class="text-[9px] font-bold text-[#e8a020] bg-orange-50 border border-orange-100 px-2 py-0.5 rounded-full uppercase tracking-wider">Featured</span>
                                @endif

                                @if(!$stat->is_active)
                                <span class="text-[9px] font-bold text-gray-400 bg-gray-50 border border-gray-100 px-2 py-0.5 rounded-full uppercase tracking-wider">Inactive</span>
                                @endif
                            </div>
                            <span class="text-[10px] font-bold text-gray-400">Order: {{ $stat->sort_order }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
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
                                <h3 class="font-bold text-gray-800 text-sm" x-text="editMode ? 'Edit Statistic' : 'Add New Statistic'">Add New Statistic</h3>
                                <p class="text-xs text-gray-400" x-text="editMode ? 'Modify an existing key figure' : 'Create a new key figure for the presentation page'">Create a new key figure</p>
                            </div>
                        </div>
                        <button @click="showStatsModal = false"
                                class="w-7 h-7 rounded-full flex items-center justify-center bg-gray-100 hover:bg-gray-200 hover:rotate-90 transition-all duration-200 group">
                            <svg class="w-3.5 h-3.5 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Modal Body: Form --}}
                    <div class="p-6">
                        <form x-bind:action="actionUrl" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">


                            {{-- Value --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                    Value <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="value" x-model="statValue" required
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow"
                                       placeholder="e.g. 3526 or 950K or < 4%">
                            </div>

                            {{-- Label --}}
                            
                <div class="flex justify-end w-full mb-3 -mt-2">
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>
<div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                    Label <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="label" x-model="statLabel" :required="lang === 'en'"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow"
                                       placeholder="e.g. Children Supported in 2025">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                    Label (French) <span class="text-gray-400 font-normal">(optional)</span>
                                </label>
                                <input type="text" name="label_fr" x-model="statLabelFr"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow"
                                       placeholder="ex. Enfants soutenus en 2025">
                            </div>

                            {{-- Description --}}
                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Description <span class="text-gray-400 font-normal">(optional)</span></label>
                                <textarea name="description" x-model="statDescription" rows="2"
                                          class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow resize-none"
                                          placeholder="Short supporting detail..."></textarea>
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Description (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                                <textarea name="description_fr" x-model="statDescriptionFr" rows="2"
                                          class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow resize-none"
                                          placeholder="Détail supplémentaire..."></textarea>
                            </div>

                            {{-- Sort order + Active --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Sort Order</label>
                                    <input type="number" name="sort_order" x-model="statSortOrder"
                                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow">
                                </div>
                                <div class="flex items-end pb-1">
                                    <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer select-none">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" x-model="statIsActive"
                                               class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20 cursor-pointer">
                                        Active
                                    </label>
                                </div>
                            </div>

                            {{-- Featured --}}
                            <div class="flex items-end">
                                <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer select-none">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox" name="is_featured" value="1" x-model="statIsFeatured"
                                           class="rounded border-gray-300 text-[#e8a020] focus:ring-[#e8a020]/20 cursor-pointer">
                                    <span>Featured <span class="text-gray-400">(Main Highlight)</span></span>
                                </label>
                            </div>

                            {{-- Submit --}}
                            <div class="flex gap-3 pt-2">
                                <button type="submit"
                                        class="flex-1 btn-primary text-sm py-2.5 inline-flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-bind:d="editMode ? 'M5 13l4 4L19 7' : 'M12 4v16m8-8H4'"/>
                                    </svg>
                                    <span x-text="editMode ? 'Save Changes' : 'Add Statistic'">Add Statistic</span>
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
