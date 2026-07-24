<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller {
    public function index() {
        $items = Gallery::latest()->get();
        return view('admin.gallery.index', compact('items'));
    }
    public function create() {
        return view('admin.gallery.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'title_fr'  => 'nullable|string|max:255',
            'image'     => 'nullable|image|max:4096',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }
        Gallery::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Photo added!');
    }
    public function edit(Gallery $gallery) {
        $item = $gallery;
        return view('admin.gallery.edit', compact('item'));
    }
    public function update(Request $request, Gallery $gallery) {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'title_fr'  => 'nullable|string|max:255',
            'image'     => 'nullable|image|max:4096',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            if ($gallery->image && !str_starts_with($gallery->image, 'http')) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('gallery', 'public');
        } else {
            unset($data['image']);
        }
        $gallery->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Photo updated!');
    }
    public function destroy(Gallery $gallery) {
        if ($gallery->image && !str_starts_with($gallery->image, 'http')) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Photo deleted!');
    }
}