<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Krousar Thmey — Helping Children in Cambodia')</title>
    <meta name="description" content="@yield('description', 'Krousar Thmey is Cambodia\'s first organization dedicated to helping disadvantaged children — through child welfare, special education, and cultural development.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800" x-data>

    {{-- Top bar --}}
    <div class="hidden lg:block bg-[#1d4e7a] text-white text-sm">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-9">
            <span class="text-white/60 text-xs">Cambodia's first organization helping disadvantaged children since 1991</span>
            <div class="flex items-center gap-5">
                <a href="{{ route('contact') }}" class="text-white/60 hover:text-white transition-colors text-xs">Contact</a>
                <span class="text-white/20">|</span>
                <div class="flex items-center gap-3">
                    <a href="https://www.facebook.com/KrousarThmey" target="_blank" rel="noopener" aria-label="Facebook"
                       class="text-white/50 hover:text-[#8da83a] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/krousarthmey/" target="_blank" rel="noopener" aria-label="Instagram"
                       class="text-white/50 hover:text-[#8da83a] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/company/krousar-thmey/" target="_blank" rel="noopener" aria-label="LinkedIn"
                       class="text-white/50 hover:text-[#8da83a] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/@KrousarThmey" target="_blank" rel="noopener" aria-label="YouTube"
                       class="text-white/50 hover:text-[#8da83a] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
                <a href="{{ route('donate') }}"
                   class="bg-[#8da83a] text-white px-4 py-1 rounded-full font-semibold hover:bg-[#a3c04a] transition-colors text-xs">
                    Donate
                </a>
            </div>
        </div>
    </div>

    {{-- Main Navbar --}}
    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100"
         x-data="{ open: false }">

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16 lg:h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}"
                         alt="Krousar Thmey"
                         class="h-12 lg:h-14 w-auto object-contain"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    {{-- Fallback if image not yet placed --}}
                    <div class="hidden items-center gap-3">
                        <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white font-bold text-lg">KT</span>
                        </div>
                        <div>
                            <div class="text-[#2d6fa3] font-bold text-lg leading-tight">Krousar Thmey</div>
                            <div class="text-[#8da83a] text-xs font-medium">គ្រួសារថ្មី · New Family</div>
                        </div>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden lg:flex items-center gap-1">

                    {{-- Who We Are --}}
                    <div class="relative" x-data="{ open: false }"
                         @mouseenter="open = true" @mouseleave="open = false">
                        <button class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg hover:bg-gray-50">
                            Who We Are
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute top-full left-0 mt-1 w-52 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                            <a href="{{ route('about') }}"            class="dropdown-item rounded-t-xl">Presentation</a>
                            <a href="{{ route('about') }}#history"    class="dropdown-item">History</a>
                            <a href="{{ route('about') }}#values"     class="dropdown-item">Our Values</a>
                            <a href="{{ route('about') }}#partners"   class="dropdown-item">Partners</a>
                            <a href="{{ route('about') }}#transparency" class="dropdown-item rounded-b-xl">Transparency</a>
                        </div>
                    </div>

                    {{-- Our Programs --}}
                    <div class="relative" x-data="{ open: false }"
                         @mouseenter="open = true" @mouseleave="open = false">
                        <button class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg hover:bg-gray-50">
                            Our Programs
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute top-full left-0 mt-1 w-64 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                            <a href="{{ route('programs') }}#welfare"   class="dropdown-item rounded-t-xl">Child Welfare</a>
                            <a href="{{ route('programs') }}#education" class="dropdown-item">Education for Deaf &amp; Blind</a>
                            <a href="{{ route('programs') }}#culture"   class="dropdown-item rounded-b-xl">Cultural Development</a>
                        </div>
                    </div>

                    {{-- Get Involved --}}
                    <div class="relative" x-data="{ open: false }"
                         @mouseenter="open = true" @mouseleave="open = false">
                        <button class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg hover:bg-gray-50">
                            Get Involved
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute top-full left-0 mt-1 w-52 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                            <a href="{{ route('involved') }}#partner"  class="dropdown-item rounded-t-xl">Partnerships</a>
                            <a href="{{ route('involved') }}#volunteer" class="dropdown-item">Volunteering</a>
                            <a href="{{ route('involved') }}#jobs"     class="dropdown-item">Job Opportunities</a>
                            <a href="{{ route('involved') }}#donate"   class="dropdown-item rounded-b-xl">Donate</a>
                        </div>
                    </div>

                    <a href="{{ route('news') }}"      class="nav-link px-3 py-2 rounded-lg hover:bg-gray-50">News</a>
                    <a href="{{ route('resources') }}" class="nav-link px-3 py-2 rounded-lg hover:bg-gray-50">Resources</a>
                    <a href="{{ route('contact') }}"   class="nav-link px-3 py-2 rounded-lg hover:bg-gray-50">Contact</a>
                </div>

                {{-- CTA + Mobile toggle --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('donate') }}" class="btn-primary text-sm hidden sm:inline-flex">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Donate
                    </a>
                    <button @click="open = !open"
                            class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors"
                            aria-label="Toggle menu">
                        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="open"  class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden border-t border-gray-100 bg-white">
            <div class="max-w-7xl mx-auto px-6 py-4 space-y-1">
                <a href="{{ route('about') }}"    class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">Who We Are</a>
                <a href="{{ route('programs') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">Our Programs</a>
                <a href="{{ route('involved') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">Get Involved</a>
                <a href="{{ route('news') }}"     class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">News</a>
                <a href="{{ route('resources') }}"class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">Resources</a>
                <a href="{{ route('contact') }}"  class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">Contact</a>
                <div class="pt-3 pb-1">
                    <a href="{{ route('donate') }}" class="btn-primary w-full justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Donate Now
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main>@yield('content')</main>

    {{-- Footer --}}
    <footer class="bg-[#1d4e7a] text-white">

        {{-- Donation Banner --}}
        <div class="bg-[#8da83a]">
            <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-white font-bold text-xl">Make a Difference Today</h3>
                    <p class="text-white/80 mt-1 text-sm">100% of your donation directly supports children in Cambodia.</p>
                </div>
                <a href="{{ route('donate') }}" class="btn-outline flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Donate Now
                </a>
            </div>
        </div>

        {{-- Main Footer --}}
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="inline-block mb-5">
                        <div class="bg-white rounded-xl px-4 py-2">
                            <img src="{{ asset('images/logo.png') }}"
                                 alt="Krousar Thmey"
                                 class="h-10 w-auto">
                        </div>
                    </a>
                    <p class="text-white/50 text-sm leading-relaxed">
                        Cambodia's first organization helping disadvantaged children — building a world where every child grows into an independent, responsible adult.
                    </p>
                    <div class="flex items-center gap-3 mt-6">
                        @foreach([
                            ['href' => 'https://www.facebook.com/KrousarThmey', 'label' => 'Facebook',  'svg' => '<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>'],
                            ['href' => 'https://www.instagram.com/krousarthmey/', 'label' => 'Instagram', 'svg' => '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>'],
                            ['href' => 'https://www.linkedin.com/company/krousar-thmey/', 'label' => 'LinkedIn', 'svg' => '<path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>'],
                            ['href' => 'https://www.youtube.com/@KrousarThmey', 'label' => 'YouTube',  'svg' => '<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>'],
                        ] as $social)
                        <a href="{{ $social['href'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }}"
                           class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center hover:bg-[#8da83a] transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">{!! $social['svg'] !!}</svg>
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Organization --}}
                <div>
                    <h4 class="font-semibold text-white mb-5 text-xs uppercase tracking-wider">Organization</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('about') }}"    class="text-white/50 hover:text-white text-sm transition-colors">Who We Are</a></li>
                        <li><a href="{{ route('programs') }}" class="text-white/50 hover:text-white text-sm transition-colors">Our Programs</a></li>
                        <li><a href="{{ route('news') }}"     class="text-white/50 hover:text-white text-sm transition-colors">News</a></li>
                        <li><a href="{{ route('resources') }}"class="text-white/50 hover:text-white text-sm transition-colors">Resources</a></li>
                        <li><a href="{{ route('contact') }}"  class="text-white/50 hover:text-white text-sm transition-colors">Contact</a></li>
                    </ul>
                </div>

                {{-- Programs --}}
                <div>
                    <h4 class="font-semibold text-white mb-5 text-xs uppercase tracking-wider">Programs</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('programs') }}#welfare"   class="text-white/50 hover:text-white text-sm transition-colors">Child Welfare</a></li>
                        <li><a href="{{ route('programs') }}#education" class="text-white/50 hover:text-white text-sm transition-colors">Education for Deaf &amp; Blind</a></li>
                        <li><a href="{{ route('programs') }}#culture"   class="text-white/50 hover:text-white text-sm transition-colors">Cultural Development</a></li>
                        <li><a href="{{ route('involved') }}#volunteer" class="text-white/50 hover:text-white text-sm transition-colors">Volunteering</a></li>
                        <li><a href="{{ route('donate') }}"             class="text-white/50 hover:text-white text-sm transition-colors">Donate</a></li>
                    </ul>
                </div>

                {{-- Newsletter --}}
                <div>
                    <h4 class="font-semibold text-white mb-5 text-xs uppercase tracking-wider">Stay Connected</h4>
                    <p class="text-white/50 text-sm mb-4">Subscribe for updates on our work in Cambodia.</p>
                    <form class="flex gap-2" onsubmit="return false;">
                        <input type="email" placeholder="Your email"
                               class="flex-1 px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/30 text-sm focus:outline-none focus:border-[#8da83a] transition-colors">
                        <button type="submit"
                                class="px-4 py-2 bg-[#8da83a] rounded-lg text-white text-sm font-medium hover:bg-[#a3c04a] transition-colors flex-shrink-0">
                            OK
                        </button>
                    </form>
                    <div class="mt-6 space-y-1.5">
                        <p class="text-white/30 text-xs uppercase tracking-wider font-medium">Contact</p>
                        @php
                            $footerAddress = data_get($settings, 'footer_address', '#58, Street 478, Phnom Penh, Cambodia');
                            $footerPhone = data_get($settings, 'footer_phone', '+855 (0)23 211 955');
                            $footerEmail = data_get($settings, 'footer_email', 'info@krousar-thmey.org');
                        @endphp
                        <p class="text-white/50 text-xs">{{ $footerAddress }}</p>
                        <p class="text-white/50 text-xs">{{ $footerPhone }}</p>
                        <p class="text-white/50 text-xs">{{ $footerEmail }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-white/30 text-xs">© {{ date('Y') }} Krousar Thmey. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-white/30 hover:text-white/60 text-xs transition-colors">Privacy Policy</a>
                    <a href="#" class="text-white/30 hover:text-white/60 text-xs transition-colors">Terms of Use</a>
                    <a href="{{ route('resources') }}" class="text-white/30 hover:text-white/60 text-xs transition-colors">Annual Reports</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
