<?php

namespace Database\Seeders;

use App\Models\PostUnit;
use Illuminate\Database\Seeder;

class PostUnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            'Hour',
            'Day',
            'Week',
            'Month',
            'Piece',
        ];

        foreach ($units as $unit) {
            PostUnit::firstOrCreate([
                'title' => $unit,
            ]);
        }
    }
}
