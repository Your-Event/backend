<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostBusyDateTime;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PostBusyDateTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Check if there are any posts
        if (Post::count() === 0) {
            $this->command->info('No posts found. Skipping PostBusyDateTime seeding.');
            return;
        }

        $posts = Post::all();
        $createdCount = 0;

        foreach ($posts as $post) {
            // Generate between 1 and 3 busy periods per post
            $periodsCount = rand(1, 3);

            for ($i = 0; $i < $periodsCount; $i++) {
                try {
                    // Ensure start date is in the future
                    $startDate = Carbon::now()->addDays(rand(1, 30));
                    // Ensure end date is after start date
                    $endDate = (clone $startDate)->addDays(rand(1, 5));

                    // Check for overlapping periods
                    $exists = PostBusyDateTime::where('post_id', $post->id)
                        ->where(function($query) use ($startDate, $endDate) {
                            $query->whereBetween('start_date', [$startDate, $endDate])
                                  ->orWhereBetween('end_date', [$startDate, $endDate])
                                  ->orWhere(function($q) use ($startDate, $endDate) {
                                      $q->where('start_date', '<=', $startDate)
                                        ->where('end_date', '>=', $endDate);
                                  });
                        })
                        ->exists();

                    if (!$exists) {
                        PostBusyDateTime::create([
                            'post_id' => $post->id,
                            'start_date' => $startDate->format('Y-m-d'),
                            'end_date' => $endDate->format('Y-m-d'),
                        ]);
                        $createdCount++;
                    }
                } catch (\Exception $e) {
                    Log::error('Error seeding PostBusyDateTime: ' . $e->getMessage());
                    $this->command->error('Error creating busy date time: ' . $e->getMessage());
                }
            }
        }

        $this->command->info("Created {$createdCount} busy date time entries.");
    }
}
