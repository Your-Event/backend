<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [];

        for ($i = 1; $i <= 30; $i++) {
            $images[] = [
                'path' => "uploads/images/sample_image_{$i}.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Image::insert($images);
    }
}
