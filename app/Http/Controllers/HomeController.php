<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $posts = Post::latest()->with('user')->withCount(["comments"])->paginate(3);
        $posts->each(function (&$post) {
            $postLikeinstance = new PostLikeController();
            $post->like = $postLikeinstance->show($post->id);
        });
        // dd($posts);
        return view('post.index', compact("posts"));
    }
    public function profile()
    {
        return 'this is profile';
    }
}
