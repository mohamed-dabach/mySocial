<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class testController extends Controller
{
    protected $model =  User::class;

    // only crud functions

    public function index()
    {

        dd("index");
    }

    public function create()
    {
        dd("create");
    }

    public function store(Request $request)
    {
        dd("store");
    }

    public function show(User $user)
    {
        dd("show",$user);
    }


    public function edit($id)
    {
        dd("edit");
    }

    public function update(Request $request, $id)
    {
        dd("update");
    }

    public function destroy($idList)
    {
        // website.com/{idlist}
        // website.com/23,22,3,2

       Docie::destroy(explode(',',$idList));
    }
}
