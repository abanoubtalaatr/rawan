<?php

namespace App\Http\Requests\Admin\Api;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes'],
            'discount_value_when_renew' => ['sometimes', 'integer'],
            'period' => ['sometimes'],
            'price' => ['sometimes'],
            'member_type' => ['sometimes'],
            'features' => ['sometimes'],
            'description' => ['sometimes'],
            'price_one' => ['nullable'],
            'price_two' => ['nullable'],
        ];
    }
}
