@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')
@section('breadcrumb', 'Categories → ' . Str::limit($category->CategoryName, 40))

@section('content')

<div class="form-container">
    {{-- Main Form --}}
    <form action="{{ route('admin.categories.update', ['category' => $category->CategoryID]) }}" method="POST" id="categoryForm">
        @csrf @method('PUT')

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
                    <input type="text" name="CategoryName" value="{{ old('CategoryName', $category->CategoryName) }}" required
                           class="form-control @error('CategoryName') error @enderror"
                           placeholder="Enter category name...">
                    @error('CategoryName')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">This will be used as the display name for the category.</div>
                </div>

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Description <span class="optional">(optional)</span></label>
                    <textarea name="Description" rows="3" class="form-control textarea @error('Description') error @enderror"
                              placeholder="Brief description of this category...">{{ old('Description', $category->Description) }}</textarea>
                    <div class="form-helper">A short description for the category (optional).</div>
                    @error('Description')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Update Category
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>

    {{-- Danger Zone --}}
    <div class="form-card danger-zone">
        <div class="card-header danger">
            <div class="icon red">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3>Danger Zone</h3>
            <span class="badge">Irreversible</span>
        </div>
        <div class="card-body danger">
            <div class="danger-content">
                <div class="danger-text">
                    <p class="title">Delete this category</p>
                    <p class="desc">This action cannot be undone. All articles in this category may be affected.</p>
                </div>
                <form action="{{ route('admin.categories.destroy', ['category' => $category->CategoryID]) }}" method="POST"
                      onsubmit="return confirm('⚠️ Permanently delete this category?\n\nThis action cannot be undone.')"
                      class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection