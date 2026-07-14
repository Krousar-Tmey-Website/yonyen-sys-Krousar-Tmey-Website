{{-- Category icons --}}@php
$catIcons = [
    'authorities' => '🇰🇭',
    'organizations' => '🏛️',
    'companies' => '🏢',
    'towns' => '🏙️',
];
@endphp

{{-- Grouped tables --}}
@foreach($partners as $cat => $catPartners)
@if($catPartners->count())
@php
    $displayName = $cat === 'Individual Donor' ? 'Individual Donor' : ucfirst($cat);
    $icon = $catIcons[$cat] ?? '🤝';
@endphp
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-5">
    <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">
        <h4 class="font-semibold text-gray-700 text-sm">{{ $icon }} {{ $displayName }}</h4>
        <span class="px-3 py-1 bg-white rounded-full text-xs text-gray-400 border border-gray-100">
            {{ $catPartners->count() }}
        </span>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-400 text-xs border-b border-gray-50">
                <th class="text-left font-medium px-6 py-3">Partner</th>
                <th class="text-left font-medium px-6 py-3">Country</th>
                <th class="text-left font-medium px-6 py-3">Status</th>
                <th class="text-right font-medium px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($catPartners as $partner)
            <tr class="border-t border-gray-50 hover:bg-gray-50/60 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($partner->logo_url)
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                             class="w-10 h-10 rounded-full object-cover border border-gray-100 bg-white">
                        @else
                        <div class="w-10 h-10 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center text-[#2d6fa3] text-xs font-semibold">
                            {{ Str::substr($partner->name, 0, 1) }}
                        </div>
                        @endif
                        <span class="font-medium text-gray-800">{{ $partner->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $partner->country ?? '—' }}</td>
                <td class="px-6 py-4">
                    @if($partner->is_active)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">Active</span>
                    @else
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">Hidden</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.partners.edit', $partner) }}" title="Edit"
                           class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Delete this partner?')">
                            @csrf @method('DELETE')
                            <button type="submit" title="Delete" class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endforeach

@if($partners->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 py-16 text-center">
    <div class="text-gray-300 text-4xl mb-3">🤝</div>
    @if(($filters['search'] ?? '') !== '' || ($filters['category'] ?? '') !== '')
    <p class="text-gray-500 text-sm font-medium">No partners found.</p>
    <p class="text-gray-400 text-xs mt-1">Try a different search term or category.</p>
    @else
    <p class="text-gray-500 text-sm">No partners available</p>
    <p class="text-gray-400 text-xs mt-1">Add your first partner using the form</p>
    @endif
</div>
@endif