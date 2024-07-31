<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'mohamed Dabach',
            'email' => 'test@example.com',
            "password" => "123"
        ]);

        User::factory(200)->create();

        Post::factory(100)->create();

        Comment::factory(200)->create();

        // PostLike::factory(100)->create();

        Post::all()->each(function ($post) {

            $users = User::inRandomOrder()->take(rand(1, 50))->pluck('id');

            foreach ($users as $index => $userId) {
                PostLike::create([
                    'user_id' => $userId,
                    'post_id' => $post->id,
                    'postLikeCount' => $index + 1,
                ]);
            }
        });
    }
}
