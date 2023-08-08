<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'meetingLink' => $this->meeting_link,
            'sessionCode' => $this->session_code,
            'paid' => $this->paid,
            'accepted' => $this->accepted,
            'mentor' => new MentorResource($this->mentor),
            'mentee' => new UserResource($this->user),
        ];
    }
}
