<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Krousar Thmey</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/htmx.org@1.9.11"></script>
    <style>
        [x-cloak] { display: none !important; }
        .htmx-indicator { opacity: 0; transition: opacity 200ms ease-in;}
        .htmx-request .htmx-indicator { opacity: 1; }
        .htmx-request.htmx-indicator { opacity: 1; }
        /* Smooth fade between pages */
        body { transition: opacity 150ms ease-out; }
        body.htmx-request { opacity: 0.6; }
    </style>
</head>
<body class="h-full" x-data="{ sidebarOpen: false }" hx-boost="true">

<div class="flex h-full">

    {{-- ── Sidebar ──────────────────────────────── --}}
    <aside class="hidden lg:flex lg:flex-col w-64 bg-[#1d4e7a] flex-shrink-0">
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10">
            <div class="bg-white rounded-xl px-3 py-1.5 flex-shrink-0">
                @php $adminLogoPath = data_get($settings ?? [], 'site_logo', 'images/logo.png'); @endphp
                <img src="{{ $adminLogoPath ? (str_starts_with($adminLogoPath, 'http') ? $adminLogoPath : (str_starts_with($adminLogoPath, 'logos/') ? asset('storage/' . $adminLogoPath) : asset($adminLogoPath))) : asset('images/logo.png') }}" alt="KT" class="h-8 w-auto"
                     onerror="this.parentElement.innerHTML='<span class=\'text-[#2d6fa3] font-black text-sm\'>KT</span>'">
            </div>
            <div>
                <p class="text-white font-bold text-sm leading-tight">{{ data_get($settings ?? [], 'site_name', 'Krousar Thmey') }}</p>
                <p class="text-white text-xs">Admin Panel</p>
            </div>
        </div>

        {{-- Nav with accordion groups --}}
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
            @php
                $currentRoute = request()->route()?->getName() ?? '';
                $routeExists = fn($r) => $r && Route::has($r);

                $groupActive = function($children) use ($currentRoute) {
                    foreach ($children as $child) {
                        if (isset($child['is_active']) && $child['is_active']) return true;
                        $r = $child['route'] ?? '';
                        if (!$r) continue;
                        $baseRoute = str_ends_with($r, '.index') ? substr($r, 0, -6) : $r;
                        if ($currentRoute && ($currentRoute === $r || str_starts_with($currentRoute, $baseRoute . '.'))) return true;
                    }
                    return false;
                };

                $childActive = function($route) use ($currentRoute) {
                    if (!$route) return false;
                    $baseRoute = str_ends_with($route, '.index') ? substr($route, 0, -6) : $route;
                    return $currentRoute && ($currentRoute === $route || str_starts_with($currentRoute, $baseRoute . '.'));
                };

                $navGroups = [
                    'dashboard' => [
                        'label' => 'Dashboard',
                        'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                        'single' => true,
                        'route' => 'admin.dashboard',
                    ],
                    'homepage' => [
                        'label' => 'Homepage',
                        'icon' => 'M10.707 2.293a1 1 0 00-1.414 0l-7 7A1 1 0 002 10h.5v8a2 2 0 002 2h15a2 2 0 002-2v-8h.5a1 1 0 00.707-1.707l-7-7z',
                        'children' => [
                            ['route' => 'admin.slides.index',       'label' => 'Slideshow'],
                            ['route' => 'admin.home.index',         'label' => 'Home Settings'],
                            ['route' => 'admin.gallery.index',      'label' => 'Gallery'],
                            ['route' => 'admin.testimonials.index', 'label' => 'Testimonials'],
                        ],
                    ],
                    'about' => [
                        'label' => 'Who We Are',
                        'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                        'children' => [
                            ['route' => 'admin.awards.index',          'label' => 'Awards'],
                            ['route' => 'admin.partners.index',        'label' => 'Partners'],
                            ['route' => 'admin.history-events.index',  'label' => 'History Timeline'],
                        ],
                    ],
                    'programs' => [
                        'label' => 'Our Programs',
                        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                        'children' => array_merge(
                            [
                                ['route' => 'admin.programs.index',  'label' => 'All Programs'],
                                ['route' => 'admin.programs-banner.index', 'label' => 'Page Banner'],
                            ],
                            \App\Models\Program::orderBy('id')->take(3)->get()->map(function($p) {
                                return [
                                    'url' => route('admin.programs.edit', $p),
                                    'label' => $p->title,
                                    'is_active' => request()->is('admin/programs/'.$p->id.'/edit')
                                ];
                            })->toArray(),
                            [
                                ['route' => 'admin.projects.index', 'label' => 'All Projects'],
                                ['route' => 'admin.program-pages.index', 'label' => 'Additional Pages'],
                            ]
                        ),
                    ],

                    'news' => [
                        'label' => 'News',
                        'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
                        'children' => [
                            ['route' => 'admin.news.index',           'label' => 'News Articles'],
                            ['route' => 'admin.annual-reports.index', 'label' => 'Annual Reports'],
                        ],
                    ],
                    'contact' => [
                        'label' => 'Contact',
                        'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                        'children' => [
                            ['route' => 'admin.offices.index', 'label' => 'Office Locations'],
                        ],
                    ],
                    'involved' => [
                        'label' => 'Get Involved',
                        'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                        'children' => [
                            ['route' => 'admin.home.index', 'label' => 'Donation Tiers (Home Settings)'],
                        ],
                    ],
                    'settings' => [
                        'label' => 'Website Management',
                        'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                        'children' => [
                            ['route' => 'admin.home.index', 'label' => 'Home Settings'],
                            ['route' => 'admin.programs-banner.index', 'label' => 'Programs Banner'],
                        ],
                    ],
                ];
            @endphp

            @foreach($navGroups as $key => $group)
                @if(isset($group['single']))
                    {{-- Single link (Dashboard) --}}
                    @php $exists = $routeExists($group['route']); @endphp
                    <a href="{{ $exists ? route($group['route']) : '#' }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                              {{ $childActive($group['route']) ? 'bg-white/15 text-white' : 'text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $group['icon'] }}"/>
                        </svg>
                        {{ $group['label'] }}
                    </a>
                @else
                    {{-- Accordion group --}}
                    @php $isGroupActive = $groupActive($group['children']); @endphp
                    <div x-data="{ open: {{ $isGroupActive ? 'true' : 'false' }} }" class="space-y-0.5">
                        <button @click="open = !open"
                                class="flex items-center justify-between w-full px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                                       {{ $isGroupActive ? 'bg-white/15 text-white' : 'text-white hover:bg-white/10' }}">
                            <span class="flex items-center gap-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $group['icon'] }}"/>
                                </svg>
                                {{ $group['label'] }}
                            </span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-1"
                             class="space-y-0.5 mt-0.5 pl-2"
                             x-cloak>
                            @foreach($group['children'] as $child)
                                @php 
                                    $linkUrl = '#';
                                    $isActive = false;
                                    $exists = true;

                                    if(isset($child['url'])) {
                                        $linkUrl = $child['url'];
                                        $isActive = $child['is_active'] ?? false;
                                    } elseif(isset($child['route'])) {
                                        $exists = $routeExists($child['route']);
                                        $linkUrl = $exists ? route($child['route']) : '#';
                                        $isActive = $childActive($child['route']);
                                    }
                                @endphp
                                <a href="{{ $linkUrl }}"
                                   {{ !$exists ? 'onclick="return false;"' : '' }}
                                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-all
                                          {{ $isActive ? 'bg-white/10 text-white font-medium' : 'text-white hover:bg-white/10' }}
                                          {{ !$exists ? 'opacity-40 cursor-default' : '' }}">
                                    <span class="w-1 h-1 rounded-full flex-shrink-0 {{ $isActive ? 'bg-white' : 'bg-white/50' }}"></span>
                                    <span>{{ $child['label'] }}</span>
                                    @if(!$exists)
                                        <span class="ml-auto text-[10px] text-white/60">soon</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>

        {{-- User + Logout Modal --}}
        <div class="px-4 py-4 border-t border-white/10"
             x-data="{ logoutModal: false, logoutForm: null }"
             @keydown.window.escape="logoutModal = false">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white text-xs font-medium truncate max-w-[120px]">{{ auth()->user()->name }}</p>
                    <p class="text-white text-xs truncate max-w-[120px]">{{ auth()->user()->email }}</p>
                </div>

                {{-- Logout trigger button --}}
                <form action="{{ route('admin.logout') }}" method="POST" x-ref="logoutForm">
                    @csrf
                    <button type="button" title="Sign Out"
                            @click="logoutForm = $refs.logoutForm; logoutModal = true"
                            class="text-white hover:text-white transition-colors p-1.5 rounded-lg hover:bg-white/10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>

            {{-- Logout Confirmation Modal --}}
            <div x-show="logoutModal"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
                 @click.self="logoutModal = false">

                <div x-show="logoutModal"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                     @click.away="logoutModal = false"
                     class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 p-6 w-full max-w-sm text-center">

                    {{-- Close button --}}
                    <button type="button" @click="logoutModal = false"
                        class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-400 hover:text-gray-600 flex items-center justify-center transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    {{-- Icon --}}
                    <div class="mx-auto w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Sign Out</h3>

                    {{-- Message --}}
                    <p class="text-sm text-gray-500 mb-6">
                        Are you sure you want to sign out?
                    </p>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3">
                        <button type="button" @click="logoutModal = false"
                            class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                            Cancel
                        </button>
                        <button type="button" @click="logoutForm.submit()"
                            class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl transition shadow-sm">
                            Sign Out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    {{-- ── Main area ────────────────────────────── --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Top bar --}}
        <header class="bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between flex-shrink-0">
            <div>
                <h1 class="text-lg font-bold text-gray-800">@yield('page-title', 'Admin Panel')</h1>
                @hasSection('breadcrumb')
                <p class="text-xs text-gray-400 mt-0.5">@yield('breadcrumb')</p>
                @endif
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-2 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors px-3 py-1.5 rounded-lg hover:bg-gray-50 border border-gray-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View Site
                </a>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2"
             x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 5000)"
             x-show="show"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span class="flex-1">{{ session('success') }}</span>
            <button @click="show = false" class="text-green-500 hover:text-green-700 transition-colors flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        @endif
        @if(session('error'))
        <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2"
             x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 5000)"
             x-show="show"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="flex-1">{{ session('error') }}</span>
            <button @click="show = false" class="text-red-500 hover:text-red-700 transition-colors flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        @endif

        {{-- Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>

</div>

</body>
</html>
