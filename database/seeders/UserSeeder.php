<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@mailinator.com',
            'password' => bcrypt('12345678'),
            'is_admin' => 1,
        ]);
        User::query()->create([
            'name' => 'Guest',
            'email' => 'guest@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
