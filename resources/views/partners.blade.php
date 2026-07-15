@extends('layouts.app')

@section('title', 'Our Partners — Krousar Thmey')
@section('description', 'Krousar Thmey partners with organizations worldwide to support children in Cambodia. View all our partners and supporters.')

@section('content')

{{-- ========================================================
     PAGE HEADER
     ======================================================== --}}
<div class="bg-white pt-16 pb-10 text-center">
    <div class="max-w-4xl mx-auto px-6">
        <h1 class="text-4xl md:text-6xl font-extrabold text-[#11568c] mb-6">PARTNERS</h1>

        @php
            $shareUrl = urlencode(request()->url());
            $shareTitle = urlencode('Our Partners — Krousar Thmey');
        @endphp
        <div class="flex justify-center gap-2">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener"
               class="w-9 h-9 bg-[#1877f2] text-white rounded-md flex items-center justify-center hover:opacity-90 transition-opacity">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener"
               class="w-9 h-9 bg-[#1da1f2] text-white rounded-md flex items-center justify-center hover:opacity-90 transition-opacity">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 14-7.496 14-13.986 0-.21 0-.42-.015-.63a9.935 9.935 0 002.46-2.548z"/></svg>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" target="_blank" rel="noopener"
               class="w-9 h-9 bg-[#0a66c2] text-white rounded-md flex items-center justify-center hover:opacity-90 transition-opacity">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
            <button onclick="if(navigator.share) { navigator.share({title: 'Our Partners — Krousar Thmey', url: '{{ request()->url() }}'}); }"
               class="w-9 h-9 bg-[#11568c] text-white rounded-md flex items-center justify-center hover:opacity-90 transition-opacity">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            </button>
        </div>
    </div>
</div>

{{-- ========================================================
     PARTNERSHIPS AROUND THE WORLD
     ======================================================== --}}
<section class="py-14 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-lg font-bold uppercase text-[#11568c] mb-4">Partnerships Around The World</h2>
        <div class="space-y-4 text-gray-600 leading-relaxed">
            <p>Since its creation, Krousar Thmey has set up long-term partnerships with Cambodian and international organizations.</p>
            <p>Donors can financially support a program or project of their choice.</p>
            <p>Technical partners allow us to benefit from specific expertise that Krousar Thmey does not have. Krousar Thmey always ensures that the projects implemented include a transfer of skills to the staff of the Foundation.</p>
            <p>Organizations, universities, institutions&hellip; many partners help Krousar Thmey's Academic and Career Counseling Project support young people in finding their path.</p>
        </div>
        <a href="#financial-partners" class="inline-flex items-center mt-6 px-5 py-2.5 border border-[#11568c] text-[#11568c] font-semibold text-sm hover:bg-[#11568c] hover:text-white transition-colors">
            See all partners
        </a>
    </div>
</section>

{{-- ========================================================
     PARTNERSHIPS WITH THE CAMBODIAN AUTHORITIES
     ======================================================== --}}
<section class="py-14 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-lg font-bold uppercase text-[#11568c] mb-4">Partnerships With The Cambodian Authorities</h2>
        <div class="space-y-4 text-gray-600 leading-relaxed">
            <p>Krousar Thmey constantly seeks to develop and maintain lasting relations with the Cambodian authorities. In addition to greater recognition, it brings us legitimacy, notoriety to the Cambodian population as well as financial contributions.</p>
            <p>&laquo;&nbsp;Memorandums of understanding&nbsp;&raquo; are regularly renewed between Krousar Thmey and governing authorities:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>the Ministry of Education, Youth and Sport regarding the Education for Deaf or Blind Children Program</li>
                <li>the Ministry of Social Affairs regarding the Child Welfare Program</li>
                <li>the Ministry of Culture and Fine Arts regarding the Cultural and Artistic Development Program</li>
            </ul>
            <p>Whether for an inauguration or to show their support, H.M. the King, the Prime Minister and his wife, as well as members of the royal family, regularly visit Krousar Thmey's structures.</p>
        </div>

        <div class="mt-10 grid grid-cols-1 sm:grid-cols-[auto_1fr] gap-6 items-center">
            <img src="{{ asset('images/partners/university.png') }}" alt="" class="w-28 h-28 mx-auto sm:mx-0 flex-shrink-0 object-contain">
            <div>
                <p class="text-gray-600 leading-relaxed mb-4">
                    From 2020 onwards, Krousar Thmey will work collaboratively with the Ministry of Education, Youth and Sport on the Education for Deaf or Blind Children Program.
                </p>
                <a href="{{ route('programs.show', 'special-education') }}" class="inline-flex items-center px-5 py-2.5 bg-[#11568c] text-white font-semibold text-sm hover:bg-[#0d4370] transition-colors">Know more</a>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     THANKS BANNER / GET INVOLVED
     ======================================================== --}}
