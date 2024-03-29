<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = true;

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
            'description' =>  $this->description,
            'content' => $this->content,
            'published' => $this->published,
            'category' => $this->category,
            'createdAt' => $this->created_at,
            'mentor' => new AdminResource($this->mentor),
            'user' => new AdminResource($this->user),
            'admin' => new AdminResource($this->admin),
        ];
    }
}
