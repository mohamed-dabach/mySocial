<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function __construct()
    {

        $this->middleware(["auth"]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {


        $posts = Post::latest()->where("user_id", $id)->with("user")->withCount(["comments"])->paginate(10);
        $posts->each(function (&$post) {
            $postLikeinstance = new PostLikeController();
            $post->like = $postLikeinstance->show($post->id);
        });
        // dd($posts);

        return view('post.index', compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create policy
        $this->authorize("create", Post::class);
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            "title" => 'required|min:2',
            "disc" => 'required|min:2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $imageName = null;
        if ($request->hasFile("image")) {
            $image = $request->file("image");
            $imageName = str_shuffle(Str::random(10) . time())  . "." . $image->extension();
            $image->move(public_path("storage/posts"), $imageName);
            $imageName = asset('/storage/posts/' . $imageName);
        }


        $post = [...$validatedData, "user_id" => Auth::user()->id, "image" => $imageName ?? null];
        // dd($post);
        Post::create($post);

        return redirect()->route("user.posts", Auth::user()->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        $post->comments = Comment::where("post_id", $id)->latest()->with("user")->get();


        $postLikeinstance = new PostLikeController();
        $post->like = $postLikeinstance->show($id);

        return view("post.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);


        return view("post.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::user()->id;
        $toUpdatePost = Post::find($id);

        $this->authorize("update", $toUpdatePost);

        $request->validate([
            "title" => 'required|min:2',
            "disc" => 'required|min:2'
        ]);
        if ($toUpdatePost->title == $request->title && $toUpdatePost->disc == $request->disc) return back()->withErrors("You need to update the Post first!");
        $toUpdatePost->title = $request->title;
        $toUpdatePost->disc = $request->disc;
        $toUpdatePost->save();

        session()->flash("message", "Successful update");

        return redirect()->route("posts.show", $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = Auth::user()->id;
        $toDeletePost = Post::find($id);
        $this->authorize("delete", $toDeletePost);

        if ($toDeletePost?->user_id != $userId)  return back()->withErrors("You can't delete this post!");

        if (Post::destroy($id)) {
            session()->flash("message", "Successful Delete");
            return redirect("/");
        } else {
            return back()->withErrors("Couldn't delete this post, Please try again later.");
        }
    }
}
