<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
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

            // Create Client linked to User
            Client::create([
                'user_id' => $user->id,
                'first_name' => $faker->firstName($gender),
                'last_name' => $faker->lastName,
                'gender' => $gender,
            ]);
        }

        $this->command->info('10 clients seeded successfully!');
    }
}
