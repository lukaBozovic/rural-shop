<?php

namespace App\Helpers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{

    public static function addCoverPhoto($model, $request): void
    {
        $path = 'storage/' . Storage::putFile('uploads/ads/' . $model->id, $request->file('cover_image'));
        $img = Image::query()->create([
            'path' => $path,
            'name' => $request->cover_image->getClientOriginalName(),
        ]);
        $model->update([
            'cover_image_id' => $img->id,
        ]);
    }

}
