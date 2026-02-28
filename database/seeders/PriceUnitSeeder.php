<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PriceUnit;

class PriceUnitSeeder extends Seeder
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
            PriceUnit::firstOrCreate([
                'title' => $unit,
            ]);
        }
    }
}
