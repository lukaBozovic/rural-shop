<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $img = Image::query()->create([
            'path' => 'logo.png',
            'name' => 'logo.png',
        ]);
        foreach (User::query()->where('is_admin', 0)->get() as $user) {
            for($i = 0; $i < 10; $i++) {
                $ad = Ad::query()->create([
                    'user_id' => $user->id,
                    'title' => $faker->word,
                    'description' => $faker->text(128),
                    'price' => $faker->randomFloat(2, 0, 1000),
                    'phone_number' => $faker->phoneNumber,
                    'city' => $faker->city,
                    'cover_image_id' => $img->id,
                ]);
                $ad->categories()->attach($faker->numberBetween(1, 5));
            }
        }
    }
}
