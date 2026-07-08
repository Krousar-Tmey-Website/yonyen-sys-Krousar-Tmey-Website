@php
    $hasSearch = filled($search ?? null);
    $totalPartners = $partners->count();
@endphp

{{-- COUNT BADGE --}}
<div class="flex items-center justify-between flex-wrap gap-4 mb-4" id="partners-count-bar">
    <div class="flex items-center gap-2">
        <h3 class="font-bold text-gray-800">All Partners</h3>
        <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold">
            Showing {{ $totalPartners }}
        </span>
    </div>
    @if ($hasSearch || filled($categoryId ?? null))
        <span class="px-2.5 py-1 bg-gray-50 border border-gray-100 text-gray-500 text-xs font-medium rounded-full">
            {{ ($hasSearch ? '1 search' : '') . (($hasSearch && filled($categoryId ?? null)) ? ' + ' : '') . (filled($categoryId ?? null) ? '1 filter' : '') }} applied
        </span>
    @endif
</div>

{{-- PARTNERS CARDS GRID --}}
@if ($totalPartners > 0)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6"
         x-data="{ deleteModal: false, deleteForm: null, deleteName: '' }">

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach ($partners as $partner)
                <div class="group relative bg-white rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all duration-200 overflow-hidden">

                    {{-- Card content --}}
                    @if ($partner->logo)
                        {{-- Logo card --}}
                        <a href="{{ route('admin.partners.show', $partner) }}"
                           class="block p-4 pt-5 flex flex-col items-center justify-center min-h-[160px]">
                            <div class="w-full h-24 flex items-center justify-center mb-3 overflow-hidden">
                                <img src="{{ asset('storage/' . $partner->logo) }}"
                                     alt="{{ $partner->name }}"
                                     class="max-w-full max-h-full object-contain">
                            </div>
                            <p class="text-xs font-medium text-gray-700 text-center leading-tight line-clamp-2">
                                {{ $partner->name }}
                            </p>
                        </a>
                    @else
                        {{-- Text-only card with same dimensions --}}
                        <a href="{{ route('admin.partners.show', $partner) }}"
                           class="block p-4 pt-5 flex flex-col items-center justify-center min-h-[160px] bg-gradient-to-br from-gray-50 to-white">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center mb-3">
                                <span class="text-xl font-bold text-blue-500">
                                    {{ Str::substr($partner->name, 0, 1) }}
                                </span>
                            </div>
                            <p class="text-xs font-semibold text-gray-800 text-center leading-tight line-clamp-2">
                                {{ $partner->name }}
                            </p>
                        </a>
                    @endif

                    {{-- Hover actions --}}
                    <div class="absolute top-2 right-2 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('admin.partners.edit', $partner) }}" title="Edit"
                           class="w-7 h-7 rounded-full bg-white shadow-sm border border-gray-100 text-blue-600 hover:bg-blue-50 flex items-center justify-center transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <button type="button" title="Delete"
                            @click="deleteForm = $el.nextElementSibling; deleteName = '{{ addslashes($partner->name) }}'; deleteModal = true"
                            class="w-7 h-7 rounded-full bg-white shadow-sm border border-gray-100 text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                            </svg>
                        </button>
                        {{-- Hidden delete form --}}
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                    {{-- Category badge --}}
                    <div class="absolute bottom-2 left-2">
                        @if ($partner->partnerCategory)
                            <span class="px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-medium">
                                {{ $partner->partnerCategory->name }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Delete Confirmation Modal --}}
        <div x-show="deleteModal"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
             @click.self="deleteModal = false">

            <div x-show="deleteModal"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 @click.away="deleteModal = false"
                 class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 p-6 w-full max-w-md">

                {{-- Close button --}}
                <button type="button" @click="deleteModal = false"
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-400 hover:text-gray-600 flex items-center justify-center transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                {{-- Warning icon --}}
                <div class="mx-auto w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>

                {{-- Message --}}
                <h3 class="text-lg font-bold text-gray-800 text-center mb-2">Delete Partner</h3>
                <p class="text-sm text-gray-500 text-center mb-1">
                    Are you sure you want to delete
                    <strong class="text-gray-700" x-text="deleteName"></strong>?
                </p>
                <p class="text-xs text-gray-400 text-center mb-6">
                    This action cannot be undone.
                </p>

                {{-- Buttons --}}
                <div class="flex items-center gap-3">
                    <button type="button" @click="deleteModal = false"
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                        Cancel
                    </button>
                    <button type="button" @click="deleteForm.submit()"
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl transition shadow-sm">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- EMPTY STATE --}}
    <div class="bg-white rounded-2xl border py-16 text-center">
        <div class="text-gray-300 text-4xl mb-3">🤝</div>
        <p class="text-gray-500 text-sm">No partners found</p>
        <p class="text-gray-400 text-xs mt-1">
            @if ($hasSearch || filled($categoryId ?? null))
                Try adjusting your search or filter criteria.
            @else
                <a href="{{ route('admin.partners.create') }}" class="text-blue-500 hover:text-blue-600 underline">
                    Add your first partner
                </a>
            @endif
        </p>
    </div>
@endif
