<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 9; $i++){
            $image = Image::query()->create([
                'path' => 'category'.$i.'.jpg',
                'name' => 'category'.$i.'.jpg',
            ]);

            Category::query()->create([
                'name' => 'Category ' . $i,
                'cover_image_id' => $image->id,
            ]);
        }
    }
}
