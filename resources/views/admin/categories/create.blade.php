@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css'])
@endpush

@section('title', 'New Category')
@section('page-title', 'Create Category')
@section('breadcrumb', 'Categories → Create')

@section('content')

<div class="form-container">
    <form action="{{ route('admin.categories.store') }}" method="POST" id="categoryForm">
        @csrf

        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <h3>Category Details</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Category Name <span class="required">*</span></label>
                    <input type="text" name="CategoryName" value="{{ old('CategoryName') }}" required
                           class="form-control @error('CategoryName') error @enderror"
                           placeholder="Enter category name...">
                    @error('CategoryName')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">This will be used as the display name for the category.</div>
                </div>

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Description <span class="optional">(optional)</span></label>
                    <textarea name="Description" rows="3" class="form-control textarea @error('Description') error @enderror"
                              placeholder="Brief description of this category...">{{ old('Description') }}</textarea>
                    <div class="form-helper">A short description for the category (optional).</div>
                    @error('Description')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Category
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

@endsection