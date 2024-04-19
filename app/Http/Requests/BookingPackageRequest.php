<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingPackageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'package_id' => ['required', 'exists:packages,id'],
            'mobile' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'country' => ['required'],
            'age' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'from_where_know_rawan' => ['required'],
            'goal' => ['nullable'],
            'level' => ['nullable'],
            'goal_in_details' => ['nullable'],
            'level_of_daily_activity' => ['nullable'],
            'describe_you_life_style' => ['nullable'],
            'do_you_know_how_to_withdraw_your_calories' => ['nullable'],
            'how_did_you_know_about_rawan' => ['nullable'],
            'free_space_for_expression' => ['nullable'],
        ];
    }
}
