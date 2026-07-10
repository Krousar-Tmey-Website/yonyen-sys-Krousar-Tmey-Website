<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectGrant;
use Illuminate\Http\Request;

class ProjectGrantController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'      => 'nullable|string|max:255',
            'amount'     => 'required|numeric|min:0',
            'label'      => 'nullable|string|max:255',
            'recipient'  => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $project->grants()->create($data);

        return redirect()->route('admin.projects.edit', $project)
            ->with('success', 'Grant added.');
    }

    public function update(Request $request, Project $project, ProjectGrant $grant)
    {
        abort_if($grant->project_id !== $project->id, 403);

        $data = $request->validate([
            'title'      => 'nullable|string|max:255',
            'amount'     => 'required|numeric|min:0',
            'label'      => 'nullable|string|max:255',
            'recipient'  => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $grant->update($data);

        return redirect()->route('admin.projects.edit', $project)
            ->with('success', 'Grant updated.');
    }

    public function destroy(Project $project, ProjectGrant $grant)
    {
        abort_if($grant->project_id !== $project->id, 403);
        $grant->delete();

        return redirect()->route('admin.projects.edit', $project)
            ->with('success', 'Grant deleted.');
    }
}
