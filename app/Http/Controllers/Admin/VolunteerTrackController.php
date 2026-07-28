<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasHexColorFields;
use App\Http\Controllers\Controller;
use App\Models\VolunteerTrack;
use Illuminate\Http\Request;

class VolunteerTrackController extends Controller
{
    use HasHexColorFields;

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active', true);
        $data = $this->normalizeColorFields($data);

        VolunteerTrack::create($data);

        return redirect()->route('admin.volunteer-section.index', ['tab' => 'tracks'])->with('success', 'Volunteer track added.');
    }

    public function update(Request $request, VolunteerTrack $volunteerTrack)
    {
        $data = $request->validate($this->rules());
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active', true);
        $data = $this->normalizeColorFields($data);

        $volunteerTrack->update($data);

        return redirect()->route('admin.volunteer-section.index', ['tab' => 'tracks'])->with('success', 'Volunteer track updated.');
    }

    public function destroy(VolunteerTrack $volunteerTrack)
    {
        $volunteerTrack->delete();

        return redirect()->route('admin.volunteer-section.index', ['tab' => 'tracks'])->with('success', 'Volunteer track deleted.');
    }

    protected function colorFields(): array
    {
        return ['accent_color', 'accent_color_secondary', 'icon_background_color', 'button_color', 'button_text_color'];
    }

    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'title_fr' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'subtitle_fr' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'extra_heading' => ['nullable', 'string', 'max:255'],
            'extra_heading_fr' => ['nullable', 'string', 'max:255'],
            'extra_content' => ['nullable', 'string'],
            'extra_content_fr' => ['nullable', 'string'],
            'footer_label' => ['nullable', 'string', 'max:255'],
            'footer_label_fr' => ['nullable', 'string', 'max:255'],
            'cta_type' => ['required', 'in:email,modal,url'],
            'cta_value' => ['nullable', 'string', 'max:255', 'required_if:cta_type,email,url'],
            'cta_button_text' => ['nullable', 'string', 'max:255'],
            'cta_button_text_fr' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ] + $this->colorValidationRules();
    }
}
