<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'status' => $this->status,
            'category' => $this->category?->only(['id', 'name', 'slug']),
            'tags' => $this->tags->map->only(['id', 'name', 'slug']),
            'created_at' => $this->created_at,
        ];
    }
}
