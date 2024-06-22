<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Tona', 'symbol' => 't'],
            ['name' => 'Kilogram', 'symbol' => 'kg'],
            ['name' => 'Gram', 'symbol' => 'g'],
            ['name' => 'Komad', 'symbol' => 'kom'],
            ['name' => 'Metar', 'symbol' => 'm'],
            ['name' => 'Litar', 'symbol' => 'L'],
            ['name' => 'Mililitar', 'symbol' => 'ml'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
