<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentMethodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:255'],
            'bank_type'        => ['nullable', 'string', 'max:50'],
            'account_name'     => ['nullable', 'string', 'max:255'],

            'account_no'       => ['nullable', 'string', 'max:100'],
            'currency'         => ['nullable', 'string', 'in:USD,KHR,Both'],
            'brand_color'      => ['nullable', 'string', 'max:10'],
            'qr_code'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'remove_qr'        => ['nullable', 'boolean'],
            'sort_order'       => ['nullable', 'integer', 'min:0'],
            'is_active'        => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'The payment method name is required.',
            'code.required'     => 'A unique code is required (e.g. ABA, ACLEDA).',
            'code.unique'       => 'This code is already taken.',
            'qr_code.image'     => 'The file must be an image.',
            'qr_code.mimes'     => 'Supported formats: JPG, PNG, GIF, WebP.',
            'qr_code.max'       => 'The QR code image may not be larger than 2 MB.',
            'currency.in'       => 'Currency must be USD, KHR, or Both.',
        ];
    }
}
