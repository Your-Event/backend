<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $companyTypes = ['Events', 'Entertainment', 'Production', 'Music', 'Catering', 'Photography'];

        for ($i = 0; $i < 10; $i++) {
            $companyName = $faker->company . ' ' . $faker->randomElement($companyTypes);

            // Create User first
            $user = User::create([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
            ]);

            // Create Company linked to User
            Company::create([
                'user_id' => $user->id,
                'name' => $companyName,
                'bio' => $faker->paragraph,
            ]);
        }

        $this->command->info('10 companies seeded successfully!');
    }
}
