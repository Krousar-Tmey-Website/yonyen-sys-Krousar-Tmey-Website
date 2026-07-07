@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')
@section('breadcrumb', 'Categories → ' . Str::limit($category->CategoryName, 40))

@section('content')

<style>
    .form-container {
        max-width: 100%;
        padding: 0;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .form-card {
        background: #ffffff;
        border: none;
        border-bottom: 1px solid #e9ecef;
        overflow: hidden;
    }
    .form-card:last-child {
        border-bottom: none;
    }
    .form-card.danger-zone {
        border: 1px solid #fecaca;
        border-radius: 12px;
        margin-top: 16px;
    }

    .card-header {
        padding: 14px 24px;
        background: #fafbfc;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .card-header .icon {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .card-header .icon.blue { background: #e3f0ff; color: #1a73e8; }
    .card-header .icon.red { background: #fee2e2; color: #dc2626; }
    .card-header .icon svg { width: 16px; height: 16px; }
    .card-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    .card-header .badge {
        font-size: 11px;
        color: #94a3b8;
        margin-left: auto;
        background: #f1f4f9;
        padding: 2px 12px;
        border-radius: 12px;
    }
    .card-header.danger {
        background: #fef2f2;
        border-bottom-color: #fecaca;
    }
    .card-header.danger h3 {
        color: #991b1b;
    }
    .card-header.danger .badge {
        background: #fee2e2;
        color: #991b1b;
    }

    .card-body {
        padding: 20px 24px;
    }
    .card-body.danger {
        background: #fef2f2;
    }

    .form-group {
        margin-bottom: 16px;
    }
    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #334155;
        margin-bottom: 5px;
    }
    .form-label .required {
        color: #ef4444;
    }
    .form-label .optional {
        font-weight: 400;
        color: #94a3b8;
        font-size: 12px;
    }

    .form-control {
        width: 100%;
        padding: 9px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
        background: #fafbfc;
        color: #0f172a;
    }
    .form-control:focus {
        outline: none;
        border-color: #2d6fa3;
        box-shadow: 0 0 0 3px rgba(45, 111, 163, 0.08);
        background: #ffffff;
    }
    .form-control:hover {
        background: #ffffff;
    }
    .form-control::placeholder {
        color: #a0aec0;
    }
    .form-control.error {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .form-control.textarea {
        min-height: 100px;
        resize: vertical;
        line-height: 1.6;
    }

    .form-helper {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 5px;
    }

    .form-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 4px;
    }

    .form-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        padding: 16px 24px;
        background: #fafbfc;
        border-top: 1px solid #e9ecef;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 28px;
        background: #2d6fa3;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background: #1a4a7a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(45,111,163,0.25);
    }
    .btn-primary svg {
        width: 18px;
        height: 18px;
    }

    .btn-cancel {
        padding: 10px 20px;
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        background: none;
        border: none;
        cursor: pointer;
        border-radius: 6px;
    }
    .btn-cancel:hover {
        color: #0f172a;
        background: #f1f5f9;
    }

    .btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: #ef4444;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }
    .btn-danger svg {
        width: 18px;
        height: 18px;
    }

    .danger-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .danger-content .danger-text {
        flex: 1;
    }
    .danger-content .danger-text p {
        margin: 0;
    }
    .danger-content .danger-text .title {
        font-size: 14px;
        font-weight: 500;
        color: #1e293b;
    }
    .danger-content .danger-text .desc {
        font-size: 13px;
        color: #64748b;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 16px;
        }
        .card-header {
            padding: 12px 16px;
        }
        .form-actions {
            flex-direction: column;
            align-items: stretch !important;
            padding: 16px !important;
        }
        .form-actions .btn-primary,
        .form-actions .btn-cancel,
        .form-actions .btn-danger {
            justify-content: center;
            width: 100%;
        }
        .danger-content {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }
        .danger-content .btn-danger {
            justify-content: center;
        }
    }
</style>

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

                <div class="form-group" style="margin-bottom: 0;">
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