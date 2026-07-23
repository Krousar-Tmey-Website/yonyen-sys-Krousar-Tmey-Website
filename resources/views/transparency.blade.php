@extends('layouts.app')

@section('title', 'Transparency — Krousar Thmey')
@section('description', 'Financial transparency and accountability at Krousar Thmey. All administrative costs remain under 4% of the total budget.')

@section('content')

{{-- ========================================================
     HERO SECTION
     ======================================================== --}}
<div class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Background Image --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/community-work.png') }}" alt="Cambodian community" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/60"></div>
    </div>
    
    {{-- Khmer Pattern Overlay --}}
    <div class="absolute inset-0 opacity-5">
        <div 
            class="w-full h-full bg-repeat"
            style="background-image: url('{{ asset('https://www.krousar-thmey.org/wp-content/uploads/2023/02/childwelfare_project-1.webp') }}');">
        </div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center" data-reveal>
        <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold text-white mb-6 tracking-tight">
            Transparency
        </h1>
        <p class="text-2xl md:text-3xl text-white/90 font-medium mb-4">
            Financial Accountability & Trust
        </p>
        <p class="text-lg text-white/70 mb-10 max-w-2xl mx-auto">
            Audited financial statements and transparent operations
        </p>
        
        {{-- Timeline decorative element --}}
        <div class="flex items-center justify-center gap-4 mb-10">
            <div class="w-16 h-px bg-[#d4af37]"></div>
            <div class="w-3 h-3 rounded-full bg-[#d4af37]"></div>
            <div class="w-16 h-px bg-[#d4af37]"></div>
        </div>
        
        <a href="#financial" 
           class="inline-flex items-center gap-3 px-8 py-4 bg-[#2d6fa3] text-white font-semibold rounded-full hover:bg-[#1d4e7a] transition-all transform hover:scale-105 shadow-lg">
            View Financial Reports
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </a>
    </div>
</div>

{{-- ========================================================
     FINANCIAL TRANSPARENCY SECTION
     ======================================================== --}}
<section id="financial" class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Financial Transparency</h2>
            <p class="text-gray-500 max-w-3xl mx-auto">Our commitment to open and responsible stewardship of donor funds</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 mb-16">
            {{-- Left: Text Content --}}
            <div data-reveal="left">
                <p class="text-gray-600 leading-relaxed mb-6 text-lg">
                    Financial transparency is a key principle for Krousar Thmey. Everybody has the right to know how the funds raised are used. The implementation of programs and projects is our priority.
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Thanks to strict financial management and the involvement of European volunteers, <strong class="text-[#2d6fa3]">all administrative costs remain under 4% of the total budget.</strong>
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Krousar Thmey Cambodia's accounts are all audited and certified each year by an independent audit firm (<strong>PricewaterhouseCoopers since 2013</strong> and KPMG before then). Working closely with the auditors, Krousar Thmey is committed to constantly improving the quality and precision of its financial processes.
                </p>
                
                {{-- Key Stats --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#2d6fa3]/5 rounded-2xl p-6 text-center border border-[#2d6fa3]/15">
                        <div class="text-3xl font-black text-[#2d6fa3] mb-1">< 4%</div>
                        <div class="text-gray-500 text-xs">Administrative Costs</div>
                    </div>
                    <div class="bg-[#8da83a]/5 rounded-2xl p-6 text-center border border-[#8da83a]/15">
                        <div class="text-3xl font-black text-[#8da83a] mb-1">100%</div>
                        <div class="text-gray-500 text-xs">Funds to Children</div>
                    </div>
                </div>
            </div>

            {{-- Right: Image --}}
            <div class="relative" data-reveal="right">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/children.jpg') }}" alt="Children at Krousar Thmey" 
                         class="w-full h-[400px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     AUDITED STATEMENTS SECTION
     ======================================================== --}}
<section class="py-24 bg-[#f8f5f0] scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Audited Financial Statements</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Download our annual reports and financial statements</p>
        </div>

        @if($reports->isNotEmpty())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($reports as $i => $report)
            <div class="group bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 p-6"
                 data-reveal="up" style="--reveal-delay: {{ $i * 80 }}">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">{{ $report->localized_title }}</h3>
                        <p class="text-gray-400 text-xs">{{ $report->year }} • {{ $report->localized_description ?? 'Annual Report' }}</p>
                    </div>
                </div>
                <a href="{{ $report->download_url }}" target="_blank"
                   class="inline-flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-[#2d6fa3] text-white text-sm font-medium rounded-lg hover:bg-[#1d4e7a] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download PDF
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12" data-reveal>
            <p class="text-gray-400">No reports available yet. <a href="{{ route('resources') }}" class="text-[#2d6fa3] hover:underline">View resources page</a>.</p>
        </div>
        @endif
    </div>
</section>

{{-- ========================================================
     ORIGINS OF FUNDS SECTION
     ======================================================== --}}
<section class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Origins of the Funds</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">How we receive and use donations to support our mission</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <div class="bg-white rounded-3xl p-8 lg:p-10 border border-gray-100 shadow-sm" data-reveal="left">
                <h3 class="text-xl font-bold text-[#2d6fa3] mb-4 flex items-center gap-3">
                    <span class="text-2xl">🌏</span> International Support
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    In support of its local activity in Cambodia, Krousar Thmey benefits from the involvement of volunteers in international entities: Krousar Thmey France, Krousar Thmey Switzerland and Krousar Thmey Singapore.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    As their main activity is fundraising, these branches are a privileged relay to donors outside of Cambodia.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 lg:p-10 border border-gray-100 shadow-sm" data-reveal="right">
                <h3 class="text-xl font-bold text-[#2d6fa3] mb-4 flex items-center gap-3">
                    <span class="text-2xl">🇰🇭</span> Local Support
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Donations received in Cambodia come mainly from non-governmental organizations and to a lesser extent from private donors and the Cambodian authorities.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Financial or in-kind donations from the Cambodian authorities have increased steadily over the past few years, accounting for nearly <strong class="text-[#2d6fa3]">8% of Krousar Thmey's resources</strong>.
                </p>
            </div>
        </div>

        {{-- Recognition badge --}}
        <div class="mt-16 text-center" data-reveal="scale">
            <div class="inline-flex items-center gap-3 bg-[#8da83a]/10 border border-[#8da83a]/20 rounded-full px-6 py-3">
                <span class="text-xl">🏆</span>
                <span class="text-sm font-medium text-gray-700">Krousar Thmey won the label <strong>Ideas</strong> in 2010 — recognising organisations committed to social innovation and impact.</span>
            </div>
        </div>
    </div>
</section>

@endsection