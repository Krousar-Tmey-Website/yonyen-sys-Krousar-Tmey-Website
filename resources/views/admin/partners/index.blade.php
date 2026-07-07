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

                    <label class="text-xs font-semibold text-gray-600">
                        Partner Name
                    </label>


                    <input type="text" name="name" required value="{{ old('name', $editPartner->name ?? '') }}"
                        class="mt-1 w-full rounded-xl border-gray-200 text-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter partner name">


                </div>





                {{-- CATEGORY --}}
                <div>

                    <label class="text-xs font-semibold text-gray-600">
                        Category
                    </label>


                    <select name="category" class="mt-1 w-full rounded-xl border-gray-200 text-sm">


                        @foreach ([
            'authorities' => 'Cambodian Authorities',
            'organizations' => 'Organizations / Foundations',
            'companies' => 'Companies',
            'towns' => 'Towns & Municipalities',
        ] as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('category', $editPartner->category ?? '') == $value ? 'selected' : '' }}>

                                {{ $label }}

                            </option>
                        @endforeach


                    </select>

                </div>






                {{-- COUNTRY --}}
                <div>

                    <label class="text-xs font-semibold text-gray-600">
                        Country
                    </label>


                    <input type="text" name="country" value="{{ old('country', $editPartner->country ?? '') }}"
                        class="mt-1 w-full rounded-xl border-gray-200 text-sm" placeholder="Example: Switzerland">


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
                    <label for="logo"
                        class="group flex flex-col items-center justify-center w-full h-40 
        border-2 border-dashed border-gray-200 rounded-2xl 
        cursor-pointer bg-gray-50 hover:bg-gray-100 
        transition duration-200">

                        <div class="flex flex-col items-center justify-center">

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


                        <input id="logo" type="file" name="logo" accept="image/*" class="hidden">

                    </label>



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
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-xl py-2.5 text-sm font-medium transition">


                    {{ isset($editPartner) ? 'Update Partner' : 'Add Partner' }}


                </button>


            </form>


        </div>







        {{-- LIST --}}
        <div class="lg:col-span-2 space-y-5">


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

                        @foreach ($partners[$cat] as $partner)
                            <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">


                                <div class="flex items-center gap-4">


                                    @if ($partner->logo)
                                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->title }}"
                                            class="w-20 h-20 rounded-[15px] object-cover border-8 border-white shadow-2xl bg-white">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400 text-xs">

                                            N/A

                                        </div>
                                    @endif




                                    <div>


                                        <p class="text-sm font-medium text-gray-800">

                                            {{ $partner->name }}

                                        </p>



                                        @if ($partner->country)
                                            <p class="text-xs text-gray-400">

                                                {{ $partner->country }}

                                            </p>
                                        @endif



                                        @if (!$partner->is_active)
                                            <span
                                                class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full bg-gray-100 text-gray-500">

                                                Hidden

                                            </span>
                                        @endif


                                    </div>


                                </div>






                                <div class="flex gap-2">


                                    <a href="{{ route('admin.partners.edit', $partner) }}"
                                        class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 text-xs hover:bg-blue-100">

                                        Edit

                                    </a>




                                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                        onsubmit="return confirm('Delete this partner?')">


                                        @csrf
                                        @method('DELETE')


                                        <button
                                            class="px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs hover:bg-red-100">

                                            Delete

                                        </button>


                                    </form>


                                </div>


                            </div>
                        @endforeach


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
