<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $items = Testimonial::orderBy('sort_order')->latest()->get();
        return view('admin.testimonials.index', compact('items'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'label'      => 'nullable|string|max:255',
            'role'       => 'nullable|string|max:255',
            'content'    => 'nullable|string',
            'story'      => 'nullable|string',
            'image'      => 'nullable|image|max:2048',
            'image_url'  => 'nullable|url|max:2048',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $imageUrl = $data['image_url'] ?? null;
        unset($data['image_url']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        } elseif (!empty($imageUrl)) {
            $data['image'] = $imageUrl;
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        $item = $testimonial;
        return view('admin.testimonials.edit', compact('item'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'label'      => 'nullable|string|max:255',
            'role'       => 'nullable|string|max:255',
            'content'    => 'nullable|string',
            'story'      => 'nullable|string',
            'image'      => 'nullable|image|max:2048',
            'image_url'  => 'nullable|url|max:2048',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $imageUrl = $data['image_url'] ?? null;
        unset($data['image_url']);

        if ($request->hasFile('image')) {
            if ($testimonial->image && !str_starts_with($testimonial->image, 'http')) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        } elseif (!empty($imageUrl)) {
            if ($testimonial->image && !str_starts_with($testimonial->image, 'http')) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $imageUrl;
        } else {
            unset($data['image']);
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image && !str_starts_with($testimonial->image, 'http')) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted!');
    }
}