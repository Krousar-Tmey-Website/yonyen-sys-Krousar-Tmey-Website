<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('id')->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255', 'unique:programs,title'],
            'description'      => ['nullable', 'string'],
            'full_description' => ['nullable', 'string'],
            'image'            => ['nullable', 'image', 'max:2048'],
            'image_url'        => ['nullable', 'url', 'max:2048'],
            'sort_order'       => ['prohibited'],
            'is_active'        => ['nullable', 'boolean'],
            'Status'           => ['nullable', 'string', 'max:255'],
            'testimony_name'   => ['nullable', 'string', 'max:255'],
            'testimony_story'  => ['nullable', 'string'],
            'testimony_image'  => ['nullable', 'image', 'max:2048'],
            'testimony_image_url' => ['nullable', 'url', 'max:2048'],
            'facebook_url'     => ['nullable', 'url', 'max:2048'],
            'linkedin_url'     => ['nullable', 'url', 'max:2048'],
            'instagram_url'    => ['nullable', 'url', 'max:2048'],
            'telegram_url'     => ['nullable', 'url', 'max:2048'],
            'youtube_url'      => ['nullable', 'url', 'max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['slug'] = \Illuminate\Support\Str::slug($data['title']);

        $imageUrl = $data['image_url'] ?? null;
        unset($data['image_url']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('programs', 'public');
        } elseif (!empty($imageUrl)) {
            $data['image'] = $imageUrl;
        }

        $testimonyImageUrl = $request->input('testimony_image_url');
        unset($data['testimony_image_url']);

        if ($request->hasFile('testimony_image')) {
            $data['testimony_image'] = $request->file('testimony_image')->store('programs/testimonials', 'public');
        } elseif (!empty($testimonyImageUrl)) {
            $data['testimony_image'] = $testimonyImageUrl;
        } elseif (empty($data['testimony_image'])) {
            unset($data['testimony_image']);
        }

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program created successfully.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255', 'unique:programs,title,' . $program->id],
            'description'      => ['nullable', 'string'],
            'full_description' => ['nullable', 'string'],
            'image'            => ['nullable', 'image', 'max:2048'],
            'image_url'        => ['nullable', 'url', 'max:2048'],
            'sort_order'       => ['prohibited'],
            'is_active'        => ['nullable', 'boolean'],
            'Status'           => ['nullable', 'string', 'max:255'],
            'testimony_name'   => ['nullable', 'string', 'max:255'],
            'testimony_story'  => ['nullable', 'string'],
            'testimony_image'  => ['nullable', 'image', 'max:2048'],
            'testimony_image_url' => ['nullable', 'url', 'max:2048'],
            'facebook_url'     => ['nullable', 'url', 'max:2048'],
            'linkedin_url'     => ['nullable', 'url', 'max:2048'],
            'instagram_url'    => ['nullable', 'url', 'max:2048'],
            'telegram_url'     => ['nullable', 'url', 'max:2048'],
            'youtube_url'      => ['nullable', 'url', 'max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['slug'] = \Illuminate\Support\Str::slug($data['title']);

        $imageUrl = $data['image_url'] ?? null;
        unset($data['image_url']);

        if ($request->hasFile('image')) {
            // Delete old image from storage
            if ($program->image && !str_starts_with($program->image, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $request->file('image')->store('programs', 'public');
        } elseif (!empty($imageUrl)) {
            // Delete old image if switching to URL
            if ($program->image && !str_starts_with($program->image, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $imageUrl;
        } else {
            // Keep existing image
            unset($data['image']);
        }

        $testimonyImageUrl = $request->input('testimony_image_url');
        unset($data['testimony_image_url']);

        if ($request->hasFile('testimony_image')) {
            if ($program->testimony_image && !str_starts_with($program->testimony_image, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($program->testimony_image);
            }
            $data['testimony_image'] = $request->file('testimony_image')->store('programs/testimonials', 'public');
        } elseif (!empty($testimonyImageUrl)) {
            if ($program->testimony_image && !str_starts_with($program->testimony_image, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($program->testimony_image);
            }
            $data['testimony_image'] = $testimonyImageUrl;
        } else {
            unset($data['testimony_image']);
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program deleted successfully.');
    }
}
