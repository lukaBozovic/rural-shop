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
        $parent['cover_image'] = asset($this->coverImage()->first()->path);
        $parent['additional_images'] = [];
        foreach ($this->images as $image){
            $parent['additional_images'][] = asset($image->path);
    }
        return $parent;
    }
}
