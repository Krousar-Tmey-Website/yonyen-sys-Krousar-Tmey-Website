<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller {
    public function index() {
        $items = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('items'));
    }
    public function create() {
        return view('admin.testimonials.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'nullable|string|max:255',
            'content'   => 'nullable|string',
            'image'     => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created!');
    }
    public function edit(Testimonial $testimonial) {
        $item = $testimonial;
        return view('admin.testimonials.edit', compact('item'));
    }
    public function update(Request $request, Testimonial $testimonial) {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'nullable|string|max:255',
            'content'   => 'nullable|string',
            'image'     => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            if ($testimonial->image && !str_starts_with($testimonial->image, 'http')) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        } else {
            unset($data['image']);
        }
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated!');
    }
    public function destroy(Testimonial $testimonial) {
        if ($testimonial->image && !str_starts_with($testimonial->image, 'http')) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted!');
    }
}