<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'logo'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'The partner name is required.',
            'category.required' => 'Please select a category.',
            'logo.image'        => 'The file must be an image.',
            'logo.mimes'        => 'Supported formats: JPG, PNG, SVG, WebP.',
            'logo.max'          => 'The image may not be larger than 2 MB.',
        ];
    }
}
