<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Auth::user()->tokens->all();
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

        $allowedKeys = ['view', 'create', 'update', 'delete'];

        $filteredRequestData = array_map(function ($item) {
            return "Post:" . $item;
        }, array_keys(array_intersect_key($request->all(), array_flip($allowedKeys))));

        $token = $request->user()->createToken($request->name ?? "token_" . Str::random(6), $filteredRequestData)->plainTextToken;

        return redirect()->route('user.index', Auth::user()->id)->with("token", $token);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $token =  Auth::user()->tokens()->where('id', $id);
        if (!$token) abort(404);
        $token->delete();
        return redirect()->route('user.index', Auth::user()->id);
    }
}
