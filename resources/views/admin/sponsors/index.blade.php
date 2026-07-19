@extends('admin.layouts.app')

@section('title', 'Sponsors')
@section('page-title', 'Sponsors')
@section('breadcrumb', 'Manage sponsors displayed on the Home page')

@section('content')

<div x-data="{ showModal: false, selectedSponsor: {} }">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Sponsors</h2>
            <p class="mt-1 text-sm text-gray-500">Manage the sponsors displayed on your homepage.</p>
        </div>
        <a href="{{ route('admin.sponsors.create') }}" class="inline-flex items-center px-4 py-2 bg-[#1a3c6e] text-white text-sm font-medium rounded-md shadow-sm hover:bg-[#153059] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1a3c6e]">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Sponsor
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-md flex items-center shadow-sm">
            <svg class="h-5 w-5 mr-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Logo</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sponsor Name</th>
                        <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Order</th>
                        <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($sponsors as $sponsor)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div @click='selectedSponsor = @json($sponsor); showModal = true;' 
                                class="flex items-center justify-center h-14 w-20 bg-gray-50 rounded-lg border border-gray-100 p-2 cursor-pointer hover:border-indigo-300 hover:shadow-sm transition-all"
                                title="Click to view details">
                                    @if($sponsor->logo)
                                        <img src="{{ str_starts_with($sponsor->logo, 'http') ? $sponsor->logo : asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}" class="max-h-full max-w-full object-contain">
                                    @else
                                        <span class="text-xs text-gray-400 font-medium">No Logo</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $sponsor->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($sponsor->is_active)
                                    <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full bg-green-100 text-green-800 border border-green-200">Active</span>
                                @else
                                    <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full bg-gray-100 text-gray-600 border border-gray-200">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 font-medium">
                                {{ $sponsor->sort_order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" @click='selectedSponsor = @json($sponsor); showModal = true;' class="action-btn view" title="View sponsor details">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <a href="{{ route('admin.sponsors.edit', $sponsor) }}" class="action-btn edit" title="Edit sponsor">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.sponsors.destroy', $sponsor) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to permanently delete this sponsor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete sponsor">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No sponsors</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new sponsor.</p>
                                <div class="mt-6">
                                    <a href="{{ route('admin.sponsors.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#1a3c6e] hover:bg-[#153059]">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Sponsor
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- View Sponsor Modal -->
    <div x-show="showModal" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500/70 backdrop-blur-sm" @click="showModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-100 z-10"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 @keydown.escape.window="showModal = false">
                
                <!-- Header -->
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 leading-tight">Sponsor Profile</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Overview of sponsor information & display status</p>
                        </div>
                    </div>
                    <button @click="showModal = false" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-all focus:outline-none">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                        <!-- Left Column: Logo preview -->
                        <div class="md:col-span-2 flex flex-col items-center">
                            <div class="w-full h-48 bg-gray-50/80 rounded-2xl border border-gray-200/60 p-5 flex items-center justify-center shadow-inner relative overflow-hidden group">
                                <template x-if="selectedSponsor.logo">
                                    <img :src="selectedSponsor.logo ? (selectedSponsor.logo.startsWith('http') ? selectedSponsor.logo : '{{ asset('storage') }}/' + selectedSponsor.logo) : ''" :alt="selectedSponsor.name" class="max-h-full max-w-full object-contain rounded-lg relative z-10 transition-transform duration-300 group-hover:scale-105">
                                </template>
                                <template x-if="!selectedSponsor.logo">
                                    <div class="flex flex-col items-center justify-center text-gray-400 relative z-10">
                                        <svg class="w-12 h-12 mb-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs font-semibold">No Logo Image</span>
                                    </div>
                                </template>
                            </div>
                            <span class="text-[11px] text-gray-400 font-bold uppercase tracking-wider mt-3">Sponsor Logo</span>
                        </div>

                        <!-- Right Column: Information Cards -->
                        <div class="md:col-span-3 space-y-4">
                            <!-- Name -->
                            <div class="bg-gray-50/50 rounded-xl p-4 border border-gray-200/50">
                                <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Sponsor Name</span>
                                <span class="text-sm font-semibold text-gray-900 leading-snug" x-text="selectedSponsor.name"></span>
                            </div>

                            <!-- Website URL -->
                            <div class="bg-gray-50/50 rounded-xl p-4 border border-gray-200/50">
                                <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Website Link</span>
                                <template x-if="selectedSponsor.url">
                                    <a :href="selectedSponsor.url" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-700 hover:bg-indigo-100 hover:text-indigo-900 transition-all font-semibold text-xs break-all">
                                        <span x-text="selectedSponsor.url"></span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </template>
                                <template x-if="!selectedSponsor.url">
                                    <span class="text-xs text-gray-400 italic font-semibold flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                        No website link provided
                                    </span>
                                </template>
                            </div>

                            <!-- Status & Position Grid -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50/50 rounded-xl p-4 border border-gray-200/50 flex flex-col justify-between">
                                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Display Status</span>
                                    <div>
                                        <template x-if="selectedSponsor.is_active">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                Active
                                            </span>
                                        </template>
                                        <template x-if="!selectedSponsor.is_active">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                                Inactive
                                            </span>
                                        </template>
                                    </div>
                                </div>

                                <div class="bg-gray-50/50 rounded-xl p-4 border border-gray-200/50">
                                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Sort Position</span>
                                    <span class="text-xl font-black text-gray-800" x-text="selectedSponsor.sort_order"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <a :href="'/admin/sponsors/' + selectedSponsor.id + '/edit'" x-show="selectedSponsor.id" class="px-4 py-2 bg-[#1a3c6e] hover:bg-[#153059] text-white text-sm font-semibold rounded-lg shadow-sm transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Quick Edit
                    </a>
                    <button @click="showModal = false" class="px-4 py-2 bg-white border border-gray-300 text-sm font-semibold rounded-lg text-gray-700 hover:bg-gray-50 transition-colors shadow-sm focus:outline-none">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
