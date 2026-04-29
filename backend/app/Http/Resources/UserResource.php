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
            'full_name' => $this->full_name,
            'image_path' => $this->image_path,
            'wall_image_path' => $this->wall_image_path,
            'role' => $this->whenLoaded('role', function () {
                return [
                    'id' => $this->role->id,
                    'title' => $this->role->title,
                ];
            }),
        ];
    }
}
