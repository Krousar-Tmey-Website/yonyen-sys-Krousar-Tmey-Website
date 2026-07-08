<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller {
    public function index() {
        $items = Project::latest()->get();
        return view('admin.projects.index', compact('items'));
    }
    public function create() {
        $programs = Program::all();
        return view('admin.projects.create', compact('programs'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'objective'   => 'nullable|string',
            'content'     => 'nullable|string',
            'activities'  => 'nullable|string',
            'make_difference_text' => 'nullable|string',
            'area_of_work' => 'nullable|string',
            'duration'    => 'nullable|string',
            'location'    => 'nullable|string',
            'beneficiaries' => 'nullable|string',
            'testimony_name' => 'nullable|string',
            'testimony_story' => 'nullable|string',
            'testimony_image' => 'nullable|image|max:2048',
            'testimony_image_url' => 'nullable|url|max:2048',
            'image'       => 'nullable|image|max:2048',
            'image_url'   => 'nullable|url|max:2048',
            'banner_image'     => 'nullable|image|max:4096',
            'banner_image_url' => 'nullable|url|max:2048',
            'program_id'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $imageUrl = $request->input('image_url');
        unset($data['image_url']);
        $testimonyImageUrl = $request->input('testimony_image_url');
        unset($data['testimony_image_url']);
        $bannerImageUrl = $request->input('banner_image_url');
        unset($data['banner_image_url']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        } elseif (!empty($imageUrl)) {
            $data['image'] = $imageUrl;
        }

        if ($request->hasFile('testimony_image')) {
            $data['testimony_image'] = $request->file('testimony_image')->store('projects', 'public');
        } elseif (!empty($testimonyImageUrl)) {
            $data['testimony_image'] = $testimonyImageUrl;
        }

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('projects/banners', 'public');
        } elseif (!empty($bannerImageUrl)) {
            $data['banner_image'] = $bannerImageUrl;
        }

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created!');
    }
    public function edit(Project $project) {
        $item = $project;
        $programs = Program::all();
        return view('admin.projects.edit', compact('item', 'programs'));
    }
    public function update(Request $request, Project $project) {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'objective'   => 'nullable|string',
            'content'     => 'nullable|string',
            'activities'  => 'nullable|string',
            'make_difference_text' => 'nullable|string',
            'area_of_work' => 'nullable|string',
            'duration'    => 'nullable|string',
            'location'    => 'nullable|string',
            'beneficiaries' => 'nullable|string',
            'testimony_name' => 'nullable|string',
            'testimony_story' => 'nullable|string',
            'testimony_image' => 'nullable|image|max:2048',
            'testimony_image_url' => 'nullable|url|max:2048',
            'image'       => 'nullable|image|max:2048',
            'image_url'   => 'nullable|url|max:2048',
            'banner_image'     => 'nullable|image|max:4096',
            'banner_image_url' => 'nullable|url|max:2048',
            'program_id'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $imageUrl = $request->input('image_url');
        unset($data['image_url']);
        $testimonyImageUrl = $request->input('testimony_image_url');
        unset($data['testimony_image_url']);
        $bannerImageUrl = $request->input('banner_image_url');
        unset($data['banner_image_url']);

        if ($request->hasFile('image')) {
            if ($project->image && !str_starts_with($project->image, 'http')) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        } elseif (!empty($imageUrl)) {
            if ($project->image && !str_starts_with($project->image, 'http')) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $imageUrl;
        } else {
            unset($data['image']);
        }

        if ($request->hasFile('testimony_image')) {
            if ($project->testimony_image && !str_starts_with($project->testimony_image, 'http')) {
                Storage::disk('public')->delete($project->testimony_image);
            }
            $data['testimony_image'] = $request->file('testimony_image')->store('projects', 'public');
        } elseif (!empty($testimonyImageUrl)) {
            if ($project->testimony_image && !str_starts_with($project->testimony_image, 'http')) {
                Storage::disk('public')->delete($project->testimony_image);
            }
            $data['testimony_image'] = $testimonyImageUrl;
        } else {
            unset($data['testimony_image']);
        }

        if ($request->hasFile('banner_image')) {
            if ($project->banner_image && !str_starts_with($project->banner_image, 'http')) {
                Storage::disk('public')->delete($project->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('projects/banners', 'public');
        } elseif (!empty($bannerImageUrl)) {
            if ($project->banner_image && !str_starts_with($project->banner_image, 'http')) {
                Storage::disk('public')->delete($project->banner_image);
            }
            $data['banner_image'] = $bannerImageUrl;
        } elseif ($request->boolean('banner_image_clear')) {
            if ($project->banner_image && !str_starts_with($project->banner_image, 'http')) {
                Storage::disk('public')->delete($project->banner_image);
            }
            $data['banner_image'] = null;
        } else {
            unset($data['banner_image']);
        }

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated!');
    }
    public function destroy(Project $project) {
        if ($project->image && !str_starts_with($project->image, 'http')) {
            Storage::disk('public')->delete($project->image);
        }
        if ($project->testimony_image && !str_starts_with($project->testimony_image, 'http')) {
            Storage::disk('public')->delete($project->testimony_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted!');
    }
}