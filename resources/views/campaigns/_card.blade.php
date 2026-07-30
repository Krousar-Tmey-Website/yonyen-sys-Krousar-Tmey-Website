{{--
    Campaign card used on /campaigns and in the "More campaigns" strip of a detail page.
    Expects: $campaign (App\Models\Campaign), optional $delay (reveal offset in ms).
--}}
@php $delay = $delay ?? 0; @endphp

<article class="card group relative overflow-hidden rounded-[2rem] shadow-xl h-[420px] cursor-pointer text-center text-white" data-reveal="up" style="--reveal-delay: {{ $delay }}">
    
    {{-- Background Image --}}
    <img src="{{ $campaign->image_url }}" alt="{{ $campaign->localized_title }}"
        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 z-0">
    
    {{-- Year badge --}}
    @if($campaign->year)
    <span class="absolute top-5 left-5 z-20 bg-[#e8a020] text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        {{ $campaign->year }}
    </span>
    @endif

    {{-- Attachment hints --}}
    @if($campaign->has_video || $campaign->has_file)
    <div class="absolute top-5 right-5 z-20 flex items-center gap-1.5">
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

    {{-- Default Gradient (Dark at bottom) --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent z-10 transition-opacity duration-500 group-hover:opacity-0"></div>

    {{-- Hover Full Overlay --}}
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>

    {{-- Default Content (Visible only when NOT hovering) --}}
    <div class="absolute inset-0 z-20 flex flex-col justify-end p-8 pb-10 transition-all duration-500 group-hover:opacity-0 group-hover:translate-y-4">
        <h3 class="text-xl font-bold uppercase tracking-wide leading-snug drop-shadow-md line-clamp-2">{{ $campaign->localized_title }}</h3>
    </div>

    {{-- Hover Content (Visible only when hovering) --}}
    <div class="absolute inset-0 z-30 flex flex-col justify-center items-center p-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
        <h3 class="text-xl font-bold uppercase tracking-wide leading-snug mb-4 line-clamp-3">{{ $campaign->localized_title }}</h3>
        
        @if($excerpt = $campaign->excerpt(150))
            <p class="text-white/90 text-sm leading-relaxed mb-6 line-clamp-5">
                {{ $excerpt }}
            </p>
        @endif
        
        <div class="mt-auto flex items-center justify-between w-full gap-4 relative z-40">
            <a href="{{ route('campaigns.show', $campaign) }}" class="inline-flex items-center gap-2 text-white font-black uppercase text-xs tracking-widest hover:text-[#e8a020] transition-colors duration-300 group/read">
                {{ __('Read More') }}
                <svg class="w-4 h-4 transform group-hover/read:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            
            {{-- Donate Button --}}
            <a href="{{ route('donate') }}" class="group/btn relative z-50 px-4 py-2.5 text-[#8da83a] bg-white hover:text-white hover:bg-[#8da83a] text-[10px] font-black uppercase tracking-widest rounded-full hover:shadow-[0_8px_20px_rgba(141,168,58,0.6)] hover:-translate-y-1 transition-all duration-300 flex items-center gap-1.5" title="Donate to {{ $campaign->localized_title }}">
                <svg class="w-3.5 h-3.5 group-hover/btn:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <span>{{ __('Donate') }}</span>
            </a>
        </div>
    </div>
    
    {{-- Main Card Link --}}
    <a href="{{ route('campaigns.show', $campaign) }}" class="absolute inset-0 z-20" aria-label="View {{ $campaign->localized_title }}"></a>
</article>
