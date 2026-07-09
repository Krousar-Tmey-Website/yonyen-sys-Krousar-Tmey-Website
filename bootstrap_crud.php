<?php
$viewsDir = __DIR__ . '/resources/views/admin';

// Array: ModelName => ['title', 'slug', 'description', 'image', 'is_active']
$entities = [
    'Project' => ['table' => 'projects', 'fields' => ['title' => 'string', 'description' => 'text', 'image' => 'string:nullable', 'is_active' => 'boolean:default(true)']],
    'Gallery' => ['table' => 'galleries', 'fields' => ['title' => 'string', 'image' => 'string:nullable', 'is_active' => 'boolean:default(true)']],
    'Testimonial' => ['table' => 'testimonials', 'fields' => ['name' => 'string', 'role' => 'string:nullable', 'content' => 'text', 'image' => 'string:nullable', 'is_active' => 'boolean:default(true)']]
];

foreach ($entities as $model => $data) {
    // Controller
    $nameLower = strtolower($model);
    $plural = ($model === 'Gallery') ? 'gallery' : $nameLower . 's';
    
    $controllerContent = "<?php\nnamespace App\Http\Controllers\Admin;\nuse App\Http\Controllers\Controller;\nuse App\Models\\$model;\nuse Illuminate\Http\Request;\n" . 
        "class {$model}Controller extends Controller {\n" . 
        "    public function index() { \$items = $model::all(); return view('admin.$plural.index', compact('items')); }\n" . 
        "    public function create() { return view('admin.$plural.create'); }\n" . 
        "    public function store(Request \$request) { {$model}::create(\$request->all()); return redirect()->route('admin.$plural.index'); }\n" . 
        "    public function edit($model \$item) { return view('admin.$plural.edit', compact('item')); }\n" . 
        "    public function update(Request \$request, $model \$item) { \$item->update(\$request->all()); return redirect()->route('admin.$plural.index'); }\n" . 
        "    public function destroy($model \$item) { \$item->delete(); return redirect()->route('admin.$plural.index'); }\n}";
    file_put_contents(__DIR__ . "/app/Http/Controllers/Admin/{$model}Controller.php", $controllerContent);

    // Model
    $modelContent = "<?php\nnamespace App\Models;\nuse Illuminate\Database\Eloquent\Model;\n" . 
        "class $model extends Model { protected \$guarded = []; }";
    file_put_contents(__DIR__ . "/app/Models/{$model}.php", $modelContent);

    // Views
    @mkdir("$viewsDir/$plural", 0777, true);
    $indexView = <<<BLADE
@extends('admin.layouts.app')
@section('title', '$model List')
@section('page-title', '$model Management')
@section('content')
<div class="mb-4"><a href="{{ route('admin.$plural.create') }}" class="btn-primary">Create $model</a></div>
<table class="w-full bg-white rounded-xl">
    <tr><th class="p-4 text-left">ID</th><th class="p-4 text-left">Name</th><th class="p-4 text-left">Actions</th></tr>
    @foreach(\$items as \$item)
    <tr class="border-t">
        <td class="p-4">{{ \$item->id }}</td>
        <td class="p-4">{{ \$item->title ?? \$item->name ?? 'Item ' . \$item->id }}</td>
        <td class="p-4">
            <a href="{{ route('admin.$plural.edit', \$item) }}" class="text-blue-500 mr-2">Edit</a>
            <form action="{{ route('admin.$plural.destroy', \$item) }}" method="POST" class="inline">
                @csrf @method('DELETE') <button type="submit" class="text-red-500">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
BLADE;

    $createView = <<<BLADE
@extends('admin.layouts.app')
@section('title', 'Create $model')
@section('page-title', 'Create $model')
@section('content')
<form action="{{ route('admin.$plural.store') }}" method="POST" class="bg-white p-6 rounded-xl space-y-4">
    @csrf
    <div><label class="block mb-1">Title/Name</label><input type="text" name="title" class="w-full border rounded p-2"></div>
    <button type="submit" class="btn-primary">Save</button>
</form>
@endsection
BLADE;

    $editView = <<<BLADE
@extends('admin.layouts.app')
@section('title', 'Edit $model')
@section('page-title', 'Edit $model')
@section('content')
<form action="{{ route('admin.$plural.update', \$item) }}" method="POST" class="bg-white p-6 rounded-xl space-y-4">
    @csrf @method('PUT')
    <div><label class="block mb-1">Title/Name</label><input type="text" name="title" value="{{ \$item->title ?? \$item->name }}" class="w-full border rounded p-2"></div>
    <button type="submit" class="btn-primary">Update</button>
</form>
@endsection
BLADE;

    file_put_contents("$viewsDir/$plural/index.blade.php", $indexView);
    file_put_contents("$viewsDir/$plural/create.blade.php", $createView);
    file_put_contents("$viewsDir/$plural/edit.blade.php", $editView);
}

// Update migrations logic simply bypassing complex DB schemas. Let's just create generic strings for all DB fields dynamically.
// Note: Generating migrations automatically here requires checking files. We can do that by replacing the latest migrations generated.
