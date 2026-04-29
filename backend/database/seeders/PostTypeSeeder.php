<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostType;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['title' => 'Event'],
            ['title' => 'Service'],
            ['title' => 'Rental'],
            ['title' => 'Product'],
            ['title' => 'Other'],
        ];

        foreach ($types as $type) {
            PostType::create($type);
        }
    }
}
