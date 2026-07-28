@extends('admin.layouts.app')

@section('title', 'Edit Office')
@section('page-title', 'Edit Office')
@section('breadcrumb', 'Offices → ' . $office->country)

@section('content')

<div>
    <form action="{{ route('admin.offices.update', $office) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        @include('admin.offices._form')

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Update Office</button>
            <a href="{{ route('admin.offices.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

@endsection
