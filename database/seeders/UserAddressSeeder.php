<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserAddress;
use App\Models\User;
use Faker\Factory as Faker;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();

        for ($i = 1; $i <= 30; $i++) {
            UserAddress::create([
                'user_id' => $i,
                'address' => $faker->streetAddress,
                'country' => $faker->country,
                'province' => $faker->state,
                'city'    => $faker->city,
            ]);
        }
    }
}
