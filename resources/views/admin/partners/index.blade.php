@extends('admin.layouts.app')

@section('title', 'Partners')
@section('page-title', 'Partners')
@section('breadcrumb', 'Manage partner organisations displayed on the About page')


@section('content')

    <div class="grid lg:grid-cols-3 gap-6">


        {{-- FORM CARD --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-fit">


            <div class="flex items-center justify-between mb-5">

                <div>
                    <h3 class="font-bold text-gray-800">
                        {{ isset($editPartner) ? 'Edit Partner' : 'Add Partner' }}
                    </h3>

                    <p class="text-xs text-gray-400 mt-1">
                        Manage partner information
                    </p>
                </div>


                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">

                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />

                    </svg>

                </div>

            </div>




            <form
                action="{{ isset($editPartner) ? route('admin.partners.update', $editPartner) : route('admin.partners.store') }}"
                method="POST" enctype="multipart/form-data" class="space-y-4">


                @csrf


                @if (isset($editPartner))
                    @method('PUT')
                @endif





                {{-- NAME --}}
                <div>

                    <label for="name" class="text-xs font-semibold text-gray-600">
                        Partner Name <span class="text-red-400">*</span>
                    </label>

                    <div class="relative mt-1">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2M5 21H3m4-14h.01M11 7h.01M7 11h.01M11 11h.01M7 15h.01M11 15h.01" />
                        </svg>

                        <input type="text" id="name" name="name" required autocomplete="off"
                            value="{{ old('name', $editPartner->name ?? '') }}"
                            class="w-full rounded-xl text-sm pl-10 transition
                                {{ $errors->has('name')
                                    ? 'border-red-300 focus:ring-red-400 focus:border-red-400'
                                    : 'border-gray-200 focus:ring-blue-500 focus:border-blue-500' }}"
                            placeholder="Enter partner name">
                    </div>

                    @error('name')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror

                </div>





                {{-- CATEGORY --}}
                <div>

                    <label for="category" class="text-xs font-semibold text-gray-600">
                        Category <span class="text-red-400">*</span>
                    </label>

                    <div class="relative mt-1">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v2a2 2 0 002 2m14 0v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6" />
                        </svg>

                        <select id="category" name="category"
                            class="w-full rounded-xl text-sm pl-10 pr-9 appearance-none bg-white transition
                                {{ $errors->has('category')
                                    ? 'border-red-300 focus:ring-red-400 focus:border-red-400'
                                    : 'border-gray-200 focus:ring-blue-500 focus:border-blue-500' }}">

                            @foreach ($categories as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('category', $editPartner->category ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>

                        <svg class="w-4 h-4 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    @error('category')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror

                </div>






                {{-- COUNTRY --}}
                <div>

                    <label for="country" class="text-xs font-semibold text-gray-600">
                        Country <span class="text-gray-300 font-normal">(optional)</span>
                    </label>

                    <div class="relative mt-1">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h1A1.5 1.5 0 0113 9.5v0A1.5 1.5 0 0014.5 11h1a1.5 1.5 0 011.5 1.5v0a1.5 1.5 0 001.5 1.5h1.535M15 21v-2a2 2 0 012-2h1.535M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <input type="text" id="country" name="country" autocomplete="off"
                            value="{{ old('country', $editPartner->country ?? '') }}"
                            class="w-full rounded-xl border-gray-200 text-sm pl-10 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Example: Switzerland">
                    </div>

                </div>






                {{-- LOGO --}}
                <div>
                    <label class="text-sm font-semibold text-gray-700">
                        Partner Logo
                    </label>

                    <p class="text-xs text-gray-400 mt-1 mb-3">
                        Upload your partner organization's logo (PNG, JPG, SVG recommended)
                    </p>


                    {{-- Upload Box --}}
                    <label for="logo" id="logo-dropzone"
                        class="group flex flex-col items-center justify-center w-full h-40 
        border-2 border-dashed border-gray-200 rounded-2xl 
        cursor-pointer bg-gray-50 hover:bg-gray-100 
        transition duration-200">

                        <div class="flex flex-col items-center justify-center" id="logo-placeholder">

                            <div
                                class="w-12 h-12 rounded-full bg-white shadow-sm 
                        flex items-center justify-center mb-3
                        group-hover:scale-110 transition">

                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117.9 9H18a4 4 0 010 8h-1m-4-4l-3-3m0 0l-3 3m3-3v12" />
                                </svg>

                            </div>


                            <p class="text-sm text-gray-600 font-medium">
                                Click to upload logo
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                PNG, JPG or SVG (max 2MB)
                            </p>

                        </div>

                        <div class="hidden flex-col items-center justify-center gap-2" id="logo-selected">
                            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm font-medium text-gray-700 px-4 text-center truncate max-w-full" id="logo-filename"></p>
                            <p class="text-xs text-blue-500">Click to choose a different file</p>
                        </div>


                        <input id="logo" type="file" name="logo" accept="image/*" class="hidden"
                            onchange="
                                const f = this.files[0];
                                if (f) {
                                    document.getElementById('logo-placeholder').classList.add('hidden');
                                    document.getElementById('logo-selected').classList.remove('hidden');
                                    document.getElementById('logo-selected').classList.add('flex');
                                    document.getElementById('logo-filename').textContent = f.name;
                                }
                            ">

                    </label>

                    @error('logo')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror



                    {{-- Existing Logo --}}
                    @if (isset($editPartner) && $editPartner->logo)
                        <div class="mt-5">

                            <p class="text-xs font-semibold text-gray-500 mb-2">
                                Current Logo
                            </p>


                            <div
                                class="flex items-center gap-4 
                    bg-gray-50 border border-gray-100 
                    rounded-2xl p-4">


                                <div
                                    class="w-20 h-20 bg-white rounded-xl 
                        border border-gray-100 
                        flex items-center justify-center">

                                    <img src="{{ asset('storage/' . $editPartner->logo) }}"
                                        class="max-w-full max-h-full object-contain p-2">

                                </div>


                                <div>

                                    <p class="text-sm font-medium text-gray-700">
                                        Partner Logo
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        Currently uploaded
                                    </p>

                                </div>


                            </div>

                        </div>
                    @endif


                </div>





                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-xl py-2.5 text-sm font-medium transition flex items-center justify-center gap-2">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if (isset($editPartner))
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        @endif
                    </svg>

                    {{ isset($editPartner) ? 'Update Partner' : 'Add Partner' }}

                </button>


            </form>


        </div>








        {{-- LIST --}}
        <div class="lg:col-span-2 space-y-5">


            @php
                $hasSearch = filled($filters['search'] ?? null);
                $hasCategory = filled($filters['category'] ?? null);
                $activeCount = ($hasSearch ? 1 : 0) + ($hasCategory ? 1 : 0);
                $totalPartners = collect($partners)->sum(fn($group) => $group->count());
            @endphp

            {{-- LIST HEADER: title + count chip + search + filter, styled like the mockup's toolbar --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div class="flex items-center justify-between flex-wrap gap-4 mb-4">

                    <div class="flex items-center gap-2">
                        <h3 class="font-bold text-gray-800">All Partners</h3>
                        <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold">
                            Showing {{ $totalPartners }}
                        </span>
                    </div>

                    @if ($activeCount > 0)
                        <span class="px-2.5 py-1 bg-gray-50 border border-gray-100 text-gray-500 text-xs font-medium rounded-full">
                            {{ $activeCount }} {{ Str::plural('filter', $activeCount) }} applied
                        </span>
                    @endif

                </div>

                <form method="GET" action="{{ route('admin.partners.index') }}" class="flex flex-wrap items-center gap-3">

                    {{-- Search pill --}}
                    <div class="relative flex-1 min-w-[220px]">
                        <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                            placeholder="Search partner name..."
                            class="w-full bg-gray-50 border border-gray-100 rounded-full pl-10 pr-4 py-2.5 text-sm text-gray-600 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                    {{-- Category filter styled like a "Filter" pill button --}}
                    <div class="relative">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-9.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <select name="category" onchange="this.form.submit()"
                            class="pl-10 pr-8 py-2.5 rounded-full border border-gray-200 text-sm font-medium text-gray-600 bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-100">
                            <option value="">All Categories</option>
                            @foreach ($categories as $value => $label)
                                <option value="{{ $value }}"
                                    {{ ($filters['category'] ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <svg class="w-3.5 h-3.5 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-full text-sm font-semibold transition">
                        Search
                    </button>

                    @if ($activeCount > 0)
                        <a href="{{ route('admin.partners.index') }}"
                            class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-full text-sm font-medium transition">
                            Reset
                        </a>
                    @endif

                </form>

            </div>


            {{-- PARTNER TABLES, still grouped by category — same flow as before, restyled --}}
            @foreach ([
            'authorities' => '🇰🇭 Cambodian Authorities',
            'organizations' => '🏛️ Organizations & Foundations',
            'companies' => '🏢 Companies',
            'towns' => '🏙️ Towns & Municipalities',
        ] as $cat => $catLabel)
                @if (isset($partners[$cat]) && $partners[$cat]->count())
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">


                        <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">

                            <h4 class="font-semibold text-gray-700 text-sm">
                                {{ $catLabel }}
                            </h4>

                            <span class="px-3 py-1 bg-white rounded-full text-xs text-gray-400 border">
                                {{ $partners[$cat]->count() }}
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
                                @foreach ($partners[$cat] as $partner)
                                    <tr class="border-t border-gray-50 hover:bg-gray-50/60 transition">

                                        {{-- Partner (avatar + name) --}}
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">

                                                @if ($partner->logo)
                                                    <img src="{{ asset('storage/' . $partner->logo) }}"
                                                        alt="{{ $partner->name }}"
                                                        class="w-10 h-10 rounded-full object-cover border border-gray-100 bg-white">
                                                @else
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-400 text-xs font-semibold">
                                                        {{ Str::substr($partner->name, 0, 1) }}
                                                    </div>
                                                @endif

                                                <span class="font-medium text-gray-800">{{ $partner->name }}</span>

                                            </div>
                                        </td>

                                        {{-- Country --}}
                                        <td class="px-6 py-4 text-gray-500">
                                            {{ $partner->country ?? '—' }}
                                        </td>

                                        {{-- Status pill --}}
                                        <td class="px-6 py-4">
                                            @if ($partner->is_active)
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">
                                                    Active
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">
                                                    Hidden
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">

                                                <a href="{{ route('admin.partners.edit', $partner) }}" title="Edit"
                                                    class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center transition">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                                    onsubmit="return confirm('Delete this partner?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete"
                                                        class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
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


            @if ($partners->isEmpty())
                <div class="bg-white rounded-2xl border py-16 text-center">

                    <div class="text-gray-300 text-4xl mb-3">
                        🤝
                    </div>

                    <p class="text-gray-500 text-sm">
                        No partners available
                    </p>

                    <p class="text-gray-400 text-xs mt-1">
                        Add your first partner using the form
                    </p>

                </div>
            @endif


        </div>


    </div>


@endsection