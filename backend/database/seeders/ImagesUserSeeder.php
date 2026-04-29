<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImagesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $images = Image::all();

        if ($users->isEmpty() || $images->isEmpty()) {
            $this->command->warn('❗️ Users կամ Images աղյուսակը դատարկ է։ Նախ ավելացրու տվյալներ։');
            return;
        }

        $pivotData = [];

        foreach ($users as $user) {
            $randomImages = $images->random(rand(1, 3));

            foreach ($randomImages as $image) {
                $pivotData[] = [
                    'user_id' => $user->id,
                    'image_id' => $image->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('images_user')->insert($pivotData);
    }
}
