<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostImage;
use App\Models\Post;
use App\Models\Image;

class PostImageSeeder extends Seeder
{
    public function run(): void
    {
        $posts = Post::all();
        $images = Image::all();

        if ($posts->isEmpty() || $images->isEmpty()) {
            return;
        }

        foreach ($posts as $post) {
            $randomImages = $images->random(rand(1, 3));

            foreach ($randomImages as $image) {
                PostImage::firstOrCreate([
                    'post_id' => $post->id,
                    'image_id' => $image->id,
                ]);
            }
        }
    }
}
