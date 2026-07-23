<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Models\MapProject;
use Illuminate\Http\Request;

class MapProjectController extends Controller
{
    public function index()
    {
        $projects = MapProject::orderBy('sort_order')->orderByDesc('id')->get();
        $provinces = $this->getProvinceList();
        $projectTypes = $this->getProjectTypeList();
        $settings = HomeSetting::allKeyed();

        return view('admin.map-projects.index', compact('projects', 'provinces', 'projectTypes', 'settings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'province_key'   => ['required', 'string', 'max:100'],
            'province_label' => ['nullable', 'string', 'max:255'],
            'location_name'  => ['required', 'string', 'max:255'],
            'project_type'   => ['required', 'string', 'max:255'],
            'sort_order'     => ['nullable', 'integer', 'min:0'],
        ]);

        $provinces = $this->getProvinceList();
        $data['province_label'] = $data['province_label'] ?: ($provinces[$data['province_key']] ?? '');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        MapProject::create($data);

        return redirect()->route('admin.map-projects.index')
            ->with('success', 'Project added to map.');
    }

    public function update(Request $request, MapProject $mapProject)
    {
        $data = $request->validate([
            'province_key'   => ['required', 'string', 'max:100'],
            'province_label' => ['nullable', 'string', 'max:255'],
            'location_name'  => ['required', 'string', 'max:255'],
            'project_type'   => ['required', 'string', 'max:255'],
            'sort_order'     => ['nullable', 'integer', 'min:0'],
        ]);

        $provinces = $this->getProvinceList();
        $data['province_label'] = $data['province_label'] ?: ($provinces[$data['province_key']] ?? '');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $mapProject->update($data);

        return redirect()->route('admin.map-projects.index')
            ->with('success', 'Map project updated.');
    }

    public function destroy(MapProject $mapProject)
    {
        $mapProject->delete();

        return redirect()->route('admin.map-projects.index')
            ->with('success', 'Project removed from map.');
    }

    /**
     * Available provinces that can have projects on the map.
     */
    private function getProvinceList(): array
    {
        return [
            'banteay-meanchey' => 'Banteay Meanchey',
            'battambang'       => 'Battambang',
            'kampong-cham'     => 'Kampong Cham',
            'kampong-chhnang'  => 'Kampong Chhnang',
            'kampong-speu'     => 'Kampong Speu',
            'kampong-thom'     => 'Kampong Thom',
            'kampot'           => 'Kampot',
            'kandal'           => 'Kandal',
            'koh-kong'         => 'Koh Kong',
            'kratie'           => 'Kratie',
            'mondulkiri'       => 'Mondulkiri',
            'phnom-penh'       => 'Phnom Penh',
            'preah-vihear'     => 'Preah Vihear',
            'prey-veng'        => 'Prey Veng',
            'pursat'           => 'Pursat',
            'ratanak-kiri'     => 'Ratanak Kiri',
            'siem-reap'        => 'Siem Reap',
            'stung-treng'      => 'Stung Treng',
            'svay-rieng'       => 'Svay Rieng',
            'takeo'            => 'Takeo',
            'tboung-khmum'     => 'Tboung Khmum',
            'pailin'           => 'Pailin',
            'preah-sihanouk'   => 'Preah Sihanouk',
            'uddor-meanchey'   => 'Oddar Meanchey',
        ];
    }

    /**
     * Available project type strings (clean labels, icons rendered on frontend).
     */
    private function getProjectTypeList(): array
    {
        return [
            'Child Welfare',
            'Outside Cases',
            'School for Deaf or Blind Children',
            'School of Khmer Arts & Culture',
        ];
    }

    /**
     * Update the right-side text content (heading, titles, items, image).
     */
    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'structure_heading'         => ['nullable', 'string', 'max:255'],
            'structure_welfare_title'   => ['nullable', 'string', 'max:255'],
            'structure_welfare_items'   => ['nullable', 'string'],
            'structure_education_title' => ['nullable', 'string', 'max:255'],
            'structure_education_items' => ['nullable', 'string'],
        ]);

        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value);
        }

        // Handle structure_image file upload
        if ($request->hasFile('structure_image')) {
            $request->validate([
                'structure_image' => ['image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            ]);

            // Delete old image if exists
            $oldValue = HomeSetting::getValue('structure_image', '');
            if ($oldValue && \Illuminate\Support\Facades\Storage::disk('public')->exists($oldValue)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldValue);
            }

            $path = $request->file('structure_image')->store('structure', 'public');
            HomeSetting::setValue('structure_image', $path);
        }

        // Handle structure_image URL fallback (if no file uploaded)
        if (! $request->hasFile('structure_image') && $request->filled('settings.structure_image')) {
            HomeSetting::setValue('structure_image', $request->input('settings.structure_image'));
        }

        // Handle structure_image removal
        if ($request->boolean('clear_structure_image')) {
            $oldValue = HomeSetting::getValue('structure_image', '');
            if ($oldValue && \Illuminate\Support\Facades\Storage::disk('public')->exists($oldValue)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldValue);
            }
            HomeSetting::setValue('structure_image', '');
        }

        return redirect()->route('admin.map-projects.index')
            ->with('success', 'Map section content updated.');
    }
}
