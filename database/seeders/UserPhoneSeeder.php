<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPhone;
use App\Models\User;
use Faker\Factory as Faker;

class UserPhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();

        for ($i = 1; $i <= 30; $i++) {
            UserPhone::create([
                'user_id'        => $i,
                'phone'          => $faker->unique()->phoneNumber,
                'phone_verified' => $faker->dateTimeBetween('-1 year', 'now'),
                'last_used_code' => $faker->numerify('######'),
                'shift_start'    => $faker->time('H:i'),
                'shift_end'      => $faker->time('H:i'),
            ]);
        }
    }
}
