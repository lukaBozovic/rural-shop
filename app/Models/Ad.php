<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ad extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'ad_category');
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'ad_image');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'cover_image_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
