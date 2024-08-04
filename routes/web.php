<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\testController;
use App\Http\Controllers\UserController;

use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function () {
    Route::get("/", "index")->name("home");
});

Route::group([
    "middleware" => 'auth',
    "prefix" => 'user'
], function () {
    Route::get("/{id}/", [UserController::class, 'index'])->name("user.index");
    Route::put("", [UserController::class, "update"])->name("user.update");
});


Route::get('/user/{id}/posts', [PostController::class, 'index'])->name("user.posts");

Route::resource("posts", PostController::class)->except(['index']);

Route::post("/comment", [CommentController::class, "store"])->name("comments.save");

Route::post('likes', [PostLikeController::class, 'addOrRemoveLike'])->name('like.addOrRemoveLike');

Route::controller(AuthController::class)->group(function () {

    Route::get('/login', 'index')->middleware('guest')->name("login");
    Route::post('/login', 'check')->middleware('guest')->name("login.check");

    Route::get("/signup", "signup")->middleware('guest')->name("signup");
    Route::post("/signup", "save")->middleware('guest')->name("signup.save");

    Route::get('/forgot-password', 'passwordrequest')->middleware('guest')->name('password.request');
    Route::post('/forgot-password', 'passwordemail')->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', 'passwordreset')->middleware('guest')->name('password.reset');
    Route::post('/reset-password', 'passwordupdate')->middleware('guest')->name('password.update');

    Route::get("/logout", "logout")->name("logout");
});



Route::get("mailConfirmation/{id}/{created_at}", [MailController::class, "mailConfirmationVerify"])->name('mailConfirmation');



Route::get('token/create', function (Request $request) {
    $token = $request->user()->createToken('token-name');

    return ['token' => $token->plainTextToken];
})->middleware('auth');


Route::resource('user/tokens', ApiController::class)->only("index", 'store', 'destroy')->middleware("auth");

Route::get("contact", function () {
    return view("contact");
});


Route::resource("test/user", testController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', function () {
        return Auth::user();
    });
});
