@extends('admin.layouts.app')

@section('title', 'Edit Partner')
@section('page-title', $partner->name)
@section('breadcrumb', 'Partners → ' . $partner->name)

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                @if ($partner->logo)
                    <img src="{{ asset('storage/' . $partner->logo) }}"
                         alt="{{ $partner->name }}"
                         class="w-12 h-12 rounded-xl object-cover border border-gray-100 bg-white">
                @else
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-400 text-lg font-bold">
                        {{ Str::substr($partner->name, 0, 1) }}
                    </div>
                @endif
                <div>
                    <h3 class="font-bold text-gray-800">Edit Partner</h3>
                    <p class="text-sm text-gray-400 mt-0.5">Update the partner name, category, or logo.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.partners._form', ['partner' => $partner])

            {{-- Actions --}}
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('admin.partners.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl text-sm font-semibold transition-all flex items-center gap-2 shadow-sm hover:shadow-md hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Update Partner
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
