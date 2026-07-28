{{--
    Campaign card used on /campaigns and in the "More campaigns" strip of a detail page.
    Expects: $campaign (App\Models\Campaign), optional $delay (reveal offset in ms).
--}}
@php $delay = $delay ?? 0; @endphp

<article data-reveal="scale" style="--reveal-delay: {{ $delay }}"
         class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">

    {{-- Media --}}
    <a href="{{ route('campaigns.show', $campaign) }}" class="relative block h-52 overflow-hidden bg-gray-100">
        <img src="{{ $campaign->image_url }}" alt="{{ $campaign->localized_title }}"
             loading="lazy"
             class="w-full h-full object-cover object-center group-hover:scale-[1.06] transition-transform duration-500">
        <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-black/10 to-transparent"></div>

        {{-- Year badge --}}
        @if($campaign->year)
        <span class="absolute top-4 left-4 inline-flex items-center gap-1.5 bg-white/95 backdrop-blur text-[#1a3c6e] px-3 py-1.5 rounded-full text-xs font-black tracking-wide shadow-sm">
            <svg class="w-3.5 h-3.5 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            {{ $campaign->year }}
        </span>
        @endif

        {{-- Attachment hints --}}
        @if($campaign->has_video || $campaign->has_file)
        <div class="absolute top-4 right-4 flex items-center gap-1.5">
            @if($campaign->has_video)
            <span title="{{ __('Includes video') }}" class="w-8 h-8 rounded-full bg-black/50 backdrop-blur text-white flex items-center justify-center">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </span>
            @endif
            @if($campaign->has_file)
            <span title="{{ __('Includes document') }}" class="w-8 h-8 rounded-full bg-black/50 backdrop-blur text-white flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </span>
            @endif
        </div>
        @endif
    </a>

    {{-- Body --}}
    <div class="p-6 flex flex-col flex-1">
        <h3 class="font-bold text-lg text-gray-800 leading-snug mb-2.5">
            <a href="{{ route('campaigns.show', $campaign) }}" class="group-hover:text-[#2d6fa3] transition-colors">
                {{ $campaign->localized_title }}
            </a>
        </h3>

        @if($excerpt = $campaign->excerpt(150))
        <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-1">{{ $excerpt }}</p>
        @else
        <div class="flex-1"></div>
        @endif

        {{-- Actions --}}
        <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
            <a href="{{ route('donate') }}"
               class="flex-1 inline-flex items-center justify-center gap-1 bg-[#8da83a] hover:bg-[#a3c04a] text-white px-3 py-1.5 rounded-full text-xs font-semibold transition-colors">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                {{ __('Donate') }}
            </a>
            <a href="{{ route('campaigns.show', $campaign) }}"
               class="flex-1 inline-flex items-center justify-center gap-1 border border-gray-200 hover:border-[#2d6fa3] text-[#2d6fa3] hover:bg-[#2d6fa3]/5 px-3 py-1.5 rounded-full text-xs font-semibold transition-all">
                {{ __('Read More') }}
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</article>
