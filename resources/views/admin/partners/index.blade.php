@extends('admin.layouts.app')

@section('title', 'Partners')
@section('page-title', 'Partners')
@section('breadcrumb', 'Manage partner organisations displayed on the About page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6 mb-6">
    {{-- Add partner form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Partner</h3>
        <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Name <span class="text-red-400">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Partner name...">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Category <span class="text-red-400">*</span></label>
                <select name="category" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] bg-white">
                    <option value="authorities">Cambodian Authorities</option>
                    <option value="organizations">Organizations / Foundations</option>
                    <option value="companies">Companies</option>
                    <option value="towns">Towns & Municipalities</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Country (optional)</label>
                <input type="text" name="country" value="{{ old('country') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="e.g. Switzerland">
            </div>
            <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Partner</button>
        </form>
    </div>

    {{-- Partner lists --}}
    <div class="lg:col-span-2 space-y-5">
        @foreach(['authorities' => '🇰🇭 Cambodian Authorities', 'organizations' => '🏛️ Organizations & Foundations', 'companies' => '🏢 Companies', 'towns' => '🏙️ Towns & Municipalities'] as $cat => $catLabel)
        @if(isset($partners[$cat]) && $partners[$cat]->count())
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
                <h4 class="font-semibold text-gray-700 text-sm">{{ $catLabel }}</h4>
                <span class="text-xs text-gray-400">{{ $partners[$cat]->count() }} entries</span>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($partners[$cat] as $partner)
                <div class="flex items-center justify-between px-5 py-3 hover:bg-gray-50/50">
                    <div>
                        <span class="text-sm text-gray-700">{{ $partner->name }}</span>
                        @if($partner->country)
                        <span class="text-xs text-gray-400 ml-2">· {{ $partner->country }}</span>
                        @endif
                        @if(!$partner->is_active)
                        <span class="ml-2 px-1.5 py-0.5 bg-gray-100 text-gray-400 text-xs rounded">hidden</span>
                        @endif
                    </div>
                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                          onsubmit="return confirm('Remove {{ addslashes($partner->name) }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-300 hover:text-red-500 transition-colors p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach

        @if($partners->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
            No partners yet. Add your first one using the form.
        </div>
        @endif
    </div>
</div>

@endsection
