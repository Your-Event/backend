<?php

namespace Database\Seeders;

use App\Models\Showman;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ShowmanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $gender = $faker->randomElement(['male', 'female']);

            // Create User first
            $user = User::create([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
            ]);

            // Create Showman linked to User
            Showman::create([
                'user_id' => $user->id,
                'first_name' => $faker->firstName($gender),
                'last_name' => $faker->lastName,
                'gender' => $gender,
                'bio' => $faker->paragraph,
            ]);
        }

        $this->command->info('10 showmen seeded successfully!');
    }
}
