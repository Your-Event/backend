<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            Post::create([
                'sub_type_id' => fake()->numberBetween(1, 5),
                'user_id' => fake()->numberBetween(1, 30),
                'title' => fake()->sentence(3),
                'description' => fake()->paragraph(),
                'price' => fake()->randomFloat(2, 10, 5000),
                'price_unit_id' => fake()->numberBetween(1, 3), // փոխիր՝ ըստ price_units_translations աղյուսակի
                'is_verified' => fake()->boolean(),
                'is_active' => fake()->boolean(80), // 80% ակտիվ
            ]);
        }
    }
}
