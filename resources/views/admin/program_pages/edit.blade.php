@extends('admin.layouts.app')

@section('title', 'Edit Item: ' . $item->title)
@section('page-title', 'Edit Page Item')
@section('breadcrumb')
    <a href="{{ route('admin.program-pages.index') }}" class="hover:text-[#2d6fa3] transition-colors">Additional Pages</a> / Edit
@endsection

@section('content')
<div class="mx-auto max-w-6xl">
    <form id="main-update-form" action="{{ route('admin.program-pages.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="bilingualForm()">
        @csrf
        @method('PUT')
        @include('admin.program_pages._form')
    </form>

    <form id="delete-item-form" action="{{ route('admin.program-pages.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this item permanently?');" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection
