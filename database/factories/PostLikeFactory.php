<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $postId = Post::all()->random()->id;
        $userId = User::all()->random()->id;

        while (PostLike::where('user_id', $userId)->where('post_id', $postId)->exists()) {
            $userId = User::all()->random()->id;
        }

        $lastPostLike = PostLike::where('post_id', $postId)->orderBy('id', 'desc')->first();
        $postLikeCount = $lastPostLike ? $lastPostLike->postLikeCount + 1 : 1;

        return [
            'user_id' => $userId,
            'post_id' => $postId,
            'postLikeCount' => $postLikeCount
        ];
    }
}
