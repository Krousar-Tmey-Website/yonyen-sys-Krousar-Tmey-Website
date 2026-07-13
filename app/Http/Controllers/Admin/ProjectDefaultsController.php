<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectDefaultsController extends Controller
{
    public function index(Request $request)
    {
        $settings = HomeSetting::where('group', 'project_defaults')
            ->orderBy('id')
            ->get()
            ->keyBy('key');

        $projects = Project::with('program')
            ->orderBy('title')
            ->get();

        $selectedProject = null;
        $selectedProjectId = $request->integer('project');

        if ($selectedProjectId) {
            $selectedProject = $projects->firstWhere('id', $selectedProjectId);
        }

        return view('admin.project_defaults.index', compact('settings', 'projects', 'selectedProject'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'selected_project_id' => ['nullable', 'integer', 'exists:projects,id'],
            'project_default_area_of_work' => ['nullable', 'string', 'max:255'],
            'project_default_duration' => ['nullable', 'string', 'max:255'],
            'project_default_location' => ['nullable', 'string', 'max:255'],
            'project_default_beneficiaries' => ['nullable', 'string', 'max:255'],
            'project_default_make_difference_text' => ['nullable', 'string', 'max:2000'],
        ]);

        $selectedProjectId = $data['selected_project_id'] ?? null;
        unset($data['selected_project_id']);

        $labels = [
            'project_default_area_of_work' => 'Default Area of Work',
            'project_default_duration' => 'Default Duration',
            'project_default_location' => 'Default Location',
            'project_default_beneficiaries' => 'Default Beneficiaries',
            'project_default_make_difference_text' => 'Default Make a Difference Text',
        ];

        foreach ($data as $key => $value) {
            HomeSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value ?? '',
                    'label' => $labels[$key] ?? $key,
                    'group' => 'project_defaults',
                ]
            );
        }

        $redirectParams = $selectedProjectId ? ['project' => $selectedProjectId] : [];

        return redirect()->route('admin.project-defaults.index', $redirectParams)
            ->with('success', 'Project defaults updated successfully.');
    }

    public function updateProject(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'project_details_mode' => ['required', 'in:defaults,specific'],
            'area_of_work' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'beneficiaries' => ['nullable', 'string', 'max:255'],
            'make_difference_text' => ['nullable', 'string', 'max:2000'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.project-defaults.index', ['project' => $project->id])
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        if ($data['project_details_mode'] === 'defaults') {
            $project->update([
                'area_of_work' => null,
                'duration' => null,
                'location' => null,
                'beneficiaries' => null,
                'make_difference_text' => null,
            ]);
        } else {
            $project->update([
                'area_of_work' => $data['area_of_work'] ?? null,
                'duration' => $data['duration'] ?? null,
                'location' => $data['location'] ?? null,
                'beneficiaries' => $data['beneficiaries'] ?? null,
                'make_difference_text' => $data['make_difference_text'] ?? null,
            ]);
        }

        return redirect()->route('admin.project-defaults.index', ['project' => $project->id])
            ->with('success', 'Project-specific public page details updated successfully.');
    }
}
