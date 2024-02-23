<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'cover' => $this->cover,
            'genres' => $this->genres->pluck('name'),
            'country' => $this->country,
            'description' => $this->description,
            'uploadedBy' => $this->uploaded_by, // 'uploadedBy' => new UserResource($this->uploadedByUser)->id
        ];
    }
}
