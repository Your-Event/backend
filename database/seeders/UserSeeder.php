<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypes = ['Client', 'Company', 'Showman'];

        $faker = Faker::create();

        $photographerRole = Role::firstOrCreate(['title' => 'photographer']);
        $DJRole = Role::firstOrCreate(['title' => 'DJ']);
        $singerRole = Role::firstOrCreate(['title' => 'singer']);

        $roles = [$photographerRole, $DJRole, $singerRole];

        foreach ($roles as $role) {
            for ($i = 0; $i < 10; $i++) {
                if ($i < 4) {
                    $k = 0;
                } elseif ($i < 8) {
                    $k = 1;
                } else {
                    $k = 2;
                }

                User::create([
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('password123'),
                    'user_type' => $userTypes[$k],
                    'role_id' => $role->id,
                    'image_path' => null,
                ]);
            }
        }
    }
}
