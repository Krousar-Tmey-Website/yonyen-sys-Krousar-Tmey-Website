@extends('admin.layouts.app')

@section('title', 'Add Office')
@section('page-title', 'Add Office')
@section('breadcrumb', 'Offices → Create')

@section('content')

<div>
    <form action="{{ route('admin.offices.store') }}" method="POST" class="space-y-6">
        @csrf
        @include('admin.offices._form')

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Save Office</button>
            <a href="{{ route('admin.offices.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

@endsection
