<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FavoritePost;
use App\Models\User;
use App\Models\Post;

class FavoritePostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();

        if ($users->isEmpty() || $posts->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $randomPosts = $posts->random(rand(2, 5));

            foreach ($randomPosts as $post) {
                FavoritePost::firstOrCreate([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            }
        }
    }
}
