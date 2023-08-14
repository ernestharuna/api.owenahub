<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupSessionResource extends JsonResource
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
            'mentor' => new MentorResource($this->mentor),
            'topic' => $this->topic,
            'description' => $this->description,
            'meetingLink' => $this->meeting_link,
            'maxAttendants' => $this->max_attendants,
            'date' => $this->date,
            'startTime' => $this->start_time,
            'endTime' => $this->end_time,
            'createdAt' => $this->created_at,
        ];
    }
}
