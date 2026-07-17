<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Krousar Thmey</title>
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
    @stack('styles')
    <link rel="icon" type="image/png" href="{{ asset('images/logo.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full" x-data="{ sidebarOpen: false }">

    <script>
        function openEmail(email) {
            if (email.toLowerCase().endsWith('@gmail.com')) {
                window.open('https://mail.google.com/mail/?view=cm&fs=1&to=' + encodeURIComponent(email), '_blank', 'noopener');
            } else {
                window.location.href = 'mailto:' + email;
            }
        }
    </script>

    <div class="flex h-full">

        {{-- ── Sidebar ──────────────────────────────── --}}
        <aside class="hidden lg:flex lg:flex-col w-64 bg-[#1d4e7a] flex-shrink-0">
            {{-- Logo --}}
            <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10">
                <div class="bg-white rounded-xl px-3 py-1.5 flex-shrink-0">
                    @php
                    $logoPath = $settings['site_logo'] ?? 'images/logo.svg';
                    $logoUrl = str_starts_with($logoPath, 'http') ? $logoPath : (str_starts_with($logoPath, 'logos/') ? asset('storage/' . $logoPath) : asset($logoPath));
                    $siteName = $settings['site_name'] ?? 'Krousar Thmey';
                    @endphp
                    <img src="{{ $logoUrl }}"
                        alt="{{ $siteName }}"
                        class="h-8 lg:h-10 w-auto object-contain"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    {{-- Fallback if image not yet placed --}}
                    <div class="hidden items-center gap-3">
                        <div class="w-4 h-4 lg:w-12 lg:h-12 rounded-xl bg-[#ffffff] flex items-center justify-center">
                            <img src="{{ asset('images/logo.svg') }}" alt="">
                        </div>
                        <!-- <div>
                            {{-- <div class="text-[#2d6fa3] font-bold text-lg leading-tight">{{ $siteName }}</div> --}}
                            {{-- <div class="text-[#8da83a] text-xs font-medium">{{ $siteTagline }}</div> --}}
                        </div> -->
                    </div>
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">Krousar Thmey</p>
                    <p class="text-white text-xs">Admin Panel</p>
                </div>
            </div>

            {{-- Nav with accordion groups --}}
            <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
                @php
                $currentRoute = request()->route()?->getName() ?? '';
                $routeExists = fn($r) => $r && Route::has($r);

                $groupActive = function ($children) use ($currentRoute) {
                foreach ($children as $child) {
                $r = $child['route'] ?? '';
                if ($currentRoute && ($currentRoute === $r || str_starts_with($currentRoute, $r . '.'))) {
                return true;
                }
                }
                return false;
                };

                $childActive = function ($route) use ($currentRoute) {
                return $currentRoute &&
                ($currentRoute === $route || str_starts_with($currentRoute, $route . '.'));
                };

                $navGroups = [
                'dashboard' => [
                'label' => 'Dashboard',
                'icon' =>
                'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                'single' => true,
                'route' => 'admin.dashboard',
                ],
                'homepage' => [
                'label' => 'Homepage',
                'icon' =>
                'M10.707 2.293a1 1 0 00-1.414 0l-7 7A1 1 0 002 10h.5v8a2 2 0 002 2h15a2 2 0 002-2v-8h.5a1 1 0 00.707-1.707l-7-7z',
                'children' => [
                ['route' => 'admin.slides.index', 'label' => 'Slideshow'],
                ['route' => 'admin.home.index', 'label' => 'Key Statistics'],
                ['route' => 'admin.page-sections.index', 'label' => 'Page Sections'],
                ['route' => 'admin.impact-statistics.index', 'label' => 'Impact Statistics'],
                ['route' => 'admin.sponsors.index', 'label' => 'Sponsors'],
                ['route' => 'admin.stories.index', 'label' => 'Success Stories'],
                ],
                ],
                'about' => [
                'label' => 'Who We Are',
                'icon' =>
                'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                'children' => [
                ['route' => 'admin.presentation.index', 'label' => 'Presentation'],
                ['route' => 'admin.core-values.index', 'label' => 'Our Values'],
                ['route' => 'admin.history-events.index', 'label' => 'Our History'],
                ['route' => 'admin.awards.index', 'label' => 'Awards'],
                ['route' => 'admin.partners.index', 'label' => 'Partners'],
                ['route' => 'admin.transparency.index', 'label' => 'Transparency'],
                ],
                ],
                'programs' => [
                'label' => 'Our Programs',
                'icon' =>
                'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                'children' => [
                ['route' => 'admin.programs-banner.index', 'label' => 'Page Banner'],
                ['route' => 'admin.project-defaults.index', 'label' => 'Project Defaults'],
                ['route' => 'admin.programs.index', 'label' => 'Programs'],
                ['route' => 'admin.projects.index', 'label' => 'Projects'],
                ['route' => 'admin.program-pages.index', 'label' => 'Additional Info'],
                ],
                ],
                'news' => [
                'label' => 'News & Resources',
                'icon' =>
                'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
                'children' => [
                ['route' => 'admin.news.index', 'label' => 'News Articles'],
                ['route' => 'admin.categories.index', 'label' => 'Categories'],
                ['route' => 'admin.reports.index', 'label' => 'Annual Reports'],
                ['route' => 'admin.media.index', 'label' => 'Media Gallery'],
                ['route' => 'admin.downloads.index', 'label' => 'Downloads'],
                ],
                ],
                'involved' => [
                'label' => 'Get Involved',
                'icon' =>
                'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                'children' => [
                ['route' => 'admin.volunteers.index', 'label' => 'Volunteer Applications'],
                ['route' => 'admin.jobs.index', 'label' => 'Job Opportunities'],
                ['route' => 'admin.books.index', 'label' => 'Book for Sales'],
                ],
                ],
                'donations' => [
                'label' => 'Donations',
                'icon' =>
                'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'children' => [
                ['route' => 'admin.donations.dashboard', 'label' => 'Dashboard'],
                ['route' => 'admin.donations.index', 'label' => 'Donations'],
                ['route' => 'admin.campaigns.index', 'label' => 'Donation Campaigns'],
                ['route' => 'admin.payments.index', 'label' => 'Payment Methods'],
                ['route' => 'admin.donations.reports', 'label' => 'Donation Reports'],
                ],
                ],
                'communication' => [
                'label' => 'Communication',
                'icon' =>
                'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.57...',
                'children' => [
                ['route' => 'admin.contacts.index', 'label' => 'Contact Messages'],
                ['route' => 'admin.newsletter.index', 'label' => 'Subscribers'],
                ],
                ],
                'settings' => [
                'label' => 'Website Management',
                'icon' =>
                'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                'children' => [
                ['route' => 'admin.website.index', 'label' => 'Website Settings'],
                ['route' => 'admin.seo.index', 'label' => 'SEO Settings'],
                ['route' => 'admin.media.library', 'label' => 'Media Library'],
                ],
                ],
                'reports' => [
                'label' => 'Reports',
                'icon' =>
                'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                'children' => [
                ['route' => 'admin.analytics.index', 'label' => 'Analytics'],
                ['route' => 'admin.reports.activity-logs.index', 'label' => 'Activity Logs'],
                ],
                ],
                ];
                @endphp

                @foreach ($navGroups as $key => $group)
                @if (isset($group['single']))
                {{-- Single link (Dashboard) --}}
                @php $exists = $routeExists($group['route']); @endphp
                <a href="{{ $exists ? route($group['route']) : '#' }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                              {{ $childActive($group['route']) ? 'bg-white/15 text-white' : 'text-white hover:bg-white/10' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="{{ $group['icon'] }}" />
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
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="{{ $group['icon'] }}" />
                            </svg>
                            {{ $group['label'] }}
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1" class="space-y-0.5 mt-0.5 pl-2"
                        x-cloak>
                        @foreach ($group['children'] as $child)
                        @php $exists = $routeExists($child['route']); @endphp
                        <a href="{{ $exists ? route($child['route']) : '#' }}"
                            {{ !$exists ? 'onclick="return false;"' : '' }}
                            class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-all
                                          {{ $childActive($child['route']) ? 'bg-white/10 text-white font-medium' : 'text-white hover:bg-white/10' }}
                                          {{ !$exists ? 'opacity-40 cursor-default' : '' }}">
                            <span
                                class="w-1 h-1 rounded-full flex-shrink-0 {{ $childActive($child['route']) ? 'bg-white' : 'bg-white/50' }}"></span>
                            <span>{{ $child['label'] }}</span>
                            @if (!$exists)
                            <span class="ml-auto text-[10px] text-white/60">soon</span>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach
            </nav>

            {{-- User --}}
            <div class="px-4 py-4 border-t border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-xs font-medium truncate max-w-[120px]">{{ auth()->user()->name }}</p>
                        <p class="text-white text-xs truncate max-w-[120px]">{{ auth()->user()->email }}</p>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Logout"
                            class="text-white hover:text-white/80 transition-colors p-1.5 rounded-lg hover:bg-white/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
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
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        View Site
                    </a>
                </div>
            </header>

            {{-- Flash messages --}}
            @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="flex-1">{{ session('success') }}</span>
                <button @click="show = false" type="button"
                    class="flex-shrink-0 p-0.5 rounded-md hover:bg-green-200/50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @endif
            @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="flex-1">{{ session('error') }}</span>
                <button @click="show = false" type="button"
                    class="flex-shrink-0 p-0.5 rounded-md hover:bg-red-200/50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
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