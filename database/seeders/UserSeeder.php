<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypeNames = ['Client', 'Company', 'Showman'];
        $userTypes = [];

        foreach ($userTypeNames as $typeName) {
            $userTypes[$typeName] = UserType::where('name', $typeName)->first();
        }

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
                    'user_type_id' => $userTypes[$userTypeNames[$k]]->id,
                    'role_id' => $role->id,
                    'image_path' => null,
                ]);
            }
        }
    }
}
