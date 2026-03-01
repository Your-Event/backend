<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FilamentAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminType = UserType::where('name', 'Admin')->first();

        User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $adminType->id,
            'full_name' => 'Admin User',
            'email_verified_at' => now(),
        ]);
    }
}
