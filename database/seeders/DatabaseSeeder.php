<?php

namespace Database\Seeders;

use App\Models\PostBusyDateTime;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            $this->call([
                RoleSeeder::class,
            ]);

            $this->call([
                UserSeeder::class,
            ]);

            $this->call([
                UserAddressSeeder::class,
                UserPhoneSeeder::class,
                ImageSeeder::class,
                ImagesUserSeeder::class,
            ]);

            $this->call([
                PostTypeSeeder::class,
                PostSubTypeSeeder::class,
                PriceUnitSeeder::class,
            ]);

            $this->call([
                PostSeeder::class,
                PostImageSeeder::class,
                PostBusyDateTimeSeeder::class,
                FavoritePostSeeder::class,
            ]);

            $this->command->info('All seeders completed successfully!');

        } catch (\Exception $e) {
            $this->command->error('Error running seeders: ' . $e->getMessage());
            $this->command->error('File: ' . $e->getFile() . ':' . $e->getLine());
            throw $e; // Re-throw to see the full stack trace
        }
    }
}
