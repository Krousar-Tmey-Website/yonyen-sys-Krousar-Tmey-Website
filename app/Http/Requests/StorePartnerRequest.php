<?php

namespace App\Http\Requests;

use App\Enums\PartnerCategory;
use App\Enums\PartnerSubcategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePartnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', Rule::in(PartnerCategory::labels())],
            'subcategory' => [
                'nullable',
                'string',
                Rule::in(PartnerSubcategory::labels()),
                Rule::requiredIf(fn () => $this->input('category') === PartnerCategory::Financial->value),
                Rule::prohibitedIf(fn () => $this->input('category') === PartnerCategory::Technical->value),
            ],
            'country'     => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'description_fr' => ['nullable', 'string', 'max:2000'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'logo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'           => 'The partner name is required.',
            'category.required'       => 'Please select a main category.',
            'category.in'             => 'Please select a valid main category.',
            'subcategory.required'    => 'Please select a subcategory for Financial Partners.',
            'subcategory.prohibited'  => 'Technical Partners cannot have a subcategory.',
            'subcategory.in'          => 'Please select a valid subcategory.',
            'website_url.url'         => 'Please enter a valid URL (e.g. https://example.com).',
            'logo.image'              => 'The file must be an image.',
            'logo.mimes'              => 'Supported formats: JPG, PNG, SVG, WebP.',
            'logo.max'                => 'The image may not be larger than 2 MB.',
        ];
    }
}
