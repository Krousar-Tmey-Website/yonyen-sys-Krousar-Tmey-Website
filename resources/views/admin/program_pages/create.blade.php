@extends('admin.layouts.app')

@section('title', 'Add Page Item')
@section('page-title', 'Add Page Item')
@section('breadcrumb')
    <a href="{{ route('admin.program-pages.index') }}" class="hover:text-[#2d6fa3] transition-colors">Additional Pages</a> / Add
@endsection

@section('content')
<div class="mx-auto max-w-6xl">
    <form action="{{ route('admin.program-pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="bilingualForm()">
        @csrf
        @include('admin.program_pages._form')
    </form>
</div>
@endsection
