@php
    $bySubcategory = fn ($items) => $items->groupBy(fn ($p) => $p->subcategory ?? 'Uncategorized');

    $subIcons = [
        'Cambodian Public Authorities' => '🇰🇭',
        'Organizations, Foundations and Institutions' => '🏛️',
        'Companies' => '🏢',
        'Towns and Municipalities' => '🏙️',
        'Uncategorized' => '🤝',
    ];

    $byCategory = $partners->groupBy('category');
    $orderedCategories = collect(\App\Enums\PartnerCategory::cases())->pluck('value');
@endphp

@foreach($orderedCategories as $cat)
    @continue(!$byCategory->has($cat) || $byCategory[$cat]->isEmpty())
    @php $catPartners = $byCategory[$cat]; @endphp

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-3">
            <h3 class="font-bold text-[#1d4e7a] text-base">
                {{ $cat }}
            </h3>
            <span class="px-2.5 py-0.5 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                {{ $catPartners->count() }}
            </span>
        </div>

        @if($cat === 'Financial Partners')
            {{-- Financial Partners: grouped by subcategory --}}
            @foreach($bySubcategory($catPartners) as $sub => $subPartners)
                @if($subPartners->count())
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-4">
                    <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">
                        <h4 class="font-semibold text-gray-700 text-sm">{{ $subIcons[$sub] ?? '🤝' }} {{ $sub }}</h4>
                        <span class="px-3 py-1 bg-white rounded-full text-xs text-gray-400 border border-gray-100">
                            {{ $subPartners->count() }}
                        </span>
                    </div>
                    @include('admin.partners._partner_table', ['catPartners' => $subPartners])
                </div>
                @endif
            @endforeach
        @else
            {{-- Technical Partners: flat table, no subcategory --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-4">
                @include('admin.partners._partner_table', ['catPartners' => $catPartners])
            </div>
        @endif
    </div>
@endforeach

@if($partners->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 py-16 text-center">
    <div class="text-gray-300 text-4xl mb-3">🤝</div>
    @if(($filters['search'] ?? '') !== '' || ($filters['category'] ?? '') !== '' || ($filters['subcategory'] ?? '') !== '')
    <p class="text-gray-500 text-sm font-medium">No partners found.</p>
    <p class="text-gray-400 text-xs mt-1">Try a different search term or category.</p>
    @else
    <p class="text-gray-500 text-sm">No partners available</p>
    <p class="text-gray-400 text-xs mt-1">Click <strong>Add New Partner</strong> to create one</p>
    @endif
</div>
@endif
