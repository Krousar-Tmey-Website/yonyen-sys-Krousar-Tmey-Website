@extends('admin.layouts.app')

@section('title', 'Awards')
@section('page-title', 'Awards')
@section('breadcrumb', 'Manage awards displayed on the Awards page')

@section('content')

<div class="form-container">
    {{-- Header with Add Button --}}
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-400">{{ $awards->count() }} award(s) · displayed on Awards page and About page</p>
        <a href="{{ route('admin.awards.create') }}" class="btn-primary text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Award
        </a>
    </div>

    {{-- Awards List --}}
    <div class="form-card">
        <div class="card-header table-header--blue">
            <div class="icon blue">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3>Awards & Recognitions</h3>
            <span class="badge">{{ $awards->count() }} total</span>
        </div>
        <div class="card-body">
            @if($awards->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="empty-title">No awards yet</h4>
                <p class="empty-desc">Add your first award to display on the Awards page and About page.</p>
                <a href="{{ route('admin.awards.create') }}" class="inline-flex items-center gap-2 mt-4 text-[#2d6fa3] font-medium hover:text-[#1a4a7a] transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add your first award
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Organization</th>
                            <th>Recipient</th>
                            <th>Link</th>
                            <th class="th-width-100 th-text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($awards as $award)
                        <tr>
                            <td>
                                @if($award->image)
                                <img src="{{ $award->image_url }}" alt="{{ $award->title }}" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                <span class="text-xl">{{ $award->icon }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="font-medium text-gray-700">{{ $award->title }}</span>
                            </td>
                            <td>
                                <span class="text-sm text-gray-600">{{ $award->organization }}</span>
                            </td>
                            <td>
                                <span class="text-sm text-gray-600">{{ $award->recipient ?? '-' }}</span>
                            </td>
                            <td>
                                @if($award->link_url)
                                <a href="{{ $award->link_url }}" target="_blank" rel="noopener" class="text-xs text-[#2d6fa3] hover:underline">
                                    {{ $award->link_text ?? ucfirst($award->link_type) }} →
                                </a>
                                @else
                                <span class="text-gray-300 text-xs">-</span>
                                @endif
                            </td>
                             <td>
                                 <div class="flex items-center justify-end gap-1">
                                     {{-- View Button --}}
                                     <a href="{{ route('awards') }}" 
                                        class="action-btn btn-view" 
                                        title="View awards page"
                                        target="_blank">
                                         <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"/>
                                         </svg>
                                     </a>

                                     {{-- Edit Button --}}
                                     <a href="{{ route('admin.awards.edit', $award) }}"
                                        class="action-btn btn-edit"
                                        title="Edit award">
                                         <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                         </svg>
                                     </a>

                                     {{-- Delete Button --}}
                                     <form action="{{ route('admin.awards.destroy', $award) }}" method="POST"
                                           onsubmit="return confirm('Remove this award?')"
                                           class="inline">
                                         @csrf @method('DELETE')
                                         <button type="submit" class="action-btn btn-delete" title="Delete award">
                                             <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
        </div>
    </div>
</div>

@endsection