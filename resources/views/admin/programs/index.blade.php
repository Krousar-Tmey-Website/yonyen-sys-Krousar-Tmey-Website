@extends('admin.layouts.app')
@section('title', 'Programs')
@section('page-title', 'Programs')
@section('breadcrumb', 'Manage programs shown on the Our Programs page')

@section('content')



<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-gray-700 font-semibold">All Programs
            <span class="text-gray-400 font-normal text-sm ml-1">({{ $programs->count() }} total)</span>
        </h2>
        <p class="text-xs text-gray-400 mt-0.5">Each program appears as a section on the public <a href="{{ route('programs') }}" target="_blank" class="text-[#2d6fa3] hover:underline">Our Programs</a> page.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('programs') }}" target="_blank"
           class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-medium text-[#2d6fa3] border border-[#2d6fa3]/30 bg-[#2d6fa3]/5 hover:bg-[#2d6fa3]/10 rounded-xl transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            View Live Page
        </a>
        <a href="{{ route('admin.programs.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Program
        </a>
    </div>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($programs as $program)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
        {{-- Thumbnail --}}
        <div class="relative">
            @if($program->image)
            <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-36 object-cover">
            @else
            <div class="w-full h-36 bg-[#1a3c6e]/8 flex items-center justify-center text-gray-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            @endif
            <span class="absolute top-2 right-2 px-2 py-0.5 rounded-full text-xs font-medium {{ $program->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                {{ $program->is_active ? 'Active' : 'Hidden' }}
            </span>
        </div>

        <div class="p-5">
            <h3 class="font-semibold text-gray-800 text-sm leading-snug mb-1">{{ $program->title }}</h3>
            @if($program->description)
            <p class="text-gray-400 text-xs leading-relaxed mb-3 line-clamp-2">{{ $program->description }}</p>
            @endif


            {{-- Social links preview --}}
            @if($program->facebook_url || $program->linkedin_url || $program->instagram_url || $program->telegram_url || $program->youtube_url)
            <div class="flex flex-wrap gap-1.5 mb-3 items-center">
                <span class="text-xs text-gray-400 mr-1">Socials:</span>
                @if($program->facebook_url)
                <span class="w-5 h-5 text-white rounded flex items-center justify-center" style="background-color: #1877f2;" title="Facebook">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </span>
                @endif
                @if($program->telegram_url)
                <span class="w-5 h-5 text-white rounded flex items-center justify-center" style="background-color: #0088cc;" title="Telegram">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M9.78 18.65l.28-4.28 7.68-6.92c.34-.3-.07-.46-.52-.18L7.74 13.3 3.64 12c-.88-.28-.9-.88.18-1.3l16.1-6.2c.74-.28 1.38.16 1.14 1.25l-2.74 12.92c-.2 1-.8 1.24-1.64.78l-4.18-3.08-2.02 1.95c-.22.22-.4.4-.78.4z"/></svg>
                </span>
                @endif
                @if($program->linkedin_url)
                <span class="w-5 h-5 text-white rounded flex items-center justify-center" style="background-color: #0a66c2;" title="LinkedIn">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </span>
                @endif
                @if($program->instagram_url)
                <span class="w-5 h-5 text-white rounded flex items-center justify-center" style="background-color: #e1306c;" title="Instagram">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                </span>
                @endif
                @if($program->youtube_url)
                <span class="w-5 h-5 text-white rounded flex items-center justify-center" style="background-color: #ff0000;" title="YouTube">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.516 0-9.387.507a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11c1.871.507 9.387.507 9.387.507s7.517 0 9.387-.507a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </span>
                @endif
            </div>
            @endif

            <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.programs.edit', $program) }}"
                       class="inline-flex items-center gap-1.5 text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.programs.destroy', $program) }}" method="POST"
                          onsubmit="return confirm('Delete &quot;{{ addslashes($program->title) }}&quot;? This cannot be undone.');" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1.5 text-red-400 hover:text-red-700 text-xs font-medium">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete
                        </button>
                    </form>
                </div>
                <a href="{{ route('programs') }}#{{ $program->slug }}" target="_blank"
                   class="inline-flex items-center gap-1 text-gray-400 hover:text-[#2d6fa3] text-xs transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Live
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-16 text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        <p class="text-sm font-medium">No programs yet</p>
        <a href="{{ route('admin.programs.create') }}" class="mt-3 inline-block text-[#2d6fa3] text-sm hover:underline">Create the first program</a>
    </div>
    @endforelse
</div>

@endsection