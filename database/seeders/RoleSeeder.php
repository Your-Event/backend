<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        try {
            $roles = ['photographer', 'DJ', 'singer'];

            foreach ($roles as $role) {
                Role::firstOrCreate(
                    ['title' => $role],
                    ['title' => $role]
                );
            }

            $this->command->info('Roles seeded successfully!');
        } catch (\Exception $e) {
            Log::error('Error seeding roles: ' . $e->getMessage());
            $this->command->error('Error seeding roles: ' . $e->getMessage());
        }
    }
}
