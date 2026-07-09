<?php
function getIndexView($model, $plural, $titleField, $descField) {
    return <<<BLADE
@extends('admin.layouts.app')
@section('title', '{$model}s')
@section('page-title', '{$model}s')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-gray-700 font-semibold">All {$model}s</h2>
    <a href="{{ route('admin.{$plural}.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Create {$model}
    </a>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach(\$items as \$item)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
        @if(\$item->image)
        <img src="{{ str_starts_with(\$item->image, 'http') ? \$item->image : asset('storage/' . \$item->image) }}" alt="{{ \$item->{$titleField} }}" class="w-full h-36 object-cover">
        @else
        <div class="w-full h-36 bg-gray-100 flex items-center justify-center text-gray-300">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        @endif
        <div class="p-5">
            <div class="flex items-start justify-between mb-2">
                <h3 class="font-semibold text-gray-700 text-sm leading-snug">{{ \$item->{$titleField} }}</h3>
                <span class="px-2 py-0.5 rounded-full text-xs {{ \$item->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }} flex-shrink-0 ml-2">
                    {{ \$item->is_active ? 'Active' : 'Hidden' }}
                </span>
            </div>
            @if(\$item->{$descField})
            <p class="text-gray-400 text-xs leading-relaxed mb-4 line-clamp-2">{{ \$item->{$descField} }}</p>
            @endif
            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('admin.{$plural}.edit', \$item) }}"
                   class="inline-flex items-center gap-1.5 text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <form action="{{ route('admin.{$plural}.destroy', \$item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this {$model}?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 text-red-500 hover:text-red-700 text-xs font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
BLADE;
}

function getCreateView($model, $plural, $fieldsHtml) {
    return <<<BLADE
@extends('admin.layouts.app')
@section('title', 'Create {$model}')
@section('page-title', 'Create {$model}')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.{$plural}.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            {$fieldsHtml}
            
            <div class="flex items-end pb-1">
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                           class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                    <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Upload Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">Create {$model}</button>
            <a href="{{ route('admin.{$plural}.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
BLADE;
}

function getEditView($model, $plural, $fieldsHtml) {
    return <<<BLADE
@extends('admin.layouts.app')
@section('title', 'Edit {$model}')
@section('page-title', 'Edit {$model}')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.{$plural}.update', \$item) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            {$fieldsHtml}
            
            <div class="flex items-end pb-1">
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', \$item->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                    <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                </div>
            </div>

            @if(\$item->image)
            <div>
                <p class="text-xs text-gray-500 mb-2">Current image:</p>
                <img src="{{ str_starts_with(\$item->image, 'http') ? \$item->image : asset('storage/' . \$item->image) }}" class="h-28 w-auto rounded-xl object-cover border border-gray-200">
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Replace Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">Save Changes</button>
            <a href="{{ route('admin.{$plural}.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
BLADE;
}

$viewsDir = __DIR__ . '/resources/views/admin';

// Projects
$projectFieldsCreate = <<<HTML
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description') }}</textarea>
            </div>
HTML;
$projectFieldsEdit = <<<HTML
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title</label>
                <input type="text" name="title" value="{{ old('title', \$item->title) }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description', \$item->description) }}</textarea>
            </div>
HTML;

file_put_contents("$viewsDir/projects/index.blade.php", getIndexView('Project', 'projects', 'title', 'description'));
file_put_contents("$viewsDir/projects/create.blade.php", getCreateView('Project', 'projects', $projectFieldsCreate));
file_put_contents("$viewsDir/projects/edit.blade.php", getEditView('Project', 'projects', $projectFieldsEdit));

// Gallery
$galleryFieldsCreate = <<<HTML
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title / Caption</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
HTML;
$galleryFieldsEdit = <<<HTML
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title / Caption</label>
                <input type="text" name="title" value="{{ old('title', \$item->title) }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
HTML;

file_put_contents("$viewsDir/gallery/index.blade.php", getIndexView('Gallery', 'gallery', 'title', 'title')); // description fallback to title or empty
file_put_contents("$viewsDir/gallery/create.blade.php", getCreateView('Gallery', 'gallery', $galleryFieldsCreate));
file_put_contents("$viewsDir/gallery/edit.blade.php", getEditView('Gallery', 'gallery', $galleryFieldsEdit));

// Testimonials
$testimonialFieldsCreate = <<<HTML
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Role / Affiliation</label>
                <input type="text" name="role" value="{{ old('role') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Content</label>
                <textarea name="content" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('content') }}</textarea>
            </div>
