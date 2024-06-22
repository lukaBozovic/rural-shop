<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $parent = parent::toArray($request);
        $parent['user_name'] = $this->user->name;
        $parent['cover_image'] = asset($this->coverImage()->first()->path);
        $parent['unit'] = $this->unit->symbol;
        $parent['additional_images'] = [];

        foreach ($this->images as $image) {
            $parent['additional_images'][] = asset($image->path);
        }
        return $parent;
    }
}
