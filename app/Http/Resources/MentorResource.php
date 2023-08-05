<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MentorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'gender' => $this->gender,
            'field' => $this->field,
            'expYears' => $this->exp_years,
            'dateOfBirth' => $this->date_of_birth,
            'email' => $this->email,
            'createdAt' => $this->created_at,
        ];
    }
}
