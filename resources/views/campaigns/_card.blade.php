{{--
    Campaign card used on /campaigns and in the "More campaigns" strip of a detail page.
    Expects: $campaign (App\Models\Campaign), optional $delay (reveal offset in ms).
--}}
@php $delay = $delay ?? 0; @endphp

<article class="card group relative overflow-hidden rounded-[2rem] shadow-xl h-[420px] cursor-pointer text-center text-white" data-reveal="up" style="--reveal-delay: {{ $delay }}" x-data="{ adminMenuOpen: false }">
    
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

    {{-- Hover Content (Visible only when hovering; pointer-events-none so blank areas fall through to the Main Card Link below) --}}
    <div class="absolute inset-0 z-30 flex flex-col justify-center items-center p-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0 pointer-events-none">
        <h3 class="text-xl font-bold uppercase tracking-wide leading-snug mb-4 line-clamp-3">{{ $campaign->localized_title }}</h3>

        @if($excerpt = $campaign->excerpt(150))
            <p class="text-white/90 text-sm leading-relaxed mb-6 line-clamp-5">
                {{ $excerpt }}
            </p>
        @endif

        <div class="mt-auto flex items-center justify-between w-full gap-4 relative z-40 pointer-events-auto">
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

    {{-- More Options (View More Detail / Edit Info). Visible to every viewer;
         "Edit Info" is protected by AdminMiddleware itself — a logged-out click
         redirects to admin login and back to this exact edit page afterward. --}}
    <div class="absolute top-16 right-5 z-50 opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-opacity duration-300">
        <button type="button" @click="adminMenuOpen = !adminMenuOpen"
            class="w-9 h-9 rounded-full bg-black/50 backdrop-blur hover:bg-black/70 text-white flex items-center justify-center transition-colors"
            aria-label="More options" title="More options">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
        </button>
        <div x-show="adminMenuOpen" x-cloak @click.away="adminMenuOpen = false"
            x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1.5 text-left text-gray-700 text-sm overflow-hidden">
            <a href="{{ route('campaigns.show', $campaign) }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                {{ __('View More Detail') }}
            </a>
            <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-gray-50 transition-colors border-t border-gray-100">
                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                {{ __('Edit Info') }}
            </a>
        </div>
    </div>
</article>
