@extends('layouts.app')

@section('title', 'Contact — Krousar Thmey')
@section('description', 'Contact Krousar Thmey\'s offices in Cambodia, France, Switzerland, and Singapore.')

@section('content')

{{-- Page Header --}}
<style>
@keyframes waveBg {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes floatBlob {
    0% { transform: translateY(0px) rotate(-6deg); }
    50% { transform: translateY(-15px) rotate(-4deg); }
    100% { transform: translateY(0px) rotate(-6deg); }
}
@keyframes floatBlob2 {
    0% { transform: translateY(0px) rotate(6deg); }
    50% { transform: translateY(-20px) rotate(4deg); }
    100% { transform: translateY(0px) rotate(6deg); }
}
@keyframes floatBlob3 {
    0% { transform: translateY(0px) rotate(-2deg); }
    50% { transform: translateY(-12px) rotate(-3deg); }
    100% { transform: translateY(0px) rotate(-2deg); }
}
.animated-bg {
    background: linear-gradient(-45deg, #0f2448, #1a3c6e, #2d6fa3, #1d4e7a);
    background-size: 400% 400%;
    animation: waveBg 15s ease infinite;
}
.floating-card-1 {
    animation: floatBlob 8s ease-in-out infinite;
}
.floating-card-2 {
    animation: floatBlob2 10s ease-in-out infinite;
}
.floating-card-3 {
    animation: floatBlob3 9s ease-in-out infinite;
}
.floating-card-1:hover, .floating-card-2:hover, .floating-card-3:hover {
    animation-play-state: paused;
    transform: rotate(0deg) scale(1.05) !important;
    z-index: 50 !important;
}
</style>

<div class="animated-bg pt-16 pb-20 md:pt-20 md:pb-24 relative overflow-hidden">
    {{-- Animated blobs --}}
    <div class="absolute -top-40 -right-40 w-[30rem] h-[30rem] rounded-full bg-gradient-to-br from-blue-300/15 to-transparent blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -left-20 w-96 h-96 rounded-full bg-gradient-to-tr from-green-300/10 to-transparent blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.08] pointer-events-none" style="background-image: radial-gradient(circle, rgba(255,255,255,0.15) 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="relative max-w-7xl mx-auto px-6 z-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            {{-- Left Column: Content --}}
            <div class="lg:col-span-7 space-y-6 flex flex-col justify-center">
                <nav class="flex items-center gap-2 text-sm text-white/50 mb-2" data-reveal="fade">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-white">Contact</span>
                </nav>
                
                <p class="text-[#8da83a] font-bold text-xs uppercase tracking-[0.2em]" data-reveal="fade">Get in Touch</p>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black uppercase tracking-wide text-white" data-reveal="fade">
                    Contact <span class="font-serif italic text-[#8da83a] normal-case">Us</span>
                </h1>
                
                @php
                    $linkedinUrl = \App\Models\HomeSetting::getValue('social_linkedin', 'https://www.linkedin.com/company/krousar-thmey/');
                    $instagramUrl = \App\Models\HomeSetting::getValue('social_instagram', 'https://www.instagram.com/krousarthmey/');
                    $facebookUrl = \App\Models\HomeSetting::getValue('social_facebook', 'https://www.facebook.com/KrousarThmey');
                @endphp
                
                <p class="text-white/80 text-base max-w-2xl leading-relaxed pr-4" data-reveal="fade">
                    We have offices in Cambodia, France, and Switzerland. Reach out to us for partnerships, donations, or general enquiries.
                </p>

                {{-- Quick contact strip --}}
                <div class="flex flex-wrap gap-3 pt-2" data-reveal="up" style="--reveal-delay: 200">
                    <a href="tel:+85523211955" class="flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-md rounded-full px-4.5 py-2.5 text-white text-xs font-bold uppercase tracking-wider hover:bg-white hover:text-[#1a3c6e] hover:scale-105 transition-all duration-300 hover:shadow-[0_8px_30px_rgba(255,255,255,0.12)] group/btn">
                        <svg class="w-3.5 h-3.5 text-current group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        +855 (0)23 211 955
                    </a>
                    <a href="#" @click.prevent="openEmail('info@krousar-thmey.org')" class="flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-md rounded-full px-4.5 py-2.5 text-white text-xs font-bold uppercase tracking-wider hover:bg-white hover:text-[#1a3c6e] hover:scale-105 transition-all duration-300 hover:shadow-[0_8px_30px_rgba(255,255,255,0.12)] group/btn">
                        <svg class="w-3.5 h-3.5 text-current group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        info@krousar-thmey.org
                    </a>
                    <a href="{{ $facebookUrl }}" target="_blank" rel="noopener" class="flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-md rounded-full px-4.5 py-2.5 text-white text-xs font-bold uppercase tracking-wider hover:bg-white hover:text-[#1a3c6e] hover:scale-105 transition-all duration-300 hover:shadow-[0_8px_30px_rgba(255,255,255,0.12)] group/btn">
                        <svg class="w-3.5 h-3.5 text-current group-hover/btn:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        Facebook
                    </a>
                    <a href="{{ $instagramUrl }}" target="_blank" rel="noopener" class="flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-md rounded-full px-4.5 py-2.5 text-white text-xs font-bold uppercase tracking-wider hover:bg-white hover:text-[#1a3c6e] hover:scale-105 transition-all duration-300 hover:shadow-[0_8px_30px_rgba(255,255,255,0.12)] group/btn">
                        <svg class="w-3.5 h-3.5 text-current group-hover/btn:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-4.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0 3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                        Instagram
                    </a>
                    <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener" class="flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-md rounded-full px-4.5 py-2.5 text-white text-xs font-bold uppercase tracking-wider hover:bg-white hover:text-[#1a3c6e] hover:scale-105 transition-all duration-300 hover:shadow-[0_8px_30px_rgba(255,255,255,0.12)] group/btn">
                        <svg class="w-3.5 h-3.5 text-current group-hover/btn:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>
            
            {{-- Right Column: Staggered Image Cards --}}
            <div class="lg:col-span-5 relative h-[320px] sm:h-[380px] lg:h-[400px] mt-12 lg:mt-0 items-center justify-center hidden lg:flex select-none">
                
                {{-- Card 1: Cambodia HQ --}}
                <div class="absolute -translate-x-16 -translate-y-8 sm:-translate-x-20 sm:-translate-y-12">
                    <div class="w-44 h-56 sm:w-48 sm:h-64 rounded-[1.8rem] overflow-hidden border-4 border-white/80 shadow-2xl transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] group/gallery floating-card-1 relative">
                        <img src="https://www.krousar-thmey.org/wp-content/uploads/2023/02/news_en_01.webp" alt="Cambodia HQ" class="w-full h-full object-cover">
                    </div>
                </div>

                {{-- Card 2: Our Programs --}}
                <div class="absolute translate-x-16 translate-y-8 sm:translate-x-20 sm:translate-y-12">
                    <div class="w-44 h-56 sm:w-48 sm:h-64 rounded-[1.8rem] overflow-hidden border-4 border-white/80 shadow-2xl transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] group/gallery floating-card-2 relative" style="animation-delay: -3.5s;">
                        <img src="https://images.squarespace-cdn.com/content/v1/63de2109b31c4e4f5ada3af2/1684249935753-MA98HR8KWUDUJN2ILCUD/DSC09300.jpg" alt="Our Programs" class="w-full h-full object-cover">
                    </div>
                </div>

                {{-- Card 3: Education --}}
                <div class="absolute translate-y-12 -translate-x-2 sm:translate-y-16">
                    <div class="w-40 h-52 sm:w-44 sm:h-58 rounded-[1.8rem] overflow-hidden border-4 border-white/80 shadow-2xl transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] group/gallery floating-card-3 relative" style="animation-delay: -6.8s;">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJoeNX153ZazzGqdkZP5M0NNAqeDVli8sgKH8g7N9YvtglgDocvffD0dD&s=10" alt="Education" class="w-full h-full object-cover">
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>

{{-- Our Offices --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14" data-reveal>
            <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Our Offices</span>
            <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-[#2d6fa3]">Find Us Around the World</h2>
            <div class="w-16 h-1 bg-[#d32f2f] rounded-full mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @forelse($offices as $loc)
            <div class="bg-[#f8f9fc] rounded-3xl border-2 border-slate-200/50 hover:border-[#2d6fa3]/40 hover:shadow-lg transition-all duration-300 overflow-hidden group flex flex-col h-full hover:-translate-y-0.5"
                 data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}">
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-start justify-between mb-4">
                        <span class="text-3xl font-black text-gray-800">{{ $loc->flag }}</span>
                        @if($loc->badge)
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full {{ $loc->badge_color }}">{{ $loc->badge }}</span>
                        @endif
                    </div>
                    <h3 class="text-lg font-black text-[#2d6fa3] uppercase tracking-wide">{{ $loc->country }}</h3>
                    <p class="text-[#8da83a] text-xs font-semibold mb-4">{{ $loc->city }}</p>

                    <div class="space-y-3 mt-auto">
                        <div class="flex items-start gap-2.5">
                            <svg class="w-3.5 h-3.5 text-[#e8a020] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <p class="text-gray-500 text-xs leading-relaxed whitespace-pre-line">{{ $loc->address }}</p>
                        </div>
                        @if($loc->phone)
                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $loc->phone) }}" class="flex items-center gap-2.5 group/link">
                            <svg class="w-3.5 h-3.5 text-[#e8a020] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span class="text-gray-500 text-xs group-hover/link:text-[#2d6fa3] transition-colors">{{ $loc->phone }}</span>
                        </a>
                        @endif
                        @if($loc->email)
                        <a href="#" @click.prevent="openEmail('{{ $loc->email }}')" class="flex items-center gap-2.5 group/link">
                            <svg class="w-3.5 h-3.5 text-[#e8a020] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="text-gray-500 text-xs group-hover/link:text-[#2d6fa3] transition-colors break-all">{{ $loc->email }}</span>
                        </a>
                        @endif
                    </div>
                </div>
                @if($loc->email)
                <div class="px-6 pb-5 mt-auto">
                    <a href="#" @click.prevent="openEmail('{{ $loc->email }}')" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-[#2d6fa3]/10 text-[#2d6fa3] text-xs font-semibold hover:bg-[#2d6fa3] hover:text-white transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Send Email
                    </a>
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-3 py-12 text-center text-gray-400 text-sm">No offices configured yet.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- Contact Form --}}
<section class="py-20 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-5 gap-12 items-start">

            {{-- Left: Info sidebar --}}
            <div class="lg:col-span-2 space-y-6" data-reveal="left">
                <div>
                    <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Write to Us</span>
                    <h2 class="text-3xl font-black uppercase tracking-wide text-[#2d6fa3] mt-4 mb-2">Send Us a Message</h2>
                    <div class="w-12 h-1 bg-[#d32f2f] rounded-full mb-5"></div>
                    <p class="text-gray-500 text-sm leading-relaxed">We'll get back to you within 2 business days. For urgent matters, please call our Cambodia headquarters directly.</p>
                </div>

                {{-- Response time --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-5 space-y-4">
                    @foreach([
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Response time', 'value' => 'Within 2 business days'],
                        ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'General enquiries', 'value' => 'info@krousar-thmey.org'],
                        ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => 'Phone (HQ)', 'value' => '+855 (0)23 211 955'],
                    ] as $info)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">{{ $info['label'] }}</p>
                            <p class="text-gray-700 text-sm font-medium">{{ $info['value'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Topics --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-5">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">We can help with</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Donations', 'Partnerships', 'Volunteering', 'Job Applications', 'Media & Press', 'General Enquiries'] as $topic)
                        <span class="bg-[#2d6fa3]/8 text-[#2d6fa3] text-xs font-medium px-3 py-1.5 rounded-full border border-[#2d6fa3]/15">{{ $topic }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Warm image --}}
                <div class="relative rounded-2xl overflow-hidden h-48 shadow-md">
                    <img src="{{ asset('images/children.jpg') }}" alt="Children at Krousar Thmey"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1d4e7a]/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <p class="text-white font-bold text-sm leading-snug">"Every message brings us closer to helping more children."</p>
                        <p class="text-white/60 text-xs mt-1">— Krousar Thmey Team</p>
                    </div>
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="lg:col-span-3" data-reveal="right">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 lg:p-10">
                    <form class="space-y-5" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">First Name <span class="text-[#d32f2f]">*</span></label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="John"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors">
                                @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Last Name <span class="text-[#d32f2f]">*</span></label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Doe"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors">
                                @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Email Address <span class="text-[#d32f2f]">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Organisation <span class="text-gray-400 font-normal normal-case">(optional)</span></label>
                            <input type="text" name="organisation" value="{{ old('organisation') }}" placeholder="Your organization"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Subject <span class="text-[#d32f2f]">*</span></label>
                            <select name="subject" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors bg-white text-gray-700">
                                <option value="">Select a topic</option>
                                <option value="Donation" {{ old('subject') === 'Donation' ? 'selected' : '' }}>Donation</option>
                                <option value="Partnership / Sponsorship" {{ old('subject') === 'Partnership / Sponsorship' ? 'selected' : '' }}>Partnership / Sponsorship</option>
                                <option value="Volunteering" {{ old('subject') === 'Volunteering' ? 'selected' : '' }}>Volunteering</option>
                                <option value="Job Application" {{ old('subject') === 'Job Application' ? 'selected' : '' }}>Job Application</option>
                                <option value="Media / Press" {{ old('subject') === 'Media / Press' ? 'selected' : '' }}>Media / Press</option>
                                <option value="General Enquiry" {{ old('subject') === 'General Enquiry' ? 'selected' : '' }}>General Enquiry</option>
                            </select>
                            @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Message <span class="text-[#d32f2f]">*</span></label>
                            <textarea rows="5" name="message" placeholder="Your message..."
                                      class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors resize-none">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex items-start gap-3 bg-[#f8f9fc] rounded-xl p-4 border border-gray-100">
                            <input type="checkbox" id="consent" name="consent" value="1" {{ old('consent') ? 'checked' : '' }} class="mt-0.5 rounded accent-[#2d6fa3] w-4 h-4 flex-shrink-0">
                            <label for="consent" class="text-gray-500 text-xs leading-relaxed cursor-pointer">
                                I agree to Krousar Thmey storing my contact information to respond to my enquiry, in accordance with their privacy policy.
                            </label>
                        </div>
                        @error('consent') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <button type="submit" class="btn-blue w-full justify-center py-4 rounded-xl text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Banner --}}
<section class="bg-[#1d4e7a] py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-72 h-72 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full bg-[#2d6fa3] translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 text-center" data-reveal="scale">
        <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Support Our Work</p>
        <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-white mb-4">Make a Difference Today</h2>
        <p class="text-white/70 text-lg mb-8 max-w-2xl mx-auto">Every contribution goes directly to supporting children across Cambodia. 100% of funds reach the children.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary text-base">Donate Now</a>
            <a href="{{ route('involved') }}" class="btn-outline text-base">Get Involved</a>
        </div>
    </div>
</section>

@endsection