<section class="py-14 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-xl md:text-2xl font-bold text-[#11568c] text-center mb-8">Many thanks to all our partners for their support!</h2>
        <div class="grid grid-cols-1 md:grid-cols-3">
            <img src="{{ asset('images/partners/partner_image1.webp') }}" alt="" class="h-56 md:h-full w-full object-cover">
            <div class="bg-[#f5f5f5] flex flex-col items-center justify-center text-center p-8">
                <p class="font-bold text-[#11568c] mb-3">Do you wish to get involved with Krousar Thmey?</p>
                <a href="{{ route('involved') }}" class="text-[#11568c] font-semibold underline hover:text-[#0d4370] transition-colors">Learn more</a>
            </div>
            <img src="{{ asset('images/partners/partner_image2.webp') }}" alt="" class="h-56 md:h-full w-full object-cover">
        </div>
    </div>
</section>

{{-- ========================================================
     TECHNICAL PARTNERS
     ======================================================== --}}
<section class="py-14 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-lg font-bold uppercase text-[#11568c] mb-10">Technical Partners</h2>
        @php
            $technicalPartners = [
                ['name' => 'Enfants Sourds du Cambodge', 'logo' => 'partner1.webp'],
                ['name' => 'Friends International', 'logo' => 'partner2.webp'],
                ['name' => 'Deaf Development Programme', 'logo' => 'partner3.webp'],
                ['name' => 'Cambodian Living Arts', 'logo' => 'partner4.webp'],
                ['name' => 'Sipar', 'logo' => 'partner5.webp'],
                ['name' => 'Save the Children', 'logo' => 'partner6.webp'],
            ];
        @endphp
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-6 gap-y-10">
            @foreach($technicalPartners as $partner)
            <div class="flex items-center justify-center">
                <img src="{{ asset('images/partners/' . $partner['logo']) }}" alt="{{ $partner['name'] }}" class="max-h-28 max-w-full object-contain">
            </div>
            @endforeach
        </div>
        <p class="text-gray-500 text-sm leading-relaxed mt-12">
            Krousar Thmey develops partnerships with other local organizations to give access to the children supported by the Foundation to other activities.
        </p>
    </div>
</section>

{{-- ========================================================
     FINANCIAL PARTNERS
     ======================================================== --}}