HTML;
$testimonialFieldsEdit = <<<HTML
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Name</label>
                <input type="text" name="name" value="{{ old('name', \$item->name) }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Role / Affiliation</label>
                <input type="text" name="role" value="{{ old('role', \$item->role) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Content</label>
                <textarea name="content" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('content', \$item->content) }}</textarea>
            </div>
HTML;

file_put_contents("$viewsDir/testimonials/index.blade.php", getIndexView('Testimonial', 'testimonials', 'name', 'role'));
file_put_contents("$viewsDir/testimonials/create.blade.php", getCreateView('Testimonial', 'testimonials', $testimonialFieldsCreate));
file_put_contents("$viewsDir/testimonials/edit.blade.php", getEditView('Testimonial', 'testimonials', $testimonialFieldsEdit));

// Generate Full Controller Logic for all 3
$controllers = [
    'Project' => ['plural' => 'projects', 'rules' => "['title' => 'required', 'description' => 'nullable', 'image' => 'nullable|image', 'is_active' => 'nullable|boolean']"],
    'Gallery' => ['plural' => 'gallery', 'rules' => "['title' => 'required', 'image' => 'nullable|image', 'is_active' => 'nullable|boolean']"],
    'Testimonial' => ['plural' => 'testimonials', 'rules' => "['name' => 'required', 'role' => 'nullable', 'content' => 'nullable', 'image' => 'nullable|image', 'is_active' => 'nullable|boolean']"],
];

foreach ($controllers as $model => $opts) {
    $plural = $opts['plural'];
    $rules = $opts['rules'];
    $controllerContent = <<<PHP
<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\\$model;
use Illuminate\Http\Request;

class {$model}Controller extends Controller {
    public function index() {
        \$items = {$model}::all();
        return view('admin.{$plural}.index', compact('items'));
    }
    public function create() {
        return view('admin.{$plural}.create');
    }
    public function store(Request \$request) {
        \$data = \$request->validate($rules);
        \$data['is_active'] = \$request->boolean('is_active');
        if (\$request->hasFile('image')) {
            \$data['image'] = \$request->file('image')->store('{$plural}', 'public');
        }
        {$model}::create(\$data);
        return redirect()->route('admin.{$plural}.index')->with('success', '{$model} created!');
    }
    public function edit({$model} \$$plural) {
        \$item = \$$plural;  // Using variable name that matches resource name securely
        return view('admin.{$plural}.edit', compact('item'));
    }
    public function update(Request \$request, {$model} \$$plural) {
        \$item = \$$plural;
        \$data = \$request->validate($rules);
        \$data['is_active'] = \$request->boolean('is_active');
        if (\$request->hasFile('image')) {
            \$data['image'] = \$request->file('image')->store('{$plural}', 'public');
        }
        \$item->update(\$data);
        return redirect()->route('admin.{$plural}.index')->with('success', '{$model} updated!');
    }
    public function destroy({$model} \$$plural) {
        \$item = \$$plural;
        \$item->delete();
        return redirect()->route('admin.{$plural}.index')->with('success', '{$model} deleted!');
    }
}
PHP;
    // Parameter name for edit/update/destroy must match route param: e.g. for projects it's \$project. Since we bind to plural, actually laravel uses singular default.
    // E.g Route::resource('projects') uses \$project.
    $singularParam = strtolower($model);
    $controllerContent = str_replace("\$$plural", "\$$singularParam", $controllerContent);
    file_put_contents(__DIR__ . "/app/Http/Controllers/Admin/{$model}Controller.php", $controllerContent);
}

echo "CRUD scaffolding built successfully.";
