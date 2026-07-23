<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'title_fr'         => ['nullable', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'description_fr'   => ['nullable', 'string'],
            'full_description' => ['nullable', 'string'],
            'full_description_fr' => ['nullable', 'string'],
            'image'            => ['nullable', 'image', 'max:2048'],
            'image_url'        => ['nullable', 'url', 'max:2048'],
            'icon_image'       => ['nullable', 'image', 'max:2048'],
            'icon_image_url'   => ['nullable', 'url', 'max:2048'],
            'is_active'        => ['nullable', 'boolean'],
            'Status'           => ['nullable', 'string', 'max:255'],
            'Status_fr'        => ['nullable', 'string'],
            'testimony_name'   => ['nullable', 'string', 'max:255'],
            'testimony_name_fr' => ['nullable', 'string', 'max:255'],
            'testimony_story'  => ['nullable', 'string'],
            'testimony_story_fr' => ['nullable', 'string'],
            'testimony_image'  => ['nullable', 'image', 'max:2048'],
            'testimony_image_url' => ['nullable', 'url', 'max:2048'],
            'facebook_url'     => ['nullable', 'url', 'max:2048'],
            'linkedin_url'     => ['nullable', 'url', 'max:2048'],
            'instagram_url'    => ['nullable', 'url', 'max:2048'],
            'telegram_url'     => ['nullable', 'url', 'max:2048'],
            'youtube_url'      => ['nullable', 'url', 'max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['slug'] = Str::slug($data['title']);

        // Check uniqueness of slug
        if (Program::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $data['slug'] . '-' . uniqid();
        }

        $imageUrl = $data['image_url'] ?? null;
        unset($data['image_url']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('programs', 'public');
        } elseif (!empty($imageUrl)) {
            $data['image'] = $imageUrl;
        }

        $iconImageUrl = $data['icon_image_url'] ?? null;
        unset($data['icon_image_url']);

        if ($request->hasFile('icon_image')) {
            $data['icon_image'] = $request->file('icon_image')->store('programs/icons', 'public');
        } elseif (!empty($iconImageUrl)) {
            $data['icon_image'] = $iconImageUrl;
        }

        $testimonyImageUrl = $request->input('testimony_image_url');
        unset($data['testimony_image_url']);

        if ($request->hasFile('testimony_image')) {
            $data['testimony_image'] = $request->file('testimony_image')->store('programs/testimonials', 'public');
        } elseif (!empty($testimonyImageUrl)) {
            $data['testimony_image'] = $testimonyImageUrl;
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
            'title_fr'         => ['nullable', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'description_fr'   => ['nullable', 'string'],
            'full_description' => ['nullable', 'string'],
            'full_description_fr' => ['nullable', 'string'],
            'image'            => ['nullable', 'image', 'max:2048'],
            'image_url'        => ['nullable', 'url', 'max:2048'],
            'icon_image'       => ['nullable', 'image', 'max:2048'],
            'icon_image_url'   => ['nullable', 'url', 'max:2048'],
            'remove_icon_image' => ['nullable', 'boolean'],
            'is_active'        => ['nullable', 'boolean'],
            'Status'           => ['nullable', 'string', 'max:255'],
            'Status_fr'        => ['nullable', 'string'],
            'testimony_name'   => ['nullable', 'string', 'max:255'],
            'testimony_name_fr' => ['nullable', 'string', 'max:255'],
            'testimony_story'  => ['nullable', 'string'],
            'testimony_story_fr' => ['nullable', 'string'],
            'testimony_image'  => ['nullable', 'image', 'max:2048'],
            'testimony_image_url' => ['nullable', 'url', 'max:2048'],
            'facebook_url'     => ['nullable', 'url', 'max:2048'],
            'linkedin_url'     => ['nullable', 'url', 'max:2048'],
            'instagram_url'    => ['nullable', 'url', 'max:2048'],
            'telegram_url'     => ['nullable', 'url', 'max:2048'],
            'youtube_url'      => ['nullable', 'url', 'max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['slug'] = Str::slug($data['title']);

        // Check uniqueness of slug (exclude current record)
        $existing = Program::where('slug', $data['slug'])->where('id', '!=', $program->id)->exists();
        if ($existing) {
            $data['slug'] = $data['slug'] . '-' . uniqid();
        }

        // Handle image
        $imageUrl = $data['image_url'] ?? null;
        unset($data['image_url']);

        if ($request->hasFile('image')) {
            if ($program->image && !str_starts_with($program->image, 'http')) {
                Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $request->file('image')->store('programs', 'public');
        } elseif (!empty($imageUrl)) {
            if ($program->image && !str_starts_with($program->image, 'http')) {
                Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $imageUrl;
        } else {
            unset($data['image']);
        }

        // Handle icon image
        $iconImageUrl = $data['icon_image_url'] ?? null;
        unset($data['icon_image_url']);

        if ($request->hasFile('icon_image')) {
            if ($program->icon_image && !str_starts_with($program->icon_image, 'http')) {
                Storage::disk('public')->delete($program->icon_image);
            }
            $data['icon_image'] = $request->file('icon_image')->store('programs/icons', 'public');
        } elseif (!empty($iconImageUrl)) {
            if ($program->icon_image && !str_starts_with($program->icon_image, 'http')) {
                Storage::disk('public')->delete($program->icon_image);
            }
            $data['icon_image'] = $iconImageUrl;
        } elseif ($request->boolean('remove_icon_image')) {
            if ($program->icon_image && !str_starts_with($program->icon_image, 'http')) {
                Storage::disk('public')->delete($program->icon_image);
            }
            $data['icon_image'] = null;
        } else {
            unset($data['icon_image']);
        }
        unset($data['remove_icon_image']);

        // Handle testimony image
        $testimonyImageUrl = $request->input('testimony_image_url');
        unset($data['testimony_image_url']);

        if ($request->hasFile('testimony_image')) {
            if ($program->testimony_image && !str_starts_with($program->testimony_image, 'http')) {
                Storage::disk('public')->delete($program->testimony_image);
            }
            $data['testimony_image'] = $request->file('testimony_image')->store('programs/testimonials', 'public');
        } elseif (!empty($testimonyImageUrl)) {
            if ($program->testimony_image && !str_starts_with($program->testimony_image, 'http')) {
                Storage::disk('public')->delete($program->testimony_image);
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
        // Delete associated files
        foreach (['image', 'icon_image', 'testimony_image'] as $field) {
            if ($program->$field && !str_starts_with($program->$field, 'http')) {
                Storage::disk('public')->delete($program->$field);
            }
        }
        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program deleted successfully.');
    }
}
