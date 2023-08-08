<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'bio' => $this->bio,
            'field' => $this->field,
            'twitterHandle' => $this->twitter_handle,
            'linkedinHandle' => $this->linkedin_handle,
            'language' => $this->language,
            'email' => $this->email,
            'interest' => $this->interest,
            'gender' => $this->gender,
            'dateOfBirth' => $this->date_of_birth,
            'articles' => ArticleResource::collection($this->whenLoaded('article')),
            'sessions' => ArticleResource::collection($this->whenLoaded('session')),
            'education' => ArticleResource::collection($this->whenLoaded('education')),
        ];
    }
}
