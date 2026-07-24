<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'title_fr'     => ['nullable', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'price'        => ['nullable', 'numeric', 'min:0', 'max:999999.99'],
            'stock'        => ['nullable', 'integer', 'min:0'],
            'is_available' => ['nullable', 'boolean'],
            'sort_order'   => ['nullable', 'integer', 'min:0'],
            'cover_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_cover' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'    => 'The book title is required.',
            'price.required'    => 'Please enter a price.',
            'price.numeric'     => 'The price must be a number.',
            'cover_image.image' => 'The file must be an image.',
            'cover_image.mimes' => 'Supported formats: JPG, PNG, WebP.',
            'cover_image.max'   => 'The cover image may not be larger than 2 MB.',
        ];
    }
}
