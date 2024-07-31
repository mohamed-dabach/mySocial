<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addOrRemoveLike(Request $request)
    {
        // dd($request->user()->id, $request->post_id);
        $post_id = $request->post_id;
        $isLiked = PostLike::where('user_id', $request->user()->id)->where('post_id', $post_id)->exists();
        $lastUser = PostLike::where("post_id", $post_id)->latest()->first();
        $lastLikeCount = $lastUser->postLikeCount ?? 0;
        // dd($lastUser);
        if (!$isLiked) {
            PostLike::create([
                "user_id" => $request->user()->id,
                "post_id" => $request->post_id,
                "postLikeCount" => $lastLikeCount + 1
            ]);
        } else {
            $lastUser->delete();
        }
        return redirect()->back();
        // PostLike::create()
    }

    /**
     * Display the specified resource.
     */
    public function show(string $postId)
    {
        return  [
            'postLikeCount' => PostLike::where('post_id', $postId)->latest()->first()->postLikeCount ?? 0,
            'userLiked' =>  PostLike::where('post_id', $postId)->where('user_id', Auth::user()->id)->exists()
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostLike $postLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostLike $postLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostLike $postLike)
    {
        //
    }
}
