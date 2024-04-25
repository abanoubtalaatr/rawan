<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'consultation' => $this->consultation,
            'program' => $this->program,
            'package' => $this->package,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'country' => $this->country,
            'age' => $this->age,
            'height' => $this->height,
            'weight' => $this->weight,
            'payment_status' => $this->payment_status == 'not_paid' ? "لم يتم اكمال الدفع" : "تم الدفع بنجاح",
            'goal' => $this->goal,
            'level' => $this->level,
            'goal_in_details' => $this->goal_in_details,
            'level_of_daily_activity' => $this->level_of_daily_activity,
            'describe_you_life_style' => $this->describe_you_life_style,
            'do_you_know_how_to_withdraw_your_calories' => $this->do_you_know_how_to_withdraw_your_calories,
            "how_did_you_know_about_rawan" => $this->how_did_you_know_about_rawan,
            'free_space_for_expression' => $this->free_space_for_expression,
            'price_one' => $this->price_one,
            'price_two' => $this->price_two,
        ];
    }
}
