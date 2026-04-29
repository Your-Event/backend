<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Create 5 additional generic users (not linked to any specific type)
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
            ]);
        }

        $this->command->info('5 generic users seeded successfully!');
    }
}
