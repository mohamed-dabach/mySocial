<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Stringable;
use Illuminate\Support\Str;

class UserController extends Controller
{
 
    public function index(Request $request, $id)
    {
        $s = new ApiController();
        $apiTokens = $s->index();

        $data  = User::where("id", $id)->withCount(["posts", "comments"])->get()->first();


        return view("user.profile", compact("data", "apiTokens"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->id());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Check if the entered password is correct
        if (Hash::check($request->password, $user->password)) {
            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $imageName = str_shuffle(Str::random(10) . time())  . "." . $image->extension();

                $image->move(public_path("storage"), $imageName);
                $user->profile_img = asset('/storage/' . $imageName);
            }

            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();

            return redirect()->back()->with('message', 'Profile updated successfully.');
        } else {
            return redirect()->back()->withErrors(['password' => 'Incorrect password.']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
