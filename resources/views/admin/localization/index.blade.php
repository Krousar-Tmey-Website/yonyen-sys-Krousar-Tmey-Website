@extends('admin.layouts.app')

@section('title', 'Localization')
@section('page-title', 'Localization')
@section('breadcrumb', "Manage every language your site supports — powered by Laravel's native translation files")

@section('content')

<div x-data="{ showAddLocale: false, showAddKey: false }"
    id="localization-app"
    data-keys-destroy-url="{{ route('admin.localization.keys.destroy') }}"
    data-locale-destroy-url-template="{{ route('admin.localization.locales.destroy', ['locale' => '__LOCALE__']) }}">

    {{-- Toolbar --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="relative w-full sm:max-w-xs">
            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" id="localization-search" placeholder="Search translation keys or values…" autocomplete="off"
                oninput="filterLocalizationRows(this.value)"
                class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>
        <div class="flex items-center gap-2">
            <button type="button" @click="showAddKey = true"
                class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-xl shadow-sm hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Key
            </button>
            <button type="button" @click="showAddLocale = true"
                class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#1a3c6e] text-white text-sm font-medium rounded-xl shadow-sm hover:bg-[#153059] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                </svg>
                Add Language
            </button>
        </div>
    </div>

    {{-- Info banner --}}
    <div class="mb-6 p-3.5 bg-blue-50 border border-blue-100 rounded-xl text-xs text-blue-700 flex items-start gap-2.5">
        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>
            These strings power labels across the site (admin menu, navigation, etc). Leave a field blank to automatically
            fall back to <strong>{{ $meta[$defaultLocale]['name'] ?? strtoupper($defaultLocale) }}</strong>. Saving writes
            straight into Laravel's native <code class="px-1 py-0.5 bg-blue-100 rounded">lang/*.json</code> files — no
            rebuild or deploy needed, changes apply immediately.
        </span>
    </div>

    <form action="{{ route('admin.localization.update') }}" method="POST" id="localization-form">
        @csrf
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="localization-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50 z-10 min-w-[220px]">
                                Key
                            </th>
                            @foreach($locales as $locale)
                            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider min-w-[220px]">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="flex items-center gap-1.5 normal-case font-bold text-gray-700 text-sm">
                                        <span>{{ $meta[$locale]['flag'] ?? '🌐' }}</span>
                                        {{ $meta[$locale]['native'] ?? strtoupper($locale) }}
                                        @if($locale === $defaultLocale)
                                        <span class="text-[10px] font-semibold px-1.5 py-0.5 bg-gray-200 text-gray-600 rounded normal-case">Default</span>
                                        @endif
                                    </span>
                                    @if($locale !== $defaultLocale)
                                    <button type="button"
                                        @click="deleteLocalizationLocale('{{ $locale }}', {{ Js::from($meta[$locale]['name'] ?? $locale) }})"
                                        title="Remove {{ $meta[$locale]['name'] ?? $locale }}"
                                        class="text-gray-300 hover:text-red-500 transition-colors flex-shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                    @endif
                                </div>
                            </th>
                            @endforeach
                            <th scope="col" class="px-4 py-3.5 w-10"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($rows as $i => $row)
                        <tr data-row-search="{{ strtolower($row['key'].' '.implode(' ', $row['values'])) }}">
                            <td class="px-4 py-3 align-top sticky left-0 bg-white z-10">
                                <input type="hidden" name="rows[{{ $i }}][key]" value="{{ $row['key'] }}">
                                <span class="text-sm font-medium text-gray-800 break-words">{{ $row['key'] }}</span>
                            </td>
                            @foreach($locales as $locale)
                            <td class="px-4 py-3 align-top">
                                <input type="text" name="rows[{{ $i }}][values][{{ $locale }}]"
                                    value="{{ $row['values'][$locale] }}"
                                    placeholder="{{ $locale === $defaultLocale ? $row['key'] : '— falls back to '.strtoupper($defaultLocale).' —' }}"
                                    class="w-full px-2.5 py-1.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </td>
                            @endforeach
                            <td class="px-4 py-3 align-top text-right">
                                <button type="button" @click="deleteLocalizationKey({{ Js::from($row['key']) }}, $el)"
                                    title="Delete this key from all languages" class="action-btn delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ count($locales) + 2 }}" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 9h8m-8 4h6m-9 6h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No translation keys yet</h3>
                                <p class="mt-1 text-sm text-gray-500">Add your first one to get started.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="localization-no-results" class="hidden mt-4 text-center text-sm text-gray-400 py-6">
            No keys match your search.
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="px-6 py-2.5 bg-[#1a3c6e] hover:bg-[#153059] text-white text-sm font-semibold rounded-xl shadow-lg shadow-[#1a3c6e]/20 transition-colors">
                Save All Translations
            </button>
        </div>
    </form>

    {{-- Add Key modal --}}
    <div x-show="showAddKey" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="fixed inset-0 bg-gray-500/70 backdrop-blur-sm" @click="showAddKey = false"></div>
            <div class="relative inline-block w-full max-w-lg bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all border border-gray-100 z-10"
                @keydown.escape.window="showAddKey = false">
                <form action="{{ route('admin.localization.keys.store') }}" method="POST">
                    @csrf
                    <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-900">Add Translation Key</h3>
                        <button type="button" @click="showAddKey = false" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Key <span class="text-red-500">*</span></label>
                            <input type="text" name="key" required maxlength="500" placeholder="e.g. Read More"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            <p class="text-xs text-gray-400 mt-1">This is exactly what you'd wrap with <code>__('...')</code> in the code — usually the default-language text itself.</p>
                        </div>
                        @foreach($locales as $locale)
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                {{ $meta[$locale]['flag'] ?? '🌐' }} {{ $meta[$locale]['native'] ?? strtoupper($locale) }}
                                @if($locale === $defaultLocale)<span class="text-gray-400">(default)</span>@endif
                            </label>
                            <input type="text" name="values[{{ $locale }}]"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        @endforeach
                    </div>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                        <button type="button" @click="showAddKey = false" class="px-4 py-2 bg-white border border-gray-300 text-sm font-semibold rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-[#1a3c6e] hover:bg-[#153059] text-white text-sm font-semibold rounded-lg shadow-sm">Add Key</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Add Language modal --}}
    <div x-show="showAddLocale" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="fixed inset-0 bg-gray-500/70 backdrop-blur-sm" @click="showAddLocale = false"></div>
            <div class="relative inline-block w-full max-w-md bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all border border-gray-100 z-10"
                @keydown.escape.window="showAddLocale = false">
                <form action="{{ route('admin.localization.locales.store') }}" method="POST">
                    @csrf
                    <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-900">Add Language</h3>
                        <button type="button" @click="showAddLocale = false" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Locale Code <span class="text-red-500">*</span></label>
                            <input type="text" name="code" required maxlength="10" placeholder="e.g. es, zh, vi"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            <p class="text-xs text-gray-400 mt-1">Creates <code>lang/{code}.json</code>. Use a short ISO code.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Display Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required maxlength="100" placeholder="e.g. Spanish"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Native Name</label>
                            <input type="text" name="native" maxlength="100" placeholder="e.g. Español"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Flag Emoji</label>
                            <input type="text" name="flag" maxlength="10" placeholder="🇪🇸"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                        <button type="button" @click="showAddLocale = false" class="px-4 py-2 bg-white border border-gray-300 text-sm font-semibold rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-[#1a3c6e] hover:bg-[#153059] text-white text-sm font-semibold rounded-lg shadow-sm">Add Language</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function filterLocalizationRows(term) {
        term = term.trim().toLowerCase();
        var visibleCount = 0;

        document.querySelectorAll('#localization-table tbody tr[data-row-search]').forEach(function (tr) {
            var matches = !term || tr.dataset.rowSearch.includes(term);
            tr.style.display = matches ? '' : 'none';
            if (matches) visibleCount++;
        });

        var noResults = document.getElementById('localization-no-results');
        if (noResults) {
            noResults.classList.toggle('hidden', !term || visibleCount > 0);
        }
    }

    function deleteLocalizationKey(key, btn) {
        if (!confirm('Delete "' + key + '" from all languages? This cannot be undone.')) {
            return;
        }

        var destroyUrl = document.getElementById('localization-app').dataset.keysDestroyUrl;

        fetch(destroyUrl, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ key: key }),
        }).then(function (res) {
            if (res.ok) {
                btn.closest('tr').remove();
            } else {
                alert('Could not delete this key.');
            }
        }).catch(function () {
            alert('Could not delete this key.');
        });
    }

    function deleteLocalizationLocale(code, name) {
        if (!confirm('Remove "' + name + '"? Its translation file will be deleted.')) {
            return;
        }

        var urlTemplate = document.getElementById('localization-app').dataset.localeDestroyUrlTemplate;

        fetch(urlTemplate.replace('__LOCALE__', encodeURIComponent(code)), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        }).then(function (res) {
            if (res.ok) {
                window.location.reload();
            } else {
                alert('Could not remove this language.');
            }
        }).catch(function () {
            alert('Could not remove this language.');
        });
    }
</script>
@endpush

@endsection
