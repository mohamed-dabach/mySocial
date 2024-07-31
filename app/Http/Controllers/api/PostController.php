<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostApiResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if (!$request->user()->tokenCan("Post:view")) return response()->json(["message" => "unauthorized"], 401);


        $postsQuery  = Post::where("title", 'like', '%' . $request->title . '%');
        $totalResults = $postsQuery->count();

        $limit = $request->limit ?? 10;

        $posts = $postsQuery->paginate($limit);

        return [
            "posts" => PostApiResource::collection($posts),
            "totalResults" => $totalResults,
        ];
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->user()->tokenCan("Post:create")) return response()->json(["message" => "unauthorized"], 401);
    }

    /**
     * Display the specified resource.
     */

    public function show(Post $post, Request $request)
    {
        if (!$request->user()->tokenCan("Post:view")) return response()->json(["message" => "unauthorized"], 401);

        return response()->json([
            'post' => new PostApiResource($post),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        if (!$request->user()->tokenCan("Post:delete")) return response()->json(["message" => "unauthorized"], 401);

        return $post->delete();
    }
}