<section id="financial-partners" class="py-14 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-lg font-bold uppercase text-[#11568c] mb-8">Financial Partners</h2>

        @php
            $publicAuthorities = [
                'His Majesty the King NORODOM Sihamoni',
                'Her Majesty the Queen Mother NORODOM Monineath Sihanouk',
                'Prime Minister Samdech Moha Borvor Thipadei HUN Manet',
                'Samdech Akka Moha Sena Padei Techo Hun Sen, President of the Senate',
                'Samdech Dr. Bun Rany HUN Sen',
                'The Royal Government of Cambodia',
                'Ministry of Social Affairs',
                'Ministry of Education, Youth and Sport',
                'Ministry of Culture and Fine Arts',
                'Ministry of Defense',
                'Ministry of Information',
                'Ministry of Interior',
                'His Excellency the ambassador for Cambodia at UNESCO',
                'His Excellency the ambassador for Cambodia to France',
            ];

            $financialPartnerGroups = [
                [
                    'title' => 'Organizations, Foundations and Institutions',
                    'items' => [
                        'DUBRULLE Family',
                        'ENFANCE ESPOIR Foundation',
                        'Fondation Amanjaya',
                        'Fondation André & Cyprien',
                        'Fondation Masalina',
                        'Fonds Mécénat SIG',
                        'Foundation Philantropique Famille Sandoz',
                        'Gertrude Hirzel Foundation',
                        'GREEN LEAVES EDUCATION Foundation',
                        'Individual donor: Peter Tschofen',
                        'Individual donor: Suzanne ROY, Grants Barbe.',
                        'INTERNATIONAL COUNCIL FOR EDUCATION OF PEOPLE WITH VISUAL IMPAIRMENT (ICEVI)',
                        "LA VOIX DE L'ENFANT Association",
                        'LES AMIS DES ENFANTS DU MONDE Association',
                        'MAY-OUI Foundation',
                        'Miwako Fujiwara – Musica Felice Foundation',
                        'Musica Felice',
                        'OVERBROOK SCHOOL FOR THE BLIND (ONNET)',
                        "PEOPLE'S ACTION FOR INCLUSIVE DEVELOPMENT (PAfID)",
                        'Raksa Koma Organization',
                        'ROTARY CLUB OF PERTH',
                        'ROTARY CLUB OF PHNOM PENH',
                        'STIFTUNG HIRTEN KINDER Foundation',
                        'TALIKA',
                        'UNICEF',
                    ],
                ],
                [
                    'title' => 'Companies',
                    'items' => [
                        'ABA BANK',
                        'AMANJAYA HOTEL',
                        'ANGKOR ARTWORK (Eric STOCKER)',
                        'BAJAJ INTRACITY',
                        'BRED BANK CAMBODIA',
                        'BLIND MASSAGE CENTER',
                        'BODIA NATURE',
                        'CAMH Co. LTD',
                        'CMDK',
                        'D+Z URBAN HOTEL',
                        'KHMER CERAMICS & FINE ARTS CENTER',
                        'LONG RA Car mechanic',
                        'PROMOTION FOR DISABILITY PROJECT',
                        'PUNLEU THMEY Restaurant',
                        'RADIO HAPPINESS VOICE FOR THE BLIND',
                        'SAN FRANSISCO COMPANY',
                        'SEIN LIM',
                        'SENG POV Car mechanic',
                        'SMART Cambodia',
                        'SOCIAL COFFEE',
                        'SOFITEL Phnom Penh Phokeethra',
                        'SOFT SKILL PROFESSIONAL TRAINING SERVICE',
                        'TEMPLATION ANGKOR BOUTIQUE',
                        'THALIAS (Malis Restaurant, Khema, Arunreas Hotel)',
                        'TOP STREET RESTAURANT',
                        'VOICE OF THE BLIND Radio station',
                    ],
                ],
                [
                    'title' => 'Towns and Municipalities',
                    'items' => [
                        'City of Geneva',
                        'City of Meyrin',
                        'Town of Hermance',
                        'Towns of Collonge-Bellerive, Hermance and Vandoeuvres',
                    ],
                ],
            ];
        @endphp

        {{-- Cambodian Public Authorities: always expanded, no accordion --}}
        <div class="mb-2">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Cambodian Public Authorities</h3>
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-1.5 text-sm text-gray-600 pb-6 border-b border-gray-200">
                @foreach($publicAuthorities as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>

        {{-- Remaining groups: collapsible --}}
        @foreach($financialPartnerGroups as $group)
        <div x-data="{ open: false }" class="border-b border-gray-200">
            <button @click="open = !open" class="w-full flex items-center justify-between gap-4 py-4 text-left bg-[#f5f5f5] px-4">
                <span class="text-xl font-bold text-gray-800">{{ $group['title'] }}</span>
                <span class="relative w-4 h-4 flex-shrink-0 text-gray-700">
                    <span class="absolute inset-0 flex items-center"><span class="w-4 h-0.5 bg-current"></span></span>
                    <span class="absolute inset-0 flex items-center justify-center transition-transform duration-300" :class="open ? 'rotate-90 opacity-0' : ''"><span class="w-0.5 h-4 bg-current"></span></span>
                </span>
            </button>
            <div x-show="open" style="display: none;"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                 class="px-4 pt-4 pb-6">
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-1.5 text-sm text-gray-600">
                    @foreach($group['items'] as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection
